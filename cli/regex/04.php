<?php

// строка для испытаний

$string = 'posts?id=1';


if(preg_match("/posts\?id=1\z/", $string))
{
    echo 'The string endins with id=1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with id=1\n";
}

// create a string
$string = '1234-5678';
 
// look for a match
echo preg_match("/1234-?5678/", $string, $matches);
echo "\n";

$string = 'posts/1';
 
// Ищем шаблон
echo preg_match("/[1234567890]$/", $string, $matches);

echo "\n";

// Ищем шаблон
echo preg_match("/[0-9]$/", $string, $matches);

echo "\n";

// Ищем одиночный символ
$string = 'regex';
 
echo preg_match("/r.g/", $string, $matches);

echo "\n";

$string = 'regex rtgen regreg';

echo preg_match_all("/r.g/", $string, $matches);
echo "\n";


// create a string
$string = 'php';
 
// look for a match
echo preg_match("/ph*p/", $string, $matches);
echo "\n";

// create a string
$string = 'pp';
 
// look for a match
echo preg_match("/ph+p/", $string, $matches);
echo "\n";

// create a string
$string = 'PHP123';
 
// look for a match
echo preg_match("/PHP[0-9]{3}/", $string, $matches);
echo "\n";
