# shopping-cart

# TABLE `users`

```sql
SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) unsigned NOT NULL DEFAULT '2',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `status`) VALUES
(1,	'Janus',	'couchjanus@gmail.com',	'$2y$12$C/UMJOWWyb1S7Sqtcl5pI.X9U12fMfx1jgUZ6UB.crsGGkWxGvXZW',	3,	1);

```

# Модель User 

```php

class User 
{
    private $role;
    
    public static function index() 
    {
        $con = Connection::make();
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $con->exec("set names utf8mb4");
        $res = $con->query($sql);
        $users = $res->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
```
# Хэширование паролей

Хеширование паролей является одним из основных соображений безопасности, которые необходимо сделать, при разработке приложения, принимающего пароли от пользователей. Без хеширования, пароли, хранящиеся в базе вашего приложения, могут быть украдены, например, если ваша база данных была скомпрометирована, а затем немедленно могут быть применены для компрометации не только вашего приложения, но и аккаунтов ваших пользователей на других сервисах, если они не используют уникальных паролей.

Применяя хеширующий алгоритм к пользовательским паролям перед сохранением их в своей базе данных, вы делаете невозможным разгадывание оригинального пароля для атакующего вашу базу данных, в то же время сохраняя возможность сравнения полученного хеша с оригинальным паролем.

## MD5, SHA1 и SHA256
Почему популярные хеширующие функции, такие как md5() и sha1() не подходят для паролей?

Такие хеширующие алгоритмы как MD5, SHA1 и SHA256 были спроектированы очень быстрыми и эффективными. При наличии современных технологий и оборудования, стало довольно просто выяснить результат этих алгоритмов методом "грубой силы" для определения оригинальных вводимых данных.

Из-за той скорости, с которой современные компьютеры могут "обратить" эти хеширующие алгоритмы, многие профессионалы компьютерной безопасности строго не рекомендуют использовать их для хеширования паролей.

## как хешировать свои пароли?

При хешировании паролей существует два важных соображения: это стоимость вычисления и соль. Чем выше стоимость вычисления хеширующего алгоритма, тем больше времени требуется для взлома его вывода методом "грубой силы".

PHP предоставляет встроенное API хеширования паролей, которое безопасно работает и с хешированием и с проверкой паролей.

## Необратимое хеширование строки

http://php.net/manual/ru/function.crypt.php
Другой возможностью является функция crypt(), которая поддерживает несколько алгоритмов хеширования в PHP. При использовании этой функции вы можете быть уверенным, что выбранный вами алгоритм доступен, так как PHP содержит собственную реализацию каждого поддерживаемого алгоритма, даже в случае, если какие-то из них не поддерживаются вашей системой.

При хешировании паролей рекомендуется применять алгоритм Blowfish, который также используется по умолчанию в API хеширования паролей, так как он значительно большей вычислительной сложности, чем MD5 или SHA1.

## Что такое соль?

Криптографическая соль представляет собой данные, которые применяются в процессе хеширования для предотвращения возможности разгадать оригинальный ввод с помощью поиска результата хеширования в списке заранее вычисленных пар ввод-хеш, известном также как "радужная" таблица.

Криптографическая соль - это кусочек дополнительных данных, которые делают ваши хеши намного более устойчивыми к взлому. Существует много онлайн-сервисов, предоставляющих обширные списки заранее вычисленных хешей вместе с их оригинальным вводом. Использование соли делает поиск результирующего хеша в таком списке маловероятным или даже невозможным.

password_hash() создает случайную соль в случае, если она не была передана, и чаще всего это наилучший и безопасный выбор.

## Как я должен хранить свою соль?

При использовании функции password_hash() или crypt(), возвращаемое значение уже содержит соль как часть созданного хеша. Это значение нужно хранить как есть в вашей базе данных, так как оно содержит также информацию о хеширующей функции, которая использовалась, и может быть непосредственно передано в функции password_verify() или crypt() при проверке пароля.
    
## password_hash
password_hash() — используется для хэширования пароля.
http://php.net/manual/ru/function.password-hash.php

## password_verify
password_verify() — используется для проверки пароля на соответствие хэшу. http://php.net/manual/ru/function.password-verify.php

