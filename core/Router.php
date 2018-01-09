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

   // Определить контроллер
   $controllerName = $path;

   //Подключаем файл контроллера
   $controllerFile = CONTROLLERS . $controllerName . EXT;

   if(file_exists($controllerFile)){
     include_once($controllerFile);
     $result = true;
     }

   if($result !== null)
     break;
    }
}
   
if($result === null){
     require_once VIEWS.'404'.EXT;
}

