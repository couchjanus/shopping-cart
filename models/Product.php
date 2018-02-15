<?php

/**
 * Модель для работы с товарами
 */
class Product {

    //Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;

    /**
     * Выводит списко всех товраов
     *
     * @return array
     */

    public static function index() {

        $con = Connection::make();
        $sql = "SELECT id, name, price FROM products
                ORDER BY id ASC";

        $res = $con->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);
        return $products;

    }


    /**
     * Получаем последние товары
     *
     * @param int $page
     * @return array
     */
    public static function getLatestProducts ($page = 1) {

        $limit = self::SHOW_BY_DEFAULT;

        //Задаем смещение
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $con = Connection::make();

        $sql = "SELECT id, name, price, is_new, description
                  FROM products
                    WHERE status = 1
                      ORDER BY id DESC
                        LIMIT :limit OFFSET :offset
                ";

        //Подготавливаем данные
        $res = $con->prepare($sql);
        $res->bindParam(':limit', $limit, PDO::PARAM_INT);
        $res->bindParam(':offset', $offset, PDO::PARAM_INT);

        //Выполняем запрос
        $res->execute();

        //Получаем и возвращаем результат
        $productsList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $productsList;
    }

    /**
     * Добавление продукта
     *
     * @param $options - характеристики товара
     * @return int|string
     */
    public static function store ($options) {

        $con = Connection::make();

        $sql = "INSERT INTO products(
                name, category_id, price, brand,
                description, is_new, status)
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
        $res->execute();
        
    }

    public static function lastId () 
    {
        $con = Connection::make();
        $res = $con->prepare("SELECT id FROM products ORDER BY id DESC LIMIT 1");
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC)['id'];
    }

     /**
     * Общее кол-во товаров в магазине
     *
     * @return mixed
     */
    public static function getTotalProducts () {

        // Соединение с БД
        $db = Connection::make();

        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM products WHERE status=1 ";

        // Выполнение коменды
        $res = $db->query($sql);

        // Возвращаем значение count - количество
        $row = $res->fetch();
        return $row['count'];
    }
    /**
     * Выбираем товар по идентификатору
     *
     * @param $productId
     * @return mixed
     */
    public static function getProductById ($productId) {

        $con = Connection::make();

        $sql = "SELECT * FROM products WHERE id = :id";

        $res = $con->prepare($sql);
        $res->bindParam(':id', $productId, PDO::PARAM_INT);
        $res->execute();

        $product = $res->fetch(PDO::FETCH_ASSOC);

        return $product;
    }

    /**
     * Изменение товара
     *
     * @param $id
     * @param $options
     * @return bool
     */
    public static function update ($id, $options) {

        $con = Connection::make();

        $sql = "
                UPDATE products
                SET
                    name = :name,
                    category_id = :category,
                    price = :price,
                    brand = :brand,
                    description = :description,
                    is_new = :is_new,
                    status = :status
                WHERE id = :id
                ";

        $res = $con->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':category', $options['category'], PDO::PARAM_INT);
        $res->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
    }

}
