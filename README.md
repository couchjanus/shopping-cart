# shopping-cart 

# PHP CLI

PHP CLI расшифровывается так: Command Line Interface. [Интерфейс командной строки](http://php.net/manual/ru/features.commandline.php).

Основная цель CLI - разработка консольных приложений на PHP. 

# Выполнение PHP-файлов 
В CLI есть три различных способа запуска PHP-кода:

- Указание конкретного файла для запуска.

```php
$ php my_script.php

$ php -f my_script.php

```
Оба способа (с указанием опции -f или без) запустят файл my_script.php. Нет ограничений, какой файл запускать; в частности, файлы не обязаны должны иметь расширение .php.

Если необходимо передать аргументы в скрипт, то при использовании опции -f первым аргументом должен быть -- .

- Передать PHP-код напрямую в командной строке.

```php
$ php -r 'print_r(get_defined_constants());'
```

- Передать запускаемый PHP-код через стандартный поток ввода (stdin).

```php
$ some_application | some_filter | php | sort -u > final_output.txt
```

## Пример Запуск PHP-скрипта как консольного

```php

<?php

phpinfo();

?>

$ php cli/info.php

```

## главные отличия между php-cli и "php через браузер":

1. php-cli выполняется с правами пользователя, который его запускает, php-через-браузер выполняется с правами "пользователя" веб-сервера.

2. Вы можете запустить что-нибудь в духе sudo php someFile.php и выполнить его с правами рута (самого главного пользователя в системе)

3. В php-cli по умолчанию нет ограничения по времени выполнения скрипта.



# Расширения для работы с базами данных
http://php.net/manual/ru/refs.database.vendors.php

# Улучшенный модуль MySQL (MySQL Improved) 
http://php.net/manual/ru/book.mysqli.php

Расширение mysqli позволяет вам получить доступ к функциональности, которую предоставляет MySQL. 

Документация MySQL находится по адресу http://dev.mysql.com/doc/.

# Подключение к MySQL из PHP

Для подключения к MySQL из PHP нам надо указать настройки подключения: адрес сервера, логин, пароль, название базы данных и т.д. 

# mysqli_connect

Эта функция является псевдонимом: mysqli::__construct()


## Пример использования mysqli_connect()

```php

<?php
$link = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db");

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Соединение с MySQL установлено!" . PHP_EOL;
echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;

mysqli_close($link);
?>

```

Так как мы будем подключаться к серверу на локальной машине, то адресом сервера будет localhost. 

По умолчанию на локальном сервере MySQL уже есть пользователь root, под которым мы и будем подключаться. И также нам необходим пароль, который мы указали при установке MySQL.

Подключиться к базе данных:


```php
<?php
$servername = "localhost"; // адрес сервера 
$username = "dev"; // имя пользователя
$password = "ghbdtn"; // пароль

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully\n\n";

mysqli_close($conn);

?>
```

# exit

exit — Вывести сообщение и прекратить выполнение текущего скрипта

```
void exit ([ string $status ] )
void exit ( int $status )

```
- status
Если status задан в виде строки, то эта функция выведет содержимое status перед выходом.

Если status задан в виде целого числа (integer), то это значение будет использовано как статус выхода и не будет выведено. Статусы выхода должны быть в диапазоне от 0 до 254, статус выхода 255 зарезервирован PHP и не должен использоваться. Статус выхода 0 используется для успешного завершения программы.

# die — Эквивалент функции exit


## Пример использования exit

```php
<?php

$filename = '/path/to/data-file';
$file = fopen($filename, 'r')
    or exit("Невозможно открыть файл ($filename)");

?>

```

# mysqli_error

```
string mysqli_error ( mysqli $link )
```
Возвращает сообщение об ошибке последнего вызова функции MySQLi, который может успешно выполниться или провалиться.

- link
Идентификатор соединения, полученный с помощью mysqli_connect() или mysqli_init()


# mysqli_close
```
bool mysqli_close ( mysqli $link )
```
Закрывает ранее открытое соединение с базой данных.

Открытые непостоянные соединения MySQL и результирующие наборы автоматически удаляются сразу по окончании работы PHP скрипта. Следовательно, закрывать соединения и очищать результирующие наборы не обязательно, но рекомендуется, так как это сразу же освободит ресурсы базы данных и память, занимаемую результатами выборки, что может положительно сказаться на производительности.


# SQL Statements

```sql

SELECT - extracts data from a database
UPDATE - updates data in a database
DELETE - deletes data from a database
INSERT INTO - inserts new data into a database
CREATE DATABASE - creates a new database
ALTER DATABASE - modifies a database
CREATE TABLE - creates a new table
ALTER TABLE - modifies a table
DROP TABLE - deletes a table
CREATE INDEX - creates an index (search key)
DROP INDEX - deletes an index

```

# Создание MySQL Database

## SQL CREATE DATABASE Statement


```sql

CREATE DATABASE testDB;

```

## SQL DROP DATABASE Statement

```sql

DROP DATABASE testDB;

```

# mysqli_query

Функция mysqli_query() возвращает объект $result, который содержит результат запроса. В случае неудачи данный объект содержит значение false.

```
mixed mysqli_query ( mysqli $link , string $query [, int $resultmode = MYSQLI_STORE_RESULT ] )

```
Выполняет запрос query к базе данных.

- link
Идентификатор соединения, полученный с помощью mysqli_connect()

- query
Текст запроса.

- resultmode
Либо константа MYSQLI_USE_RESULT, либо MYSQLI_STORE_RESULT в зависимости от требуемого поведения функции. По умолчанию используется MYSQLI_STORE_RESULT.

Возвращает FALSE в случае неудачи. В случае успешного выполнения запросов SELECT, SHOW, DESCRIBE или EXPLAIN mysqli_query() вернет объект mysqli_result. Для остальных успешных запросов mysqli_query() вернет TRUE.


# mysqli_connect_errno

```
int mysqli_connect_errno ( void )
```
Возвращает код ошибки последнего вызова mysqli_connect().

```php

<?php
$link = mysqli_connect("localhost", "my_user", "my_password", "world");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

mysqli_close($link);
?>

```


# Создание MySQL Database с помощью MySQLi

```php

<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

echo "Connected successfully\n\n";

// Create database
$sql = "CREATE DATABASE mydb";

if (mysqli_query($conn, $sql)) {
    echo "Database created successfully\n\n";

} else {
    // echo "Error creating database: " . mysqli_error($conn);
    printf("Error creating database: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
?>

```

# Создание MySQL Tables


# SQL CREATE TABLE Statement

```sql

CREATE TABLE table_name (
    column1 datatype,
    column2 datatype,
    column3 datatype,
   ....
);

```


# Типы SQL Date

- DATE - format YYYY-MM-DD
- DATETIME - format: YYYY-MM-DD HH:MI:SS
- TIMESTAMP - format: YYYY-MM-DD HH:MI:SS
- YEAR - format YYYY or YY

# SQL CREATE TABLE

```php

CREATE TABLE guestbook (
    id int,
    username varchar(25),
    email varchar(30),
    comment text,
    appended_at TIMESTAMP,
    PRIMARY KEY (id)
);

```


# SQL NOT NULL 


```php

CREATE TABLE guestbook (
    id int NOT NULL,
    username varchar(25) NOT NULL,
    email varchar(30) NOT NULL,
    comment text NOT NULL,
    appended_at TIMESTAMP,
    PRIMARY KEY (id)
);

```
# SQL PRIMARY KEY

```php

CREATE TABLE guestbook (
    id int NOT NULL,
    username varchar(25) NOT NULL,
    email varchar(30) NOT NULL,
    comment text NOT NULL,
    appended_at TIMESTAMP,
    PRIMARY KEY (id)
);

```

# AUTO INCREMENT поле

```php

CREATE TABLE guestbook (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    email varchar(30) NOT NULL,
    comment text NOT NULL,
    appended_at TIMESTAMP,
    PRIMARY KEY (id)
);
```


# SQL DEFAULT 

Автоматическое назначение TIMESTAMP
https://dev.mysql.com/doc/refman/5.5/en/timestamp-initialization.html

```php

CREATE TABLE guestbook (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    email varchar(30) NOT NULL,
    comment text NOT NULL,
    appended_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

```


Создаем таблицу guestbook

```php

<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

echo "Connected successfully\n\n";

// Create database
$sql = "CREATE TABLE guestbook (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    email varchar(30) NOT NULL,
    comment text NOT NULL,
    appended_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);";

if (mysqli_query($conn, $sql)) {
    echo "Table guetbook created successfully\n\n";

} else {
    printf("Error creating table: %s\n", mysqli_error($conn));
}

mysqli_close($conn);
?>
```


# Вставка данныз в MySQL

```sql 
INSERT INTO table_name (column1, column2, column3, ...)
VALUES (value1, value2, value3, ...);

```


# Добавляем запись в таблицу

```php

<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

echo "Connected successfully\n\n";

// Create database
$sql = "INSERT INTO guestbook (username, email, comment)
VALUES ('John', 'john@example.com', 'Hi, It is John Doe');";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

```

# Реализауия контроллера

## config/app.php

```php

define('HOST', 'localhost'); // адрес сервера 
define('DATABASE', 'mydb'); // имя базы данных
define('DBUSER', 'dev'); // имя пользователя
define('DBPASSWORD', 'ghbdtn'); // пароль

```

# mysqli_real_escape_string

```
string mysqli_real_escape_string ( mysqli $link , string $escapestr )
```

Эта функция используется для создания допустимых в SQL строк, которые можно использовать в SQL выражениях. Заданная строка кодируется в экранированную SQL строку, используя текущий набор символов подключения.

```php

if (!empty($_POST)) {
    
    if ( !$_POST['username'] or !$_POST['email'] or !$_POST['comment']){
        echo "<b>please complete all the fields</b><br><br>";
    }
    else{
        // подключаемся к серверу
        $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
        or die("Ошибка " . mysqli_error($conn));


        $username = mysqli_real_escape_string ($conn, $_POST['username']);
        $email = mysqli_real_escape_string ($conn, $_POST['email']);
        $comment = mysqli_real_escape_string ($conn, $_POST['comment']);

        // выполняем операции с базой данных

        $sql = "INSERT INTO guestbook (username, email, comment) VALUES ('$username', '$email', '$comment')";

        mysqli_query($conn, $sql) or die("Ошибка: " . mysqli_error($conn));
        mysqli_close($conn);
    }
    
}

```


# SQL SELECT Statement

```sql

SELECT column1, column2, ...
FROM table_name;


SELECT * FROM table_name;

```

# Выбираем записи из таблицы

```php

<?php
$servername = "localhost";
$username = "dev";
$password = "ghbdtn";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

echo "Connected successfully\n\n";

$sql = "SELECT * FROM guestbook";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - User Name: " . $row["username"]. " Email: " . $row["email"]. " Comment: " . $row["comment"]. " Created: " . $row["appended_at"]. "\n\n";
    }
} else {
    echo "0 results\n";
}

mysqli_close($conn);
?>

```

# mysqli_fetch_assoc

mysqli_result::fetch_assoc -- mysqli_fetch_assoc — Извлекает результирующий ряд в виде ассоциативного массива

```
array mysqli_fetch_assoc ( mysqli_result $result )
```
Возвращает ассоциативный массив строк, соответствующий результирующей выборке, где каждый ключ в массиве соответствует имени одного из столбцов выборки или NULL, если других рядов не существует.

Имена полей, возвращаемые этой функцией являются регистро-зависимыми.

Эта функция устанавливает NULL-поля в значение NULL PHP.

- result
Идентификатор результата запроса, полученный с помощью mysqli_query().


# Извлечение данных из табоицы

```php

$conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
        or die("Ошибка " . mysqli_error($conn));

$comments = [];

$sql = "SELECT * FROM guestbook";

$result = mysqli_query($conn, $sql);

$resCount = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result)){
        array_push($comments, $row);
    }

// закрываем подключение
mysqli_close($conn);

```
# Публиквция данных

```html

    <?php 
        if($resCount>0){
          echo "<h3>$resCount comments:</h3> ";
          // print_r($comments);
          foreach ($comments as $row) {
            echo "<div class='top'><b>User ".$row["username"]."</b> <a href='mailto:".$row["email"]."'>".$row["email"]."</a> Added this </div>"; 
            echo "<div class='comment'>".strip_tags($row["comment"])."</div>"; 
            echo "<div class='added_at'> At: ".strip_tags($row["appended_at"])."</div>"; 
          }
        }
        else{
             echo "No comments.... ";
        }
    ?>
```
