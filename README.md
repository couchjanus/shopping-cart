# shopping-cart

# Сессии
Сессии являются простым способом хранения информации для отдельных пользователей с уникальным идентификатором сессии. Это может использоваться для сохранения состояния между запросами страниц. 

Идентификаторы сессий обычно отправляются браузеру через сессионный cookie и используются для получения имеющихся данных сессии. 

Отсутствие идентификатора сессии или сессионного cookie сообщает PHP о том, что необходимо создать новую сессию и сгенерировать новый идентификатор сессии.

Когда сессия создана, PHP будет либо получать существующую сессию, используя переданный идентификатор (обычно из сессионного cookie) или, если ничего не передавалось, будет создана новая сессия. 

PHP заполнит суперглобальную переменную $_SESSION сессионной информацией после того, как будет запущена сессия. 

## session_start()

Сессии могут запускаться вручную с помощью функции session_start(). 
Эта команда говорит серверу, что данная страница нуждается во всех переменных, которые связаны с данным пользователем (браузером). Сервер берёт эти переменные из файла и делает их доступными. 

Очень важно открыть сессию до того, как какие-либо данные будут посылаться пользователю; на практике это значит, что функцию session_start() желательно вызывать в самом начале страницы:

```php

<?php
session_start();

```

Если директива session.auto_start установлена в 1, сессия автоматически запустится, в начале запроса.

Запустите браузер, и откройте в нём Developer Tools, далее перейдите в Storage — вы должны увидеть заголовки которые нам прислал сервер:

## Browser session cookie

браузер хранит у себя cookie с именем `PHPSESSID`:

```
Name: PHPSESSID 
Domain: 127.0.0.1
Expires on: Session
Value: 95bok2h8eu4u7prdkpbfpr9rqp
Last accessed on: 27.02.2018
HttpOnly: false
```

PHPSESSID – имя сессии по умолчанию, регулируется из конфига php.ini директивой session.name, при необходимости имя можно изменить в самом конфигурационном файле или с помощью функции session_name() 


## Регистрация переменной с помощью $_SESSION.

```php
<?php
session_start();
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
?>
```
## Отмена объявления переменной с помощью $_SESSION.

```php
<?php
session_start();
unset($_SESSION['count']);
?>


```
## Регистрация переменной

После начала сессии можно задавать глобальные переменные. При присвоении какого-либо значения любому полю массива $_SESSION, переменная с таким же именем автоматически регистрируется, как переменная сессии. Этот массив доступен на всех страницах, использующих сессию.

```php
    public static function set($key,$value){
		$_SESSION[SESSION_PREFIX.$key] = $value;
	}
```
При использовании сессий вся информация хранится не на стороне клиента, а на стороне сервера. 

В броузере клиента, хранится лишь уникальный идентификатор номера сессии, либо в форме cookie, либо в виде переменной в адресной строке броузера, какой из двух способов использовать для передачи идентификатора сессии между страницами интерпретатор PHP выбирает сам. Это безопасно, так как идентификатор сессии уникален, и подделать его практически невозможно.

Чтобы идентифицировать пользователей, сервер использует уникальные пользовательские идентификаторы/userID, которые хранятся в куках. 

```
Value: 95bok2h8eu4u7prdkpbfpr9rqp

```
## session.save_path
По умолчанию PHP использует внутренний обработчик files для сохранения сессий, который установлен в INI-переменной session.save_handler. Этот обработчик сохраняет данные на сервере в директории, указанной в конфигурационной директиве session.save_path.

Для задания директории в которой будут сохраняться файлы сессий используется функция session_save_path():

```php
session_save_path($_SERVER['DOCUMENT_ROOT'].'/session');

```

Сессии, использующие файлы (по умолчанию в PHP), блокируют файл сессии сразу при открытии сессии функцией session_start() или косвенно при указании session.auto_start. После блокировки, ни один другой скрипт не может получить доступ к этому же файлу сессии, пока он не будет закрыт или при завершении скрипта или при вызове функции session_write_close().


