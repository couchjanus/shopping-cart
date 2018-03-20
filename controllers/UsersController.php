<?php

/**
 * Class UserController для работы с пользователем
*/
class UsersController extends Controller
{

    protected $user;

    /**
     * Регистрация пользователя
    */
    public function signup()
    {

        $result = false;
        
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['role'] = 3;
            $options['password'] = trim(strip_tags($_POST['password']));
            $data['errors'] = false;//Флаг ошибок

            //Валидация полей

            if (!User::checkName($options['name'])) {
                $data['errors'][] = "Имя не может быть короче 2-х символов";
            }
            
            if (!User::checkEmail($options['email'])) {
                $data['errors'][] = "Некорректный Email";
            }
            
            if (!User::checkPassword($options['password'])) {
                $data['errors'][] = "Пароль не может быть короче 6-ти символов";
            }
            
            if (User::checkEmailExists($options['email'])) {
                $data['errors'][] = "Такой email уже используется";
            }
            
            if ($data['errors'] == false) {
                $result = User::store($options);
                header("Location: /login");
            }

        }

        $data['success'] = $result;
        $data['title'] = 'Signup Page ';
        $this->_view->render('user/signup', $data);
    }

    
    /**
     * Авторизация пользователя
     *
     * @return bool
    */
    public function login() 
    {
        $email = '';
        $password = '';

        if (Session::get('logged') == true) {
            header("Location: /profile"); //перенаправляем в личный кабинет
        }

        if (isset($_POST) and (!empty($_POST))) {

            $email = trim(strip_tags($_POST['email']));

            $password = trim(strip_tags($_POST['password']));

            
            //Флаг ошибок
            $data['errors'] = false;

            //Валидация полей
            if (!User::checkEmail($email)) {
                $data['errors'][] = "Некорректный Email";
            }

            //Проверяем, существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $data['errors'][] = "Пользователя с таким email или паролем не существует";
            } else {
                $this->user = User::get($userId);

                User::auth($userId); //записываем пользователя в сессию

                header("Location: /profile"); //перенаправляем в личный кабинет
            }
        }
        $data['title'] = 'Login Page ';

        $this->_view->render('user/login', $data);

    }

    /**
     * Выход из учетной записи
     *
     * @return bool
    */
    public function logout()
    {
        Session::destroy();
        header('Location: /');
        return true;
    }

    public function actionCheck()
    {
        if (!Session::get('logged') == true) {

            $response = array(
                    'r' => 'fail',
                    'url' => '/login'
                );
        } else {
                $response = array(
                    'r' => 'success',
                    'data' => User::get(Session::get('userId'))
                );
        }
        echo json_encode($response);
        exit;
    }


    

}
