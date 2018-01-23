<?php

$filename = CONFIG.'routes'.EXT;

$result = null;

// if (file_exists($filename)) {
//     $routes = include($filename);
// } else {
//     echo "Файл $filename не существует";
// }

if (file_exists($filename)) {
    define('ROUTES',include($filename));
} else {
    echo "Файл $filename не существует";
}


function getURI(){
    if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
        return trim($_SERVER['REQUEST_URI'], '/');
}

function directPath($uri)
    {
      // Проверить наличие такого запроса в routes.php
        if (array_key_exists($uri, ROUTES)) {
            return ROUTES[$uri];
        }
        Throw new Exception('No route defined for this URI.');
    }


//получаем строку запроса

$uri = getURI();

$path = directPath($uri);


list($segments, $action) = explode('@', $path);

$segments = explode('\\', $segments);
// 

$controller = array_pop($segments);

$controllerFile = '';

do {
    if(count($segments)==0){
       $controllerFile = CONTROLLERS .$controllerFile.$controller . EXT;
       break;
    }
    else{
        $segment = array_shift($segments);
        $controllerFile = $controllerFile.$segment.'/';
    }
}while ( count($segments) >= 0);

//Подключаем файл контроллера

    try {
      include_once($controllerFile);
      $controller = new $controller;

      try {
          // код который может выбросить исключение
          $controller->$action();  
          $result = true;
      } catch (Exception $e) {

        $result = false;
          // код который может обработать исключение
        if (! method_exists($controller, $action)) {
          throw new Exception(
          "{$controller} does not respond to the {$action} action."
          );
        }
      }
    } 
    catch (Exception $e) {
        // код который может обработать исключение
        // если конечно оно появится
        $result = false;
        if (! file_exists($controllerFile)) {
          throw new Exception("{$controllerFile} does not respond.");
      }
    }
    finally{
      return  $result;
    } 


// Проверить наличие такого запроса в routes

// foreach ($routes as $uriPattern => $path) {

//  //Сравниваем uriPattern и $uri
//  if($uriPattern == $uri){

//    $segments = explode('@', $path);
//    $controller = array_shift($segments);
//    $action = array_shift($segments);
   
//    // Определить контроллер
   
//    //Подключаем файл контроллера
//    $controllerFile = CONTROLLERS . $controller . EXT;

//     try {
     
//       include_once($controllerFile);

//       $controller = new $controller;

//       try {
//           // код который может выбросить исключение
//           $controller->$action();  
//       } catch (Exception $e) {
//           // код который может обработать исключение
//           // если конечно оно появится
//         if (! method_exists($controller, $action)) {
//           throw new Exception(
//           "{$controller} does not respond to the {$action} action."
//           );
//         }
//       }
      
//       $result = true;
//       break; 
//     } 
//     catch (Exception $e) {
//         // код который может обработать исключение
//         // если конечно оно появится
//         if (! file_exists($controllerFile)) {
//           throw new Exception("{$controllerFile} does not respond.");
//       }
//     } 

//    //  
//   }
// }
   
// if($result === null){
//      require_once VIEWS.'404'.EXT;
// }

if(!$result){
     require_once VIEWS.'404'.EXT;
}