```php

private static $_sessionStarted = false;

	public static function init(){

		if(self::$_sessionStarted == false){
			session_start();
			self::$_sessionStarted = true;
		}

	}


```
- после вызова session_start() PHP ищет в cookie идентификатор сессии по имени прописанном в session.name – это PHPSESSID
- если нет идентификатора – то он создаётся, и создаёт пустой файл сессии по пути session.save_path с именем sess_{session_id()}, в ответ сервера будет добавлены заголовки, для установки cookie {session_name()}={session_id()}
- если идентификатор присутствует, то ищем файл сессии в папке session.save_path:
- если не находим – создаём пустой файл с именем sess_{$_COOKIE[session_name()]} (идентификатор может содержать лишь символы из диапазонов a-z, A-Z, 0-9, запятую и знак минус)
- если находим, читаем файл и распаковываем данные в супер-глобальную переменную $_SESSION
- когда скрипт закончил свою работу, то все данные из $_SESSION запаковывают с использованием session_encode() в файл по пути session.save_path с именем sess_{session_id()}


Когда PHP завершает работу, он автоматически сериализует содержимое суперглобальной переменной $_SESSION и отправит для сохранения, используя сессионный обработчик для записи сессии.

Сессия обычно завершает свою работу, когда PHP заканчивает исполнять скрипт, но может быть завершена и вручную с помощью функции session_write_close().

## session_destroy();
По умолчанию сессия длится, пока пользователь не закроет окно браузера, и тогда она загибается автоматически. Но если вы хотите принудительно завершить сессию, её всегда можно замочить таким образом:


```php
		if(self::$_sessionStarted == true){
			session_unset();
			session_destroy();
		}
```

Сессия заканчивается/(dies), если пользователь не запрашивает страниц в течение какого-то времени (стандартное значение - 20 минут). 

## Управление сессиями 
http://php.net/manual/ru/book.session.php

Другие полезные функции для работы с сессиями:

- unset($_SESSION['a']) - сессия "забывает" значение заданной сессионой переменной;
- session_destroy() - сессия уничтожается (если пользователь покинул систему, нажав кнопку "выход");
- session_set_cookie_params(int lifetime [, string path [, string domain]]) - с помощью этой функции можно установить, как долго будет "жить" сессия, задав unix_timestamp определяющий время "смерти" сессии. По умолчанию, сессия "живёт" до тех пор, пока клиент не закроет окно браузера.
- session_write_close() - запись переменных сесии и закрытие ее. Это необходимо для открытия сайта в новом окне, если страница выполняет длительную обработу и заблокировала для вашего браузера файл сессий.

## config/app.php

```php

define('SESSION_PREFIX', 'shop_');

```
# class Session

```php
<?php

class Session {

	private static $_sessionStarted = false;

	public static function init(){

		if(self::$_sessionStarted == false){
			session_start();
			self::$_sessionStarted = true;
		}

	}

	public static function set($key,$value){
		$_SESSION[SESSION_PREFIX.$key] = $value;
	}

	public static function get($key,$secondkey = false){

		if($secondkey == true){

			if(isset($_SESSION[SESSION_PREFIX.$key][$secondkey])){
				return $_SESSION[SESSION_PREFIX.$key][$secondkey];
			}

		} else {

			if(isset($_SESSION[SESSION_PREFIX.$key])){
				return $_SESSION[SESSION_PREFIX.$key];
			}

		}

		return false;

	}

	public static function display(){
		return $_SESSION;
	}

	public static function destroy(){

		if(self::$_sessionStarted == true){
			session_unset();
			session_destroy();
		}

	}

}

```

## Логин в систему с сессиями

### Форма входа в систему:

