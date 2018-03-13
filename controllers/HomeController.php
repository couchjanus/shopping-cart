<?php

class HomeController extends Controller
{
    
    public function index()
    {   
        $title = 'Our <b>Cat Members</b>';

        $this->_view->render('home/index', ['title'=>$title]);

    }

    public function getProduct($vars)
    {
        $products = Product::getProducts();
        echo json_encode($products);
    }
    
}
