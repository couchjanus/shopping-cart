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


// // Basic usage
// echo "This is an example string. Nothing fancy." . "\n";
// echo Slug::makeSlug("This is an example string. Nothing fancy.") . "\n\n";

// // Example using transliteration
// echo "Что делать, если я не хочу, UTF-8?" . "\n";
// echo Slug::makeSlug("Что делать, если я не хочу, UTF-8?", array('transliterate' => true)) . "\n\n";

// // Some other options
// echo "This is an Example String. What's Going to Happen to Me?" . "\n";

// echo Slug::makeSlug(
// 	"This is an Example String. What's Going to Happen to Me?", 
// 	array(
// 		'delimiter' => '_',
// 		'limit' => 40,
// 		'lowercase' => false,
// 		'replacements' => array(
// 			'/\b(an)\b/i' => 'a',
// 			'/\b(example)\b/i' => 'Test'
// 		)
// 	)
// );

$app = new App();
$app->init();
