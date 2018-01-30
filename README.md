# shopping-cart 

# Регистрация хостинга

- Зарегистрируйтесь на https://www.000webhost.com
- Активируте учетную запись и перейдите в пвнель управления сайтом https://www.000webhost.com/members/website/janusnic


# File manager
- Выбеоите вкладку File manager в https://files.000webhost.com/ 

- В директории public_html создайте файл index.php

```php

<?php
echo "hello ";

```

- Измените файл index.php

```php

<?php

phpinfo();

```

- В корне проекта / создайте директорию config

- В директории config создайте файл app.php

```php

<?php
  
    define('ROOT', realpath(__DIR__.'/../'));
    define('VIEWS', ROOT.'/views/');
    define('CONTROLLERS', ROOT.'/controllers/');
    define('CONFIG', ROOT.'/config/');
    define('CORE', ROOT.'/core/');
    define('EXT', '.php');
    define('APPNAME', 'Great Shopaholic');
    define('SLOGAN', 'Lets Build Cool Site');

```

- В корне проекта / создайте директорию bootstrap

- В директории bootstrap создайте файл bootstrap.php

```php

<?php

// Общие настройки
if (function_exists('date_default_timezone_set')){
    date_default_timezone_set('Europe/Kiev');    
}

// Включить обработку ошибок

ini_set('display_errors',1);
error_reporting(E_ALL);

// Подключить файл конфигурации
require_once realpath(__DIR__).'/../config/app.php';

```

## В корне проекта / создайте директории
- views
- controllers
- core

- Измените файл index.php

```php

<?php

require_once realpath(__DIR__).'/../bootstrap/bootstrap.php';

```
                

# Manage database
- Перейти в раздел
https://www.000webhost.com/members/website/janusnic/database

- Создать базу данных, указав ее имя и пароль доступа
Например для базы ланных mydb и пользователя dev будет создана такая конфигурация подключения к базе данных 

```

id3998067_mydb  id3998067_dev localhost

```
## phpMyAdmin

- Перейдите в панель управления phpMyAdmin, введя логин и пароль подключения к базе данных 

https://databases.000webhost.com/index.php

https://databases.000webhost.com/db_structure.php?server=1&db=id3998067_mydb

- Создайте с помощью phpMyAdmin таблицу для публикации постов блога

```sql
CREATE TABLE posts (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    status tinyint(1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
```
## Установка соединения с базой mysql

В директории config создайте файл db.php

## Замените данные для подключения к БД на ваши

```php
<?php
 /**
 * Данные для подключения к БД db.php
 */

return [
    'database' => [
        'name' => 'id3998067_mydb',
        'username' => 'id3998067_dev', // - Логин $username
        'password' => 'ghbdtn', // Пароль $password
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];

```

## Установка соединения с базой mysql

В директории core создайте файл Connection.php

```php

/* Установка соединения с базой mysql */
 <?php

 class Connection
 {
  public static function make()
  {
    $db = include CONFIG.'db.php';

    $config = $db['database'];

    try {
      return new PDO(
        // строка dsn. В ней указан драйвер подключения к базе, хост, имя базы 
        $config['connection'].';dbname='.$config['name'], 
        $config['username'],
        $config['password'],
        $config['options']
      );

    } catch (PDOException $e) { // Обработка ошибок подключения
      die($e->getMessage());
    }
  }
 }

```

В директории core создайте файл Controller.php

```php
<?php

class Controller {

    protected $_view;
    
    function __construct()
    {
        $this->_view = new View();
    }

    // действие (action), вызываемое по умолчанию
    function actionIndex()
    {
        // todo
    }
}
```

В директории core создайте файл View.php
```php
<?php

class View {

    public function render($path, $data = [], $error = false){
        extract($data);
        return require VIEWS."/{$path}.php";
    }

}

```
В директории config создайте файл routes.php

```php

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

```

В директории core создайте файл Router.php

