# shopping-cart 

# Объектно ориентированный PHP

Объектно-ориентированное программирование - это стиль кодирования, который позволяет разработчикам группировать схожие задачи в классы. Это помогает сохранить код в соответствии с принципом «не повторяйся» (DRY) и простым в обслуживании.

Одним из основных преимуществ программирования по принципу DRY является то, что если в вашей программе изменяется часть информации, обычно требуется только одно изменение для обновления кода. 

ООП является очень наглядным и более простым подходом к программированию.

# Объекты и классы

Каждое определение класса начинается с ключевого слова class, затем следует имя класса, и далее пара фигурных скобок, которые заключают в себе определение свойств и методов этого класса.

Именем класса может быть любое слово, при условии, что оно не входит в список зарезервированных слов PHP, начинается с буквы или символа подчеркивания и за которым следует любое количество букв, цифр или символов подчеркивания. 
Если задать эти правила в виде регулярного выражения, то получится следующее выражение: 

```
  
  ^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$.

```

Класс может содержать собственные константы, переменные (называемые свойствами) и функции (называемые методами).

# Синтаксис для создания класса

объявить класс с помощью ключевого слова class, за которым следует имя класса и набор фигурных скобок ({}):

## MyClass01.php

```php

class MyClass
{
  
  // Class properties and methods go here   

}
 
```

## AboutController.php

```php

<?php
 
class AboutController
{
 
   // Class properties and methods go here   
    
}

```

## Создание экземпляра класса

После создания класса новый экземпляр может быть создан и сохранен в переменной с использованием ключевого слова new:

```php

$obj = new MyClass;

$obj = new AboutController;


```

Новый объект всегда будет создан, за исключением случаев, когда он содержит конструктор, в котором определен вызов исключения в случае ошибки. Рекомендуется определять классы до создания их экземпляров.

Чтобы увидеть содержимое класса, используйте var_dump ():

## MyClass01.php

```php

<?php
 
class MyClass
{
  // Class properties and methods go here
}
 
$obj = new MyClass;
 
var_dump($obj);
 
?>

```

Если с директивой new используется строка (string), содержащая имя класса, то будет создан новый экземпляр этого класса. Если имя находится в пространстве имен, то оно должно быть задано полностью.

## Создание экземпляра класса

## MyClass02.php

```php

<?php
$instance = new MyClass();

// Это же можно сделать с помощью переменной:
$className = 'MyClass';
$instance = new $className(); // new MyClass()
?>

```

# Свойства и методы 


## Определение свойств класса

Для добавления данных в класс используются свойства или переменные класса. Они работают точно так же, как и обычные переменные, за исключением того, что они привязаны к объекту и поэтому могут быть доступны только с помощью объекта.

Чтобы добавить свойство в MyClass, добавьте следующий код в свой скрипт:

```php

<?php
 
class MyClass
{
  // Class properties and methods go here
  public $prop1 = "I'm a class property!";
}

$instance = new MyClass();
 
var_dump($instance);

```
## Ключевое слово public
Ключевое слово public определяет видимость свойства. Затем свойство присваивается с использованием стандартного синтаксиса переменных и присваивается значение (хотя свойствам классов не требуется начальное значение).

Чтобы прочитать это свойство и вывести его в браузер, укажите объект, с которого следует читать, и свойство, которое нужно прочитать:

```
echo $obj->prop1;

```
Поскольку могут существовать несколько экземпляров класса, если отдельный объект не ссылается, то сценарий не сможет определить, с какого объекта следует читать свойство. Использование стрелки (->) является конструкцией ООП, которая обращается к содержащимся в нем свойствам и методам данного объекта.

## MyClass04.php

```php

<?php
 
<?php
 
class MyClass
{
  // Class properties and methods go here
  public $prop1 = "I'm a class property!";
}

$instance = new MyClass();

echo $instance->prop1; // Output the property
 
?>
```

