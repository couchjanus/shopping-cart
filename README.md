# shopping-cart

# Регулярные выражения

Регулярные выражения - это выражения для поиска и замены подстроки по шаблону.

В PHP используется название PCRE (Perl Compatible Regular Expressions - перл совместимые регулярные выражения). 
Регулярные выражения PCRE http://php.net/manual/ru/pcre.pattern.php

### Синтаксис регулярных выражений 
http://php.net/manual/ru/reference.pcre.pattern.syntax.php


### Функции для работы с регулярными выражениями (Perl-совместимые)
http://php.net/manual/ru/ref.pcre.php

- preg_filter — Производит поиск и замену по регулярному выражению
- preg_grep — Возвращает массив вхождений, которые соответствуют шаблону
- preg_last_error — Возвращает код ошибки выполнения последнего регулярного выражения PCRE
- preg_match_all — Выполняет глобальный поиск шаблона в строке
- preg_match — Выполняет проверку на соответствие регулярному выражению
- preg_quote — Экранирует символы в регулярных выражениях
- preg_replace_callback_array — Выполняет поиск и замену по регулярному выражению с использованием функций обратного вызова
- preg_replace_callback — Выполняет поиск по регулярному выражению и замену с использованием callback-функции
- preg_replace — Выполняет поиск и замену по регулярному выражению
- preg_split — Разбивает строку по регулярному выражению


## Строка для испытаний

```php
// строка для испытаний
$string = 'http://localhost:8000/posts';
 
// вывод
echo $string;
echo "\n";

```

## preg_match

preg_match — Выполняет проверку на соответствие регулярному выражению http://php.net/manual/ru/function.preg-match.php

Если нам нужно просто узнать есть ли шаблон 'posts' в строке $string
мы можем набросать такой код:

```php
<?php

// строка для испытаний
$string = 'http://localhost:8000/posts';
 
// вывод
echo $string;
echo "\n";

// Этот код выведет '1'. Потому что он нашел 1 (одно) вхождение шаблона в строке.

echo "Этот код выведет 1\n";

echo preg_match("/posts/", $string);
echo "Потому что он нашел 1 (одно) вхождение шаблона в строке\n";

?>
```

Если шаблон в строке не обнаружен, preg_match вернет 0. При нахождении первого вхождения, функция сразу возвращает результат  Дальнейший поиск не продолжается


## Нахождение начала строки

Символ начала строки в регулярках - '^' (caret - знак вставки).

Пример:

```php
// Нахождение начала строки

// Теперь мы желаем узнать, начинается ли строка с 'posts'.
// Символ начала строки в регулярках - '^' (caret - знак вставки).
 
// тест на начало строки
$string = 'posts/1';

if(preg_match("/^posts/", $string))
{
    // окей, строка начинается с posts
    echo "\nThe string begins with posts\n";
   
}
else
{
    echo "\nThe string doesn't begin with posts\n";
}

```

Пример выведет:

The string begins with posts

## Оборачивающие слэши

Оборачивающие слэши - разделители, содержат регуряное выражение. Это могут быть любые парные символы,

например 

```
@regex@, 

#regex#, 

/regex/
```

и .т.п.

Символ ^ сразу после первого разделителя указывает что выражение начинается сначала строки и НИКАК иначе.


## регистр символов (строчные-прописные)

```php
if(preg_match("/^POSTS/", $string))
{
    // окей, строка начинается с posts
    echo "\nThe string begins with POSTS\n";
   
}
else
{
    echo "\nThe string doesn't begin with POSTS\n";
}

```
Скрипт вернет:

The string doesn't begin with POSTS


### модификатор 'i'

Чтобы найти оба варианта, нужно использовать модификатор 'i', который нужно указать за закрывающим разделителем
регулярного выражения.

```php
if(preg_match("/^POSTS/i", $string))
{
    // окей, строка начинается с posts
    echo "\nThe string begins with POSTS\n";
   
}
else
{
    echo "\nThe string doesn't begin with POSTS\n";
}

```

Теперь скрипт найдет паттерн 'POSTS'. Также теперь будут попадать под шаблон строки вида posts, POSTS, Posts, poSts, и т.п.

## конец строки в паттерне 

Каретка (^) обозначает начало страки и доллар ($) - ее конец.

```php
// тест на конец строки

$string = "posts";
if(preg_match("/^posts$/", $string))
{
    echo 'The string endins with posts';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with POSTS\n";
}

$string = "posts/1";
if(preg_match("/1$/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

// использовать утверждение \z

$string = "posts/1";
if(preg_match("/1\z/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

```

