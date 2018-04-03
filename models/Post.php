<?php

/**
 * Модель для работы с posts
 * 
*/

class Post
{

    const SHOW_BY_DEFAULT = 4;

    public static function index() 
    {
        $con = Connection::make();
        // $con->exec("set names utf8");
        $sql = "SELECT id, title, slug, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status FROM posts ORDER BY id ASC";
        $res = $con->query($sql);
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public static function show($id)
    {
        $con = Connection::make();
        // $con->exec("set names utf8");
        $sql = "SELECT * FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public static function store($options) 
    {

        $db = Connection::make();
        // $con->exec("set names utf8");
        $sql = "INSERT INTO posts(title, slug, content, status)
                VALUES (:title, :slug, :content, :status)";
        $res = $db->prepare($sql);
        
        $slug = Slug::makeSlug($options['title'], array('transliterate' => true));
        
        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':slug', $slug, PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        //Если запрос выполнен успешно
        if ($res->execute()) {
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }


    // public static function store($options) 
    // {

    //     $db = Connection::make();
    //     $con->exec("set names utf8");
    //     $sql = "INSERT INTO posts(title, content, status)
    //             VALUES (:title, :content, :status)";
    //     $res = $db->prepare($sql);
    //     $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
    //     $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
    //     $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

    //     //Если запрос выполнен успешно
    //     if ($res->execute()) {
    //         return $db->lastInsertId();
    //     } else {
    //         return 0;
    //     }
    // }


    public static function getStatusText($status) 
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    public static function lastId() 
    {
        
        $con = Connection::make();
        $res = $con->prepare("SELECT id FROM posts ORDER BY id DESC LIMIT 1");
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC)['id'];

    }

    public static function getPostById($postId) 
    {
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $postId, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public static function getPostBySlug($slug) 
    {
        $con = Connection::make();
        
        $sql = "SELECT * FROM posts WHERE slug = :slug";
        $res = $con->prepare($sql);
        $res->bindParam(':slug', $slug, PDO::PARAM_STR);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }
    
    public static function update($id, $options) 
    {

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

    /**
     * Получаем последние Posts
     *
     * @param int $page
     * @return array
     */
    public static function getLatestPosts($page = 1) 
    {

        $limit = self::SHOW_BY_DEFAULT;
        //Задаем смещение
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $con = Connection::make();
        $con->exec("set names utf8mb4");

        $sql = "SELECT id, 
                       title, 
                       content, 
                       DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s')AS formated_date, 
                       status
                  FROM posts
                  WHERE status = 1
                  ORDER BY id DESC
                  LIMIT :limit OFFSET :offset
                ";

        //Подготавливаем данные
        $res = $con->prepare($sql);
        $res->bindParam(':limit', $limit, PDO::PARAM_INT);
        $res->bindParam(':offset', $offset, PDO::PARAM_INT);

        //Выполняем запрос
        $res->execute();
        //Получаем и возвращаем результат
        $postList = $res->fetchAll(PDO::FETCH_ASSOC);
        return $postList;
    }


    public static function getTotalPosts() 
    {

        // Соединение с БД
        $db = Connection::make();
        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM posts WHERE status=1 ";
        // Выполнение коменды
        $res = $db->query($sql);
        // Возвращаем значение count - количество
        $row = $res->fetch();
        return $row['count'];
    }

    public static function searchPost($query) 
    {
        $db = Connection::make();
        $sql = "SELECT id, title, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date FROM posts WHERE status = 1 and ((title LIKE '%{$query}%') OR (content LIKE '%{$query}%'))";
        $res = $db->prepare($sql);
        $res->execute();
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

}
