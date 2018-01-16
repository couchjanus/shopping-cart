<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
$instance = new MyClass;
 
echo $instance->getProperty(); // Get the property value
 
$instance->setProperty("I'm a new property value!"); // Set a new one
 
echo $instance->getProperty(); // Read it out again to show the change

// var_dump($instance);