Когда нам нужно получить в результате строку без "разделителей строк", $ не должен использоваться.

```php

$string = "posts/1\n";

if(preg_match("/1\z/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

if(preg_match("/1$/", $string))
{
    echo 'The string endins with 1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with 1\n";
}

```

## Мета символы

Список мета символов в регулярных выражениях:

```
    . (Точка, Full stop)
    ^ (Каретка, Carat)
    * (Звездочка, Asterix)
    + (Plus)
    ? (Question Mark)
    { (Opening curly brace)
    [ (Opening brace)
    ] (Closing brace)
    \ (Backslash)
    | (Pipe)
    ( (Opening parens)
    ) (Closing parens)
    } (Closing curly brace)
```

Если вам нужно составить шаблон в котором содержится такой символ, его необходимо экранировать

```php
$string = 'posts?id=1';


if(preg_match("/posts\?id=1\z/", $string))
{
    echo 'The string endins with id=1';
    echo "\n";
}
else
{
    echo "\nThe string doesn't endin with id=1\n";
}

```

Результат скрипта:

The string endins with id=1

Потому что интерпретатор проигнорировал специальное значение символа "?", обозначенного символом экранирования "\".
Если бы мы не добавили экран к ?, то preg_match("/posts?id=1\z/", $string) не нашло бы совпадений с шаблоном.

Сам бэкслэш в свою очередь тоже нужно экранировать, если мы ищем именно этот символ "\\".

## Мета символ "?"

Знак вопроса совпадет с НУЛЕМ или ОДНИМ вхождением символа или регулярным выражением, указанным сразу перед ним. Полезен для указания опциональных символов (которых может и не быть).

Например, телефонный номер: 1234-5678.
```php
// create a string
$string = '1234-5678';
 
// look for a match
echo preg_match("/1234-?5678/", $string, $matches);
echo "\n";
```

## Квадратные скобки [ ]
Квадратные скобки [ ] обозначают "символьный класс".

Символьный класс - просто набор символов, которые должны совпасть в искомой строке. Они могут записываться индивидуально (по одному):

```
[abcdef]

```
Или как диапазон, разделенный символом "-":

```
[a-f]

```

```php
$string = 'posts/1';
 
// Ищем шаблон
echo preg_match("/[1234567890]$/", $string, $matches);

echo "\n";

```
Результат скрипта:
return 1

Потому что preg_match() нашел совпадение.

## Диапазон символов

```php
// Ищем шаблон
echo preg_match("/[0-9]$/", $string, $matches);

echo "\n";
```

Диапазон символов [a-f] равнозначен такой записи [abcdef]. Словами формулируется так [от 'a' до 'f'].
выражения регистрозависимые, и [A-F] не тоже самое что и [a-f].

Мета символы не работыют внутри классов, поэтому их не нужно экранировать внутри квадратных скобок [...].

Например класс [abcdef$] совпадет с символами a b c d e f $. Доллар ($) внутри класса - это простой знак доллара без какого либо специального мета-свойства.

## шаблон НЕ совпадающий с диапазоном символов

Одна из полезных функций регулярных выражений - возможность указать шаблон НЕ совпадающий с диапазоном символов.
Чтобы это сделать, нужно использовать каретку (^) первым символом класса.

Найдем любые символы, кроме "b":
```php
<?php
$string = 'abcefghijklmnopqrstuvwxyz0123456789';
 
// осуществляем поиск
preg_match("/[^b]/", $string, $matches);
 
// выведем все совпадения в цикле foreach
foreach ($matches as $key => $value) {
    echo $key.' -> '.$value;
}
?>

```

Результат скрипта:
0 -> a

Здесь preg_match() нашел первое совпадение с шаблоном /[^b]/.

## preg_match_all()
Изменим скрипт и используем preg_match_all() для нахождения всех вхождений соответствующих шаблону /[^b]/.

```php
<?php
$string = 'abcefghijklmnopqrstuvwxyz0123456789';
 
// ищем ВСЕ совпадения
preg_match_all("/[^b]/", $string, $matches);
 
// выведем все совпадения в цикле foreach
foreach ($matches[0] as $value) {
    echo $value;
}
?>

```
Результат скрипта:
acefghijklmnopqrstuvwxyz0123456789

Выведет все символы, которые НЕ совпадают с шаблоном "b".

Так мы можем отфильтровать все цифры в строке:

```php
<?php
$string = 'abcefghijklmnopqrstuvwxyz0123456789';
 
// все символы не являющиеся цифрами от 0 до 9
preg_match_all("/[^0-9]/", $string, $matches);
 
 
foreach ($matches[0] as $value) {
    echo $value;
}
?>

```
Результат скрипта:
abcefghijklmnopqrstuvwxyz

