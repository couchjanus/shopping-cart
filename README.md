# shopping-cart

# CRUD-приложения

Классическое приложение для работы с БД обычно называют CRUD - по первым буквам стандартных операций, Create, read, update and delete (Создание чтение обновление удаление).


# Выборка из базы данных. 
## Основы SELECT.


Выберем только title и content:

```sql

    $sql = "SELECT title, content FROM posts";

```

## ИСПОЛЬЗОВАНИЕ ПСЕВДОНИМОВ В SQL.

Дадим колонке created_at имя formated_date при выводе с помощью команды AS, хотя она не обязательна, достаточно просто поставить пробел между именем колонки и псевдонимом. В самой базе изменений не произойдет. Измениться только конкретный вывод:

```sql

    "SELECT id, title, content, 
        
        DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') 
        AS formated_date, 
        
        status 
        FROM posts";

```


## Сортировка данных SQL.


Вывести все публикации и отсортировать их по возрастанию с помощью ключевого слова ORDER BY:

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    ORDER BY id ASC";

```


А теперь по title:

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    ORDER BY title ASC";

```

Можно сортировать по нескольким параметрам, например по title и created_at:

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    ORDER BY created_at, title ASC";

```

можем отсортировать публикации по убыванию с помощью ключевого слова DESC:


```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    ORDER BY created_at DESC";

```

## ключевое слово LIMIT

Представьте, что у вас тысячи записей, но вам, например, нужно вывести 5 записей начиная с 3 записи. Или вывести всего 4 записи из огромной базы. Для этого в SQL существует ключевое слово LIMIT.

вывести 4 записи отсортированных по возрастанию.

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    ORDER BY created_at ASC LIMIT 4";

```

выберем пять записей отсортированных по title начиная с 3:

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    ORDER BY title ASC LIMIT 3,5";

```

Первая цифра после LIMIT означает номер записи, с которой начинается выборка, а вторая количество — выбираемых записей.

## ИСПОЛЬЗОВАНИЕ КЛЮЧЕВОГО СЛОВА WHERE В SQL

Представьте, что у вас есть таблица на 1000 записей, но вам нужно посмотреть только тех, чей id равен 30 или больше. 

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 
    
    WHERE id>=30
    ;

```

нужно найти title, у которого идентификатор равен 11:

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 
    
    WHERE id=11
    ;

```

## Ключевое слово AND

Это логическое И. 

```sql
    "SELECT * FROM metas 
        WHERE (resource_id = :resource_id 
               AND 
               resource = :resource)"

```


Или выберем title, чей id больше 20 и меньше 30.

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    WHERE id>20 AND id<30";

```

## Ключевое слово OR

Это логическое ИЛИ. 

```sql

    "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status 

    FROM posts 

    WHERE id>20 AND created_at=2018-02-07 OR id<200 AND created_at=2016-02-29";

```

## Выбираем post по идентификатору

```php

    public static function getPostById ($postId) {

        $con = Connection::make();
        $con->exec("set names utf8");
        
        $sql = "SELECT * FROM posts WHERE id = :id";
    
        $res = $con->prepare($sql);
        $res->bindParam(':id', $postId, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

```

## Выбираем товар по идентификатору

```php

    /**
     * Выбираем товар по идентификатору
     *
     * @param $productId
     * @return mixed
     */
    public static function getProductById ($productId) {

        $con = Connection::make();

        $sql = "SELECT * FROM products WHERE id = :id";

        $res = $con->prepare($sql);
        $res->bindParam(':id', $productId, PDO::PARAM_INT);
        $res->execute();

        $product = $res->fetch(PDO::FETCH_ASSOC);

        return $product;
    }


```

## Выбираем metas по идентификатору

```php

 public static function getMetas($resource, $resourceId)
    {
        $con = Connection::make();
        
        $res = $con->prepare(
            "SELECT * FROM metas 
                   WHERE (resource_id = :resource_id 
                   AND resource = :resource)"
            );

        $res->bindParam(':resource_id', $resourceId, PDO::PARAM_INT);

        $res->bindParam(':resource', $resource, PDO::PARAM_STR);
        
        $res->execute();

        $metas = $res->fetch(PDO::FETCH_ASSOC);
        return $metas;
    }

```


## Обновление

Обновление записей БД MySQL с помощью ключевого слова UPDATE:


```sql

    "
     UPDATE products
    
            SET
               name = :name,
               category_id = :category,
               price = :price,
               brand = :brand,
               description = :description,
               is_new = :is_new,
               status = :status
            
            WHERE id = :id
            ";


```

