# shopping-cart
# Модель

Модель — содержит бизнес-логику приложения и включает методы выборки (это могут быть методы ORM), обработки (например, правила валидации) и предоставления конкретных данных, что зачастую делает ее очень толстой.

Модель не должна напрямую взаимодействовать с пользователем. Все переменные, относящиеся к запросу пользователя должны обрабатываться в контроллере.

Модель не должна генерировать HTML или другой код отображения, который может изменяться в зависимости от нужд пользователя. Такой код должен обрабатываться в видах.

Одна и та же модель, например: модель аутентификации пользователей может использоваться как в пользовательской, так и в административной части приложения. В таком случае можно вынести общий код в отдельный класс и наследоваться от него, определяя в наследниках специфичные для подприложений методы.

### Создать таблицу categories

```php
# Create TABLE categories

$sql = "CREATE TABLE categories (
   id int(11) NOT NULL AUTO_INCREMENT,
   name varchar(255) NOT NULL,
   status tinyint(1) NOT NULL,
   PRIMARY KEY (id)
);";

```

### Создать папку models

### Создать в models файл Category.php

## Модель для работы с категориями

```php

  <?php
    * Модель для работы с категориями
    /**
       models/Category.php
    */

    class Category {


    }

```

## Список категорий

### Создать метод index ()

```php

/* Список категорий для админпанели
   Возвращает массив всех категорий  
   @return array
*/
  public static function index () {
       $db = Connection::make();
       $sql = "SELECT id, name, status FROM categories ORDER BY id ASC";
       $res = $db->query($sql);
       $categories = $res->fetchAll(PDO::FETCH_ASSOC);
       return $categories;
   }

```


## Чтение (read) SELECT  GET
```php
       $db = Connection::make();

       $sql = "SELECT id, name, status FROM categories
                   ORDER BY id ASC";

       $res = $db->query($sql);
       $categories = $res->fetchAll(PDO::FETCH_ASSOC);
```

## Только активные категории

### Создать метод getActiveCategories ()

```php
/* Список категорий для админпанели
   Возвращает массив всех категорий, у которых статус отображения = 0
   @return array   
*/
           public static function getActiveCategories () {
               $db = Connection::make();
               $sql = "SELECT id, name, status FROM categories
                       WHERE status = 1
                       ORDER BY id ASC";
               $res = $db->query($sql);
               $categories = $res->fetchAll(PDO::FETCH_ASSOC);
               return $categories;
           }

```
## Отображение статуса
### Создать метод getStatusText ($status)
```php
 /**
   * Вместо числового статуса категории, отображаем определенную строку
   * full-stack-php/models/Category.php
   * @param $status
   * @return string
*/
public static function getStatusText ($status) {
                  switch ($status) {
                      case '1':
                          return 'Отображается';
                          break;
                      case '0':
                          return 'Скрыта';
                          break;
                  }
              }
```

## Контроллер для категорий
### Создать в папке controllers/Admin/shop файл CategoriesController.php
### Создать метод index ()

```php

/* Контроллер для управления категориями CategoriesController.php
 controllers/Admin/shop/CategoriesController.php */

  class CategoriesController extends Controller{
     /**
     * Главная страница управления категориями
     * @return bool
     */
     public function index (){
           $data['categories'] = Category::index();
           $data['title'] = 'Admin Category List Page ';
           $this->_view->render('admin/categories/index', $data);
     }
```

## Шаблон отображения

### Создать шаблон представления для списка категлрий

```php

// views/admin/categories/index.php

 <?php include_once VIEWS.'shared/admin/header.php'; ?>
         <main><h1><?= $title;?></h1></main>
                   <article class='large'>
                        <a href="/admin/category/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить категорию</a>

                        <h4>Список категорий</h4>
                        <table>
                            <tr>
                                <th>ID категории</th>
                                <th>Название категории</th>
                                <th>Статус</th>
                            </tr>


```

## Построение списка категорий

```php
<?php foreach ($categories as $category):?>
    <tr>
        <td><?php echo $category['id']?></td>
        <td><?php echo $category['name']?></td>
        <td>
            <?php echo Category::getStatusText($category['status']);?>
        </td>
        <td><a title="Редактировать" href="" class="del">
                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
            </a></td>
        <td><a title="Удалить" href="" class="del">
                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
            </a></td>
    </tr>
<?php endforeach;?>
</table>
```

