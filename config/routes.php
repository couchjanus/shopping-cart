<?php

$router->get('', 'HomeController@index');

$router->get('about', 'AboutController@index');
$router->get('contact', 'ContactController@index');

$router->get('guestbook', 'GuestbookController@index');

$router->get('blog', 'BlogController@index');
$router->post('blog/search', 'BlogController@search');
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

$router->get('profile', 'ProfileController@index');
$router->get('profile/edit', 'ProfileController@edit');
$router->post('profile/edit', 'ProfileController@edit');

$router->get('profile/orders', 'ProfileController@ordersList');

$router->get('profile/orders/view/{id}', 'ProfileController@ordersView');
$router->get('profile/orders/edit/{id}', 'ProfileController@ordersEdit');
$router->get('profile/orders/delete/{id}', 'ProfileController@ordersDelete');


$router->get('logout', 'UsersController@logout');
$router->post('logout', 'UsersController@logout');

$router->get('admin/gallery', 'Admin\gallery\GalleryController@index');
$router->get('admin/gallery/create', 'Admin\gallery\GalleryController@create');
$router->post('admin/gallery/create', 'Admin\gallery\GalleryController@create');
$router->get('admin/gallery/delete/{id}', 'Admin\gallery\GalleryController@delete');
$router->post('admin/gallery/delete/{id}', 'Admin\gallery\GalleryController@delete');

$router->get('api/shop', 'HomeController@getProduct');

$router->post('check', 'UsersController@actionCheck');
$router->post('cart', 'CartController@index');

$router->get('admin/orders', 'Admin\shop\OrdersController@index');
$router->get('admin/orders/view/{id}', 'Admin\shop\OrdersController@view');
$router->get('admin/orders/edit/{id}', 'Admin\shop\OrdersController@edit');

$router->get('admin/orders/delete/{id}', 'Admin\shop\OrdersController@delete');
$router->post('admin/orders/edit/{id}', 'Admin\shop\OrdersController@edit');
$router->post('admin/orders/delete/{id}', 'Admin\shop\OrdersController@delete');