Будьте внемательны, если вы не укажете условие WHERE, а просто напишите UPDATE human SET name = :name, то установите name всем записям в таблице.


## UPDATE product по идентификатору

```php

public static function update ($id, $options) {

        $con = Connection::make();

        $sql = "
                UPDATE products
                SET
                    name = :name,
                    category_id = :category,
                    price = :price,
                    brand = :brand,
                    description = :description,
                    is_new = :is_new,
                    status = :status
                WHERE id = :id
                ";

        $res = $con->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':category', $options['category'], PDO::PARAM_INT);
        $res->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
    }

```
## UPDATE post по идентификатору

```php

    public static function update ($id, $options) {

        $con = Connection::make();

        $sql = "
                UPDATE posts
                SET
                    title = :title,
                    content = :content,
                    status = :status
                WHERE id = :id
                ";

        $res = $con->prepare($sql);

        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        $res->execute();
    }

```

## Редатирование товара

```php

     /**
     * Редатирование товара
     *
     * @param $id
     * @return bool
     */
    public function edit ($vars) {

        //Получаем информацию о выбранном товаре
        extract($vars);

        $product = Product::getProductById($id);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Product::update($id, $options);

            $this->metas['resource_id'] = $id;
            $this->metas['resource'] = $this->resource;
            $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
            $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
            $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
            $this->metas['links'] = trim(strip_tags($_POST['meta_links']));

            Meta::store($this->metas);
     
            header('Location: /admin/products');
        }
      
        $data['product'] = Product::getProductById($id);
        $data['categories'] = Category::index();
        $data['metas']  = Meta::getMetas($this->resource, $id);
        $data['title'] = 'Admin Product Edit Page ';
        
        $this->_view->render('admin/products/edit',$data);
        
    }


```

## Форма редактирования товара

```php

<?php
include_once VIEWS.'shared/admin/header.php';
?>
<div class="page-content">
   <div class="row">
        <div class="col-md-2">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
        ?>
        </div>
      <div class="col-md-10">
        <div class="content-box-large">
          <div class="panel-heading">
                <div class="panel-title"><?= $title;?> <?= $product['name']?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>

          <form class="form-horizontal" role="form" method="POST" id="idForm">

            <div class="panel-body">
                
                <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Product Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']?>">
                        </div>
                </div>
                <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Product Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="<?= $product['price']?>">
                        </div>
                </div>
 
                <div class="form-group">
                  <label for="category" class="col-sm-2 control-label">Product Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="category" name="category">
                        <?php if (is_array($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"
                                    <?php if ($product['category_id'] == $category['id']) echo ' selected'; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                        <label for="brand" class="col-sm-2 control-label">Product Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="brand" name="brand" value="<?= $product['brand']?>">
                        </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">Product Description</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="description" name="description" value="<?= $product['description']?>">
                        </div>
                </div>

                <div class="form-group">
                        <label for="is_new" class="col-sm-2 control-label">Is New</label>
                        <div class="col-sm-10">
                            <select name="is_new" class="form-control">
                                <option value="1" <?php if($product['is_new'] == 1) echo 'selected'?>>Да</option>
                                <option value="0" <?php if($product['is_new'] == 0) echo 'selected'?>>Нет</option>
                            </select>
                        </div>
                </div>

                <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" <?php if($product['status'] == 1) echo 'selected'?>>Отображается</option>
                                <option value="0" <?php if($product['status'] == 0) echo 'selected'?>>Скрыт</option>
                            </select>
                        </div>
                </div>
            
                
            </div>
            <hr>
            <div class="panel-body">
                
                <div class="form-group">
                <label for="meta_title" class="col-sm-2 control-label">Page Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $metas['title']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="col-sm-2 control-label">Page meta description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?= $metas['description']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keywords" class="col-sm-2 control-label">Page meta keywords</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?= $metas['keywords']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="meta_links" class="col-sm-2 control-label">Page meta links</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_links" name="meta_links" value="<?= $metas['links']?>">
                </div>
            </div>                
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Add Product</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';


```


## Редатирование поста

