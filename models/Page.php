<?php

class Page implements StaticPage {

    public static function findBySlug($slug)
    {
        $db = Connection::make();
        $sql = "SELECT * FROM pages WHERE slug = :slug";
        $res = $db->prepare($sql);
        $res->bindParam(':slug', $slug);
        $res->execute();
        $page = $res->fetch(PDO::FETCH_ASSOC);
        return $page;
    }

    public static function index () {
        $db = Connection::make();
        $sql = "SELECT * FROM pages ORDER BY slug ASC";
        $res = $db->query($sql);
        $pages = $res->fetchAll(PDO::FETCH_ASSOC);
        return $pages;
    }

    public static function delete ($id) {
        $db = Connection::make();
        $sql = "DELETE FROM pages WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    public static function add ($options) {
        $db = Connection::make();
        $sql = "INSERT INTO pages(slug, title, article, description, tags)
                VALUES (:slug, :title, :content, :description, :tags)";
        $res = $db->prepare($sql);
        $title_slug = Slug::makeSlug($options['title']);
        $res->bindParam(':slug', $title_slug, PDO::PARAM_STR);
        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res->bindParam(':tags', $options['tags'], PDO::PARAM_STR);
        return $res->execute();
    }

    public static function get ($id) {
        $db = Connection::make();
        $sql = "SELECT * FROM pages
                WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id);
        $res->execute();
        $page = $res->fetch(PDO::FETCH_ASSOC);
        return $page;
    }

    public static function update ($id, $options) {
        $db = Connection::make();
        $sql = "UPDATE pages
                SET
                    title = :title,
                    slug = :slug,
                    article = :content,
                    description = :description,
                    tags = :tags
                WHERE id = :id"; 
        $res = $db->prepare($sql);
        $title_slug = Slug::makeSlug($options['title']);
        $res->bindParam(':slug', $title_slug, PDO::PARAM_STR);
        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res->bindParam(':tags', $options['tags'], PDO::PARAM_STR);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }
}
