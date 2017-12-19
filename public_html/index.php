<?php

// require_once realpath(__DIR__).'/../bootstrap/bootstrap.php';

      echo "Имя сервера - ".$_SERVER['SERVER_NAME']."<br />";
      echo "IP-адрес сервера - ".$_SERVER['SERVER_ADDR']."<br />";
      echo "Порт сервера - ".$_SERVER['SERVER_PORT']."<br />";
      echo "Web-сервер - ".$_SERVER['SERVER_SOFTWARE']."<br />";
      echo "Версия HTTP-протокола - ".$_SERVER['SERVER_PROTOCOL']."<br />";
      echo "Маршрут - ".$_SERVER['REQUEST_URI']."<br />";


// switch ($_SERVER['REQUEST_URI']) {

//     case '/':
//         # code...
//         include realpath(__DIR__).'/../views/home/index.php';
//         break;

//     case '/about':
//         # code...
//         include_once realpath(__DIR__).'/../views/home/about.php';
//         break;

//     default:
//          echo "<h1>404</h1>";
// }
