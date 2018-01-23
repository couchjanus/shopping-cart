# shopping-cart 

# Расширения для работы с базами данных


- DBA — Database (dbm-style) 
- ODBC — ODBC (Unified)
- PDO — Объекты данных PHP
- MongoDB — Драйвер MongoDB
- Mssql — Microsoft SQL Server
- MySQL — MySQL драйверы и плагины
- OCI8 — Oracle OCI8
- PostgreSQL
- SQLite3
- Sybase

http://php.net/manual/ru/refs.database.php 

# Расширение Объекты данных PHP (PDO)

Расширение Объекты данных PHP (PDO) определяет простой и согласованный интерфейс для доступа к базам данных в PHP. Каждый драйвер базы данных, в котором реализован этот интерфейс, может представить специфичный для базы данных функционал в виде стандартных функций расширения. 

Само по себе расширение PDO не позволяет манипулировать доступом к базе данных. Чтобы воспользоваться возможностями PDO, необходимо использовать соответствующий конкретной базе данных PDO драйвер.

PDO обеспечивает абстракцию доступа к данным. Это значит, что вне зависимости от того, какая конкретная база данных используется, вы можете пользоваться одними и теми функциями для выполнения запросов и выборки данных. PDO не абстрагирует саму базу данных, это расширение не переписывает SQL запросы и не эмулирует отсутствующий в СУБД функционал. Если нужно именно это, необходимо воспользоваться полноценной абстракцией базы данных.

PDO может поддерживать любую систему управления базами данных, для которой существует PDO-драйвер.

## Увидеть список доступных драйверов можно так:

```
    print_r(PDO::getAvailableDrivers());

```
## Инсталляция PDO на Unix системах

PDO и драйвер PDO_SQLITE включены по умолчанию в PHP, начиная с версии 5.1.0. Чтобы включить PDO драйвер для произвольной базы данных, обратитесь к документации PDO драйверы баз данных.

## Пользователи Windows
PDO и все основные драйверы внедрены в PHP как загружаемые модули. Чтобы их использовать, требуется их просто включить, отредактировав файл php.ini следующим образом:

```
extension=php_pdo.dll
```

## Способы подключения к MS SQL Server и Sybase 
```php
try {  
        # MS SQL Server и Sybase через PDO_DBLIB  
        $DBH = new PDO("mssql:host=$host;dbname=$dbname", $user, $pass);  
        $DBH = new PDO("sybase:host=$host;dbname=$dbname", $user, $pass);  
    }  
        catch(PDOException $e) {  
            echo $e->getMessage();  
        }

```

## Способы подключения к SQLite
```php
try {  
    # SQLite  
        $DBH = new PDO("sqlite:my/database/path/database.db");  
        }  
        catch(PDOException $e) {  
            echo $e->getMessage();  
        }


```
## PDO_PGSQL DSN — Соединение с базой данных PostgreSQL

Строка подключания (Data Source Name или DSN) PDO_PGSQL состоит из следующих элементов, разделенных пробелом либо точкой с запятой:

- Префикс DSN
- pgsql:.

```
$connection = new PDO("pgsql:host=localhost;port=5432;dbname=myshop; user=dev; password=ghbdtn");

```
- host - Имя хоста, на котором расположена база данных.
- port - Порт, на котором эта база данных ждет подключения.
- dbname - Имя базы данных.
- user - Имя пользователя для соединения. Если вы зададите имя пользователя в DSN, PDO проигнорирует значение, переданное в качестве параметра конструктору.
- password - Пароль пользователя для соединения. Если вы зададите пароль в DSN, PDO проигнорирует значение, переданное в качестве параметра конструктору.


## Установка соединения с базой mysql

```php
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

/* проверка соединения */

   $connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);

    echo "Connected successfully\n";

```

## Конструктор принимает три параметра:

- "mysql:host=$host;dbname=$dbname" - Так называемая строка dsn. В ней указан драйвер подключения к базе, хост, имя базы и кодировка.
- Логин $username = "dev";
- Пароль $password = "ghbdtn";


При успешном подключении к базе данных в скрипт будет возвращен созданный PDO объект. Соединение остается активным на протяжении всего времени жизни объекта. Чтобы закрыть соединение, необходимо уничтожить объект путем удаления всех ссылок на него (этого можно добиться, присваивая NULL всем переменным, указывающим на объект). Если не сделать этого явно, PHP автоматически закроет соединение по окончании работы скрипта.

## Обработка ошибок подключения

```php
try {
    $connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    echo "Connected successfully\n";
    $connection->query($sql);
    echo "Table Created successfully\n";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "\n";
    die();
} finally {
    // код, который будет выполнен при любом раскладе
    $connection = null;
}
```
Если ваше приложение не перехватывает исключение PDO конструктора, движок zend выполнит стандартные операции для завершения работы скрипта и вывода обратной трассировки. В этой трассировке будет содержаться детальная информация о соединении с базой данных, включая имя пользователя и пароль. Ответственность за перехват исключений лежит на вас. Перехватить исключение можно явно (с помощью выражения catch), либо неявно, задав глобальный обработчик ошибок функцией set_exception_handler().

При успешном подключении к базе данных в скрипт будет возвращен созданный PDO объект. Соединение остается активным на протяжении всего времени жизни объекта. Чтобы закрыть соединение, необходимо уничтожить объект путем удаления всех ссылок на него (этого можно добиться, присваивая NULL всем переменным, указывающим на объект). Если не сделать этого явно, PHP автоматически закроет соединение по окончании работы скрипта.

## Закрытие соединения
```php
$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
// здесь мы каким-то образом используем соединение
$sth = $dbh->query('SELECT * FROM foo');

// соединение больше не нужно, закрываем
$sth = null;
$dbh = null;
```
## Постоянные соединения

