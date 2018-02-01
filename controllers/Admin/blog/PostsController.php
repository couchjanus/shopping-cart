<?php

class PostsController extends Controller {

  public function index()
  {
      $posts = Post::index();
      $data['title'] = 'Admin Posts Page ';
      $data['posts'] = $posts;
      $this->_view->render('admin/posts/index',$data);
  }


  public function create () {
      //Принимаем данные из формы
      if (isset($_POST) and !empty($_POST)) {
          $options['title'] = trim(strip_tags($_POST['title']));
          $options['content'] = trim($_POST['content']);
          // $options['content'] = trim(strip_tags($_POST['content']));
          $options['status'] = trim(strip_tags($_POST['status']));

          $id = Post::store($options);
          header('Location: /admin/posts');

      }
      $data['title'] = 'Admin Add Post ';

      $this->_view->render('admin/posts/create',$data);

  }

}
