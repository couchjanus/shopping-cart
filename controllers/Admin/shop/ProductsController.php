<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
 */
class ProductsController extends Controller {

    /**
     * Просмотр всех товаров
     * @return bool
     */
    public function index () {
        
        $db = Connection::make();
        // $con->exec("set names utf8");

        $sql = "SELECT * FROM products ORDER BY id ASC";

        $res = $db->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);
        $data['title'] = 'Admin Product List Page ';
        $data['products'] = $products;
        $this->_view->render('admin/products/index', $data);
    }

    /**
     * Добавление товара
     *
     * @return bool
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

            $con = Connection::make();
        
            $sql = "
                INSERT INTO products(name, category_id, price, brand, description, is_new, status)
                VALUES (:name, :category_id, :price, :brand, :description, :is_new, :status)
                ";

        $res = $con->prepare($sql);
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

        $data['title'] = 'Admin Product Add New Product ';
        $this->_view->render('admin/products/add',$data);
        
    }


}
