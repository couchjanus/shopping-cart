<?php

class HomeController extends Controller
{
    
    public function index()
    {   
        $title = 'Our <b>Cat Members</b>';

        $this->_view->render('home/index', ['title'=>$title]);

    }
    
}
