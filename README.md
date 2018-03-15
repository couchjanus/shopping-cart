# shopping-cart


## TABLE `orders`

```sql
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

```

## Модель для работы с заказами

```php
class Order {

    /**
     * Сохранение заказа пользователя в БД
     */
    public static function save($userId, $productsInCart)
    {
        $db =  Connection::make();

        //Преобразовываем массив товаров в строку JSON
        $productsInCart = json_encode($productsInCart);

        $sql = "INSERT INTO orders(user_id, products)
                VALUES (:userId, :products)";

        $res = $db->prepare($sql);

        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->bindParam(':products', $productsInCart, PDO::PARAM_STR);

        return $res->execute();
    }

    /**
     * Список заказов
     */
    public static function getOrdersList()
    {

        $db =  Connection::make();

        $sql = "SELECT id, user_id,
                 DATE_FORMAT(`order_date`, '%d.%m.%Y %H:%i:%s') AS formated_date, status
                 FROM orders ORDER BY id DESC";

        $ordersList = array();

        $res = $db->query($sql);

        $ordersList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $ordersList;
    }

    public static function getOrders()
    {

      $db =  Connection::make();

      $sql = "SELECT * 
               FROM orders INNER JOIN users
               ON orders.user_id = users.id
               ORDER BY orders.order_date DESC";


      $sth = $db->prepare($sql);

      $sth->execute();

      return $sth->fetchAll(PDO::FETCH_ASSOC);

    }
    /**
     * Строковое представление статуса заказа
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1' :
                return 'Новый';
                break;
            case '2' :
                return 'В обработке';
                break;
            case '3' :
                return 'Доставляется';
                break;
            case '4' :
                return 'Закрыт';
                break;
        }
    }

}
```

## routes.php

```php

$router->get('admin/orders', 'Admin\shop\OrdersController@index');
$router->get('admin/orders/view/{id}', 'Admin\shop\OrdersController@view');
$router->get('admin/orders/edit/{id}', 'Admin\shop\OrdersController@edit');

$router->get('admin/orders/delete/{id}', 'Admin\shop\OrdersController@delete');
$router->post('admin/orders/edit/{id}', 'Admin\shop\OrdersController@edit');
$router->post('admin/orders/delete/{id}', 'Admin\shop\OrdersController@delete');

```

## Контроллер для управления заказами
```php
class OrdersController extends Controller
{
    /**
     * Главная, отображает все заказы пользователей
     *
     * @return bool
     */
    public function index()
    {

        $data['orders'] = Order::getOrders();
       
        $data['title'] = 'Admin Orders List Page ';
        
        $this->_view->render('admin/orders/index', $data);
        
    }
```

## routes.php

```php
$router->post('check', 'UsersController@actionCheck');

```
## UsersController

```php

public function actionCheck()
    {
        if (!Session::get('logged') == true) {

            $response = array(
                    'r' => 'fail',
                    'url' => 'login'
                );
        } else {
                $response = array(
                    'r' => 'success',
                    'data' => User::get(Session::get('userId'))
                );
        }
        echo json_encode($response);
        exit;
    }
```

## JSON (JavaScript Object Notation) 

JSON - простой формат обмена данными, удобный для чтения и написания как человеком, так и компьютером. Он основан на подмножестве языка программирования JavaScript, определенного в стандарте ECMA-262 3rd Edition - December 1999. JSON - текстовый формат, полностью независимый от языка реализации, но он использует соглашения, знакомые программистам C-подобных языков, таких как C, C++, C#, Java, JavaScript, Perl, Python и многих других. Эти свойства делают JSON идеальным языком обмена данными.

JSON основан на двух структурах данных:

- Коллекция пар ключ/значение. В разных языках, эта концепция реализована как объект, запись, структура, словарь, хэш, именованный список или ассоциативный массив.
- Упорядоченный список значений. В большинстве языков это реализовано как массив, вектор, список или последовательность.

Это универсальные структуры данных. Почти все современные языки программирования поддерживают их в какой-либо форме. 

Объект - неупорядоченный набор пар ключ/значение. Объект начинается с { (открывающей фигурной скобки) и заканчивается } (закрывающей фигурной скобкой). Каждое имя сопровождается : (двоеточием), пары ключ/значение разделяются , (запятой).

Массив - упорядоченная коллекция значений. Массив начинается с [ (открывающей квадратной скобки) и заканчивается ] (закрывающей квадратной скобкой). Значения разделены , (запятой).

Значение может быть строкой в двойных кавычках, числом, true, false, null, объектом или массивом. Эти структуры могут быть вложенными.

Строка - коллекция нуля или больше символов Unicode, заключенная в двойные кавычки, используя \ (обратную косую черту) в качестве символа экранирования. Символ представляется как односимвольная строка. Похожий синтаксис используется в C и Java.

Число представляется так же, как в C или Java, кроме того, что используется толко десятичная система счисления.

Пробелы могут использоваться между любыми лексемами.

## Функция JSON.stringify
 
Преобразует значение JavaScript в строку JSON (нотация объектов JavaScript).

```js
JSON.stringify(
value [, replacer] [, space])
```
### Параметры