## Шаблон [^0-9]

Шаблон [^0-9] расшифровывается как все НЕ включая цифры от 0 до 9.


## Метасимвол Бэкслэш (\).

Основное значение - экранирование других метасимволов.

```php
<?php
// create a string
$string = 'This is a [templateVar]';
 
// try to match our pattern
preg_match_all("/[\[\]]/", $string, $matches);
 
// loop through the matches with foreach
foreach ($matches[0] as $value) {
    echo $value;
}
?>
```

Результат скрипта:
[]

Здесь мы хотели найти все символы []. Без экранирования шаблон выглядел бы так - "/[[]]/", но мы добавили бэеслэши к скобкам [], чтобы отменить их мета-статус.

Бэкслэш также используется в строках для указания специальных последовательностей: \n, \r и др.

## Символ "." (точка) - "полный стоп".

Точка совпадает с любым символом кроме символов разрыва строки \r или \n.
С помощью точки мы можем найти любой одиночный символ, за исключением разрыва строки.
Чтобы точка также совпадала с переводом каретки и разрывом строки, можно использовать флаг /s.

Совпадает один раз с любым символом (кроме разрыва строки)

```php
<?php
// create a string
$string = 'abcdefghijklmnopqrstuvwxyz0123456789';
 
// try to match any character
if (preg_match("/./", $string)) {
    echo 'The string contains at least on character';
} else {
    echo 'String does not contain anything';
}
?>

```
Результат скрипта:
The string contains at least on character

## Ищем одиночный символ
```php
// Ищем одиночный символ
$string = 'regex';
 
echo preg_match("/r.g/", $string, $matches);

echo "\n";
```

Результат скрипта:
1

preg_match() нашел одно совпадение.


## preg_match_all()

```php
$string = 'regex rtgen regreg';

echo preg_match_all("/r.g/", $string, $matches);
echo "\n";

```
preg_match_all() нашел 4 совпадения. 

## Символ - звездочка (*) asterisk

Совпадает с 0 и/или БОЛЕЕ вхождений шаблона, находящегося перед звездочкой.

"*" означает опциональный шаблон - допускается что символы могут быть, а могут и отсутствовать в строке.
Так шаблон '.*' совпадает с любым количеством любых символов. 

```php

<?php
// create a string
$string = 'php';
 
// look for a match
echo preg_match("/ph*p/", $string, $matches);
 
?>

```
Результат скрипта:
1

Нашлось одно совпадение. В примере это один символ "h".
Пример также совпадет также со строкой "pp" (ноль символов "h"), и "phhhp" (три символа "h").

## Плюс символ "+"

Плюс почти тоже самое что и звездочка, за исключением того что плюс совпадает с ОДНИМ и БОЛЬШЕ символом.
Так в примере звездочка "*" совпала со строкой 'pp', с плюсом "+" такое не пройдет.

```php
<?php
// create a string
$string = 'pp';
 
// look for a match
echo preg_match("/ph+p/", $string, $matches);
 
?>
```

Результат скрипта:
0

Потому что ни одного символа "h".


## Фигурные скобки {}

Указывает на количество совпавших символов или их интервал.
Например, за фразой PHP должно следовать ТОЧНО ТРИ цифры:

```php
<?php
 
// create a string
$string = 'PHP123';
 
// look for a match
echo preg_match("/PHP[0-9]{3}/", $string, $matches);
 
?>
```

Результат скрипта:
1

Шаблон PHP 0-9(цифры от 0 до 9) {3} (три раза) совпал.

## Специальные последовательности

Бэкслэш (\) используется для спец. последовательностей:

```
* \d - любая цифра (тоже самое что и [0-9])
* \D - любая НЕ цифра ([^0-9])
* \s - все "недосимволы" - пробелы, переводы строки, табуляция ([ \t\n\r\f\v])
* \S - все НЕ "недосимволы" ([^ \t\n\r\f\v])
* \w - все альфа-цифровые символы (буквенно-числовые) ([a-zA-Z0-9_])
* \W - все НЕ альфа-цифровые символы ([^a-zA-Z0-9_])
```

Используя последофательности (флаги) мы можем сократить наши регулярные выражения и улучшить их читабельность.


```php
<?php
// create a string
$string = 'ab-ce*fg@ hi & jkl(mnopqr)stu+vw?x yz0>1234<567890';
 
// match our pattern containing a special sequence
preg_match_all("/[\w]/", $string, $matches);
 
// loop through the matches with foreach
foreach ($matches[0] as $value) {
    echo $value;
}
?>

```
Результат скрипта:
abcefghijklmnopqrstuvwxyz0123456789