```php

  public function edit ($vars) {
    
    extract($vars);
    
    if (isset($_POST) and !empty($_POST)) {
        $options['title'] = trim(strip_tags($_POST['title']));
        $options['content'] = trim($_POST['content']);
        $options['status'] = trim(strip_tags($_POST['status']));
        
        Post::update($id, $options);

        $this->metas['resource_id'] = $id;
        $this->metas['resource'] = $this->resource;
        $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
        $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
        $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
        $this->metas['links'] = trim(strip_tags($_POST['meta_links']));

        Meta::store($this->metas);

        $this->redirect('/admin/posts');
      
    }
        
    $data['title'] = 'Admin Edit Post ';
    $data['metas']  = Meta::getMetas($this->resource, $id);
    $data['post'] = Post::getPostById($id);
    $this->_view->render('admin/posts/edit',$data);

    }
```

## admin/posts/index.php

```php

<tbody class="table-items">
    <?php foreach ($posts as $post):?>
       <tr>
           <td><?php echo $post['id']?></td>
           <td><?php echo $post['title']?></td>
           <td>
               <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
               <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>
               <a href="/admin/posts/edit/<?= $post['id']?>"><button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
               <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></td>
        </tr>
    <?php endforeach;?>
 </tbody>

```

## Форма редактирования поста

```php

<?php
include_once VIEWS.'shared/admin/header.php';
?>
<div class="page-content">
   <div class="row">
        <div class="col-md-2">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
        ?>
        </div>
      <div class="col-md-10">
        <div class="content-box-large">
          <div class="panel-heading">
                <div class="panel-title"><?= $title;?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>
          <form class="form-horizontal" role="form" method="POST"  id="idForm">

            <div class="panel-body">
                <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Post Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="title" name="title" value="<?= $post['title']?>">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="content">Post Content</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" id="content" name="content"><?= $post['content']?></textarea>
                        </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                      <select name="status" class="form-control">
                        <option value="1" <?php if($post['status'] == 1) echo 'selected'?>>Отображать</option>
                        <option value="0" <?php if($post['status'] == 0) echo 'selected'?>>Скрывать</option>
                      </select>
                    </div>
                </div>
                
                <hr>

                
                <div class="form-group">
                    <label for="meta_title" class="col-sm-2 control-label">Page Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $metas['title']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_description" class="col-sm-2 control-label">Page meta description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?= $metas['description']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_keywords" class="col-sm-2 control-label">Page meta keywords</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?= $metas['keywords']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_links" class="col-sm-2 control-label">Page meta links</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_links" name="meta_links" value="<?= $metas['links']?>">
                    </div>
                </div>                
                
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Add Post</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';


```

## routes.php


```php

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


```

## Router

```php

<?php

class Router
{

    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }


    public function define($routes)
    {
        $this->routes = $routes;
    }


    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }


    public function directPath($uri, $requestType)
    {   

        if (array_key_exists($uri, $this->routes[$requestType])) {
            
            return $this->callAction(
            ...$this->getPathAction($this->routes[$requestType][$uri])
            );
        }else{
        
            foreach ($this->routes[$requestType] as $key => $val){
                $pattern = preg_replace('#\(/\)#', '/?', $key);
                $pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
                preg_match($pattern, $uri, $matches);
                array_shift($matches);
                if($matches){
                    $getAction = $this->getPathAction($val);
                    return $this->callAction($getAction[0],$getAction[1],$getAction[2], $matches);
                }
            }
        }
        throw new Exception('No route defined for this URI.');
    }


    private function getPathAction($route){
        list($segments, $action) = explode('@', $route);
        $segments = explode('\\', $segments);
        $controller = array_pop($segments);
        $controllerFile = '/';
        do {
            if(count($segments)==0){
              return array ($controller, $action, $controllerFile);
                }
                else{
                    $segment = array_shift($segments);
                    $controllerFile = $controllerFile.$segment.'/';
                }
            }while ( count($segments) >= 0);

    }

    protected function callAction($controller, $action, $controllerFile, $vars = []) 
    {
        
        include(CONTROLLERS.$controllerFile.'/'.$controller.EXT);
        
        $controller = new $controller;
        
        if (! method_exists($controller, $action)) {
            throw new Exception(
            "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action($vars); // return $vars to the action
    }

}

```

## class Request

```php

<?php

class Request
{
	
    public static function uri()
	{
		if (isset($_SERVER["REQUEST_URI"]) and !empty($_SERVER["REQUEST_URI"]))
            return trim($_SERVER["REQUEST_URI"], '/');
	}
    
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

}
```

## bootstrap.php

```php

$routesFile = CONFIG.'routes.php';

Router::load($routesFile)
            ->directPath(Request::uri(), Request::method());

```
