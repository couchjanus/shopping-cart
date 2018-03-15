<?php

/**
 * Контроллер для управления заказами
 */
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
        $order = Order::getOrderById($id);

        //Преобразуем JSON  строку продуктов и их кол-ва в массив

        $productsInOrder = json_decode(json_decode($order['products'], true));

        // print_r($productsInOrder);

        //Выбираем ключи заказанных товаров
        $productIds = array();

        $productQuantity =  array();

        for ($i=0; $i<count($productsInOrder); $i++) {
            array_push($productIds, $productsInOrder[$i]->{'Id'});
            array_push($productQuantity, array($productsInOrder[$i]->{'Id'} => $productsInOrder[$i] ->{'Quantity'}));
        }

        // print_r($productIds);
        // print_r($productQuantity);

        // Получаем список товаров по выбранным id

        $products = Product::getProductsByIds($productIds);

        // print_r($products);

        $data['order'] = $order;
        $data['pQuantity'] = $productQuantity;
        $data['products'] = $products;
        $data['title'] = 'Admin Order View Page ';
        
        $this->_view->render('admin/orders/view', $data);
    }

    /**
     * Изменение заказа
     *
     * @param $id
     * @return bool
     */
    public function edit ($vars)
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
        $data['title'] = 'Admin Order Edit Page ';
        
        $this->_view->render('admin/orders/edit', $data);

    }

    /**
     * Удаление заказа
     *
     * @param $id
     * @return bool
     */
    public function delete($vars)
    {
        extract($vars);
        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Order::deleteOrderById($id);
            //и перенаправляем на страницу заказов
            header('Location: /admin/orders');
        }

        $data['id'] = $id;
        $data['title'] = 'Admin Order Delete Page ';
        
        $this->_view->render('admin/orders/delete', $data);

    }
}
