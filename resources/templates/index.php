<!doctype html>
<html lang="@LANG@">
<head>
    <meta charset="@CHARSET@">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Potato - Simple Php MVC application skeleton</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            font-family: "Open Sans", serif;
            text-shadow: 0 1px 2px #ce9d74;
            text-transform: uppercase;
            user-select: none;
            margin-bottom: 50px;
        }
        .wrapper h2 {
            color: #3b007b;
        }
        .wrapper span {
            color: #3b007b;
            font-weight: bold;
        }
        .wrapper img {
            max-width: 270px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <img src="/imgs/branding.png">
        <h2>
            Potato would like to present
        </h2>
        <br>
        <?php
            echo $name;
        ?>
        <span>your brand new @APP_NAME@ application ready to use!</span>
    </div>
</body>
</html>