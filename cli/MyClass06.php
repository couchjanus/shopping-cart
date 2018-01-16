<?php
 
class MyClass
{
    public $bar = 'свойство';
    
    public function bar() {
        return 'метод';
    }
}

$obj = new MyClass();

echo $obj->bar, PHP_EOL, $obj->bar(), PHP_EOL;

