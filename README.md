# shopping-cart

## Функция header в php
http://php.net/manual/ru/function.header.php

### header — Отправка HTTP-заголовка

```php

void header ( string $string [, bool $replace = true [, int $http_response_code]] )


```
header() используется для отправки HTTP-заголовка. 

Заголовки - это инструкции браузеру. они должны быть посланы до любого другого вывода.

$string: сам заголовок. Бывает двух типов. 
- Первый начинается с «HTTP/» (header(«HTTP/1.0 404 Not Found»);). 
- Второй начинается не с «HTTP/». Состоит из двух частей «имя парметра: значение» (например, «Location: http://www.example.com/» или «Content-type: application/pdf»).

Второй необязательный параметр, означающий нужно ли перезаписывать ранее указанный аналогичный заголовок, отправленный в браузер пользователя (по умолчанию «true»);

- Если true (по умолчанию), то заголовок замещает предыдущий с таким же именем параметра
- Если false, то передаётся несколько параметров одного типа

Третий параметр, $http_response_code - необязательный параметр принудительного задания кода HTTP ответа, если таковой не был задан в ранее переданном заголовке, и если строка заголовка не пуста. По умолчанию передается код «302 Moved Temporarily» - «временно перемещено».

```php

header('WWW-Authenticate: Negotiate');
header('WWW-Authenticate: NTLM', false);
// 301 Moved Permanently
header("Location: /foo.php",TRUE,301);
// 302 Found
header("Location: /foo.php",TRUE,302); //это значение по умолчанию.
header("Location: /foo.php");//аналогично
// 303 See Other
header("Location: /foo.php",TRUE,303);
// 307 Temporary Redirect
header("Location: /foo.php",TRUE,307);

```

Для того, чтобы осуществить непосредственный редирект, необходимо чтобы был указан специальный вид строки заголовка «location: …». Например, так:

```php
header('Location: http://www.example.com/');

```
в данном случае, после отправки заголовка, пользователь будет перенаправлен на любой сайт, указанный вместо «http://www.example.com/».

согласно спецификациии HTTP/1.1 необходимо в качестве аргумента «location» указывать абсолютный путь, с указанием протокола подключения (например: http), имени хоста (домен сайта) и пути назначения. Это требование указано в справке по функции header().

### Передача кода HTTP статуса при редиректе (301/302).

По умолчанию при передаче строки заголовка типа «location», передается статус HTTP ответа «302 Moved Temporarily» - «материал временно перемещен». Что может быть для нас не всегда удобно: дело в том что, если Вы таким образом перенаправляете пользователей со старого адреса материала на новый, то поисковые системы не будут менять прежний адрес материала в индексе, он ведь «временно перемещен»… 

Чтобы изменить адрес материала в поисковом индексе, необходимо указывать код «301 Moved Permanently» - «перемещено постоянно» или «302 Found» - «найдено». 

А иногда нужно отдать заголовок «200 OK» - «хорошо», означающий что запрошенный материал успешно передан в браузер пользователя.

## Коды HTTP ответа
Коды HTTP ответа можно задавать принудительно двумя различными способами. 

Первый способ следует из спецификации самой функции header, в которой в качестве третьего параметра можно указывать код статуса HTTP, например:

```php
header( 'Location: http://www.example.com/', true, 301 );

```
Второй способ принудительной передачи кода HTTP ответа – отправка строки заголовка иного вида, перед отправкой заголовка «location». В большинстве случаев это:

```php

header('HTTP/1.1 301 Moved Permanently');
header('Location: http://www.example.com/');

```

## Пример перенаправления:
```php
    
    public static function redirect($url = '/')
    {
        header('Location: ' . $url);
        die();
    }


```
## Javascript перенаправления:

```php

    $previous = "javascript:history.go(-1)";

    html:

    <a href="<?= $previous ?>">Back</a>

```

## Пример внешнего перенаправления:

```php

public static function redirect($redirect_url = '/')
    {
        header('HTTP/1.1 200 OK');
        header('Location: http://'.$_SERVER['HTTP_HOST'].$redirect_url);
        exit();

    }

```
## HTTP_REFERER перенаправления:

```php

    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }

```
## Пример HTTP_REFERER перенаправления:

```php

    if (Product::addProduct($options)){
        header('Location: /admin/products');
    }
    else{
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        header("Location: $previous");
    }
}

```

## goBack

```php

protected $previous = '/';

public static function goBack()
    {
        if(isset($_SERVER['HTTP_REFERER'])) {
            $this->previous = $_SERVER['HTTP_REFERER'];
        }

        header('HTTP/1.1 200 OK');

        header("Location: $this->previous");
        // header('Location: http://'.$_SERVER['HTTP_HOST'].$this->previous);
        exit();
    }

```
# Включение буферизации вывода
## Функция ob_start()
```php
bool ob_start ([ callable $output_callback = NULL [, int $chunk_size = 0 [, int $flags = PHP_OUTPUT_HANDLER_STDFLAGS ]]] )

```
Эта функция включает буферизацию вывода. Если буферизация вывода активна, никакой вывод скрипта не отправляется (кроме заголовков), а сохраняется во внутреннем буфере.

Содержимое этого внутреннего буфера может быть скопировано в строковую переменную, используя ob_get_contents(). 

Для вывода содержимого внутреннего буфера следует использовать ob_end_flush(). 

В качестве альтернативы можно использовать ob_end_clean() для очистки содержимого буфера.

Буферы вывода помещаются в стек, то есть допускается вызов ob_start() после вызова другой активной ob_start(). При этом необходимо вызывать ob_end_flush() соответствующее количество раз. Если активны несколько callback-функций, вывод последовательно фильтруется для каждой из них в порядке вложения.

Функция ob_start() с момента вызова, включает сбор всей исходящей информации в буфер вывода, а не отдает ее сразу клиенту, что помогает избежать ситуации, при которой заголовки, отправленные после любого текста, вызывают ошибку. 

Буфер вывода сортирует входящие данные, и все заголовки ставит в начало ответа. 

Таким образом, мы можем отдавать заголовки ситуативно, независимо от того, что они идут не в начале вывода.

```php

    <?php

    if (function_exists('date_default_timezone_set')){
        date_default_timezone_set('Europe/Kiev');
    }

    // Общие настройки
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    ob_start();

    require_once realpath(__DIR__).'/../config/app.php';
    require_once MODELS.'Category.php';
    require_once MODELS.'Product.php';
    require_once MODELS.'Post.php';
    require_once CORE.'Connection.php';
    require_once CORE.'View.php';
    require_once CORE.'Controller.php';
    require_once CORE.'Router.php';

```

## TABLE `categories`

```sql

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```
## TABLE `products`

```sql

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `price` float unsigned NOT NULL,
  `brand` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `is_recommended` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```
## TABLE `posts`

```sql
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```

# class Controller

```php
<?php

class Controller {

    protected $_view;
    
    function __construct()
    {
        $this->_view = new View();
    }

    public static function redirect($url = '/')
    {
        header('Location: ' . $url);
        die();
    }

}

```

## Контроллер для управления категориями

```php

<?php
/**
 * Контроллер для управления категориями
*/
class CategoriesController extends Controller{


    /* Добавление категории */
     
     public function create () {

         if (isset($_POST) and !empty($_POST)) {
             $options['name'] = trim(strip_tags($_POST['name']));
             $options['status'] = trim(strip_tags($_POST['status']));
             
             Category::store($options);
             
             $this->redirect('/admin/categories');
     
            //  header('Location: /admin/categories');
         }
         $data['title'] = 'Admin Category Add New Category ';
         $this->_view->render('admin/categories/create', $data);

     }

}

```

# Router

```php

$filename = CONFIG.'routes'.EXT;

$result = null;

if (file_exists($filename)) {
    define('ROUTES',include($filename));
} else {
    echo "Файл $filename не существует";
}

```

## Маршруты

```php

<?php

return [
    'contact' => 'ContactController@index',
    'about' => 'AboutController@index',
    'blog' => 'BlogController@index',
    'guestbook' => 'GuestbookController@index',

    'admin' => 'Admin\DashboardController@index',

    'admin/categories'=>'Admin\shop\CategoriesController@index',
    'admin/categories/create' => 'Admin\shop\CategoriesController@create',

    'admin/products' => 'Admin\shop\ProductsController@index',
    'admin/products/create'=>'Admin\shop\ProductsController@create',

    'admin/posts' => 'Admin\blog\PostsController@index',
    'admin/posts/create' => 'Admin\blog\PostsController@create',

    //Главаня страница
    'index.php' => 'HomeController@index',
    '' => 'HomeController@index',
];

```

# Класс — self, объект — $this

Классы выступают в качестве шаблонов для объектов. Для того чтобы обратиться к внутреннему содержимому объекта, используется ключевое слово $this . 

Для обращения к внутреннему содержимому класса используется ключевое слово self.

Ключевое слово $this снабжено символом доллара, чтобы подчеркнуть связь с переменными. В то время как ключевое слово self обходится без символа доллара — это указание на то, что обращаемся мы не к переменной.

Для того чтобы воспользоваться self, потребуется объявить статическую переменную или метод класса.

Особенностью статических членов и методов является тот факт, что они определяются не на уровне объекта, а на уровне класса.

Статическое свойство недоступно через обращение 

```
$this->property
```
 или

```
  $obj->property
```

Вместо этого используется оператор :: и либо имя класса ( ИмяКласса::$property ), либо ключевое слово self ( self::$property ).

Статический метод во время своего запуска не получает ссылку $this, поэтому он может работать только со статическими членами (свойствами и другими методами) своего класса.


# class Router

```php

class Router
{
   // Определение массива констант
   protected $routes = [];

    protected $result;

    public function define($routes)
    {
        $this->routes = $routes;
    }

```
## Определение массива констант

```php

$router->define([
    'contact' => 'ContactController@index',
    'about' => 'AboutController@index',
    'blog' => 'BlogController@index',
    'blog/search' => 'BlogController@search',
    'guestbook' => 'GuestbookController@index',
    'admin' => 'Admin\DashboardController@index',
    'admin/categories'=>'Admin\shop\CategoriesController@index',
    'admin/categories/create' => 'Admin\shop\CategoriesController@create',
    'admin/products' => 'Admin\shop\ProductsController@index',
    'admin/products/create'=>'Admin\shop\ProductsController@create',
    'admin/posts' => 'Admin\blog\PostsController@index',
    'admin/posts/create' => 'Admin\blog\PostsController@create',
    //Главаня страница
    'index.php' => 'HomeController@index', 
    '' => 'HomeController@index',  
]);


```

## Позднее статическое связывание

Начиная с версии PHP 5.3.0 появилась особенность, называемая позднее статическое связывание или LSB (Late Static Binding), которая может быть использована для того, чтобы получить ссылку на вызываемый класс в контексте статического наследования.

У конструкции self и константы __CLASS__ имеется ограничение: они не позволяют переопределить статический метод в производных классах. 

Для решения этой дилеммы был придуман механизм связывания «позднего», на этапе рантайма. Работает он очень просто — достаточно вместо слова «self» написать «static» и связь будет установлена с тем классом, который вызывает данный код, а не с тем, где он написан:


```php
class Model {
  public static $table = 'table';
  public static function getTable() {
    return static::$table;
  }
}

```

Позднее статическое связывание сохраняет имя класса указанного в последнем "неперенаправленном вызове". 

В случае статических вызовов это явно указанный класс (обычно слева от оператора ::); в случае не статических вызовов это класс объекта. 

"Перенаправленный вызов" - это статический вызов, начинающийся с self::, parent::, static::, или, если двигаться вверх по иерархии классов, forward_static_call(). 

Функция get_called_class() может быть использована для получения строки с именем вызванного класса, а static:: представляет ее область действия.

Само название "позднее статическое связывание" отражает в себе внутреннюю реализацию этой особенности. 

"Позднее связывание" отражает тот факт, что обращения через static:: не будут вычисляться по отношению к классу, в котором вызываемый метод определен, а будут вычисляться на основе информации в ходе исполнения. 

Также эта особенность была названа "статическое связывание" потому, что она может быть использована (но не обязательно) в статических методах.

```php
class Model {
  public static $table = 'table';
  public static function getTable() {
    return static::$table;
  }
}
class Post extends Model {
  public static $table = 'posts';
}

echo Post::getTable(); // 'posts'  // Это и есть загадочное «позднее статическое связывание». 

```
# Использование new static()
Для абстрактных классов со статическим методом вы можете использовать ключевое слово static следующим образом:

```php
abstract class A{
    static function create(){
        //return new self();  //Fatal error: Cannot instantiate abstract class A
        return new static(); //this is the correct way
    }
}

class B extends A{
}

$obj=B::create();

var_dump($obj);

```

```php

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

```

## cli/router

```php

$routesFile = realpath(__DIR__).'/routes.php';


print_r(Router::load($routesFile));

Router Object
(
    [routes:protected] => Array
        (
            [contact] => ContactController@index
            [about] => AboutController@index
            [blog] => BlogController@index
            [blog/search] => BlogController@search
            [guestbook] => GuestbookController@index
            [admin] => Admin\DashboardController@index
            [admin/categories] => Admin\shop\CategoriesController@index
            [admin/category/add] => Admin\shop\CategoriesController@create
            [admin/products] => Admin\shop\ProductsController@index
            [admin/product/add] => Admin\shop\ProductsController@create
            [admin/posts] => Admin\posts\PostController@index
            [admin/posts/add] => Admin\posts\PostController@add
            [index.php] => HomeController@index
            [] => HomeController@index
        )

    [result:protected] => 
)

```
## directPath

```php

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

```

# Переменное количество аргументов

http://php.net/manual/ru/language.types.callable.php 

```php

mixed call_user_func_array ( callable $callback , array $param_arr )

```
Вызывает callback-функцию callback, с параметрами из массива param_arr.
- callback - Вызываемая функция типа callable.
- param_arr - Передаваемые в функцию параметры в виде индексированного массива.

Возвращает результат функции или FALSE в случае ошибки.
Если количество аргументов, которые вы хотите передать, зависит от длины массива, это, вероятно, означает, что вы можете упаковать их в массив самостоятельно - и использовать его для второго параметра call_user_func_array.

Элементы этого массива будут приниматься вашей функцией в виде отдельных параметров.

```php

function test() {

  var_dump(func_num_args());
  var_dump(func_get_args());

}

// Вы можете упаковать свои параметры в массив, например:

$params = array( 10,  'glop',  'test',);

// И затем вызовите функцию:

call_user_func_array('test', $params);

```

## Router

### Поиск маршрутов

```php

public function directPath($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            return call_user_func_array('Router::action', explode('@', $this->routes[$uri]));
        }
        else{
          require_once VIEWS.'404'.EXT;
          throw new Exception('No route defined for this URI.');
      }
    }

```

# Оператор splat

В  Php 5.6+ можно использовать ... operator вместо func_get_args().
оператор... (также известный как оператор splat на некоторых языках):

Можно получить все параметры, которые вы передаете:

```php
function manyVars(...$params) {
   var_dump($params);
}
```
оператор ... собирает список переменных аргументов в массиве.

```php

public function directPath($uri)
   {
       if (array_key_exists($uri, $this->routes)) {
           return $this->callAction(...explode('@', $this->routes[$uri]));
       }
       throw new Exception('No route defined for this URI.');
   }


```

## function action

```php

protected function action($segments, $action, $vars = [])
    {
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

      include($controllerFile);

      $controller = new $controller;
      if (! method_exists($controller, $action)) {
        require_once VIEWS.'404'.EXT;
        throw new Exception(
        "{$controller} does not respond to the {$action} action."
        );
      }
      $this->result = true;
      return $controller->$action($vars); // return $vars to the action
    }
```
## function directPath

```php

public function directPath($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            return $this->action(...explode('@', $this->routes[$uri]));
        }
        else{
          require_once VIEWS.'404'.EXT;
          throw new Exception('No route defined for this URI.');
      }
    }

```
## getURI

```php

function getURI(){
    if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
        return trim($_SERVER['REQUEST_URI'], '/');
}

```

# class Request

```php
<?php

class Request
{
	
    public static function uri()
	{
		if (isset($_SERVER["REQUEST_URI"]) and !empty($_SERVER["REQUEST_URI"]))
            return trim($_SERVER["REQUEST_URI"], '/');
	}

}

```
# bootstrap

```php

require_once realpath(__DIR__).'/../config/app.php';
require_once CORE.'Connection.php';
require_once MODELS.'Category.php';
require_once MODELS.'Product.php';
require_once MODELS.'Post.php';
require_once CORE.'View.php';
require_once CORE.'Controller.php';

require_once CORE.'Request.php';
require_once CORE.'Router.php';

```

# Экземпляр маршрутизатора

```php


$routesFile = CONFIG.'routes.php';

Router::load($routesFile)
   ->directPath(Request::uri());

```

# Реализация маршрутизатора

```php

<?php
class Router
{
    protected $routes = [];

    protected $result;

    public function __construct(){

    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function directPath($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            return $this->action(...explode('@', $this->routes[$uri]));
        }
        else{
          require_once VIEWS.'404'.EXT;
          throw new Exception('No route defined for this URI.');
      }
    }


    protected function action($segments, $action, $vars = [])
    {
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

      include($controllerFile);

      $controller = new $controller;
      if (! method_exists($controller, $action)) {
        require_once VIEWS.'404'.EXT;
        throw new Exception(
        "{$controller} does not respond to the {$action} action."
        );
      }
      $this->result = true;
      return $controller->$action($vars); // return $vars to the action
    }
}

```