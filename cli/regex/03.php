<?php

 
// тест на конец строки

$string = "posts";
if(preg_match("/^posts$/", $string))
{
    echo 'The string endins with posts';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with POSTS\n";
}

$string = "posts/1";
if(preg_match("/1$/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

// использовать утверждение \z

$string = "posts/1";
if(preg_match("/1\z/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

$string = "posts/1\n";
if(preg_match("/1\z/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

if(preg_match("/1$/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}
