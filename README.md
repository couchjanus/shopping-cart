# shopping-cart


## TABLE `products`;
```sql
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  `price` float unsigned NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `is_recommended` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```
## TABLE `pictures`;
```sql
CREATE TABLE `pictures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `resource_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```
## Добавление товара

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

            Product::store($options);
            
            $product_id = (int)Product::lastId();

            if (isset($_FILES['image'])) {
                
                //Каталог загрузки картинок
                $uploadDir = 'media';
                
                //Вывод ошибок
                $errors = array();
                
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];

                // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
                $type = pathinfo($_FILES['image']['name']);
                $file_ext = strtolower($type['extension']);

                $expensions= array("jpeg","jpg","png",'gif');
                //Определяем типы файлов для загрузки
                $fileTypes = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );

                //Проверяем пустые данные или нет
                if (empty($_FILES)) {
                    $errors[] = 'File name must have name';
                } elseif ($_FILES['image']['error'] > 0) {
                    // Проверяем на ошибки
                    $errors[] = $_FILES['image']['error'];
                } elseif ($file_size > 2097152) {
                    // если размер файла превышает 2 Мб
                    $errors[] = 'File size must be excately 2 MB';
                } elseif (in_array($file_ext, $expensions)=== false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                } elseif (!in_array($file_type, $fileTypes)) {
                    // Проверяем тип файла
                    $errors[] = 'Запрещённый тип файла';
                }
                
                if (empty($errors)) {
                
                    $type = pathinfo($_FILES['image']['name']);
                    
                    $name = uniqid('files_') .'.'. $type['extension'];
           
                    move_uploaded_file($file_tmp, "media/".$name);
                      
                    $opts['filename'] = $name;
                    $opts['resource_id'] = $product_id;
                } else {
                    print_r($errors);
                }
            }

            $opts['resource'] = $this->_resource;
            Picture::store($opts);

            $this->metas['resource_id'] = $product_id;
            $this->metas['resource'] = $this->_resource;
            $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
            
            $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
            
            $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
            
            $this->metas['links'] = trim(strip_tags($_POST['meta_links']));

            Meta::store($this->metas);

            header('Location: /admin/products');
         }

         $data['title'] = 'Admin Product Add New Product ';
         $data['categories'] = Category::index();
         $this->_view->render('admin/products/create', $data);
     }
```

## Оператор SQL IN

Оператор SQL IN позволяет определить, совпадает ли значение объекта со значением в списке.

Оператор SQL IN имеет следующий синтаксис:

```sql	
expression [ NOT ] IN ( expression, [...] )
```


```sql	
SELECT *
FROM products
WHERE title IN ('cat', 'new cat')
```
Этот запрос аналогичен:

```sql	
SELECT *
FROM products
WHERE title = 'cat'
OR title = 'new cat'
```
если значений много, то удобней перечислить их в операторе SQL IN


# Join (SQL)

JOIN — оператор языка SQL, который является реализацией операции соединения реляционной алгебры. Входит в предложение FROM операторов SELECT, UPDATE и DELETE.

Операция соединения, как и другие бинарные операции, предназначена для обеспечения выборки данных из двух таблиц и включения этих данных в один результирующий набор. Отличительными особенностями операции соединения являются следующие:

- в схему таблицы-результата входят столбцы обеих исходных таблиц (таблиц-операндов), то есть схема результата является «сцеплением» схем операндов;
- каждая строка таблицы-результата является «сцеплением» строки из одной таблицы-операнда со строкой второй таблицы-операнда.

Определение того, какие именно исходные строки войдут в результат и в каких сочетаниях, зависит от типа операции соединения и от явно заданного условия соединения. Условие соединения, то есть условие сопоставления строк исходных таблиц друг с другом, представляет собой логическое выражение (предикат).

При необходимости соединения не двух, а нескольких таблиц, операция соединения применяется несколько раз (последовательно). 


## Описание оператора
```sql
FROM
  Table1
  {INNER | {LEFT | RIGHT | FULL} OUTER | CROSS } JOIN
  Table2
    {ON <condition> | USING (field_name [,... n])}
```
В большинстве СУБД при указании слов LEFT, RIGHT, FULL слово OUTER можно опустить. Слово INNER также в большинстве СУБД можно опустить.

В общем случае СУБД при выполнении соединения проверяет условие (предикат) condition. Если названия столбцов по которым происходит соединение таблиц совпадают, то вместо ON можно использовать USING. Для CROSS JOIN условие не указывается.

Для перекрёстного соединения (декартова произведения) CROSS JOIN в некоторых реализациях SQL используется оператор «запятая» (,):
```sql
FROM
  Table1,
  Table2