## Оператор создания (create) INSERT  

INSERT — оператор языка SQL, который позволяет добавить строки в таблицу, заполняя их значениями.

Значения можно вставлять перечислением с помощью слова values и перечислив их в круглых скобках через запятую или оператором select.


## Оператор INSERT

```sql
INSERT [LOW_PRIORITY | DELAYED] [IGNORE]
        [INTO] tbl_name [(col_name,...)]
        VALUES (expression,...),(...),...
        [ ON DUPLICATE KEY UPDATE col_name=expression, ... ]

```

Оператор INSERT вставляет новые строки в существующую таблицу. Форма данной команды INSERT ... VALUES вставляет строки в соответствии с точно указанными в команде значениями.

tbl_name задает таблицу, в которую должны быть внесены строки.

Если не указан список столбцов для INSERT ... VALUES, то величины для всех столбцов должны быть определены в списке VALUES(). Если порядок столбцов в таблице неизвестен, для его получения можно использовать DESCRIBE tbl_name.

Любой столбец, для которого явно не указано значение, будет установлен в свое значение по умолчанию. Например, если в заданном списке столбцов не указаны все столбцы в данной таблице, то не упомянутые столбцы устанавливаются в свои значения по умолчанию.

Если указывается ключевое слово LOW_PRIORITY, то выполнение данной команды INSERT будет задержано до тех пор, пока другие клиенты не завершат чтение этой таблицы.
В этом случае данный клиент должен ожидать, пока данная команда вставки не будет завершена, что в случае интенсивного использования таблицы может потребовать значительного времени.

В противоположность этому команда INSERT DELAYED позволяет данному клиенту продолжать операцию сразу же

## Добавление категории(админка)

```php
/* Добавление категории(админка)
* /models/Category.php
* @param $options массив параметров
* @return bool
*/

public static function store ($options) {
   $db = Connection::make();
   $db->exec("set names utf8");
   $sql = "INSERT INTO categories(name, status)
               VALUES (:name, :status) ";
   $res = $db->prepare($sql);
   $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
   $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
   return $res->execute();
}

```
## Добавление категории

```php
/* Добавление категории

* /controllers/Admin/shop/CategoriesController.php
* @return bool
*/

   public function create () {
       if (isset($_POST) and !empty($_POST)) {
           $options['name'] = trim(strip_tags($_POST['name']));
           $options['status'] = trim(strip_tags($_POST['status']));
           Category::store($options);
           header('Location: /admin/categories');
       }
       $data['title'] = 'Admin Category Add New Category ';
       $this->_view->render('admin/categories/create', $data);

   }
```
## Функция string strip_tags

Эта функция пытается возвратить строку, из которой удалены все NULL-байты, HTML- и PHP-теги.

```php
   string strip_tags ( string $str [, string $allowable_tags ] )

   - str - Входная строка.
   - allowable_tags - Второй необязательный параметр может быть использован для указания тегов, которые не нужно удалять.

```

Комментарии HTML и PHP-теги также будут удалены.
Самозакрывающиеся (такие как br) теги XHTML игнорируются и только не самозакрывающиеся теги должны быть использованы в allowable_tags.


### Пример использования strip_tags()

```php
   $text = '<p>Параграф.</p><!-- Комментарий --> <a href="#fragment">Еще текст</a>';
   echo strip_tags($text);
   echo "\n";

   // Разрешаем <p> и <a>
   echo strip_tags($text, '<p><a>');

   Результат выполнения данного примера:

   Параграф. Еще текст
   <p>Параграф.</p> <a href="#fragment">Еще текст</a>
```

## HTML-формы (GET и POST)

Когда происходит отправка данных формы PHP-скрипту, информация из этой формы автоматически становится доступной этому скрипту.

```html

<form action="#" method="post">
    <p>Название категории</p>
    <input required type="text" name="name">

    <input type=submit name="submit" value="Сохранить" id="add_btn">

</form>

```

PHP также понимает массивы в контексте переменных формы.