```php
<?php
// Router.php
$filename = CONFIG.'routes'.EXT;

$result = null;

if (file_exists($filename)) {
    define('ROUTES',include($filename));
} else {
    echo "Файл $filename не существует";
}


function getURI(){
    if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
        return trim($_SERVER['REQUEST_URI'], '/');
}

function directPath($uri)
    {
      // Проверить наличие такого запроса в routes.php
        if (array_key_exists($uri, ROUTES)) {
            return ROUTES[$uri];
        }
        Throw new Exception('No route defined for this URI.');
    }


//получаем строку запроса

$uri = getURI();

$path = directPath($uri);


list($segments, $action) = explode('@', $path);

$segments = explode('\\', $segments);

$controller = array_pop($segments);

$controllerFile = '';

do {
    if(count($segments)==0){
       $controllerFile = CONTROLLERS .$controllerFile.$controller . EXT;
       break;
    }
    else{
        $segment = array_shift($segments);
        $controllerFile = $controllerFile.$segment.'/';
    }
}while ( count($segments) >= 0);

//Подключаем файл контроллера

    try {
      include_once($controllerFile);
      $controller = new $controller;

      try {
          // код который может выбросить исключение
          $controller->$action();  
          $result = true;
      } catch (Exception $e) {

        $result = false;
          // код который может обработать исключение
        if (! method_exists($controller, $action)) {
          throw new Exception(
          "{$controller} does not respond to the {$action} action."
          );
        }
      }
    } 
    catch (Exception $e) {
        // код который может обработать исключение
        // если конечно оно появится
        $result = false;
        if (! file_exists($controllerFile)) {
          throw new Exception("{$controllerFile} does not respond.");
      }
    }
    finally{
      return  $result;
    } 

if(!$result){
     require_once VIEWS.'404'.EXT;
}

```
Подключить в файле bootstrap.php созданные классы

```php
require_once CORE.'Connection.php';
require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Router.php';

```
В директории controllers создайте файл HomeController.php

```php
<?php

class HomeController extends Controller
{
    
    public function index()
    {   
        $title = 'Our <b>Cat Members</b>';

        $this->_view->render('home/index', ['title'=>$title]);

    }
    
}
```
В директории views.home создайте файл index.php

```html

<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title"><?=$title;?></b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="product-items">


            </div>
        </div>
    </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<div class="clearfix"></div>

```

## Создаем таблицу categories

```sql

CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    PRIMARY KEY (id)
);

```

## Создаем таблицу products
```sql

CREATE TABLE products (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    category_id int(11) UNSIGNED DEFAULT NULL,
    price float UNSIGNED NOT NULL,
    brand varchar(255) NOT NULL,
    description text NOT NULL,
    is_new tinyint(1) NOT NULL DEFAULT '1',
    is_recommended tinyint(1) NOT NULL DEFAULT '0'
    PRIMARY KEY (id)
);
```

## Наследование класса
```php
<?php
class AboutController extends Controller
{
   public function index()
   {
       $title = 'SHOPAHOLIC <b>ABOUT PAGE</b>';
      
       $this->_view->render('home/about', ['title'=>$title]);
   }
  
}
```
## class HomeController
```php
<?php
class HomeController extends Controller
{
  
   public function index()
   {  
       $title = 'Our <b>Cat Members</b>';
       $this->_view->render('home/index', ['title'=>$title]);
   }
  
}
```
# Панель администратора
```php
<?php
class DashboardController extends Controller      
{
    public function index()
    {
         $this->_view->render('admin/index', ['title'=>'Dashboard Controller PAGE']);
    }
}
```
## Маршруты

```php
<?php
return [
   'admin' => 'Admin\DashboardController@index',
   'admin/categories'=>'Admin\shop\CategoriesController@index',
   'admin/category/add' => 'Admin\shop\CategoriesController@create',
   'admin/products' => 'Admin\shop\ProductsController@index',
   'admin/product/add'=>'Admin\shop\ProductsController@create',
];

```



## Синтаксис оператора SELECT
SELECT применяется для извлечения строк, выбранных из одной или нескольких таблиц.