## Определение методов класса

Методы являются специфичными для класса функциями. Отдельные действия, которые объект сможет выполнить, определены внутри класса как методы.

Например, чтобы создать методы, которые будут устанавливать и получать значение свойства класса $prop1, добавьте в свой код следующее:

## MyClass05.php

```php

<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
$instance = new MyClass;
 
echo $instance->prop1;
 
?>
```

ООП позволяет объектам ссылаться на себя, используя $this. При работе внутри метода используйте $this таким же образом, как вы использовали бы имя объекта вне класса.

## Псевдопеременная $this

Псевдопеременная $this доступна в том случае, если метод был вызван в контексте объекта. $this является ссылкой на вызываемый объект. Обычно это тот объект, которому принадлежит вызванный метод, но может быть и другой объект, если метод был вызван статически из контекста другого объекта. 

## Простое определение класса

```php

<?php
class SimpleClass
{
    // объявление свойства
    public $var = 'значение по умолчанию';

    // объявление метода
    public function displayVar() {
        echo $this->var;
    }
}
?>

```

Чтобы использовать эти методы, вызовите их так же, как обычные функции, но сначала укажите ссылку на объект, к которому они принадлежат. Прочитайте свойство из MyClass, измените его значение и прочитайте его еще раз, внеся следующие изменения:

## MyClass05.php
```php
<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
$instance = new MyClass;
 
echo $instance->getProperty(); // Get the property value
 
$instance->setProperty("I'm a new property value!"); // Set a new one
 
echo $instance->getProperty(); // Read it out again to show the change
 
?>
```

Свойства и методы класса живут в разделенных "пространствах имен", так что возможно иметь свойство и метод с одним и тем же именем. Ссылки как на свойства, так и на методы имеют одинаковую нотацию, и получается, что получите вы доступ к свойству или же вызовете метод - определяется контекстом использования.

## Доступ к свойству vs. вызов метода

## MyClass06.php

```php

<?php
class MyClass
{
    public $bar = 'свойство';
    
    public function bar() {
        return 'метод';
    }
}

$obj = new MyClass();

echo $obj->bar, PHP_EOL, $obj->bar(), PHP_EOL;

```

## использование нескольких экземпляров одного класса

## MyClass07.php

```php

<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
// Create two objects
$obj = new MyClass;
$obj2 = new MyClass;
 
// Get the value of $prop1 from both objects
echo $obj->getProperty();
echo $obj2->getProperty();
 
// Set new values for both objects
$obj->setProperty("I'm a new property value!");
$obj2->setProperty("I belong to the second instance!");
 
// Output both objects' $prop1 value
echo $obj->getProperty();
echo $obj2->getProperty();
 
?>

```

ООП хранит объекты как отдельные сущности, что позволяет легко разделять различные фрагменты кода на небольшие связанные пакеты.

# Волшебные методы в ООП
Чтобы упростить использование объектов, PHP также предоставляет ряд магических методов или специальных методов, вызываемых, когда определенные общие действия происходят внутри объектов. Это позволяет разработчикам выполнять ряд полезных задач с относительной легкостью.

## Использование конструкторов и деструкторов
Когда создается экземпляр объекта, часто желательно сразу же установить несколько вещей. Чтобы справиться с этим, PHP предоставляет магический метод __construct(), который вызывается автоматически всякий раз, когда новый объект
создается.

## MyClass08.php

```php

<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function __construct()
  {
      echo 'The class "', __CLASS__, '" was initiated!<br />';
  }
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
// Create a new object
$obj = new MyClass;
 
// Get the value of $prop1
echo $obj->getProperty();
 
// Output a message at the end of the file
echo "End of file.\n>";
 
?>
```

__CLASS__ возвращает имя класса, в котором оно вызывается; Это то, что известно как волшебная константа. 

## магический метод __destruct()

Чтобы вызвать функцию, когда объект разрушен, доступен магический метод __destruct(). Это полезно для очистки класса (например, закрытие соединения с базой данных).

