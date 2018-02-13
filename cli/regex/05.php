<?php


// create a string
$string = 'ab-ce*fg@ hi & jkl(mnopqr)stu+vw?x yz0>1234<567890';
 
// match our pattern containing a special sequence
preg_match_all("/[\w]/", $string, $matches);
 
// loop through the matches with foreach
foreach ($matches[0] as $value) {
    echo $value;
}

echo "\n";

// create a string
$string = '2 bad for perl';
 
// echo our string
if (preg_match("/^\d/", $string)) {
    echo 'String begins with a number';
} else {
    echo 'String does not begin with a number';
}
echo "\n";

// create a string
$string = 'abcdefghijklmnopqrstuvwxyz0123456789';
 
// try to match our pattern
if (preg_match("/^ABC/i", $string)) {
    echo 'Совпадение, строка начинается с abc';
} else {
    echo 'Не думаю';
}

echo "\n";

$string = 'We will replace the word foo';
 
// заменяем `for` на `bar`
$string = preg_replace("/foo/", 'bar', $string);
 
echo $string;

echo "\n";


// заменяем все цифры помещенные в скобки на звездочки.


$str = "(945)-55-34-33(02)";
$arr_str = preg_replace("/\([0-9]+\)/", "***",$str);
print_r ($arr_str);
echo "\n";

// заменяем строку соответствующую всему шаблону, данными 
// соответствующими первой подмаске по ссылке \$1. 

// "have 3 apples", соответствующие "/(\w+) (\d+) (\w+)/", 
// будет заменено на "have", соответствующее (\w+).


$str = "I have 3 apples";
$pattern = "/(\w+) (\d+) (\w+)/";
$replacement = "\$1";
echo preg_replace($pattern, $replacement, $str);
echo "\n";


$string = "Вырезаем повторяющиеся многократно символы .......... или ??????? или )))))))) или !!!!!!!! или ((((((((";
echo $string;

echo "\n";

function cleanText($text){
    $text = preg_replace("#(\.|\?|!|\(|\)){3,}#", "\$1 ", $text);
    return $text;
}

echo cleanText($string);

echo "\n";

$string = '<br> We will<br> replace<br> the word foo';

echo preg_replace("/<br(\s*+)?\/?\>/i", "\n", $string);

echo "\n";