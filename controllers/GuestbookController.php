<?php

// $handle = fopen(DB."comments", "rt");

// $comments = '';

// while (!feof($handle))
//     $comments .= fread($handle, 4096);
// fclose($handle);

// $comments = file_get_contents(DB."comments");

// $comments = str_replace("\n","<br />\n", htmlspecialchars(implode("\n", file( DB."comments" ) )) );

// $file = file( DB."comments" );

// $count=count($file);

// $comments = str_replace("\n","<br />\n", htmlspecialchars(implode("\n", $file )) );

// if ($_POST) {
//     echo '<br><br><br><br><br><br>';
//     echo '<pre>';
//     echo htmlspecialchars(print_r($_POST, true));
//     echo '</pre>';
// }

// if (!empty($_POST)) {
//     echo '<br><br><br><br><br><br>';
//     echo '<pre>';
//     if ( !$username or !$email or !$comments){
//         echo "<b>please complete all the fields</b><br><br>";
//     }
//     else{
//         echo htmlspecialchars(print_r($_POST, true));
//     }
//     echo '</pre>';
// }


// add comment to comments.txt


// if (!empty($_POST)) {
    
//     if ( !$_POST['username'] or !$_POST['email'] or !$_POST['comment']){
//         echo "<b>please complete all the fields</b><br><br>";
//     }
//     else{
//         $fields = [];

//         $username = $_POST['username'];

//         array_push($fields,$username); 
//         $email = $_POST['email'];
//         array_push($fields,$email); 
//         $comment = $_POST['comment'];
//         array_push($fields,$comment); 
//         $appended_at = date("Y-m-d");
//         array_push($fields,$appended_at); 
//         // $appended_at =  date("Y/m/d");
//         // $appended_at =  date("Y.m.d");
//         // $appended_at =  date("Y-m-d");
//         // $appended_at =  date("l");

//         $handle = fopen(DB."comments.csv", "a+");

//         $string = $username.":".$email.":".$comment.":".$appended_at."\r\n";

//         // fwrite($handle, $string);

//         // file_put_contents(DB."comments.csv", $string, FILE_APPEND);

//         fputcsv($handle, $fields, ':');

//         fclose($handle);

//     }
    
// }

//     $comments = [];

//     $handle = fopen(DB."comments.csv", "rt");


//     while (($row = fgetcsv($handle , 10000, ":")) !== FALSE) 
//     { 
//         array_push($comments,$row); 
        
//     } 

//     fclose($handle); 


require_once VIEWS.'guestbook/index.php';