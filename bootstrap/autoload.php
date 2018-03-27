<?php
// подключаем файлы ядра
function autoloadsystem($class) {
    $filename = CORE .  $class . EXT;
    if(file_exists($filename)){
       require_once $filename;
    }
    $filename = MODELS . $class . EXT;
    if(file_exists($filename)){
       require_once $filename;
    }
 }