Мы нашли (preg_match_all) все цифры и буквы (\w) класса ( [] ).

## строка не содержит чисел.

```php
<?php
// create a string
$string = '2 bad for perl';
 
// echo our string
if (preg_match("/^\d/", $string)) {
    echo 'String begins with a number';
} else {
    echo 'String does not begin with a number';
}
?>

```

## Модификаторы и утверждения

Модификаторы изменяют поведения шаблонов регулярных выражений.

### Модификаторы
 
 ```
     i - регистронезависимый (Ignore Case, case insensitive)
     U - нежадный поиск (Make search ungreedy)
     s - включая перевод строки (Includes New line)
     m - мультистрока (Multiple lines)
     x - Extended for comments and whitespace
     e - Enables evaluation of replacement as PHP code. (preg_replace only)
     S - Extra analysis of pattern
``` 
### Утверждения (Assertions)

``` 
     b - граница слова (Word Boundry)
     B - НЕ граница слова (Not a word boundary)
     A - начало шаблона (Start of subject)
     Z - конец шаблона или разрыв строки (End of subject or newline at end)
     z - конец шаблона (End of subject)
     G - первая совпавшая позиция в шаблоне (First matching position in subject)
```


Пример модификатора "i"

```php
<?php
// create a string
$string = 'abcdefghijklmnopqrstuvwxyz0123456789';
 
// try to match our pattern
if (preg_match("/^ABC/i", $string)) {
    echo 'Совпадение, строка начинается с abc';
} else {
    echo 'Не думаю';
}
?>
```

# Вычисление с preg_replace
## preg_replace

preg_replace — Выполняет поиск и замену по регулярному выражению
http://php.net/manual/ru/function.preg-replace.php

```php
<?php

$string = 'We will replace the word foo';
 
// заменяем `for` на `bar`
$string = preg_replace("/foo/", 'bar', $string);
 
echo $string;
?>

```
Пример заменит в строке foo на bar. В таких простых заменах целесообразнее использовать функции обработки строк
str_replace(), которые быстрее справляются с простыми задачами, но имеют некоторые ограничения, например не поддерживают юникод.

заменяем все цифры помещенные в скобки на звездочки.

```php
// заменяем все цифры помещенные в скобки на звездочки.


$str = "(945)-55-34-33(02)";
$arr_str = preg_replace("/\([0-9]+\)/", "***",$str);
print_r ($arr_str);
echo "\n";

```
заменяем строку соответствующую всему шаблону, данными 
соответствующими первой подмаске по ссылке \$1. 

```php
// заменяем строку соответствующую всему шаблону, данными 
// соответствующими первой подмаске по ссылке \$1. 

// "have 3 apples", соответствующие "/(\w+) (\d+) (\w+)/", 
// будет заменено на "have", соответствующее (\w+).


$str = "I have 3 apples";
$pattern = "/(\w+) (\d+) (\w+)/";
$replacement = "\$1";
echo preg_replace($pattern, $replacement, $str);
echo "\n";
```

### Вырезать повторяющиеся символы из текста

