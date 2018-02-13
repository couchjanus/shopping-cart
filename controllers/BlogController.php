<?php

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::index();
        $data['title'] = 'Blog Page ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['posts'] = $posts;
        $this->_view->render('blog/index',$data);
    }

    public function view($vars)
	{
		extract($vars);
		$post = Post::show($id);
        $data['title'] = 'Blog Post ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['post'] = $post;
		$this->_view->render('blog/show', $data);
	}    
    
}