<?php


// Нахождение начала строки

// Теперь мы желаем узнать, начинается ли строка с 'posts'.
// Символ начала строки в регулярках - '^' (caret - знак вставки).
 
// тест на начало строки
$string = 'posts/1';

if(preg_match("/^posts/", $string))
{
    // окей, строка начинается с posts
    echo "\nThe string begins with posts\n";
   
}
else
{
    echo "\nThe string doesn't begin with posts\n";
}


// регистр символов (строчные-прописные)


if(preg_match("/^POSTS/", $string))
{
    // окей, строка начинается с posts
    echo "\nThe string begins with POSTS\n";
   
}
else
{
    echo "\nThe string doesn't begin with POSTS\n";
}


// Чтобы найти оба варианта, нужно использовать модификатор 'i', 
// который нужно указать за закрывающим разделителем регулярного выражения.

if(preg_match("/^POSTS/i", $string))
{
    // окей, строка начинается с posts
    echo "\nThe string begins with POSTS\n";
   
}
else
{
    echo "\nThe string doesn't begin with POSTS\n";
}

