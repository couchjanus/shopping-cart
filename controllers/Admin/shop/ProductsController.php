<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
 */
class ProductsController extends Controller {

    private $metas = [];
    private $resource = 'products';

    /**
     * Просмотр всех товаров
     * @return bool
    */
     public function index () {
         $data['products'] = Product::index();
         $data['title'] = 'Admin Product List Page ';
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

            Product::store($options);
            
            $product_id = (int)Product::lastId();

            $this->metas['resource_id'] = $product_id;
            $this->metas['resource'] = 'products';
            $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
            
            $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
            
            $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
            
            $this->metas['links'] = trim(strip_tags($_POST['meta_links']));

            Meta::store($this->metas);

            header('Location: /admin/products');
         }

         $data['title'] = 'Admin Product Add New Product ';
         $data['categories'] = Category::index();
         $this->_view->render('admin/products/create',$data);
     }

     /**
     * Редатирование товара
     *
     * @param $id
     * @return bool
     */
    public function edit ($vars) {

        //Получаем информацию о выбранном товаре
        extract($vars);

        $product = Product::getProductById($id);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Product::update($id, $options);

            $this->metas['resource_id'] = $id;
            $this->metas['resource'] = $this->resource;
            $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
            $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
            $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
            $this->metas['links'] = trim(strip_tags($_POST['meta_links']));

            Meta::store($this->metas);
     
            header('Location: /admin/products');
        }
      
        $data['product'] = Product::getProductById($id);
        $data['categories'] = Category::index();
        $data['metas']  = Meta::getMetas($this->resource, $id);
        $data['title'] = 'Admin Product Edit Page ';
        
        $this->_view->render('admin/products/edit',$data);
        
    }

}