```
# Виды оператора JOIN

## INNER JOIN

Оператор внутреннего соединения INNER JOIN соединяет две таблицы. Порядок таблиц для оператора неважен, поскольку оператор является симметричным.

Заголовок таблицы-результата является объединением (конкатенацией) заголовков соединяемых таблиц.

Тело результата логически формируется следующим образом. Каждая строка одной таблицы сопоставляется с каждой строкой второй таблицы, после чего для полученной «соединённой» строки проверяется условие соединения (вычисляется предикат соединения). Если условие истинно, в таблицу-результат добавляется соответствующая «соединённая» строка.

Описанный алгоритм действий является строго логическим, то есть он лишь объясняет результат, который должен получиться при выполнении операции, но не предписывает, чтобы конкретная СУБД выполняла соединение именно указанным образом. Существует множество способов реализации операции соединения, например, соединение вложенными циклами (англ. inner loops join), соединение хэшированием (англ. hash join), соединение слиянием (англ. merge join). Единственное требование состоит в том, чтобы любая реализация логически давала такой же результат, как при применении описанного алгоритма.

```sql
SELECT *
FROM
  products
  INNER JOIN
  pictures
    ON products.id = pictures.resource_id

```
### INNER JOIN это тоже что и JOIN.

## OUTER JOIN

Соединение двух таблиц, в результат которого обязательно входят все строки либо одной, либо обеих таблиц.

## LEFT OUTER JOIN

Оператор левого внешнего соединения LEFT OUTER JOIN соединяет две таблицы. Порядок таблиц для оператора важен, поскольку оператор не является симметричным.

Заголовок таблицы-результата является объединением (конкатенацией) заголовков соединяемых таблиц.

Тело результата логически формируется следующим образом. Пусть выполняется соединение левой и правой таблиц по предикату (условию) p.

В результат включается внутреннее соединение (INNER JOIN) левой и правой таблиц по предикату p.
Затем в результат добавляются те записи левой таблицы, которые не вошли во внутреннее соединение на шаге 1. Для таких записей поля, соответствующие правой таблице, заполняются значениями NULL.

```sql
SELECT *
FROM
  products -- Левая таблица
  LEFT OUTER JOIN
  pictures   -- Правая таблица
    ON products.id = pictures.resource_id

```

## RIGHT OUTER JOIN

Оператор правого внешнего соединения RIGHT OUTER JOIN соединяет две таблицы. Порядок таблиц для оператора важен, поскольку оператор не является симметричным.

Заголовок таблицы-результата является объединением (конкатенацией) заголовков соединяемых таблиц.

Тело результата логически формируется следующим образом. Пусть выполняется соединение левой и правой таблиц по предикату (условию) p.

В результат включается внутреннее соединение (INNER JOIN) левой и правой таблиц по предикату p.
Затем в результат добавляются те записи правой таблицы, которые не вошли во внутреннее соединение на шаге 1. Для таких записей поля, соответствующие левой таблице, заполняются значениями NULL.

```sql
SELECT *
FROM
  products -- Левая таблица
  RIGHT OUTER JOIN
  pictures   -- Правая таблица
    ON products.id = pictures.resource_id

```

## FULL OUTER JOIN

Оператор полного внешнего соединения FULL OUTER JOIN соединяет две таблицы. Порядок таблиц для оператора неважен, поскольку оператор является симметричным.

Заголовок таблицы-результата является объединением (конкатенацией) заголовков соединяемых таблиц.

Тело результата логически формируется следующим образом. Пусть выполняется соединение первой и второй таблиц по предикату (условию) p. Слова «первой» и «второй» здесь не обозначают порядок в записи (который неважен), а используются лишь для различения таблиц.

В результат включается внутреннее соединение (INNER JOIN) первой и второй таблиц по предикату p.
В результат добавляются те записи первой таблицы, которые не вошли во внутреннее соединение на шаге 1. Для таких записей поля, соответствующие второй таблице, заполняются значениями NULL.
В результат добавляются те записи второй таблицы, которые не вошли во внутреннее соединение на шаге 1. Для таких записей поля, соответствующие первой таблице, заполняются значениями NULL.

```sql
SELECT *
FROM
  products
  FULL OUTER JOIN
  pictures
    on products.id = pictures.resource_id
```

## CROSS JOIN

Оператор перекрёстного соединения, или декартова произведения CROSS JOIN соединяет две таблицы. Порядок таблиц для оператора неважен, поскольку оператор является симметричным.

Заголовок таблицы-результата является объединением (конкатенацией) заголовков соединяемых таблиц.

Тело результата логически формируется следующим образом. Каждая строка одной таблицы соединяется с каждой строкой второй таблицы, давая тем самым в результате все возможные сочетания строк двух таблиц.
```sql
SELECT *
FROM
  products
  CROSS JOIN
  pictures