## password_needs_rehash
password_needs_rehash() — используется для проверки необходимости создать новый хэш.
http://php.net/manual/ru/function.password-needs-rehash.php

## password_get_info
password_get_info() — возвращает имя алгоритма хеширования и различные параметры, используемые при хэшировании.
http://php.net/manual/ru/function.password-get-info.php

### Функция password_hash()

```php
<?php
// наш пароль
$pass="123456";
$hash=password_hash($pass, PASSWORD_DEFAULT);
?>
```
Первым параметр - строка пароля, который необходимо хэшировать, а второй параметр определяет алгоритм, который должен быть использован для генерирования хэша.

## salt
Если вы хотите использовать вашу собственную соль (или стоимость вычисления), вы можете сделать это путем передачи третьего аргумента функции:

```php
$options = [
   'salt' => custom_function_for_salt(), //write your own code to generate a suitable salt
   'cost' => 12 // the default cost is 10
];
$hash = password_hash($password, PASSWORD_DEFAULT, $options);
```
Если PHP позже примет решение о применении более мощного алгоритма хеширования, ваш код может воспользоваться им без изменений.

# Предопределенные константы

- PASSWORD_BCRYPT (integer) = 1
- PASSWORD_BCRYPT используется для создания нового хэш пароля с использованием алгоритма CRYPT_BLOWFISH.

# Алгоритм по умолчанию

Алгоритм по умолчанию - BCrypt, но более сильный алгоритм может быть установлен по умолчанию.

## PASSWORD_DEFAULT

PASSWORD_DEFAULT (integer) = PASSWORD_BCRYPT

Используется алгоритм хэширования по умолчанию, если алгоритм не задан. Он может измениться в новых версиях PHP, когда будут поддерживаться новые, более эффективные алгоритмы хэширования.

Если вы используете PASSWORD_DEFAULT, обязательно храните хэш в колонке, размером больше 60 символов. Лучше всего установить размер 255. 

## PASSWORD_BCRYPT
Также можете использовать PASSWORD_BCRYPT в качестве второго параметра. В этом случае результат всегда будет 60 символов.

```php
    
    // generate new password

    $hash = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);

    $res->bindParam(':password', $hash, PDO::PARAM_STR);
    $res->bindParam(':role', $options['role'], PDO::PARAM_INT);

    return $res->execute();
   }

```

```php

    public static function store($options) 
    {

        $db = Connection::make();

        $sql = "INSERT INTO users(name, email, password, role_id)
                VALUES(:name, :email, :password, :role)";
               
        $password = password_hash($options['password'], PASSWORD_DEFAULT);
        
        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $res->bindParam(':password', $password, PDO::PARAM_STR);
        $res->bindParam(':role', $options['role'], PDO::PARAM_INT);

        return $res->execute();
    }

```

```php
    public static function update($userId, $options)
    {

        $db = Connection::make();

        $sql = "UPDATE users
                SET name = :name, 
                    password = :password, 
                    email = :email, 
                    role_id = :role, 
                    status = :status
                WHERE id = :id
               ";


        $res = $db->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':password', $options['password'], PDO::PARAM_STR);
        $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
        
        $status = $options['status']? 1:0;
        
        $res->bindParam(':status', $status, PDO::PARAM_INT);
        $res->bindParam(':id', $userId, PDO::PARAM_INT);

        return $res->execute();
    }
```

```php
    public static function destroy($id) 
    {
        $con = Connection::make();
        $sql = "DELETE FROM users WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $res->execute();
    }

```


# CRUD-приложения

```php
<?php

class UsersController extends Controller
{
```

# SELECT

```php
    public function index()
    {
            $data['users'] = User::index();
            $data['title'] = 'Admin User List Page ';
            $this->_view->render('admin/users/index', $data);
    }
```    
# CREATE

```php
    public function create() 
    {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['role'] = $_POST['role'];
            
            $options['password'] = trim(strip_tags($_POST['password']));
            
            User::store($options);

            header('Location: /admin/users');
        }
        
        $data['title'] = 'Admin User Add Page ';
        
        $this->_view->render('admin/users/create', $data);
        
    }
```

