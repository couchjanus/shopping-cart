<?php

class HomeController
{
    
    public function __construct()
    {   
        render('home/index', ['title'=>'Our <b>Cat Members</b>']);
    }
    
    // public function index()
    // {   
    //     render('home/index', ['title'=>'Our <b>Cat Members</b>']);
    // }
    
}
