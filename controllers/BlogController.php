<?php

class BlogController
{

public function index()
    {   
        $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
        or die("Ошибка " . mysqli_error($conn));
        $posts = [];
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($conn, $sql);
        $resCount = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
                array_push($posts, $row);
            }
        // закрываем подключение
        mysqli_close($conn);

        render('blog/index', ['title'=>'Our <b>Cats Blog</b>', 'posts'=>$posts, 'resCount'=>$resCount]);
    }
}