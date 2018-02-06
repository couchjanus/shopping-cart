<?php

if (function_exists('date_default_timezone_set')){
    date_default_timezone_set('Europe/Kiev');
}


// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

ob_start();

require_once realpath(__DIR__).'/../config/app.php';
require_once MODELS.'Category.php';
require_once MODELS.'Product.php';
require_once MODELS.'Post.php';
require_once CORE.'Connection.php';
require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Request.php';
require_once CORE.'Router.php';

$routesFile = CONFIG.'routes.php';

Router::load($routesFile)
    ->directPath(Request::uri());
