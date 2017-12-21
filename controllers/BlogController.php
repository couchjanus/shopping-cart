<?php

/*
Ten Little Niggers

Ten little nigger boys went out to dine;
One choked his little self, and then there were nine.


Nine little nigger boys sat up very late;
One overslept himself, and then there were eight.

Kight little nigger boys travelling in Devon;
One said he?d stay there, and then there were seven.

Seven little nigger boys chopping up sticks;
One chopped himself in half, and then there were six.

Six little nigger boys playing with a hive;
A bumble-bee stung one, and then there were five.

Five little nigger boys going in for law;
One got in chancery, and then there were four.

Four little nigger boys going out to sea;
A red herring swallowed one, and then there were three.

Three little nigger boys walking in the Zoo;
A big bear hugged one, and then there were two.

Two little nigger boys sitting in the sun;
One got frizzled up, and then there was one.

One little nigger boy left all alone;
He went out and hanged himself and then there were None.

*/


$arr1 = ['went out to dine', 'sat up very late', 'travelling in Devon', 'chopping up sticks', 'playing with a hive', 'going in for law', 'going out to sea', 'walking in the Zoo', 'sitting in the sun', 'left all alone'];

$arr2 = ['One choked his little self', 'One overslept himself', 'One said he?d stay there', 'One chopped himself in half', 'A bumble-bee stung one', 'One got in chancery', 'A red herring swallowed one', 'A big bear hugged one', 'One got frizzled up', 'He went out and hanged himself'];

$str1 = ' little nigger boys ';
$str2 = ', and then there were ';
$str3 = ', and then there was ';
$str4 = 'None';

$arr3 = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

$rhyme = [];


for($i=0, $j = 9; $i<count($arr3); $i++, $j--){

    $t = $arr3[$j].$str1.$arr1[$i];
    $c = $arr3[$j].$str1.$arr1[$i].'<br>'.$arr2[$i].$str2.$arr3[$j-1];
    array_push($rhyme, [$t, $c]);
    
}

 require_once VIEWS.'blog/index.php';