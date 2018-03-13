<?php

/**
 * GalleryController
 * PHP version 7.2
*/

class GalleryController extends Controller
{
  
    private $_resource = 'gallery';
    private $_metas = [];

    public function index()
    {
        // $pictures = Picture::index();
        $pictures = Gallery::index();
        $data['title'] = 'Admin Gallery Page ';
        $data['pictures'] = $pictures;
        $this->_view->render('admin/gallery/index', $data);
    }

    public function create() 
    {
        if (isset($_POST) and !empty($_POST)) {
            $options['title'] = trim(strip_tags($_POST['title']));
            $options['description'] = trim($_POST['description']);
            
            // если была произведена отправка формы
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
                    $opts['resource_id'] = (int)Gallery::lastId();
                } else {
                    print_r($errors);
                }
            }

            $opts['resource'] = $this->_resource;
            Picture::store($opts);
            Gallery::store($options);
            $this->redirect('/admin/gallery');
        
        }
        $data['title'] = 'Admin Add Picture ';

        $this->_view->render('admin/gallery/create', $data);

    }

    public function edit($vars)
    {
    
        extract($vars);
        $data['title'] = 'Admin Edit Post ';
        $this->_view->render('admin/posts/edit', $data);

    }

    public function delete($vars) 
    {
        extract($vars);
        
        $picture = Picture::getPictureById($id);

        if (isset($_POST['submit'])) {
            
            unlink('media/'.$picture['filename']);            

            Picture::destroy($id);
            $this->redirect('/admin/gallery');
            
        } elseif (isset($_POST['reset'])) {
            $this->redirect('/admin/gallery');            
        }

        $data['title'] = 'Admin Delete Picture ';
        $data['picture'] = $picture;
        $this->_view->render('admin/gallery/delete', $data);
    
    }
}
