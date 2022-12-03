<?php

use Illuminate\Database\Eloquent\Model;

error_reporting(0);
if (isset($argv[1])) {

    $mainProperty = $argv[1];
    $secondProperty = null;
    $sufix = null;

    if (isset($argv[2])) {
        $secondProperty = $argv[2];
    }

    if (isset($argv[3])) {
        $sufix = $argv[3];
    }

    if ($mainProperty === 'serve') {
        echo `php -S localhost:8001 -t public/`;
    } else {
        execute($mainProperty, $secondProperty, $sufix);
    }


} else {
    printDescription();
}

/**
 * It prints the word "Description" to the screen
 */
function printDescription() {
    echo "Description";
}

function checkDir($path, $name) {
    $path = $path . $name . '.php';
    return file_exists($path);
}

function createController($name, $sufix = null) {
    if (checkDir('app/Controllers/', $name . $sufix)) {
        echo "{$name}{$sufix} already exist!";
        return false;
    };

    try {
        $file = @fopen("app/Controllers/{$name}{$sufix}.php", "w");
        $generatedName = $name . $sufix;
        $content = "<?php\nnamespace App\Controllers;\nuse App\Controllers\Controller;\nuse Psr\Container\ContainerInterface;\nuse Psr\Http\Message\ResponseInterface;\nuse Psr\Http\Message\ServerRequestInterface;
    
class $generatedName extends Controller
{
    // Your code goes here
}
        ";
            fwrite($file, $content);
            fclose($file);
            echo "Controller $generatedName created at App\Controllers";
        } catch(TypeError $e) {
            echo "Something goes wrong, error code {$e->getCode()}";
        }

}

function createModel($name, $sufix = null) {
    if (checkDir('app/Models/', $name . $sufix)) {
        echo "{$name}{$sufix} already exist!";
        return false;
    };

    try {
        $file = @fopen("app/Models/{$name}{$sufix}.php", "w");
        $generatedName = $name . $sufix;
        $table = '$table';
        $content = "<?php\nnamespace App\Models;\nuse Illuminate\Database\Eloquent\Model;\n

class $generatedName extends Model
{
    /**
     * @var string
     */
    protected $table = '';
}
        ";
        fwrite($file, $content);
        fclose($file);
        echo "Model $generatedName created at App\Models";
    } catch(TypeError $e) {
        echo "Something goes wrong, error code {$e->getCode()}";
    }

}

function createMigration($name, $sufix = null) {
    try {
        echo `php vendor/bin/phinx create {$name}`;
    } catch(TypeError $e) {
        echo "Something goes wrong, error code {$e->getCode()}";
    }

}

/**
 * > It takes three arguments, the first one is mandatory, the second and third are optional. It returns a boolean value
 *
 * @param mainProperty The first parameter that is passed to the command.
 * @param secondProperty The name of the class you want to create.
 * @param sufix This is the sufix of the file.
 *
 * @return bool A boolean value.
 */
function execute($mainProperty, $secondProperty = null, $sufix = null): bool
{
    $parsed = explode(':', $mainProperty);
    if ($parsed[0] === 'c') {
        switch($parsed[1]) {
            case 'controller':
                createController($secondProperty, $sufix);
                return true;
                break;
            case 'model':
                createModel($secondProperty, $sufix);
                break;
            case 'migration':
                createMigration($secondProperty, $sufix);
                break;
            default:
                printDescription();
                return false;
        };
    }
    return false;
}