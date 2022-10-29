<?php
namespace App\Handlers;
use Slim\Interfaces\ErrorRendererInterface;
use Throwable;

/* Implementing the ErrorRendererInterface. */
class ErrorRenderer implements ErrorRendererInterface
{
    /**
     * It takes the exception, and displays it in a nice, readable format
     *
     * @param Throwable exception The exception that was thrown
     * @param bool displayErrorDetails This is a boolean value that determines whether or not the error details are
     * displayed.
     */
    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        $error = $exception->getMessage();
        $file = $exception->getFile();
        $trace = $exception->getTrace();
        $code = $exception->getPrevious();
        $line = $exception->getLine();
        $codeSection = $this->getCodeFromFile($file, end($trace), $line);

        $content = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Oh My Fries!</title>
            <script src='//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js'></script>
             <style>
                body {
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    align-items: center;
                    min-height: 100vh;
                    background-color: #ffd26f;
                    padding: 0;
                    margin: 0;
                }
                .wrapper {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    font-family: 'Open Sans', serif;
                    margin-top: 20px;
                    max-width: 60%;
                }
                .wrapper h2 {
                    text-transform: uppercase;
                    user-select: none;
                    color: #3b007b;
                    text-shadow: 0 1px 2px #ce9d74;
                }
                .wrapper span {
                    color: #3b007b;
                    display: inline-block;
                    width: 100%;
                }
                .title {
                    user-select: none;
                    font-weight: bold; 
                    text-transform: uppercase;
                }
                .content {
                    width: 100%;
                    margin: 10px;
                    padding: 10px;
                    background-color: #2d3a41;
                    border-radius: 5px;
                    word-break: break-all;
                    font-size: 0.8rem;
                    color: #fff!important;
                    text-shadow: unset;
                }
                .content p {
                    font-size: 0.8rem;
                }
                .wrapper img {
                    user-select: none;
                    max-width: 130px;
                }
                
                .code {
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 0.8rem!important;
                    border: 0!important;
                }
                
                .code td {
                    vertical-align: middle;
                    padding: 0 5px 5px 0;
                    font-size: 0.8rem!important;
                    background-color: #2d3a41!important;
                    color: #fff!important;
                }
                
                .code-line {
                    max-width: 40px;
                }
                
                .code-content {
                    padding-left: 10px;
                }
                .code td.red {
                    background-color: #6c4040!important;
                }
            </style>
        </head>
            <body>
            <div class='wrapper'>
                <img src='imgs/branding.png' alt='Potato'>
                <h2>Oh my fries!</h2>
                <br>
                <span class='title'>Error:</span>
                <span class='content'>$error</span>
                <br>
                <span class='title'>File:</span>
                <span class='content'>$file</span>
                <br>
                {$codeSection}
                <br>
                <span class='title'>Trace:</span>
                <span class='content'>
                {$this->renderTrace($trace)}
                </span>
            </div>
            </body>
        </html>
        ";
        if ($_ENV['MODE'] === 'development') {
            echo $content;
        } else {
            echo "Error";
        }
    }

    /**
     * It takes an array of stack trace information and returns a string of HTML
     *
     * @param trace The trace array from the exception
     *
     * @return The file and line number of the error.
     */
    public function renderTrace($trace)
    {
        $content = '';
        foreach ($trace as $t) {
            $content .= ($t['file']) ? "<p>{$t['file']} [{$t['line']}]</p>" : '';
        }

        return $content;
    }

    /**
     * It takes a file name, a file array, and a line number, and returns a string of HTML
     *
     * @param fileName The file name of the file that contains the error.
     * @param file The file that the error occurred in.
     * @param line The line number of the error
     *
     * @return string The code from the file that is being called.
     */
    public function getCodeFromFile($fileName, $file, $line): string
    {

        $raw = file_get_contents($fileName);
        $code = explode("\n", $raw);

            $start = ($file['line'] >= 8) ? $file['line'] - 16 : 0;

        $end = $file['line'] + 8;

        $parsed = [];

        for($x = $start; $x < $end; $x++) {
            $parsed[] = $code[$x];
        }

        $content = "
                <br>
                <span class='title'>Code</span>
                <pre class='content'>
                <table class='code' style='border: 0'>
        ";

        foreach ($parsed as $p) {
            $start++;
            $code = htmlspecialchars($p);
            if ($code === '') {
                continue;
            }

            $error = '';

            if ($start === $line) {
                $error = 'red';
            }

            $content .= "<tr><td class='code-line {$error}'>{$start}</td><td class='code-content {$error}'>{$code}</td></tr>";
        }

        $content .= "</table></pre>";

        return $content;
    }
}