```
$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
```
Чтобы использовать постоянные соединения, необходимо добавить константу PDO::ATTR_PERSISTENT в массив параметров драйвера, который передается конструктору PDO. Если просто задать этот атрибут функцией PDO::setAttribute() уже после создания объекта, драйвер не будет использовать постоянные соединения.

## Выполнение запросов
Для выполнения запросов можно пользоваться двумя методами query и execute. 
Если в запрос не передаются никакие переменные, то можно воспользоваться функцией query(). 
http://php.net/manual/ru/pdo.query.php 

Функция query выполнит запрос и вернёт специальный объект — PDO statement. 
Получить данные из этого объекта можно как традиционным образом, через while, так и через foreach(). 

## Функция PDO::query
```php
PDO::query — Выполняет SQL запрос и возвращает результирующий набор в виде объекта PDOStatement
public PDOStatement PDO::query ( string $statement )
public PDOStatement PDO::query ( string $statement , int $PDO::FETCH_COLUMN , int $colno )
public PDOStatement PDO::query ( string $statement , int $PDO::FETCH_CLASS , string $classname , array $ctorargs )
public PDOStatement PDO::query ( string $statement , int $PDO::FETCH_INTO , object $object )

```
## Список параметров 
- statement - Текст SQL запроса для подготовки и выполнения.
Данные в запросе должны быть правильно экранированы.

PDO::query() возвращает объект PDOStatement или FALSE, если запрос выполнить не удалось.

## Создаем таблицу categories

```php
// Create TABLE categories
$sql = "CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    status tinyint(1) NOT NULL,
    PRIMARY KEY (id)
);";

$connection = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    echo "Connected successfully\n";


    $connection->query($sql);
    echo "Table Created successfully\n";
```


## Создаем таблицу products
```php
// Create TABLE products
$sql = "CREATE TABLE products (
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
);";
```
## Параметры соединения db.php
```
return [
    'database' => [
        'name' => 'mydb',
        'username' => 'dev',
        'password' => 'ghbdtn',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
```
## Класс Connection.php
```php
class Connection
 {
  
public static function make()
  {
    $db = include CONFIG.'db.php';
    $config = $db['database'];

    try {
      return new PDO(
        $config['connection'].';dbname='.$config['name'],
        $config['username'],
        $config['password'],
        $config['options']
      );

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
 }
```
# Использование наследования
Классы могут наследовать методы и свойства другого класса

Наследование реализуется с помощью ключевого слова extends
private свойства и методы не наследуются. 

Это не мешает работать public геттерам и сеттерам, унаследованным от User, например: $student->setName() работает, но напрямую получить свойство name внутри класса потомка мы не сможем - это приведет к ошибке.

Но если не устраивает - нужные нам свойства и методы можно объявить как protected - в этом случае они станут доступны в потомках, но по-прежнему не будут доступны извне.

## class View

```php

<?php

class View {
   
public function render($path, $data = [], $error = false){
       extract($data);
       return require VIEWS."/{$path}.php";
   }

}
```
## class Controller

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

## Изменим bootstrap

```php
<?php
if (function_exists('date_default_timezone_set')){
   date_default_timezone_set('Europe/Kiev');   
}
// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once realpath(__DIR__).'/../config/app.php';

require_once CORE.'Connection.php';
require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Router.php';
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
## Router.php

```php
<?php
$filename = CONFIG.'routes'.EXT;
$result = null;

function getURI(){
   if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
       return trim($_SERVER['REQUEST_URI'], '/');
}

if (file_exists($filename)) {
   define('ROUTES',include($filename));
} else {
   echo "Файл $filename не существует";
}
```

## Функция array_key_exists()

```php
function directPath($uri)
   {
     // Проверить наличие такого запроса в routes.php
       if (array_key_exists($uri, ROUTES)) {
           return ROUTES[$uri];
       }
       Throw new Exception('No route defined for this URI.');
   }
```
http://php.net/manual/ru/function.array-key-exists.php 
Функция array_key_exists() возвращает TRUE, если в массиве присутствует указанный ключ key. Параметр key может быть любым значением, которое подходит для индекса массива.

## Конструкция list()
```php
//получаем строку запроса
$uri = getURI();
$path = directPath($uri);

list($segments, $action) = explode('@', $path);
```
Подобно array(), это не функция, а языковая конструкция. list() используется для того, чтобы присвоить списку переменных значения за одну операцию.

http://php.net/manual/ru/function.list.php 


## Подключаем контроллер
```php
$segments = explode('\\', $segments);
$controller = array_pop($segments);
//Подключаем файл контроллера
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
```
## Создаем экземпляр класса
```php
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
```   
## Обработка исключений

```php
   catch (Exception $e) {
       // код который может обработать исключение
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
## Функция PDO::query
Если запрос будет запускаться многократно, для улучшения производительности приложения имеет смысл этот запрос один раз подготовить методом PDO::prepare(), а затем запускать на выполнение методом PDOStatement::execute() столько раз, сколько потребуется.

Если после выполнения предыдущего запроса вы не выбрали все данные из результирующего набора, следующий вызов PDO::query() может потерпеть неудачу. В таких случаях следует вызывать метод PDOStatement::closeCursor(), который освободит ресурсы базы данных занятые предыдущим объектом PDOStatement. После этого можно безопасно вызывать PDO::query().


Особенностью PDO::query() является то, что после выполнения SELECT запроса можно сразу работать с результирующим набором посредством курсора.
```php
function getFruit($conn) {
    $sql = 'SELECT name, color, calories FROM fruit ORDER BY name';
    foreach ($conn->query($sql) as $row) {
        print $row['name'] . "\t";
        print $row['color'] . "\t";
        print $row['calories'] . "\n";
    }
}
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