```
или

```sql
SELECT *
FROM
  products,
  pictures
```

Если в предложении WHERE добавить условие соединения (предикат p), то есть ограничения на сочетания кортежей, то результат эквивалентен операции INNER JOIN с таким же условием:

```sql
SELECT *
FROM
  products,
  pictures
WHERE
  pictures.resource = 'products' AND products.id = pictures.resource_id

```
## Модель для работы с товарами
```sql
        SELECT t1.*, t2.filename as picture
            FROM products t1
            JOIN pictures t2
            ON t2.resource = 'products' 
            AND t1.id = t2.resource_id
            ORDER BY id ASC";
```



```php
class Product {

    /**
     * Выводит список всех товраов
     *
     * @return array
     */


    public static function getProducts() {

        $con = Connection::make();

        $sql = "SELECT t1.*, t2.filename as picture
                FROM products t1
                JOIN pictures t2
                ON t2.resource = 'products' 
                AND t1.id = t2.resource_id
                ORDER BY id ASC";
      

        $res = $con->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);
        return $products;

    }
```

## json_encode

json_encode — Возвращает JSON-представление данных

Возвращает строку, содержащую JSON-представление для указанного value.

Функция работает только с кодировкой UTF-8.

PHP реализует надмножество JSON, который описан в первоначальном » RFC 7159.


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

    public function getProduct($vars)
    {
        $products = Product::getProducts();
        echo json_encode($products);
    }
    
}
```


## routers.php

```php


$router->get('api/shop', 'HomeController@getProduct');

```

# Fetch API

Fetch API предоставляет интерфейс JavaScript для доступа и обработки частей протокола HTTP, таких как запросы и ответы. Оно также предоставляет глобальный метод fetch(), который даёт лёгкий, логический способ для извлечения ресурсов асинхронно по сети.

Такая функциональность была ранее достигнута с помощью XMLHttpRequest. Fetch представляет собой лучшую альтернативу, которая может быть легко использована другими технологиями, такими как Service Workers. Fetch также обеспечивает единое логическое место, чтобы определить другие связанные с HTTP понятия, такие как CORS и расширения для HTTP.

fetch спецификация отличается от jQuery.ajax() в основном двумя способами:

- Promise возвращенный fetch() не отклонит состояние ошибки HTTP, даже если ответ HTTP 404 или 500.  Вместо этого, он будет выполнен нормально (с установкой статуса ok  в false) и будет отклонять только при сбое сети или если что-либо помешало запросу выполниться.
- По умолчанию, fetch не будет отправлять или получать файлы cookie с сервера, в результате чего запросы будут без проверки подлинности, если сайт основан на сохранении сессии пользователя (для потправки cookies в опции init должны быть установлены параметры доступа).

## Оформление запросов

Самое простое использование fetch() принимает один аргумент — путь к ресурсу, который вы хотите получить — и возвращает promise, содержащее ответ (объект Response).

```js
var url = '/api/shop';

  fetch(url).then((response) => response.json())
    .then((data) => {
      console.log(data);
    });
```

## Снабжение параметрами запроса

Метод fetch() может принимать второй параметр - обьект init, который позволяет вам контролировать различные настройки:

```js
var myHeaders = new Headers();

var myInit = { method: 'GET',
               headers: myHeaders,
               mode: 'cors',
               cache: 'default' };

var url = '/api/shop';

  fetch(url, myInit).then((response) => response.json())
    .then((data) => {
      console.log(data);
    });
```

## script

```js  
$(function() {

try {
    
  var url = '/api/shop';

  fetch(url).then((response) => response.json())
    .then((data) => {

      var shoppingCart = [];
      console.log(data);
      function showCart(){
        if (shoppingCart.length == 0) {
          console.log("Your Shopping Cart is Empty!");
          return;
        }

      $("#cartBody").empty();

      for (var i in shoppingCart) {
        var $templateCart = $($('#cartItem').html());
        var item = shoppingCart[i];
        $templateCart.attr('product_id', item.Id);
        $templateCart.find(".item-quantities").text(item.Quantity);
        $templateCart.find(".item-quantities").after(' '+ item.Product); 
        $templateCart.find('.item-price').text(item.Price);
        $templateCart.find('.item-prices').text(item.Quantity * item.Price);
        $templateCart.find('span.qty').attr('style', 'background-image:'+ 'url('+item.Picture+')');
        $(".cart-items").append($templateCart);
      }
      updateTotal();
    }
```