- value - Обязательный.  Преобразуемое значение JavaScript, обычно объект или массив.  
- replacer - Необязательный.  Функция или массив, используемые для преобразования результатов. Если replacer представляет собой функцию, метод JSON.stringify вызывает эту функцию, передавая ей ключ и значение каждого члена.  Возвращаемое значение используется вместо исходного значения.  Если функция возвращает значение undefined, член исключается.  Ключ для корневого объекта — это пустая строка: "".  Если replacer представляет собой массив, преобразуются только члены со значениями ключа, присутствующими в массиве.  Порядок преобразования членов соответствует порядку ключей в массиве.  Массив в аргументе replacer игнорируется, если аргумент value также является массивом.  
- space - Необязательный.  Добавляет отступы, пробелы и символы разрыва строки в текст JSON возвращаемого значения, чтобы сделать его более удобным для чтения. Если аргумент space опущен, текст возвращаемого значения создается без дополнительных пробелов. Если space представляет собой число, в текст возвращаемого значения вставляются отступы на указанное число пробелов на каждом уровне.  Если space больше 10, отступ текста составляет 10 пробелов. Если space представляет собой непустую строку, например '\t', в текст возвращаемого значения в качестве отступа на каждом уровне вставляются символы этой строки. Если space представляет собой строку длиннее 10 символов, используются первые 10 символов.

Строковые значения начинаются и заканчиваются кавычкой.  Все символы Юникода могут быть заключены в кавычки, за исключением символов, которые должны предваряться escape-символом (обратной косой чертой).  Предваряться обратной косой чертой должны следующие символы:  

```
    кавычка (");

    обратная косая черта (\);

    BACKSPACE (b);

    перевод страницы (f);

    новая строка (\n);

    возврат каретки (r);

    горизонтальная табуляция (t);

    четыре шестнадцатеричные цифры (uhhhh).
```

```js
 data: { 
        'val': JSON.stringify(shoppingCart),
        'customer': JSON.stringify({'user_name': $('#user_name').val(), 'telephone': $('#telephone').val()}),
        }
```

## TABLE `users`

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) unsigned NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```
## class User

```php

public static function userName($id)
    {
        try {
            $db = Connection::make();
            $sql = "SELECT first_name, last_name FROM users WHERE id = :id";

            $res = $db->prepare($sql);
            $res->bindParam(':id', $id);
            $res->execute();
            $result = $res->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        return $result;
        
    }

```


```js

$('.dialog__trigger').on('click',function(){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'check',
            success: function(d) {
                if(d.r == "fail") {
                    window.location.href = d.url;
                } else {
                    console.log(d.data);
                    toggle_panel(cart, shadow_layer);
                    $('.product-items').empty();
                    let $template = $($('#step1').html());
                    $template.find('#sub_price').text($('#allTotal').text());
                    $template.find('#user_name').val( d.data['name']);
                   
                    $template.find('#calculated_total').text(parseFloat($template.find('#sub_price').text())+parseFloat($template.find('#sub_tax').text())+parseFloat($template.find('#sub_ship').text()));
                    
                    $(".product-items").append($template);
                    $('#complete').on('click',function(){
                      $.ajax({
                           type: 'POST',
                           url: 'cart',
                           dataType: 'json',
                           data: { 
                             'val': JSON.stringify(shoppingCart),
                             'customer': JSON.stringify({'user_name': $('#user_name').val(), 'telephone': $('#telephone').val()}),
                             }
                          })
                          .then( function(data){
                              console.log('succsess');
                              localStorage.removeItem('shoppingCart');
                              $("#cartBody").empty();
                              shoppingCart = [];
                              updateTotal();
                              $(location).attr('href', 'profile')
                           }
                      );
                
                    });
                }
              }
            });
     });

```


```html
<script id="step1" type="text/template">
  <div id="wrap">

    <div class="step">
      <div class="title">
        <h1>Order Information</h1>
        <hr>
      </div>
    </div>
    
    <div class="content order" id="address">
      
      <form class="go-right">
        
        <div>
        <label for="user_name">Your Name: </label>&nbsp;<input type="name" name="user_name" value="" id="user_name" placeholder="Your Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your First and Last Name"/>
        </div>

        <div>
        <label for="telephone">Telephone: </label>&nbsp;
        <input type="phone" name="telephone" value="" id="telephone" placeholder="Phone(555)-555-5555" data-trigger="change" data-validation-minlength="1" data-type="number" data-required="true" data-error-message="Enter Your Telephone Number"/>
        </div>
        <div class="content" id="final_products">
        <div id="ordered">
        <ul class="totals">
          <li class="subtitle">Subtotal $<span id="sub_price">45.00</span></li>
          <li class="subtitle">Tax $<span id="sub_tax">2.00</span></li>
          <li class="subtitle">Shipping $<span id="sub_ship">4.00</span></li>
        </ul>
        <div class="final">
          <hr>
          <span class="title"><b>Total <span id="calculated_total">$51.00</span></b></span>
        </div>
        <br>
        </div>
        
      </form>
    <div class="complete">
    
          <a class="big_button btn btn-success" id="complete">Complete Order</a>
          <span class="sub">By selecting this button you agree to the purchase and subsequent payment for this order.</span>
    
        </div>
        
        </div>
    </div>
  </div>
</script>
```

## CartController

```php
class CartController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        //Получаем id пользователя из сессии
        $userId = User::checkLog();

        //Получаем всю информацию о пользователе из БД
        $user = User::getUserById($userId);

        $productsInCart = $_POST['val'];

        $customer = $_POST['customer'];

        $res = Order::save($userId, $productsInCart);

        echo true;
    }

}
```
## routes.php

```php
$router->post('cart', 'CartController@index');
```