выражение SELECT обязательно включает, выражение FROM
```sql
SELECT --- FROM таблица 

```
Выражение SELECT включает в себя список столбцов возвращаемых запросом.
Выражение FROM включает в себя список таблиц для выполнения запроса.


## Выражение select_expression

Выражение select_expression задает столбцы, в которых необходимо проводить выборку.

```php
public function index (){
   
       $db = Connection::make();
       // $db->exec("set names utf8");
   
       $sql = "SELECT id, name, status FROM categories ORDER BY id ASC";
   
       $res = $db->query($sql);

```
## Получить все столбцы
```sql
SELECT * FROM categories
```
## GROUP BY, HAVING, ORDER BY
Выражение GROUP BY позволяет создать итоговой запрос, разбитый на группы.

Выражение HAVING определяет условие возврата групп и используется только совместно с GROUP BY.

Выражение ORDER BY определяет порядок сортировки результирующего набора данных.

## Выборка данных

Для выборки данных используются методы fetch() или fetchAll(). 

Перед вызовом функции нужно указать PDO как Вы будете доставать данные из базы. 
- PDO::FETCH_ASSOC вернет строки в виде ассоциативного массива с именами полей в качестве ключей. 
- PDO::FETCH_NUM вернет строки в виде числового массива. 
По умолчанию выборка происходит с PDO::FETCH_BOTH, который дублирует данные как с численными так и с ассоциативными ключами, поэтому рекомендуется указать один способ, чтобы не иметь дублирующих массивов

## Функция ::fetchAll
PDOStatement::fetchAll — Возвращает массив, содержащий все строки результирующего набора
```php
public array PDOStatement::fetchAll ([ int $fetch_style [, mixed $fetch_argument [, array $ctor_args = array() ]]] )
```
http://php.net/manual/ru/pdostatement.fetchall.php 


## Список всех категорий
```php
public function index (){
       $db = Connection::make();
       // $db->exec("set names utf8");
       $sql = "SELECT id, name, status FROM categories ORDER BY id ASC";
       $res = $db->query($sql);
       // PDO::FETCH_ASSOC - строки в виде ассоциативного массива с именами полей в качестве ключей
       $categories = $res->fetchAll(PDO::FETCH_ASSOC);

       $data['categories'] = $categories;
       $data['title'] = 'Admin Category List Page ';
       $this->_view->render('admin/categories/index',$data);
   }
```

## Контроллер категорий

```php
<?php
/**
* Контроллер для управления категориями
*/
class CategoriesController extends Controller{
   public function index (){
       $db = Connection::make();
       // $db->exec("set names utf8");
       $sql = "SELECT id, name, status FROM categories ORDER BY id ASC";
       $res = $db->query($sql);
       $categories = $res->fetchAll(PDO::FETCH_ASSOC);
       $data['categories'] = $categories;
       $data['title'] = 'Admin Category List Page ';
       $this->_view->render('admin/categories/index',$data);
   }
```
## Шаблон списка категорий

```html
    
    <article class='large'>
       <a href="/admin/category/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить категорию
       </a>
       <h4>Список категорий</h4>
       <table>
           <tr>
               <th>ID категории</th>
               <th>Название категории</th>
              
           </tr>

           <?php foreach ($categories as $category):?>
               <tr>
                   <td><?php echo $category['id']?></td>
                   <td><?php echo $category['name']?></td>
                   <td><a title="Редактировать" href="" class="del">
                           <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                       </a></td>
                   <td><a title="Удалить" href="" class="del">
                           <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                       </a></td>
               </tr>
           <?php endforeach;?>
       </table>
    </article>

```
## Контроллер товаров

```php
class ProductsController extends Controller {
   public function index () {
       $db = Connection::make();
       $sql = "SELECT * FROM products ORDER BY id ASC";
       $res = $db->query($sql);
       $products = $res->fetchAll(PDO::FETCH_ASSOC);
       $data['title'] = 'Admin Product List Page ';
       $data['products'] = $products;
       $this->_view->render('admin/products/index', $data);
   }
```
## Шаблон для товаров
```html
        <tbody class="table-items">
           <?php foreach ($products as $product):?>
              <tr>
                <td><?php echo $product['id']?></td>
                <td><?php echo $product['name']?></td>
                <td><?php echo $product['price']?></td>
                <td>
                   <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
                   <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>
                   <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                   <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></td>
              </tr>
            <?php endforeach;?>
                            
        </tbody>
```
## Использование prepared statements

