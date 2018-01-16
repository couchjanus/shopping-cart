<?php
 
class MyClass
{
  // Class properties and methods go here
}

// $instance = new MyClass();

// Это же можно сделать с помощью переменной:

$className = 'MyClass';

$instance = new $className(); // new MyClass()
 
var_dump($instance);
