<?php

/**
 * Модель для работы с Gallery
 * 
*/

class Gallery
{

    const SHOW_BY_DEFAULT = 4;

    public static function index() 
    {
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM galleries ORDER BY id ASC";
        $res = $con->query($sql);
        $pictures = $res->fetchAll(PDO::FETCH_ASSOC);
        return $pictures;
    }

    public static function show($id)
    {
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM galleries WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $picture = $res->fetch(PDO::FETCH_ASSOC);
        return $picture;
    }

    public static function store($options) 
    {

        $db = Connection::make();
        $db->exec("set names utf8");
        $sql = "INSERT INTO galleries(title, description)
                VALUES (:title, :description)";
        $res = $db->prepare($sql);
        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        
        //Если запрос выполнен успешно
        if ($res->execute()) {
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }

    public static function lastId() 
    {
        $con = Connection::make();
        $res = $con->prepare("SELECT id FROM galleries ORDER BY id DESC LIMIT 1");
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC)['id'];

    }

    public static function getPictureById($id) 
    {
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM galleries WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $picture = $res->fetch(PDO::FETCH_ASSOC);
        return $picture;
    }

    
    public static function update($id, $options) 
    {

    }
    
    public static function destroy($id) 
    {
        $con = Connection::make();
        $sql = "DELETE FROM galleries WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

}
