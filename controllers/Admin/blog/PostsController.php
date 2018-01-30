<?php

class PostsController extends Controller {

    public function index () {
        $db = Connection::make();
        $sql = "SELECT * FROM posts ORDER BY id ASC";
        $res = $db->query($sql);
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        $data['title'] = 'Admin Post List Page ';
        $data['posts'] = $posts;
        $this->_view->render('admin/posts/index', $data);
    }

    public function create () {
        if (isset($_POST) and !empty($_POST)) {
            $options['title'] = trim(strip_tags($_POST['title']));
            $options['content'] = trim(strip_tags($_POST['content']));
            $options['status'] = trim(strip_tags($_POST['status']));
            $con = Connection::make();
        
            $sql = "INSERT INTO posts(title, content, status)
                VALUES (:title, :content, :status)";

            $res = $con->prepare($sql);
            $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
            $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
            $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
            $res->execute();
            header('Location: /admin/posts');
        }
        $data['title'] = 'Admin Add New Post ';
        $this->_view->render('admin/posts/create',$data);
    }
}
