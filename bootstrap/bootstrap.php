<?php

// Общие настройки

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Europe/Kiev');
}


ini_set('display_errors', 1);
error_reporting(E_ALL);

ob_start();

require_once realpath(__DIR__).'/../config/app.php';


require_once realpath(__DIR__).'/./autoload.php';
// Регистрируем автозагрузчик
spl_autoload_register("autoloadsystem");

// Регистрируем twig

require_once realpath(__DIR__).'/../Twig/Autoloader.php';
Twig_Autoloader::register();


$app = new App();
$app->init();
