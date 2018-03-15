<?php

/**
 * Модель для работы с заказами
 */
class Order {

    /**
     * Сохранение заказа пользователя в БД
     *
     * @param $userName
     * @param $userId
     * @param $productsInCart
     * @return bool
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
     * Список заказов (для админки)
     *
     * @return array
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
     *
     * @param $status
     * @return string
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

    /**
     * Выбираем заказ по его id
     *
     * @param $id
     * @return mixed
     */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db =  Connection::make();

        $sql = "SELECT * FROM orders INNER JOIN users
               ON orders.user_id = users.id WHERE orders.id = :id";

        $res = $db->prepare($sql);
        
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем запрос
        $res->execute();

        // Возвращаем данные
        return $res->fetch(PDO::FETCH_ASSOC);
    }

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

    /**
     * Изменение заказа(админка)
     *
     * @param $id
     * @param $userName
     * @param $status
     * @return bool
     */
    public static function updateOrder($id, $status)
    {

        $db =  Connection::make();

        $sql = "UPDATE orders
                SET status = :status
                WHERE id = :id
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':id', $id, PDO::PARAM_INT);
        
        $res->bindParam(':status', $status, PDO::PARAM_STR);

        return $res->execute();
    }

    /**
     * Удадение заказа
     *
     * @param $id
     * @return bool
     */
    public static function deleteOrderById($id)
    {

        $db =  Connection::make();

        $sql = "DELETE FROM orders WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

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
}
