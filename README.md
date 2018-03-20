# shopping-cart

## Просмотр истории заказов пользователя

```php
/**
     * Просмотр истории заказов для пользователя(личный кабинет)
     *
     * @param $id
     * @return array
     */
    public static function getOrdersListByUserId($id)
    {

        // Соединение с БД
        $db =  Connection::make();

        $sql = "SELECT id, DATE_FORMAT(`order_date`, '%d.%m.%Y %H:%i:%s') AS formated_date, status, products
                  FROM orders WHERE user_id = $id
                  ORDER BY id DESC
               ";

        // Выполняем запрос
        $res= $db->query($sql);

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
```

## class ProfileController

```php

class ProfileController extends Controller
{
    private $_userId;
    private $_user;

    public function __construct()
    {
        parent::__construct();
        //Получаем id пользователя из сессии
        $this->_userId = User::checkLog();
        //Получаем всю информацию о пользователе из БД
        $this->_user = User::getUserById($this->_userId);
    }

     /**
     * Просмотр истории заказов пользователя
     *
     * @return bool
     */

    public function ordersList()
    {
    
        $orders = Order::getOrdersListByUserId($this->_userId);
        $data['title'] = 'Личный кабинет ';
        $data['subtitle'] = 'Ваши заказы ';
        $data['user'] = $this->_user;
        $data['orders'] = $orders;

        $this->_view->render('profile/orders', $data);

    }

```

## Выбираем заказ по его id

```php

/**
     * Выбираем заказ по его id
     *
     * @param $id
     * @return mixed
     */
    public static function getUserOrderById($id)
    {
        // Соединение с БД
        $db =  Connection::make();

        $sql = "SELECT * FROM orders WHERE id = :id";


        $res = $db->prepare($sql);
        
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем запрос
        $res->execute();

        // Возвращаем данные
        return $res->fetch(PDO::FETCH_ASSOC);
    }
```
## Просмотр заказов пользователя

```php
    public function ordersView($vars)
    {
    
        extract($vars);
        
        $order = Order::getUserOrderById($id);
        
        $data['title'] = 'Личный кабинет ';
        $data['subtitle'] = 'Ваш заказ #'.$order['id'];
        
        $data['user'] = $this->_user;
        
        $data['order'] = $order;

        $this->_view->render('profile/order', $data);

    }

```
## routes

```php

$router->get('profile', 'ProfileController@index');
$router->get('profile/edit', 'ProfileController@edit');
$router->post('profile/edit', 'ProfileController@edit');

$router->get('profile/orders', 'ProfileController@ordersList');

$router->get('profile/orders/view/{id}', 'ProfileController@ordersView');
$router->get('profile/orders/edit/{id}', 'ProfileController@ordersEdit');
$router->get('profile/orders/delete/{id}', 'ProfileController@ordersDelete');

```


## json_decode — Декодирует строку JSON
```php
mixed json_decode ( string $json [, bool $assoc = FALSE [, int $depth = 512 [, int $options = 0 ]]] )
```
Принимает закодированную в JSON строку и преобразует ее в переменную PHP.

- json -  Строка (string) json для декодирования.
- assoc - Если TRUE, возвращаемые объекты будут преобразованы в ассоциативные массивы.
- depth - Указывает глубину рекурсии.
- options - Битовая маска опций декодирования JSON. В настоящий момент поддерживается только две опции. Первая из них - JSON_BIGINT_AS_STRING, позволяет конвертировать большие целые числа в строки, а не в числа с плавающей точкой (float), что происходит по умолчанию. Вторая опция - JSON_OBJECT_AS_ARRAY, действует так же, как если был задан assoc равным TRUE.

Возвращает данные json, преобразованные в соответствующие типы PHP. Значения true, false и null возвращаются как TRUE, FALSE и NULL соответственно. NULL также возвращается, если json не может быть преобразован или закодированные данные содержат вложенных уровней больше, чем допустимый предел для рекурсий.

Эта функция работает только со строками в кодировке UTF-8.
PHP реализует надмножество JSON, который описан в первоначальном » RFC 7159.


### Примеры использования json_decode()
```php
<?php
$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

var_dump(json_decode($json));
var_dump(json_decode($json, true));

?>
```
## order 

```php

<?php 
    // Преобразуем JSON  строку продуктов в массив
    $Products = json_decode(json_decode($order['products'], true));
                                        
    for ($i=0; $i<count($Products); $i++) {
        $productArr = (array)$Products[$i];
        echo '<a href="/products/'.$productArr['Id'].'">';
        echo '<img src = "'.$productArr['Picture'].'" width=70 height=40>'.$productArr['Product']."</a></br>";
        echo "<span>Кол-во: </span>" . $productArr['Quantity'].'</br>';
        echo '<span>Цена: </span>' . $productArr['Price']. ' грн</br>';
     
        //считаем общую сумму всех товаров в заказе, с учетом их кол-ва
        echo '<span>Сумма: </span>' .  $productArr['Price'] * $productArr['Quantity']. ' грн</br>';
        //подсчитываем сумму по каждому товару и пишем в массив
        $arr[] = $productArr['Price'] * $productArr['Quantity'];
    }
    $totalValue = array_sum($arr);
?>
```

## array_sum — Вычисляет сумму значений массива
```php

number array_sum ( array $array )

```

array - Входной массив.

Возвращает сумму значений в виде целого числа или числа с плавающей точкой; 0, если array пуст.


###  Пример использования array_sum()
```php

<?php
$a = array(2, 4, 6, 8);
echo "sum(a) = " . array_sum($a) . "\n";

$b = array("a" => 1.2, "b" => 2.3, "c" => 3.4);
echo "sum(b) = " . array_sum($b) . "\n";
?>

Результат выполнения данного примера:

sum(a) = 20
sum(b) = 6.9
```
## total

```php

<tr class="total_price">
    <td colspan="4"><?php echo '<span>Сумма заказа: ' . $totalValue.' грн</span>';?></td>
</tr>
<?php
    //Очищаем массив
    $arr = array();
?>
```

## все заказы пользователей

```php
/**
     * отображает все заказы пользователей
     *
     * @return bool
     */
    public function index()
    {
        $data['orders'] = Order::getOrdersList();
        $data['title'] = 'Admin Orders List Page ';
        $this->_view->render('admin/orders/index', $data);
        
    }
```

## Просмотр конкретного заказа

```php
    /**
     * Просмотр конкретного заказа
     *
     * @param $id заказа
     * @return bool
     */
    public function view($vars)
    {
        extract($vars);
        //Получаем заказ по id
        $order = Order::getUserOrderById($id);
        $Products = json_decode(json_decode($order['products'], true));
        $data['title'] = 'Admin Order View Page ';
        $data['order'] = $order;
        $data['products'] = (array)$Products;
        $this->_view->render('admin/orders/view', $data);
    }

```

## Изменение заказа

```php
    /**
     * Изменение заказа
     *
     * @param $id
     * @return bool
     */
    public function edit($vars)
    {
        extract($vars);
        //Получаем заказ по id
        $order = Order::getOrderById($id);

        //Если форма отправлена, принимаем данные и обрабатываем
        if (isset($_POST) and !empty($_POST)) {
            $status = $_POST['status'];
            //Записываем изменения
            Order::updateOrder($id, $status);
            //Перенаправляем на страницу просмотра данного заказа
            header("Location: /admin/orders/view/$id");
        }

        $data['order'] = $order;
        $data['title'] = 'Admin Edit Order ';
        $this->_view->render('admin/orders/edit', $data);

    }
```