Использование prepared statements укрепляет защиту от SQL-инъекций.
http://php.net/manual/ru/pdo.prepare.php 
```php
$db = Connection::make();

$res = $db->prepare($sql);

```
Prepared statement — это заранее скомпилированное SQL-выражение, которое может быть многократно выполнено путем отправки серверу лишь различных наборов данных. 
Дополнительным преимуществом является невозможность провести SQL-инъекцию через данные, используемые в placeholder.

## Именные placeholders

```php
    # первым аргументом является имя placeholder
    # его принято начинать с двоеточия
    # хотя работает и без них

       $res = $db->prepare($sql);
       $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
       $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
```
Здесь тоже можно передавать массив, но он должен быть ассоциативным. 
В роли ключей должны выступать имена placeholder.

```php
    # данные, которые мы вставляем

       $db = Connection::make();
       $res = $db->prepare($sql);

       $sql = "INSERT INTO categories(name, status)  VALUES (:name, :status) ";
```       
Одним из удобств использования именных placeholder является возможность вставки объектов напрямую в базу данных, если названия свойств совпадают с именами параметров. 

## Создание новой категории

```php
   public function create () {
       if (isset($_POST) and !empty($_POST)) {
           $options['name'] = trim(strip_tags($_POST['name']));
           $options['status'] = trim(strip_tags($_POST['status']));
           $db = Connection::make();
       // $db->query("set names utf8");
       $sql = "INSERT INTO categories(name, status)  VALUES (:name, :status) ";
       $res = $db->prepare($sql);
       $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
       $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
       $res->execute();
       header('Location: /admin/categories');
       }
       $data['title'] = 'Admin Category Add New Category ';
       $this->_view->render('admin/categories/create', $data);
   }
```
## Создание нового товара

```php
   public function create () {
       //Принимаем данные из формы
       if (isset($_POST) and !empty($_POST)) {
           $options['name'] = trim(strip_tags($_POST['name']));
           $options['price'] = trim(strip_tags($_POST['price']));
           $options['category'] = trim(strip_tags($_POST['category']));
           $options['brand'] = trim(strip_tags($_POST['brand']));
           $options['description'] = trim(strip_tags($_POST['description']));
           $options['is_new'] = trim(strip_tags($_POST['is_new']));
           $options['status'] = trim(strip_tags($_POST['status']));
```
## Вставка записи в таблицу
```php
           $con = Connection::make();
           $sql = "
               INSERT INTO products(name, category_id, price, brand, description, is_new, status)
               VALUES (:name, :category_id, :price, :brand, :description, :is_new, :status)
               ";
       $res = $con->prepare($sql);
```
## PDOStatement::execute
```php
public bool PDOStatement::execute ([ array $input_parameters ] )
```
Запускает подготовленный запрос. Если запрос содержит метки параметров (псевдопеременные), вы должны либо:
вызвать PDOStatement::bindParam() и/или PDOStatement::bindValue(), чтобы связать эти маркеры, соответственно, с переменными или значениями. Связанные переменные передают свои значения как входные данные и получают выходные значения 
или передать массив значений только на вход
http://php.net/manual/ru/pdostatement.execute.php 


## Выполняем запрос 
```php
       $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
       $res->bindParam(':category_id', $options['category'], PDO::PARAM_INT);
       $res->bindParam(':price', $options['price'], PDO::PARAM_INT);
       $res->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
       $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
       $res->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
       $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
       $res->execute();
       header('Location: /admin/products');
       }

// Вызов формы добавления

       $data['title'] = 'Admin Product Add New Product ';
       $this->_view->render('admin/products/add',$data);
      
   }
}
```
