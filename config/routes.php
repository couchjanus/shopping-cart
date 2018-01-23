<?php

return [
    'contact' => 'ContactController@index',
    'about' => 'AboutController@index',
    'blog' => 'BlogController@index',
    'guestbook' => 'GuestbookController@index',

    'admin' => 'Admin\DashboardController@index',

    'admin/categories'=>'Admin\shop\CategoriesController@index',
    'admin/category/add' => 'Admin\shop\CategoriesController@create',

    'admin/products' => 'Admin\shop\ProductsController@index',
    'admin/product/add'=>'Admin\shop\ProductsController@create',
    //Главаня страница
    'index.php' => 'HomeController@index', 
    '' => 'HomeController@index',  
];
