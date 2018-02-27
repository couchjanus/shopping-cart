<?php

/**
 * Class ProfileController
 * Контроллер для работы с личным кабинетом
*/
class ProfileController extends Controller
{
    private $_userId;
    private $_user;

    public function __construct()
    {
        parent::__construct();
        //Получаем id пользователя из сессии
        $this->_userId = User::checkLog();
        //Получаем всю информацию о пользователе из БД
        $this->_user = User::getUserById($this->_userId);
    }
  
    /**
    * Основная страница личного кабинета
    *
    * @return bool
    */
    public function index()
    {
        $data['title'] = 'Личный кабинет ';
        $data['subtitle'] = 'Edit Your Private Things ';
        $data['user'] = $this->_user;

        if ($data['user']['role_id']==1) {
            $this->_view->render('admin/index', $data);   
        } else {
            $this->_view->render('profile/index', $data);
        }
    }

    /**
     * Редактирование профиля
     *
     * @return bool
    */
    public function edit()
    {
        //  Получаем id пользователя из сессии
        //  $userId = User::checkLog();

        //  $user = User::get($userId);

        $res = false;

        //Флаг ошибок
        $errors = false;

        if (isset($_POST) and (!empty($_POST))) {
            $name = trim(strip_tags($_POST['name']));
            $password = trim(strip_tags($_POST['password']));

            // Валидация полей
            if (!User::checkName($name)) {
                $errors[] = "Имя не может быть короче 2-х символов";
            }

            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не может быть короче 6-ти символов";
            }

            if ($errors == false) {
                $res = User::edit($userId, $name, $password);
            }
        }

        $data['title'] = 'Личный кабинет ';
        $data['res'] = $res;
        $data['user'] = $this->_user;
        $data['errors'] = $errors;
                    
        $this->_view->render('profile/edit', $data);
             
    }
}
