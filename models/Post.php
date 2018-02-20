<?php

/**
 * Модель для работы с posts
 * 
*/

class Post {

    public static function index() 
    {
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status FROM posts ORDER BY id ASC";
        $res = $con->query($sql);
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public static function show($id){
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public static function store ($options) {

        $db = Connection::make();
        $con->exec("set names utf8");
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

    public static function lastId () {
        
        $con = Connection::make();
        $res = $con->prepare("SELECT id FROM posts ORDER BY id DESC LIMIT 1");
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC)['id'];

    }

    public static function getPostById ($postId) {

        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $postId, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    
    public static function update ($id, $options) {

        $con = Connection::make();

        $sql = "
                UPDATE posts
                SET
                    title = :title,
                    content = :content,
                    status = :status
                WHERE id = :id
                ";

        $res = $con->prepare($sql);

        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        $res->execute();
    }
    
    public static function destroy($resource, $id) 
    {
        $con = Connection::make();
        $sql = "DELETE FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        Meta::destroy($resource, $id);
        return $res->execute();
    }

 }