Можно сгруппировать связанные переменные вместе или использовать эту возможность для получения значений списка множественного выбора select.

```html
            <p>Статус отображения</p>
            <select name="status">
                <option value="1" selected>Отображать</option>
                <option value="0">Скрыть</option>
            </select>
```

GET-форма используется аналогично, за исключением того, что вместо POST, вам нужно будет использовать соответствующую предопределенную переменную GET.

GET относится также к QUERY_STRING (информация в URL после '?').

Так, например, http://www.example.com/test.php?id=3 содержит GET-данные, доступные как

```
$_GET['id'].
```

## Шаблон создания категории

```html

<?php include_once VIEWS.'shared/admin/header.php'; ?>
<main><h1><?= $title;?></h1></main>

   <article class='large'>
       <h1>Добавить новню категорию</h1>
       <form action="" method="post" id="add_form">
           <p>Название категории</p>
           <input required type="text" name="name">
           <p>Статус отображения</p>
           <select name="status">
               <option value="1" selected>Отображать</option>
               <option value="0">Скрыть</option>
           </select>
           <input type=submit name="submit" value="Сохранить" id="add_btn">
       </form>
  </article>

<?php include_once VIEWS.'shared/admin/footer.php';

```

## Create TABLE products

```sql

// views/admin/categories/create.php
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
   is_recommended tinyint(1) NOT NULL DEFAULT '0',
   PRIMARY KEY (id)
);";
```
## Модель для работы с товарами

```php
<?php
/**
* Модель для работы с товарами
* models/Product.php
*/

class Product {

   //Количество отображаемых товаров по умолчанию

   const SHOW_BY_DEFAULT = 6;

   /**
    * Выводит список всех товаров
    *
    * @return array
    */
   public static function index() {
       $con = Connection::make();
       $con->exec("set names utf8mb4");
       $sql = "SELECT id, name, price FROM products
               ORDER BY id ASC";
       $res = $con->query($sql);
       $products = $res->fetchAll(PDO::FETCH_ASSOC);
       return $products;
   }
```
## Контроллер для управления списком товаров

```php
   <?php
   /*

   Контроллер для просмотра и управления
   списком всех товаров, имеющихся в базе

   */

   class ProductsController extends Controller {
      /**
       * Просмотр всех товаров
       * @return bool
       */
      public function index () {

          $data['products'] = Product::index();
          $data['title'] = 'Admin Product List Page ';
          $this->_view->render('admin/products/index', $data);
      }
```
## Шаблон списка товаров

```html

      // views/admin/products/index.php
      <?php include_once VIEWS.'shared/admin/header.php'; ?>
             <main> <h1><?= $title;?></h1> </main>
      <article class='large'>
        <div class="container_admin">
         <a href="/admin/product/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить товар </a>
         <h4>Список товаров</h4>
         <table>
             <tr>
                 <th>id товара</th>
                 <th>Название</th>
                 <th>Цена</th>
             </tr>


             <?php foreach ($products as $product):?>
             <tr>
                 <td><?php echo $product['id']?></td>
                 <td><?php echo $product['name']?></td>
                 <td><?php echo $product['price']?></td>
                 <td><a title="Редактировать" href="" class="del">
                     <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                     </a></td>
                 <td><a title="Удалить" href="" class="del">
                     <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                 </a></td>
             </tr>
             <?php endforeach;?>
         </table>
      </div>
      </article>
```

## Добавление продукта

```php
      /**
          * Добавление продукта
          * full-stack-php/models/Product.php
          * @param $options - характеристики товара
          * @return int|string
       */
         public static function store ($options) {

             $con = Connection::make();
             $sql = "INSERT INTO products(
                     name, category_id, price, brand,
                     description, is_new, status
                     )
                     VALUES (:name, :category_id, :price,
                     :brand, :description, :is_new, :status)";

             $res = $con->prepare($sql);

             $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
             $res->bindParam(':category_id', $options['category'], PDO::PARAM_INT);
             $res->bindParam(':price', $options['price'], PDO::PARAM_INT);
             $res->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
             $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
             $res->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
             $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

       }
```

## Идентификатор последней записи

