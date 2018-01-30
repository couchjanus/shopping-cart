<?php

class BlogController extends Controller
{

public function index () {
        $db = Connection::make();
        $sql = "SELECT * FROM posts ORDER BY id ASC";
        $res = $db->query($sql);
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        $data['title'] = 'Blog Page ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['posts'] = $posts;
        $this->_view->render('blog/index', $data);
    }
}