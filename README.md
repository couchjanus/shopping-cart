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

```PHP

<?php

    define('ROOT', realpath(__DIR__.'/../'));
    define('VIEWS', ROOT.'/views/');
    define('CONTROLLERS', ROOT.'/controllers/');
    define('CONFIG', ROOT.'/config/');

    define('MODELS', ROOT.'/models/');

    define('CORE', ROOT.'/core/');
    define('DB', ROOT.'/db/');
    define('EXT', '.php');
    define('APPNAME', 'Great Shopaholic');
    define('SLOGAN', 'Lets Build Cool Site');
```

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

/* Список категорий
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
                    <div class="panel-title"><h3><?= $title;?></h3></div>
                    <a href="/admin/categories/create"><button class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Add New</button></a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Category Name</th>
                              <th>Action</th>
                            </tr>
                          </thead>



```

## Построение списка категорий

```php
<tbody class="table-items">
<?php foreach ($categories as $category):?>
  <tr>
    <td><?php echo $category['id']?></td>
    <td><?php echo $category['name']?></td>
    <td>
    <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
    <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>
    <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
    <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></td>
  </tr>
  <?php endforeach;?>
</tbody>
</table>
</div>
</div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';
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
    $sql = "INSERT INTO categories(name, status)
            VALUES (:name, :status)";

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
    $data['title'] = 'Admin Add New Category ';
    $this->_view->render('admin/categories/create', $data);

}
```
## Функция trim

trim — Удаляет пробелы (или другие символы) из начала и конца строки
Описание
```
string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
```

Эта функция возвращает строку str с удаленными из начала и конца строки пробелами. Если второй параметр не передан, trim() удаляет следующие символы:

```
    " " (ASCII 32 (0x20)), обычный пробел.
    "\t" (ASCII 9 (0x09)), символ табуляции.
    "\n" (ASCII 10 (0x0A)), символ перевода строки.
    "\r" (ASCII 13 (0x0D)), символ возврата каретки.
    "\0" (ASCII 0 (0x00)), NUL-байт.
    "\x0B" (ASCII 11 (0x0B)), вертикальная табуляция.

```
Список параметров

- str - Обрезаемая строка (string).
- character_mask -  Можно также задать список символов для удаления с помощью необязательного аргумента character_mask. Просто перечислите все символы, которые вы хотите удалить. Можно указать конструкцию .. для обозначения диапазона символов.

## Пример использования trim()

```php
<?php

$text   = "\t\tThese are a few words :) ...  ";
$binary = "\x09Example string\x0A";
$hello  = "Hello World";
var_dump($text, $binary, $hello);

print "\n";

$trimmed = trim($text);
var_dump($trimmed);

$trimmed = trim($text, " \t.");
var_dump($trimmed);

$trimmed = trim($hello, "Hdle");
var_dump($trimmed);

$trimmed = trim($hello, 'HdWr');
var_dump($trimmed);

// удаляем управляющие ASCII-символы с начала и конца $binary
// (от 0 до 31 включительно)
$clean = trim($binary, "\x00..\x1F");
var_dump($clean);

?>
```


## Обрезание значений массива с помощью trim()

```php
<?php
function trim_value(&$value)
{
    $value = trim($value);
}

$fruit = array('apple','banana ', ' cranberry ');
var_dump($fruit);

array_walk($fruit, 'trim_value');
var_dump($fruit);

?>
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

## Шаблон создания категории

```html

<form class="form-horizontal" method="POST" role="form" id="idForm">

  <div class="panel-body">
      <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Category Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
              </div>
      </div>

      <div class="form-group">
              <label for="status" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                  <select name="status" class="form-control">
                      <option value="1" selected>Отображается</option>
                      <option value="0">Скрыт</option>
                  </select>
              </div>
      </div>
  </div>
  <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button id="save" type="submit" class="save btn btn-primary">Add Category</button>
      </div>
  </div>
</form>

```

PHP также понимает массивы в контексте переменных формы.

Можно сгруппировать связанные переменные вместе или использовать эту возможность для получения значений списка множественного выбора select.

```html
<div class="form-group">
        <label for="status" class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
            <select name="status" class="form-control">
                <option value="1" selected>Отображается</option>
                <option value="0">Скрыт</option>
            </select>
        </div>
</div>
```

GET-форма используется аналогично, за исключением того, что вместо POST, вам нужно будет использовать соответствующую предопределенную переменную GET.

GET относится также к QUERY_STRING (информация в URL после '?').

Так, например, http://www.example.com/test.php?id=3 содержит GET-данные, доступные как

```
$_GET['id'].
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
   $this->_view->render('admin/products/create',$data);

 }


```
## Шаблон Добавление товара

```php
    /views/admin/products/create.php
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
              <form class="form-horizontal" role="form" method="POST" id="idForm">

                <div class="panel-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Product Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Product Price">
                            </div>
                    </div>
```

## Product Category

```php
                    <div class="form-group">
                      <label for="category" class="col-sm-2 control-label">Product Category</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="category" name="category">
                            <?php if (is_array($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
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
                                <input type="text" class="form-control" id="brand" name="brand" placeholder="Product brand">
                            </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 control-label" for="description">Product Description</label>
                            <div class="col-sm-10">
                               <input type="text" class="form-control" id="description" name="description" placeholder="Product Description">
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="is_new" class="col-sm-2 control-label">Is New</label>
                            <div class="col-sm-10">
                                <select name="is_new" class="form-control">
                                    <option value="1" selected>Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    <option value="1" selected>Отображается</option>
                                    <option value="0">Скрыт</option>
                                </select>
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

 }

```

## Контроллер для управления post

```php
class PostsController extends Controller {

  public function index()
  {       
      $posts = Post::index();
      $data['title'] = 'Admin Posts Page ';
      $data['posts'] = $posts;
      $this->_view->render('admin/posts/index',$data);
  }


  public function create () {
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

      $this->_view->render('admin/posts/create',$data);

  }
```

## Шаблон списка публикаций

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
                    <div class="panel-title"><h3><?= $title;?></h3></div>
                    <a href="/admin/posts/create"><button class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Add New</button></a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Post Title</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody class="table-items">
                          <?php foreach ($posts as $post):?>
                            <tr>
                              <td><?php echo $post['id']?></td>
                              <td><?php echo $post['title']?></td>
                              <td>
                              <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
                              <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>
                              <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                              <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></td>
                            </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
include_once VIEWS.'shared/admin/footer.php';

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
```

```php
public function create () {
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
                          <input type="text" class="form-control" id="title" name="title" placeholder="Post Title">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="content">Post Content</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" id="content" name="content">Post Content</textarea>
                        </div>
                </div>

                <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" selected>Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>
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