```php
//Если запрос выполнен успешно
        if ($res->execute()) {
            //Возвращаем id последней записи
            return $con->lastInsertId();
        } else {
            return NULL;
        }
```

## PDO::lastInsertId
```
public string PDO::lastInsertId ([ string $name = NULL ] )
```
Возвращает ID последней вставленной строки либо последнее значение, которое выдал объект последовательности. Что именно будет возвращено, зависит от нижележащего драйвера. Например, метод PDO_PGSQL требует задать имя объекта последовательности для параметра name.
name - Имя объекта последовательности, который должен выдать ID.

В зависимости от PDO драйвера этот метод может вообще не выдать осмысленного результата, так как база данных может не поддерживать автоинкремент или последовательности.

Если объект последовательности для name не задан, PDO::lastInsertId() вернет строку представляющую ID последней добавленной в базу записи.
Если же объект последовательности для name задан, PDO::lastInsertId() вернет строку представляющую последнее значение, полученное от этого объекта.

Если PDO драйвер не поддерживает эту возможность, PDO::lastInsertId() запишет IM001 в SQLSTATE.

```php
/* Добавление товара    

controllers/Admin/shop/ProductsController.php  

*/

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
        Product::store($options);
        header('Location: /admin/products');
    }


   $data['title'] = 'Admin Product Add New Product ';
   $data['categories'] = Category::index();
   $this->_view->render('admin/products/add',$data);

 }


```


```php
    /views/admin/products/add.php


    <?php include_once VIEWS.'shared/admin/header.php'; ?>
    <main> <h1><?= $title;?></h1>  </main>

      <article class='large'>

               <h1>Добавить новый товар</h1>
               <form action="" method="post">
                   <p>Название товара</p>
                   <input required type="text" name="name">
                   <p>Стоимость</p>
                   <input required type="text" name="price">


                                  <p>Категория</p>
                                  <select name="category">
                                      <?php if (is_array($data['categories'])): ?>
                                          <?php foreach ($data['categories'] as $category): ?>
                                              <option value="<?php echo $category['id']; ?>">
                                                  <?php echo $category['name']; ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>

                                  <p>Производитель</p>
                                  <input required type="text" name="brand">
                                  <p>Детальное описание</p>
                                  <textarea id="add_description" name="description"></textarea>
                                  <p>Новинка</p>
                                  <select name="is_new">
                                      <option value="1" selected>Да</option>
                                      <option value="0">Нет</option>
                                  </select>
                                  <p>Статус</p>
                                  <select name="status">
                                      <option value="1" selected>Отображается</option>
                                      <option value="0">Скрыт</option>
                                  </select>
                                  <input type=submit name="submit" value="Сохранить" id="add_btn">
                              </form>

```

## Функция header в php
http://php.net/manual/ru/function.header.php

header — Отправка HTTP-заголовка
```
void header ( string $string [, bool $replace = true [, int $http_response_code]] )

```
header() используется для отправки HTTP-заголовка. В спецификации HTTP/1.1 есть подробное описание HTTP заголовков.
$string: сам заголовок. Бывает двух типов. Первый начинается с «HTTP/» (header(«HTTP/1.0 404 Not Found»);). Второй начинается не с «HTTP/». Состоит из двух частей «имя парметра: значение» (например, «Location: http://www.example.com/» или «Content-type: application/pdf»).
Второй параметр булевого типа. Если true (по умолчанию), то заголовок замещает предыдущий с таким же именем параметра, если false, то передаётся несколько параметров одного типа
Третий параметр, $http_response_code, можно использовать для передачи HTTP-заголовков ответа (200, 404 и т.п.)

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
Функция header используется для простановки заголовков «вручную», для кэширования, для внешнего перенаправления, для выставления правильного mime-типа и кодировки.
```

## Пример внешнего перенаправления:
```php
    public static function redirect($url = '/')
    {
        header('Location: ' . $url);
        die();
    }

    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }

    html:

    <a href="<?= $previous ?>">Back</a>

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

## Подключаем модели

