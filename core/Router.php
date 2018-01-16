<?php

function getURI(){
    if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
        return trim($_SERVER['REQUEST_URI'], '/');
}


//получаем строку запроса

$uri = getURI();


$filename = CONFIG.'routes'.EXT;

if (file_exists($filename)) {
    $routes = include($filename);
} else {
    echo "Файл $filename не существует";
}


// Проверить наличие такого запроса в routes

foreach ($routes as $uriPattern => $path) {

 //Сравниваем uriPattern и $uri
 if($uriPattern == $uri){

   // $segments = explode('@', $path);
   // $controller = array_shift($segments);
   // $action = array_shift($segments);
   
   // Определить контроллер

   $controller = $path;

   //Подключаем файл контроллера
   $controllerFile = CONTROLLERS . $controller . EXT;

   if(file_exists($controllerFile)){
     include_once($controllerFile);

     $result = true;

     $controller = new $controller;

     // if (! method_exists($controller, $action)) {
     //  throw new Exception(
     //  "{$controller} does not respond to the {$action} action."
     //  );
     //  }
     //  else{
     //   $controller->$action();  
     //  }
     break;
     }

    // try {
     
    //   include_once($controllerFile);

    //   $controller = new $controller;

    //   try {
    //       // код который может выбросить исключение
    //       $controller->$action();  
    //   } catch (Exception $e) {
    //       // код который может обработать исключение
    //       // если конечно оно появится
    //     if (! method_exists($controller, $action)) {
    //       throw new Exception(
    //       "{$controller} does not respond to the {$action} action."
    //       );
    //     }
    //   }
      
    //   $result = true;
    //   break; 
    // } 
    // catch (Exception $e) {
    //     // код который может обработать исключение
    //     // если конечно оно появится
    //     if (! file_exists($controllerFile)) {
    //       throw new Exception("{$controllerFile} does not respond.");
    //   }
    // } 

   //  
  }
}
   
if($result === null){
     require_once VIEWS.'404'.EXT;
}
