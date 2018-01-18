# shopping-cart 

## bootstrap.php

```php

<?php

if (function_exists('date_default_timezone_set')){
    date_default_timezone_set('Europe/Kiev');    
}


// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

function render($path, $data = []) 
{
    extract($data);
    
    return require VIEWS."/{$path}.php";
}

require_once realpath(__DIR__).'/../config/app.php';
require_once CORE.'Router.php';

```

## Конструктор класса в PHP.

Конструктор объявляется как метод класса с именем __construct(). Он может содержать произвольное число параметров, и предназначен, прежде всего, для инициализации свойств создаваемого экземпляра объекта.

Конструкторы вызываются автоматически при создании новых объектов. Чтобы это стало возможным, имя метода-конструктора должно совпадать с именем класса, в котором он содержится.

## AboutController.php

```php

<?php

class AboutController
{
    private $title = 'SHOPAHOLIC ABOUT PAGE';
    
    public function __construct()
    {   
        render('home/about', ['title'=>'SHOPAHOLIC ABOUT PAGE']);
    }
    
}

```
## Вызвать конструктор класса

```  
    // Вызвать конструктор класса
    
    $controller = new AboutController();
```

## Доступ к класам и объектам в PHP

Доступ к элементам класса осуществляется с помощью оператора ->.

Чтобы получить доступ к элементам класса внутри класса, необходимо использовать указатель $this, которы всегда относится к текущему объекту.


```php

<?php

class AboutController
{
    
    private $title = 'SHOPAHOLIC ABOUT PAGE';

    public function __construct()
    {   
        render('home/about', ['title'=>$this->title]);
    }
    
}

```

Указатель $this можно также использовать для доступа к методам класса.

В зависимости от количества передаваемых параметров могут вызываться разные конструкторы. 

Можно вызвать конструктор, который просто создает объект, но не инициализирует его свойства:

```
$page = new AboutController();

```

## класс AboutController:


```php

<?php

class AboutController
{
    
    private $title = 'SHOPAHOLIC ABOUT PAGE';

    public function __construct($title)
    {   
        $this->title = $title;

        render('home/about', ['title'=>$this->title]);
    }
    
}

```
Можно создать объект класса AboutController и присвоить значение его свойству title:

```
$page = new AboutController("About page");

```

## home/about.php

```html

  <section class="product">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="feature_header text-center">
                      <h3 class="feature_title"><?=$title;?></h3>
                      <h4 class="feature_sub">Hello There</h4>
                      <div class="divider"></div>
                  </div>
              </div>  <!-- Col-md-12 End -->
          </div>
      </div> <!-- Conatiner product end -->
  </section>  <!-- Section product End -->
```


## функция extract

Импортирует переменные из массива в текущую таблицу символов.
Каждый ключ проверяется на предмет корректного имени переменной. Также проверяются совпадения с существующими переменными в символьной таблице.

Эта функция рассматривает ключи массива в качестве имен переменных, а их значения - в качестве значений этих переменных. Для каждой пары ключ/значение будет создана переменная в текущей таблице символов, в соответствии с параметрами flags и prefix.

# Создание экземпляра клнтроллера

## Router.php

```php

// Проверить наличие такого запроса в routes

foreach ($routes as $uriPattern => $path) {

 //Сравниваем uriPattern и $uri
 if($uriPattern == $uri){

   // Определить контроллер
   $controller = $path;

   //Подключаем файл контроллера
   $controllerFile = CONTROLLERS . $controller . EXT;

   if(file_exists($controllerFile)){

     include_once($controllerFile);
     
     $result = true;

     // Создание экземпляра клнтроллера
     
     $controller = new $controller;
     
     break;
     }
   }
}
   
if($result === null){
     require_once VIEWS.'404'.EXT;
}

```

# Добавляем методы контроллера

Методы действий (action methods) представляют такие методы контроллера, которые обрабатывают запросы по определенному URL.

## routes.php

```php

return [
    'contact' => 'ContactController@index',
    'about' => 'AboutController@index',
    'blog' => 'BlogController@index',
    'guestbook' => 'GuestbookController@index',
    //Главаня страница
    'index.php' => 'HomeController@index', 
    '' => 'HomeController@index',  
];
```

Здесь метод index является методом действия или просто действием контроллера. При получении запроса типа /about контроллер передает обработку запроса действию index.

Методы действий всегда имеют модификатор public. Закрытых приватных методов действий не бывает. 

```php

    public function index()
    {   
        render('home/about', ['title'=>'SHOPAHOLIC <b>ABOUT PAGE</b>']);
    }

```

## explode — Разбивает строку с помощью разделителя

Возвращает массив строк, полученных разбиением строки string с использованием delimiter в качестве разделителя.

- delimiter - Разделитель.
- string - Входная строка.
- limit - Если аргумент limit является положительным, возвращаемый массив будет содержать максимум limit элементов, при этом последний элемент будет содержать остаток строки string. Если параметр limit отрицателен, то будут возвращены все компоненты, кроме последних -limit. Если limit равен нулю, то он расценивается как 1.

Если delimiter является пустой строкой (""), explode() возвращает FALSE. Если delimiter не содержится в string, и используется отрицательный limit, то будет возвращен пустой массив (array), иначе будет возвращен массив, содержащий string.

# Вызываем метод контроллера

## Router.php

Разбиваем путь к контроллеру на сегменты 