```html

<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>

<section class="product">
    <div class="container">
        <div class="row">
          <div class="col-md-12">

          <?php if (isset($data['errors']) && is_array($data['errors'])):?>
            <div class="jumbotron">
              <h4>Eroors:</h4>
            </div>
            <div class="row">
              <ul class="errors">
                  <?php foreach($data['errors'] as $error):?>
                      <li> - <?php echo $error;?></li>
                  <?php endforeach;?>
              </ul>
            </div>
          <?php endif;?>

        <div class="jumbotron">
           <h1><?=$title;?></h1>
        </div>

      <div class="row">
            <div class="form">
                    <div id="login">
                      <h1>Welcome Back!</h1>

                      <form method="post" autocomplete="off">

                        <div class="field-wrap">
                        <label for="email">Email Address 
                          <span class="req">*</span>
                        </label>
                        <input type="email" name="email" id="email" required autocomplete="new-password" placeholder = ''/>
                      </div>

                      <div class="field-wrap">
                        <label>
                          Password<span class="req">*</span>
                        </label>
                        <input type="password" name="password" required autocomplete="new-password"/>
                      </div>

                      <p class="forgot"><a href="#">Forgot Password?</a></p>

                      <input type="submit" class="button button-block" value="Log In" />

                      </form>
                  </div><!-- content -->

            </div> <!-- /form -->
      </div>
    </div>
  </div>
</div>
</section>

<?php
require_once VIEWS.'shared/footer.php';

```
## Метод login

```php

    public function login() 
    {
        $email = '';
        $password = '';

        if (Session::get('logged') == true) {
           
            //перенаправляем в личный кабинет
            header("Location: /profile"); 

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

            // Проверяем, существует ли пользователь

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $data['errors'][] = "Пользователя с таким email или паролем не существует";
            } else {
                $this->user = User::get($userId);

                // записываем пользователя в сессию
            
                User::auth($userId); 

                //перенаправляем в личный кабинет

                header("Location: /profile"); 
            }
        }
        $data['title'] = 'Login Page ';
        $this->_view->render('user/login', $data);

    }

```


## Проверить корректность username и password

```php

    /**
     * Проверка на существовние введенных данных
     *
     * @param $email
     * @param $password
     * 
     * @return bool
     */
    public static function checkUserData($email, $password)
    {

        $db = Connection::make();
        $sql = "SELECT * FROM users WHERE email = :email";
        $res = $db->prepare($sql);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();
        $user = $res->fetch();

        if (!self::checkPw($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

```


```php

    protected static function checkPw($userpassword, $dbpassword)
    {
        $resp = password_verify($userpassword, $dbpassword);
        return $resp;
    }

```
	 
## Если корректны, устанавливаем значение ключей сессии

```php

    /**
     *Запись пользователя в сессию
     *
     * @param $userId
    */
    public static function auth($userId)
    {
        Session::set('userId', $userId);
        Session::set('logged', true);
    }

```

При работе с защищёнными файлами мы проверяем, вошёл ли пользователь с корректным логином. Если нет, the пользователь отправляется обратно к логин-форме:

```php

    /**
     * Проверяем, авторизован ли пользователь при переходе в личный кабинет
     *
     * @return mixed
    */
    public static function checkLog()
    {
        //Если сессия есть, то возвращаем id пользователя

        if ((Session::get('userId'))) {
            return Session::get('userId');
        }
        
        // Если пользователь не зашёл, отправить его/её к логин-форме
        
        header('Location: user/login');
    }

```

### Проверяем наличие открытой сессии у пользователя

```php
    /**
     * Проверяем наличие открытой сессии у пользователя для
     * отображения на сайте необходимой информации
     *
     * @return bool
    */
    public static function isGuest()
    {

        if (Session::get('logged') == true) {
            return false;
        }
        return true;
    }

```

### navigation

```html

<dropdown>
    <input id="toggle-user" type="checkbox">
        <ul class="animate">
            <?php if(User::isGuest()):?>
                <li class="animate"><a href="/register">SignUp<i class="fa fa-user-plus float-right"></i></a></li>
                <li class="animate"><a href="/login">LogIn<i class="fa fa-sign-in float-right"></i></a></li>
            <?php else:?>
                <li class="animate"><a href="/logout">LogOut<i class="fa fa-sign-out float-right"></i></a></li>
            <?php endif;?>
        </ul>
    </dropdown>
```

## Контроллер для работы с личным кабинетом

```php

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

```

## Основная страница личного кабинета
```php
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
```
