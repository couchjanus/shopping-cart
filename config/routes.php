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

$router->get('admin/users', 'Admin\users\UsersController@index');
$router->get('admin/users/create', 'Admin\users\UsersController@create');
$router->get('admin/users/edit/{id}', 'Admin\users\UsersController@edit');
$router->get('admin/users/delete/{id}', 'Admin\users\UsersController@delete');
$router->post('admin/users/create', 'Admin\users\UsersController@create');
$router->post('admin/users/edit/{id}', 'Admin\users\UsersController@edit');
$router->post('admin/users/delete/{id}', 'Admin\users\UsersController@delete');

$router->get('login', 'UsersController@login');
$router->post('login', 'UsersController@login');

$router->get('register', 'UsersController@signup');
$router->post('register', 'UsersController@signup');