```php
foreach ($routes as $uriPattern => $path) {

 //Сравниваем uriPattern и $uri
 if($uriPattern == $uri){

   // Разбиваем путь к контроллеру на сегменты 
   
   $segments = explode('@', $path);

   // Определить контроллер

   $controller = array_shift($segments);
   
   // Определить действие контроллера

   $action = array_shift($segments);

   //Подключаем файл контроллера
   
   $controllerFile = CONTROLLERS . $controller . EXT;

   if(file_exists($controllerFile)){
   
     include_once($controllerFile);

     // Создаем экземпляр контроллера

     $controller = new $controller;

     // Вызываем метод контроллера

     $controller->$action(); 
   
     $result = true;
     break;
     }
   }
}
```

# Функция method_exists()

Функция method_exists() проверяет, поддерживается ли объектом метод с заданным именем. Если метод поддерживается, функция возвращает TRUE, в противном случае возвращается FALSE. Синтаксис функции method_exists():
```
bool method_exi sts (object имя_обьекта. string имя_метода)
```

- object - Экземпляр объекта или имя класса
- method_name - Имя метода


### Пример использования method_exists()

```php

   //Подключаем файл контроллера
   $controllerFile = CONTROLLERS . $controller . EXT;

   if(file_exists($controllerFile)){
     include_once($controllerFile);
     
     $result = true;

     // Создаем экземпляр контроллера

     $controller = new $controller;

     if (! method_exists($controller, $action)) {
      throw new Exception(
      "{$controller} does not respond to the {$action} action."
      );
      }

      // Вызываем метод контроллера

      else{
       $controller->$action();  
      }

```
## Модель исключений (exceptions)

Модель исключений (exceptions) в PHP схожа с используемыми в других языках программирования. Исключение можно сгенерировать ("выбросить") при помощи оператора throw, и можно перехватить ( "поймать") оператором catch. 

Код генерирующий исключение, должен быть окружен блоком try, для того чтобы можно было перехватить исключение. 
Каждый блок try должен иметь как минимум один соответствующий ему блок catch или finally.

Генерируемый объект должен принадлежать классу Exception или наследоваться от Exception. Попытка сгенерировать исключение другого класса приведет к неисправимой ошибке

Внутренние функции PHP в основном используют сообщения об ошибках, и только новые объектно-ориентированные расширения используют исключения. Однако, ошибки можно легко преобразовать в исключения с помощью класса ErrorException.

Стандартная библиотека PHP (SPL) предоставляет хороший набор встроенных классов исключений.

## Выброс исключений

```php

function inverse($x) {
    if (!$x) {
        throw new Exception('Деление на ноль.');
    }
    return 1/$x; }

public function direct($uri)
  {
    if (array_key_exists($uri, $this->routes)) {
      return $this->routes[$uri];
    }
    Throw new Exception('No route defined for this URI.');
  }
```

Для того, чтобы отловить исключение, используется конструкция try...catch. В блоке try выполняются операции, которые могут привести к исключительной ситуации, а блок catch позволяет принять решение что делать, если исключение было брошено.

```php

  try {
      throw new Exception(\\\"Exception message\\\");
      echo \\\"That code will never been executed\\\";
  } catch (Exception $e) {
      echo $e->getMessage(); //выведет \\\"Exception message\\\"
  }
```
при выбрасывании исключения, остальной код в блоке try выполнен не будет, а управление будет передано в оператор catch, в котором мы указываем, как будет называться объект, в который будет передано выброшенное исключение (в нашем случае — $e). 

Внутри блока оператора catch, на основании данных из исключения мы можем применять какое-либо действие в зависимости от ситуации. 


Также исключения можно передавать цепочкой (chain) наверх:

```php

  class MyException extends Exception {}
  try {
      try {
          //...
          throw new Exception(\\\"inner\\\");
          //...
      }
  catch (Exception $e) {
          throw new MyException(\\\"outer\\\");
      }
  } catch (MyException $e) {
      echo $e->getMessage(); //выведет \\\"outer\\\"
  }

```
## блок finally
этот блок будет выполнен вне зависимости от того, было выброшено исключение или нет:

```php

try {
    // код который может выбросить исключение
} catch (Exception $e) {
    // код который может обработать исключение
    // если конечно оно появится
} finally {
    // код, который будет выполнен при любом раскладе
}
```

```php

try {
     
      include_once($controllerFile);
      $controller = new $controller;

      try {
          // код который может выбросить исключение
          $controller->$action();  
      } catch (Exception $e) {
          // код который может обработать исключение если оно появится
        if (! method_exists($controller, $action)) {
          throw new Exception(
          "{$controller} does not respond to the {$action} action."
          );
        }
      }
      
      $result = true;
      break; 
    } 
    catch (Exception $e) {
        // код который может обработать исключение
        // если конечно оно появится
        if (! file_exists($controllerFile)) {
          throw new Exception("{$controllerFile} does not respond.");
      }
    } 
```

## Контроллер Blog

```php

<?php

class BlogController
{

public function index()
    {   
        $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
        or die("Ошибка " . mysqli_error($conn));
        $posts = [];
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($conn, $sql);
        $resCount = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
                array_push($posts, $row);
            }
        // закрываем подключение
        mysqli_close($conn);

        render('blog/index', ['title'=>'Our <b>Cats Blog</b>', 'posts'=>$posts, 'resCount'=>$resCount]);
    }
}
```

## Шаблон blog/index.php

```html

  <div class="items">
    <?php 
      if($resCount>0){
         echo "<h3>$resCount posts:</h3> ";
         foreach ($posts as $row) {
           echo "<h2>".$row["title"]."</h2>"; 
           echo "<div class='added_at'> Added At: ".strip_tags($row["created_at"])."</div>"; 
           echo "<div class='content'>".strip_tags($row["content"])."</div>"; 
                  
          }
        }
        else{
          echo "No posts yet.... ";
        }
    ?>
  </div>
```
