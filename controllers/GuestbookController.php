<?php

if (!empty($_POST)) {
    
    if ( !$_POST['username'] or !$_POST['email'] or !$_POST['comment']){
        echo "<b>please complete all the fields</b><br><br>";
    }
    else{
        // подключаемся к серверу
        $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
        or die("Ошибка " . mysqli_error($conn));


        $username = mysqli_real_escape_string ($conn, $_POST['username']);
        $email = mysqli_real_escape_string ($conn, $_POST['email']);
        $comment = mysqli_real_escape_string ($conn, $_POST['comment']);

        // выполняем операции с базой данных

        $sql = "INSERT INTO guestbook (username, email, comment) VALUES ('$username', '$email', '$comment')";

        mysqli_query($conn, $sql) or die("Ошибка: " . mysqli_error($conn));
        mysqli_close($conn);
    }
    
}

$conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
        or die("Ошибка " . mysqli_error($conn));

$comments = [];

$sql = "SELECT * FROM guestbook";

$result = mysqli_query($conn, $sql);

$resCount = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result)){
        array_push($comments, $row);
    }

// закрываем подключение
mysqli_close($conn);

require_once VIEWS.'guestbook/index.php';