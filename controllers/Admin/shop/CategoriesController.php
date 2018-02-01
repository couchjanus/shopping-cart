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
         $data['categories'] = Category::index();
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
             Category::store($options);
             header('Location: /admin/categories');
         }
         $data['title'] = 'Admin Category Add New Category ';
         $this->_view->render('admin/categories/create', $data);

     }

}