Вырезаем повторяющиеся многократно символы .......... или ??????? или )))))))) или !!!!!!!! или ((((((((

```php	
$string = "Вырезаем повторяющиеся многократно символы .......... или ??????? или )))))))) или !!!!!!!! или ((((((((";
echo $string;

echo "\n";

function cleanText($text){
    $text = preg_replace("#(\.|\?|!|\(|\)){3,}#", "\$1 ", $text);
    return $text;
}

echo cleanText($string);
```
### Конвертация тега переноса BR в символ новой строки

```php	
$string = '<br> We will<br /> replace<br/> the word foo';

echo preg_replace("/<br(\s*+)?\/?\>/i", "\n", $string);

echo "\n";

```


```php

<?php


$string = 'posts/1';

echo preg_match("#[\w]+\/[0-9]#", $string, $matches);

echo "\n";

print_r($matches);

echo "\n";


$pattern = preg_replace('#\(/\)#', '/?', $string);
print_r($pattern);
echo "\n";

$pattern = preg_replace('/{([0-9]+)}/', '(?<$1>[0-9]+)', $pattern);
print_r($pattern);
echo "\n";

$uri = 'admin/posts/1';
$key = 'admin/posts/{id}';

$pattern = preg_replace('#\(/\)#', '/?', $uri);
echo $pattern;
echo "\n";

$pattern = preg_replace('#\(/\)#', '/?', $key);
echo $pattern;
echo "\n";

$pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
echo $pattern;
echo "\n";
echo preg_match($pattern, $uri, $matches);
echo "\n";
print_r($matches);
echo "\n";
// array_shift($matches);
print_r(array_shift($matches));
echo "\n";
print_r($matches);
echo "\n";

```

## routes

```php

$router->define([
    'contact' => 'ContactController@index',
    'about' => 'AboutController@index',
    'blog' => 'BlogController@index',
    'blog/{id}' => 'BlogController@view',
    'blog/search' => 'BlogController@search',
    'guestbook' => 'GuestbookController@index',
    'admin' => 'Admin\DashboardController@index',
    'admin/categories'=>'Admin\shop\CategoriesController@index',
    'admin/categories/create' => 'Admin\shop\CategoriesController@create',
    'admin/products' => 'Admin\shop\ProductsController@index',
    'admin/products/create'=>'Admin\shop\ProductsController@create',
    'admin/posts' => 'Admin\blog\PostsController@index',
    'admin/posts/create' => 'Admin\blog\PostsController@create',
    //Главаня страница
    'index.php' => 'HomeController@index', 
    '' => 'HomeController@index',  
]);

```
## class Router

```php
<?php
class Router
{
    protected $routes = [];
    protected $result;

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    public function directPath($uri)
    {
        if (array_key_exists($uri, $this->routes)) {
            
            return $this->callAction(
            ...$this->getPathAction($this->routes[$uri])
            );
        }
        else{
              foreach ($this->routes as $key => $val){
                $pattern = preg_replace('#\(/\)#', '/?', $key);
                $pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
                preg_match($pattern, $uri, $matches);
                array_shift($matches);
                if($matches){
                    $getAction = $this->getPathAction($val);
                    return $this->callAction($getAction[0],$getAction[1],$getAction[2], $matches);
                }
            }  
          
      }
      require_once VIEWS.'404'.EXT;
      throw new Exception('No route defined for this URI.');
    }


    private function getPathAction($route){
        list($segments, $action) = explode('@', $route);
        $segments = explode('\\', $segments);
        $controller = array_pop($segments);
        $controllerFile = '/';
        do {
            if(count($segments)==0){
              return array ($controller, $action, $controllerFile);
                }
                else{
                    $segment = array_shift($segments);
                    $controllerFile = $controllerFile.$segment.'/';
                }
            }while ( count($segments) >= 0);
    }

    protected function callAction($controller, $action, $controllerFile, $vars = []) 
    {
        
        include(CONTROLLERS.$controllerFile.'/'.$controller.EXT);
        
        $controller = new $controller;
        
        if (! method_exists($controller, $action)) {
            throw new Exception(
            "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action($vars); 
    }
   
}
```

## Модель для работы с posts

```php

<?php


class Post {

    public static function index () {
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT id, title, content, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date, status FROM posts ORDER BY id ASC";
        $res = $con->query($sql);
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public static function show($id){
        $con = Connection::make();
        $con->exec("set names utf8");
        $sql = "SELECT * FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public static function store ($options) {
        $db = Connection::make();
        $sql = "INSERT INTO posts(title, content, status)
                VALUES (:title, :content, :status)";
        $res = $db->prepare($sql);
        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        $res->execute();

    }

 }
```

## class BlogController

```php

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::index();
        $data['title'] = 'Blog Page ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['posts'] = $posts;
        $this->_view->render('blog/index',$data);
    }

    public function view($vars)
	{
		extract($vars);
		$post = Post::show($id);
        $data['title'] = 'Blog Post ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['post'] = $post;
		$this->_view->render('blog/show', $data);
	}    
    
}
```
## blog/index

```php
    <div class="items">
        <?php 
            if(count($posts)>0){
                foreach ($posts as $post) {
                  echo "<h2>".$post["title"]."</h2>"; 
                  echo "<div class='added_at'> Added At: ".strip_tags($post["formated_date"])."</div>"; 

                  echo "<p><a href=/blog/".$post["id"].">Read more</a></p>"; 
                }
            }
            else{
                echo "No posts yet.... ";
            }
        ?>
    </div>
```

## blog/show

```php

        <div class="row">
            <div class="col-md-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title"><?=$title;?></h3>
                    <h4 class="feature_sub"><?=$subtitle;?></h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="items">
              <?php 
                  echo "<h2>".$post["title"]."</h2>"; 
                  echo "<div class='added_at'> Added At: ".$post["created_at"]."</div>"; 
                  echo "<div class='content'>".$post["content"]."</div>"; 
              ?>
            </div>
        </div>
```

