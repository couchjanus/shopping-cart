<?php

switch ($_SERVER['REQUEST_URI']) {

    case '/':
        # code...
        require_once CONTROLLERS.'HomeController.php';
        break;

    case '/about':
        # code...
        require_once CONTROLLERS.'AboutController.php';;
        break;

    default:
        # code...
        echo "<h1>404</h1>";
}
