<?php

$router->get('', 'HomeController@index');

$router->get('about', 'AboutController@index');
$router->get('contact', 'ContactController@index');

$router->get('guestbook', 'GuestbookController@index');

$router->get('blog', 'BlogController@index');
$router->get('blog/{id}', 'BlogController@view');

$router->get('admin', 'Admin\DashboardController@index');

$router->get('admin/products', 'Admin\shop\ProductsController@index');
$router->get('admin/products/create', 'Admin\shop\ProductsController@create');
$router->post('admin/products/create', 'Admin\shop\ProductsController@create');
$router->get('admin/products/edit/{id}', 'Admin\shop\ProductsController@edit');
$router->post('admin/products/edit/{id}', 'Admin\shop\ProductsController@edit');

$router->get('admin/products/delete/{id}', 'Admin\shop\ProductsController@delete');
$router->post('admin/products/delete/{id}', 'Admin\shop\ProductsController@delete');

$router->get('admin/categories', 'Admin\shop\CategoriesController@index');
$router->get('admin/categories/create', 'Admin\shop\CategoriesController@create');
$router->post('admin/categories/create', 'Admin\shop\CategoriesController@create');
$router->get('admin/categories/edit/{id}', 'Admin\shop\CategoriesController@edit');
$router->post('admin/categories/edit/{id}', 'Admin\shop\CategoriesController@edit');
$router->get('admin/categories/delete/{id}', 'Admin\shop\CategoriesController@delete');
$router->post('admin/categories/delete/{id}', 'AdminCategoriesController@delete');

$router->get('admin/posts', 'Admin\blog\PostsController@index');
$router->get('admin/posts/create', 'Admin\blog\PostsController@create');
$router->get('admin/posts/edit/{id}', 'Admin\blog\PostsController@edit');
$router->get('admin/posts/delete/{id}', 'Admin\blog\PostsController@delete');
$router->post('admin/posts/create', 'Admin\blog\PostsController@add');
$router->post('admin/posts/edit/{id}', 'Admin\blog\PostsController@edit');
$router->post('admin/posts/delete/{id}', 'Admin\blog\PostsController@delete');


// $router->define([
//     'contact' => 'ContactController@index',
//     'about' => 'AboutController@index',
//     'blog' => 'BlogController@index',
//     'blog/{id}' => 'BlogController@view',
//     'blog/search' => 'BlogController@search',
//     'guestbook' => 'GuestbookController@index',
//     'admin' => 'Admin\DashboardController@index',
//     'admin/categories'=>'Admin\shop\CategoriesController@index',
//     'admin/categories/create' => 'Admin\shop\CategoriesController@create',
//     'admin/products' => 'Admin\shop\ProductsController@index',
//     'admin/products/create'=>'Admin\shop\ProductsController@create',
//     'admin/posts' => 'Admin\blog\PostsController@index',
//     'admin/posts/create' => 'Admin\blog\PostsController@create',
//     //Главаня страница
//     'index.php' => 'HomeController@index', 
//     '' => 'HomeController@index',  
// ]);
