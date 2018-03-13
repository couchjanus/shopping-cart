<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
 */
class ProductsController extends Controller {

    private $metas = [];
    private $_resource = 'products';

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

            if (isset($_FILES['image'])) {
                
                //Каталог загрузки картинок
                $uploadDir = 'media';
                
                //Вывод ошибок
                $errors = array();
                
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];

                // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
                $type = pathinfo($_FILES['image']['name']);
                $file_ext = strtolower($type['extension']);

                $expensions= array("jpeg","jpg","png",'gif');
                //Определяем типы файлов для загрузки
                $fileTypes = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );

                //Проверяем пустые данные или нет
                if (empty($_FILES)) {
                    $errors[] = 'File name must have name';
                } elseif ($_FILES['image']['error'] > 0) {
                    // Проверяем на ошибки
                    $errors[] = $_FILES['image']['error'];
                } elseif ($file_size > 2097152) {
                    // если размер файла превышает 2 Мб
                    $errors[] = 'File size must be excately 2 MB';
                } elseif (in_array($file_ext, $expensions)=== false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                } elseif (!in_array($file_type, $fileTypes)) {
                    // Проверяем тип файла
                    $errors[] = 'Запрещённый тип файла';
                }
                
                if (empty($errors)) {
                
                    $type = pathinfo($_FILES['image']['name']);
                    
                    $name = uniqid('files_') .'.'. $type['extension'];
           
                    move_uploaded_file($file_tmp, "media/".$name);
                      
                    $opts['filename'] = $name;
                    $opts['resource_id'] = $product_id;
                } else {
                    print_r($errors);
                }
            }

            $opts['resource'] = $this->_resource;
            Picture::store($opts);

            $this->metas['resource_id'] = $product_id;
            $this->metas['resource'] = $this->_resource;
            $this->metas['title'] = trim(strip_tags($_POST['meta_title']));
            
            $this->metas['description'] = trim(strip_tags($_POST['meta_description']));
            
            $this->metas['keywords'] = trim(strip_tags($_POST['meta_keywords']));
            
            $this->metas['links'] = trim(strip_tags($_POST['meta_links']));

            Meta::store($this->metas);

            header('Location: /admin/products');
         }

         $data['title'] = 'Admin Product Add New Product ';
         $data['categories'] = Category::index();
         $this->_view->render('admin/products/create', $data);
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