# UPDATE
```php
    public function edit($vars) 
    {
        
        extract($vars);

        $user = User::get($id);

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['password'] = trim(strip_tags($_POST['password']));
            $options['role'] = $_POST['role'];
            $options['status'] = $_POST['status'];
            
            User::update($id, $options);

            header('Location: /admin/users');
        }
        
        $data['title'] = 'Admin User Edit Page ';
        
        $data['user'] = $user;
        
        $this->_view->render('admin/users/edit', $data);
    }
```

## DELETE

```php
    public function delete($vars) 
    {

        extract($vars);

        if (isset($_POST['submit'])) {
            
            User::destroy($id);
            
            header('Location: /admin/users');
        }
        
        $data['title'] = 'Admin User Delete Page ';
        $data['user_id'] = $id;

        $this->_view->render('admin/users/delete', $data);

    }
```


### routes.php

```php

    $router->get('admin/users', 'Admin\users\UsersController@index');
    $router->get('admin/users/create', 'Admin\users\UsersController@create');
    $router->get('admin/users/edit/{id}', 'Admin\users\UsersController@edit');
    $router->get('admin/users/delete/{id}', 'Admin\users\UsersController@delete');
    $router->post('admin/users/create', 'Admin\users\UsersController@create');
    $router->post('admin/users/edit/{id}', 'Admin\users\UsersController@edit');
    $router->post('admin/users/delete/{id}', 'Admin\users\UsersController@delete');


```

### admin/users/index.php
```php

 <?php foreach ($users as $user):?>
    <tr>
        <td><?php echo $user['id']?></td>
        <td><?php echo $user['name']?></td>
        <td><?php echo $user['status']?></td>
        <td>
            <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
                  
            <a href="/admin/users/edit/<?= $user['id']?>">
                <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
            </a>
                              
            <a href="/admin/users/delete/<?= $user['id']?>">
                <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button>
            </a>
        </td>
    </tr>
<?php endforeach;?>

```

## password_verify()
Мы просто берем хэш из базы, и пароль, введенный пользователем и передаем их в эту функцию. 

password_verify() возвращает true, если хэш соответствует указанному паролю.

```php
if (password_verify($password, $hash)) {
   // Success!
}else {
   // Invalid credentials
}
```
Соль является частью хэша и поэтому нам не придется возиться с ней отдельно.

## password_needs_rehash()

Вы решили усилить безопасность и увеличить стоимость вычисления или изменить соль, или PHP изменил алгоритм хэширования, используемый по умолчанию.
Во этих случаях вы хотели бы изменить существующие хэши паролей. Функция password_needs_rehash() проверяет, использует ли хэш пароля конкретный алгоритм, соль и стоимость вычисления.

```php
<?php
if (password_needs_rehash($hash, PASSWORD_DEFAULT, ['cost' => 12])) {
   // the password needs to be rehashed as it was not generated with
   // the current default algorithm or not created with the cost
   // parameter 12
   $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
   // don't forget to store the new hash!
}
```
## password_get_info()
Функция password_get_info() принимает хэш и возвращает ассоциативный массив из трех элементов
http://php.net/manual/ru/function.password-get-info.php

- algo — константа, которая идентифицирует конкретный алгоритм http://php.net/manual/ru/password.constants.php
- algoName — название используемого алгоритма
- options — различные опции, используемые при генерации хэша
   
```php   

 if(!password_verify($password, $passwordFromDatabase)){

 // update hash from database - replace old hash 
 // $passwordFromDatabase with new hash 

 $password = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);

 }
```

## filter_var
filter_var — Фильтрует переменную с помощью определенного фильтра


### Пример использования filter_var()

```php
var_dump(filter_var('bob@example.com', FILTER_VALIDATE_EMAIL));
var_dump(filter_var('http://example.com', FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED));
```
Результат выполнения данного примера:
```
string(15) "bob@example.com"
bool(false)

```
## FILTER_VALIDATE_EMAIL
Проверяет, что значение является корректным e-mail.

В целом, происходит проверка синтаксиса адреса в соответствии с RFC 822, с тем исключением, что не поддерживаются комментарии, схлопывание пробельных символов и доменные имена без точек.

```php
   /**
    * Проверяем поле Email на корректность
    */
   public static function checkEmail ($email) {
       if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
           return true;
       }
       return false;
   }

```
