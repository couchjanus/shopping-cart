<?php

/**
 * Контроллер для управления категориями
 */
class CategoriesController extends Controller{

    /**
     * Главная страница управления категориями
     *
     * @return bool
     */
    public function index (){

        $db = Connection::make();
        // $db->exec("set names utf8");

        $sql = "SELECT id, name, status FROM categories ORDER BY id ASC";

        $res = $db->query($sql);

        $categories = $res->fetchAll(PDO::FETCH_ASSOC);

        $data['categories'] = $categories;
        $data['title'] = 'Admin Category List Page ';
        $this->_view->render('admin/categories/index',$data);
    }

    /**
     * Добавление категории
     *
     * @return bool
     */
    public function create () {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['status'] = trim(strip_tags($_POST['status']));

            $db = Connection::make();
        // $db->query("set names utf8");

        $sql = "
                INSERT INTO categories(name, status)
                VALUES (:name, :status)
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        $res->execute();
        
        header('Location: /admin/categories');
        
        }

        $data['title'] = 'Admin Category Add New Category ';
       
        $this->_view->render('admin/categories/create', $data);
        
    }

}