```php
// bootstrap/bootstrap.php
if (function_exists('date_default_timezone_set')){
   date_default_timezone_set('Europe/Kiev');   
}
// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once realpath(__DIR__).'/../config/app.php';
require_once CORE.'Connection.php';
require_once MODELS.'Category.php';
require_once MODELS.'Product.php';
require_once MODELS.'Post.php';
require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Router.php';

```

## Модель блога

```php

<?php
/**
* Модель для работы с posts
*/
class Post {
     public static function index () {

       $con = Connection::make();

       //Подготавливаем данные
       $sql = "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status FROM posts ORDER BY id ASC";

       //Выполняем запрос
       $res = $con->query($sql);

       //Получаем и возвращаем результат
       $posts = $res->fetchAll(PDO::FETCH_ASSOC);
       return $posts;
   }
```

## Контроллер для управления post

```php
   <?php
   /** controllers/Admin/posts/PostController.php
   * Контроллер для управления post
   */
   class PostController extends Controller{
      /* Главная страница управления post
       * @return bool    */
      public function index()
      {      
          $posts = Post::index();
          $data['title'] = 'Admin Posts Page ';
          $data['posts'] = $posts;
          // print_r($posts);
          $this->_view->render('admin/posts/index',$data);
      }


         public static function getStatusText ($status) {
             switch ($status) {
                 case '1':
                     return 'Отображается';
                     break;
                 case '0':
                     return 'Скрыта';
                     break;
             }
         }
```

## Шаблон списка публикаций

```php
<?php include_once VIEWS.'shared/admin/header.php';?>
       <main> <h1><?= $title;?></h1>  </main>
<article class='large'>
       <a href="/admin/posts/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить пост  </a>
       <h4>Список публикаций</h4>
       <table>
           <tr>
               <th>ID</th>
               <th>Название</th>
               <th>Статус</th>
               <th colspan="2">Action</th>
           </tr>

           <?php foreach ($data['posts'] as $post):?>
               <tr>
                   <td><?php echo $post['id']?></td>
                   <td><?php echo $post['title']?></td>
                   <td>
                       <?php echo Post::getStatusText($post['status']);?>
                   </td>
                   <td><a title="Редактировать" href="" class="del">
                           <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                       </a></td>
                   <td><a title="Удалить" href="" class="del">
                           <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                       </a></td>
               </tr>
           <?php endforeach;?>
       </table>
```

## Создание блога
```php
public static function store ($options) {
    $db = Connection::make();

    $sql = "INSERT INTO posts(title, content, status)
            VALUES (:title, :content, :status)";
    $res = $db->prepare($sql);
    $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
    $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
    $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
    //Если запрос выполнен успешно
    if ($res->execute()) {
        return $db->lastInsertId();
    } else {
        return 0;
    }
}

public function add () {
    //Принимаем данные из формы
    if (isset($_POST) and !empty($_POST)) {
        $options['title'] = trim(strip_tags($_POST['title']));
        $options['content'] = trim($_POST['content']);
        // $options['content'] = trim(strip_tags($_POST['content']));
        $options['status'] = trim(strip_tags($_POST['status']));
        $id = Post::store($options);
        header('Location: /admin/posts');
    }
    $data['title'] = 'Admin Add Post ';

    $this->_view->render('admin/posts/add',$data);

}
}
```
## Шаблон создания публикации

```php
<?php include_once VIEWS.'shared/admin/header.php'; ?>
<main> <h1><?= $title;?></h1></main>
       <h1>Добавить новую публикацию</h1>
       <form action='' method='post'>
           <p><label>Заголовок</label><br />
           <input type='text' name='title' value=''></p>
           <p><label>Контент</label><br />
           <textarea name='content' cols='60' rows='10'></textarea></p>
           <p>Статус отображения</p>
           <select name="status">
               <option value="1" selected>Отображать</option>
               <option value="0">Скрыть</option>
           </select>
           <p><input type='submit' name='submit' value='Сохранить'></p>
       </form>
<?php include_once VIEWS.'shared/admin/footer.php';
```
## Маршруты

```php
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
   'admin/posts' => 'Admin\posts\PostController@index',
   'admin/posts/add' => 'Admin\posts\PostController@add',
   //Главаня страница
   'index.php' => 'HomeController@index',
   '' => 'HomeController@index',
];
```
