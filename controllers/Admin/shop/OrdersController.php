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
        $data['orders'] = Order::getOrdersList();
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
        $order = Order::getUserOrderById($id);
        $Products = json_decode(json_decode($order['products'], true));
        $data['title'] = 'Admin Order View Page ';
        $data['order'] = $order;
        $data['products'] = (array)$Products;
        $this->_view->render('admin/orders/view', $data);
    }

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
