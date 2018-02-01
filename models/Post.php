<?php

/**
 * Модель для работы с posts
 */

class Post {

    
    public static function index () {
        
        $con = Connection::make();
        //Подготавливаем данные

        $sql = "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status FROM posts ORDER BY id ASC";

        // $con->exec("set names utf8mb4");
        
        //Выполняем запрос
        $res = $con->query($sql);
        //Получаем и возвращаем результат
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);

        return $posts;

    }

    public static function store ($options) {

        $db = Connection::make();

        $sql = "INSERT INTO posts(title, content, status)
                VALUES (:title, :content, :status)";

        $res = $db->prepare($sql);

        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        //Если запрос выполнен успешно
        if ($res->execute()) {
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }

    public static function getStatusText ($status) {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    public static function searchPost ($query) {

        $db = Connection::make();

        $sql = "SELECT id, title, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date FROM posts WHERE status = 1 and ((title LIKE '%{$query}%') OR (content LIKE '%{$query}%'))";

        $res = $db->prepare($sql);
        
        $res->execute();

        $posts = $res->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

 }