Вывести сообщение, когда объект уничтожен, определяя магический метод
__destruct() в MyClass:

## MyClass09.php

```php

<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function __construct()
  {
      echo 'The class "', __CLASS__, '" was initiated!<br />';
  }
 
  public function __destruct()
  {
      echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
// Create a new object
$obj = new MyClass;
 
// Get the value of $prop1
echo $obj->getProperty();
 
// Output a message at the end of the file
echo "End of file.\n";
 
?>
```

«Когда достигнут конец файла, PHP автоматически освобождает все ресурсы».

Чтобы явно вызвать деструктор, вы можете уничтожить объект, используя
функцию unset():

## MyClass10.php

```php
<?php
 
class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function __construct()
  {
      echo 'The class "', __CLASS__, '" was initiated!<br />';
  }
 
  public function __destruct()
  {
      echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
// Create a new object
$obj = new MyClass;
 
// Get the value of $prop1
echo $obj->getProperty();
 
// Destroy the object
unset($obj);
 
// Output a message at the end of the file
echo "End of file.\n";
 
?>
```

## функция extract

Импортирует переменные из массива в текущую таблицу символов.
Каждый ключ проверяется на предмет корректного имени переменной. Также проверяются совпадения с существующими переменными в символьной таблице.

Эта функция рассматривает ключи массива в качестве имен переменных, а их значения - в качестве значений этих переменных. Для каждой пары ключ/значение будет создана переменная в текущей таблице символов, в соответствии с параметрами flags и prefix.

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

## AboutController.php

```php

<?php

class AboutController
{
    
    public function __construct()
    {   
        render('home/about', ['title'=>'SHOPAHOLIC ABOUT PAGE']);
    }
    
}

```


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

     $controller = new $controller;
     
     break;
     }
   }
}
   
if($result === null){
     require_once VIEWS.'404'.EXT;
}

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

## explode — Разбивает строку с помощью разделителя

Возвращает массив строк, полученных разбиением строки string с использованием delimiter в качестве разделителя.

- delimiter - Разделитель.
- string - Входная строка.
- limit - Если аргумент limit является положительным, возвращаемый массив будет содержать максимум limit элементов, при этом последний элемент будет содержать остаток строки string. Если параметр limit отрицателен, то будут возвращены все компоненты, кроме последних -limit. Если limit равен нулю, то он расценивается как 1.

Если delimiter является пустой строкой (""), explode() возвращает FALSE. Если delimiter не содержится в string, и используется отрицательный limit, то будет возвращен пустой массив (array), иначе будет возвращен массив, содержащий string.


## Router.php

```php
foreach ($routes as $uriPattern => $path) {

 //Сравниваем uriPattern и $uri
 if($uriPattern == $uri){

   // Определить контроллер
   $segments = explode('@', $path);
   $controller = array_shift($segments);
   $action = array_shift($segments);

   //Подключаем файл контроллера
   $controllerFile = CONTROLLERS . $controller . EXT;

   if(file_exists($controllerFile)){
     include_once($controllerFile);
     $controller = new $controller;
     $controller->$action(); 
     $result = true;
     break;
     }
   }
}
```

## method_exists — Проверяет, существует ли метод в данном классе

- object - Экземпляр объекта или имя класса
- method_name - Имя метода

Возвращает TRUE, если метод method_name определен для указанного объекта object, иначе возвращает FALSE.

### Пример использования method_exists()

```php

   //Подключаем файл контроллера
   $controllerFile = CONTROLLERS . $controller . EXT;

   if(file_exists($controllerFile)){
     include_once($controllerFile);
     
     $result = true;

     $controller = new $controller;

     if (! method_exists($controller, $action)) {
      throw new Exception(
      "{$controller} does not respond to the {$action} action."
      );
      }
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


## Blog

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

## blog/index.php

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
