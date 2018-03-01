# shopping-cart

# Оператор SQL LIKE

MySQL условие LIKE позволяет использовать шаблоны в операторе WHERE для оператора SELECT, INSERT, UPDATE или DELETE. Это позволяет выполнять сопоставление шаблонов.

## Синтаксис условия LIKE в MySQL:
```sql
expression LIKE pattern [ ESCAPE ‘escape_character’ ]
```

### Параметры

- expression — символьное выражение, такое как столбец или поле.
- pattern — символьное выражение, содержащее сопоставление шаблонов. 

Шаблоны, которые вы можете выбрать:
- % — позволяет вам сопоставлять любую строку любой длины (включая нулевую длину)
- _ — позволяет вам сопоставлять один символ
- escape_character — необязательный. Это позволяет вам проверять для буквенных экземпляров символы подстановки, такие как % или _. Если вы не укажите escape_character, MySQL предположит, что «\» является escape_character.

## Подстановочный знак процента

Пример использования знака % (подстановочный знак процента)

Найти все title, которые начинаются с Hell.
```sql
SELECT title 
FROM posts 
WHERE title LIKE 'Hell%';
```
Можно использовать % несколько раз в одной строке.
```sql
SELECT title 
FROM posts 
WHERE title LIKE '%ns%';
```
В этом примере мы ищем все заголовки, у которых title содержит символы ‘ns’.

## Подстановочный знак подчеркивания

Подстановочный знак _ означает только один символ.
```sql
SELECT * 
FROM posts 
WHERE title LIKE 'Ber_ard';
```
возвращает все записи, title которых составляет 7 символов, причем первые три символа — «Ber», а последние три символа — «ard». Например, он может вернуть все записи, title которых — ‘Bernard’, ‘Berzard’, ‘Bermard’, ‘Bersard’ и т.д.

```sql
SELECT *
FROM posts
WHERE id LIKE '12345_';
```
Вам может понадобиться найти номер учетной записи, но у вас есть только 5 из 6 цифр. В приведенном выше примере будет извлечено потенциально 10 записей (где отсутствующее значение могло бы равняться чему угодно от 0 до 9). Например, запрос может вернуть suppliers, чьи номера учетной записи: 123450, 123451, 123452, 123453, 123454, 123455, 123456, 123457, 123458, 123459

## Пример использования оператора NOT

условие LIKE для поиска posts, title которых не начинается с «B».

```sql
SELECT *
FROM posts
WHERE title NOT LIKE 'B%';
```
Помещая оператора NOT перед MySQL условием LIKE, вы получите всех posts, title которых не начинается с «B».

## Пример использования символов Escape

Предположим, вы хотели найти символы % или _ в MySQL условии LIKE. Вы можете сделать это, используя символ Escape.

Обратите внимание, что вы можете определить только escape-символ как один символ (длина 1).

```sql
SELECT *
FROM posts
WHERE title LIKE 'B\%';
```
Поскольку мы не указали каким будет escape-символ, то MySQL предполагает, что «\» и является escape-символом. Т.к. MySQL предположил, что «\» это и есть escape-символ, что приведет к тому, что MySQL обработает символ % как литерал, вместо подстановочного знака. Затем этот запрос будет возвращать все posts, у которых title = ‘B\%’.

Мы можем переопределить escape-символ по умолчанию в MySQL, предоставив модификатор ESCAPE следующим образом:
```sql
SELECT *
FROM posts
WHERE title LIKE 'Br!%' ESCAPE '!';
```
Этот пример MySQL условия LIKE идентифицирует символ ! как escape-символ. Escape-символ ! приведет к тому, что MySQL обрабатывает символ % как литерал. В результате в этом запросе также будут выбраны все posts, title которых Br%.

Вот еще один более сложный пример использования escape-символов в MySQL условии LIKE.
```sql
SELECT *
FROM posts
WHERE title LIKE 'H%\%';
```
Этот пример условия LIKE MySQL возвращает все posts, чье title начинается с H и заканчивается на %. Например, он вернет значение  «Hello%». Поскольку мы не указывали escape-символ в условии LIKE, MySQL предполагает, что escape-символ «\», что приводит к тому, что MySQL обрабатывает второй символ % как литерал вместо подстановочного знака.

Мы могли бы изменить это условие LIKE, указав escape-символ следующим образом:
```sql
SELECT *
FROM posts
WHERE title LIKE 'H%!%' ESCAPE '!';
```	

Этот пример MySQL условия LIKE возвращает всех posts, title которых начинается с H и заканчивается символом %. Например, он вернет значение, например «Hello%».

Вы также можете использовать escape character с символом _ в MySQL условии LIKE.
```sql
SELECT *
FROM posts
WHERE title LIKE 'H%\_';
```
поскольку не предусмотрен модификатор ESCAPE, MySQL использует «\» в качестве символа escape, в результате чего символ _ обрабатывается как литерал вместо подстановочного знака. В этом примере будут возвращены все posts, title которых начинается с H и заканчивается на _. Например, запрос вернет значение, такое как «Hello_».

## Справочное руководство по MySQL
http://www.mysql.ru/docs/man/String_comparison_functions.html

# class Post

```php
    public static function searchPost($query) 
    {
        $db = Connection::make();
        $sql = "SELECT id, title, DATE_FORMAT(`created_at`, '%d.%m.%Y %H:%i:%s') AS formated_date FROM posts WHERE status = 1 and ((title LIKE '%{$query}%') OR (content LIKE '%{$query}%'))";
        $res = $db->prepare($sql);
        $res->execute();
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

```

## Поиск по сайту на PHP и MySQL

Пользователь выполняет POST запрос из формы поиска, этот запрос передается специальному скрипту-обработчику, который должен обработать поисковый запрос пользователя и возвратить результат.

Сначала скрипт должен обработать должным образом запрос пользователя для обеспечения безопасности, затем выполняется запрос к базе данных, который возвращает в ассоциативном массиве результаты, которые должны будут выводиться на экран.

Создадим форму поиска на странице blog:

```html
<div class="row">
  <h4>Search Blog</h4>
    <form action="/blog/search" method="post">
      <div id="custom-search-input">
        <div class="input-group col-md-12">
            <input type="text" class="search-query form-control" placeholder="Search" name="query" />
            <span class="input-group-btn">
                <button class="btn btn-danger" type="submit">
                    <span class=" glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
      </div>
    </form>
</div>
```

## Метод обработчик поискового запроса.

## class BlogController

```php
    public function search()
    {
        //Флаг ошибок
        $data['errors'] = false;
        $result = false;
        
        if (isset($_POST) and !empty($_POST)) {
        // обрабатываем запрос, чтобы он стал безопасным для базы. Такую обработку нужно делать обязательно, т.к. любая форма на Вашем сайте — это потенциальная уязвимость для злоумышленников.

            $query = $_POST['query'];
            $query = trim($query); 
            $query = strip_tags($query);
            $query = htmlspecialchars($query);
            
            // Если запрос пустой, то возвращаем соответствующее сообщение пользователю. 

            if (!empty($query)) {
                // Если запрос не пустой, проверяем его на размер.

                // Если поисковый запрос имеет длину менее 3 или более 128 символов, также выводим соответствующие сообщения пользователю. 

                if (strlen($query) < 3) {
                    $data['errors'][] = 'Слишком короткий поисковый запрос.';
                } 
                else if (strlen($query) > 128) {
                    $data['errors'][] = 'Слишком длинный поисковый запрос.';
                } 
                // Иначе, выполняем запрос к базе данных, который делает выборку $posts = Post::searchPost($query), в которой найдены совпадения нужных нам полей с поисковым запросом.

                else { 
                    $posts = Post::searchPost($query);
                    $num_rows = count($posts);
                    if ($num_rows > 0) { 
                        $data['num_rows'] = 'По запросу <b>'.$query.'</b> найдено совпадений: '.$num_rows;
                    } 
                    else {
                        $data['errors'][] = 'По вашему запросу ничего не найдено.';
                    }
                } 
            } 
            else {
                $data['errors'][] = 'Задан пустой поисковый запрос.';
            }
        }   

        if ($data['errors'] == false) {
                $result = true;
                $data['posts'] = $posts;
        }

        $data['success'] = $result;
        $data['title'] = 'Search Post Page ';
        $this->_view->render('blog/search', $data);
    }    

```

## htmlspecialchars

htmlspecialchars — Преобразует специальные символы в HTML-сущности

В HTML некоторые символы имеют особый смысл и должны быть представлены в виде HTML-сущностей, чтобы сохранить их значение. Эта функция возвращает строку, над которой проведены эти преобразования. Если вам нужно преобразовать все возможные сущности, используйте htmlentities().

Если входная строка, переданная в эту функцию и результирующий документ используют одинаковую кодировку символов, то этой функции достаточно, чтобы подготовить данные для вставки в большинство частей HTML документа. Однако, если данные содержат символы, не определенные в кодировке символов результирующего документа и вы ожидаете сохранения этих символов (как числовые или именованные сущности), то вам недостаточно будет этой и htmlentities() функций (которые только преобразуют подстроки с соответствующими сущностями). Необходимо использовать функцию mb_encode_numericentity().

Производятся следующие преобразования

```
& (амперсанд) 	&amp;
" (двойные кавычки) 	&quot;, если не установлена ENT_NOQUOTES
' (одинарные кавычки) 	&#039; (для ENT_HTML401) или &apos; (для ENT_XML1, ENT_XHTML или ENT_HTML5), но только если установлена ENT_QUOTES
< (меньше) 	&lt;
> (больше) 	&gt;
```
http://php.net/manual/ru/function.htmlspecialchars.php

## routes.php

```php
$router->get('blog', 'BlogController@index');
$router->post('blog/search', 'BlogController@search');

$router->get('blog/{id}', 'BlogController@view');
```

## views/blog/search

```php

<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>
 <!-- Start -->
<section class="product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="feature_header text-center">
          <h2 class="feature_title"><?= $title;?></h2>

          <div class="divider"></div>
        </div>
      </div>  <!-- Col-md-12 End -->
```

## Если поиск прошел успешно
```php      
      <div class="items">
    
        <?php if ($success == true) :?>
          <h3><?= $num_rows;?></h3>
          <ul>
            <?php foreach($posts as $singleItem): ?>
              <li>
                <h3><?php echo $singleItem['title']?></h3>
                  <p><?php echo $singleItem['formated_date'];?></p>
                  <a href="/blog/<?php echo $singleItem['id']; ?>">Read More</a>
              </li>
            <?php endforeach; ?>
          </ul> 
```
## Если возникли ошибки
```php

        <?php else : ?>
          <ul>
            <?php foreach($errors as $error): ?>
              <li>
                <?php echo $error;?>
              </li>
            <?php endforeach; ?>
          </ul> 
        <?php endif;?>
      </div>
    </div>
  </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>
<?php require_once VIEWS.'shared/footer.php';

```

## Breadcrumb «хлебные крошки» на сайте

«Хлебными крошками» в компьютерном мире является совокупность ссылок на разделы сайта, каталоги файловых систем и прочие сущности, к которым относится итоговый файл или страница сайта.

Чаще всего под хлебными крошками понимают навигацию для пользователя, чтобы он понимал в каком разделе сайта он находится, а также для быстрого перехода по уровням меню.

## breadcrumb PHP class

```php

<?php
class Breadcrumb
{
    private $_breadcrumb; // содержит HTML-код

    private $_separator = ' / '; // разделитель HTML между breadcrumb

    private $_domain = DOMAIN; // ссылки указывают на на веб-сайт

    // здесь создаем хлебную крошку

    public function build($array)
    {
        $breadcrumbs = array_merge(array('Home' => ''), $array);

        $count = 0;

        foreach ($breadcrumbs as $title => $link) {
            $this->_breadcrumb .= '
            <span itemscope="" itemtype="">
                <a href="'.$this->_domain. '/'.$link.'" itemprop="url">
                <span itemprop="title">'.$title.'</span>
                </a>
            </span>';

            $count++;

            if ($count !== count($breadcrumbs)) {
                $this->_breadcrumb .= $this->_separator;
            }
        }
        return $this->_breadcrumb;
    }
}

```

## Генерация breadcrumb 

Мы будем использовать ассоциативные массивы для передачи значений в формате ключ => заголовок при генерации breadcrumb: 

```php
array ('title' => 'link');
```
## передача двух страниц:
```php
array ('Title 1' => 'page-1.html', 'Title 2' => 'page-2.html') // 
```

## добавим домашнюю страницу как первій элемент breadcrumb. 
```php
   $breadcrumbs = array_merge(array('Home' => ''), $array);
```
Это всегда будет первым элементом breadcrumb, добавим этот элемент в начало нашего массива с помощью array_merge. 

Устанавливаем переменную $_domain, которая содержит нашу основную ссылку на домен.
```php

define('DOMAIN', 'http://localhost:8000');

private $_domain = DOMAIN; // ссылки указывают на на веб-сайт

```
## breadcrumb HTML loop

Помещаем ключ $title в качестве заголовка breadcrumb, а значение $link в качестве ссылки breadcrumb.
Генерируем HTML, присваиваем его переменной breadcrumb.

```php
     
     $count = 0;

        foreach ($breadcrumbs as $title => $link) {
            $this->_breadcrumb .= '
            <span itemscope="" itemtype="">
                <a href="'.$this->_domain. '/'.$link.'" itemprop="url">
                <span itemprop="title">'.$title.'</span>
                </a>
            </span>';

            $count++;
            
            // используя $this->_breadcrumb, проверяем, не является ли это последним сегментом, если последний, вставляем разделитель.

            if ($count !== count($breadcrumbs)) {
                $this->_breadcrumb .= $this->_separator;
            }
        }

```

## Создание breadcrumbs

### index
```php

    public function index()
    {
        $posts = Post::index();
        $data['title'] = 'Blog Page ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['posts'] = $posts;

    
        $data['breadcrumb'] = $this->_breadcrumb->build(
            array(
                'All Posts' => 'blog',
            )
        );
    
        $this->_view->render('blog/index', $data);
    }

```
### view

```php
    public function view($vars)
	{
		extract($vars);
		$post = Post::show($id);
        $data['title'] = 'Blog Post ';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['post'] = $post;

        $data['breadcrumb'] = $this->_breadcrumb->build(
            array(
                'All Posts' => 'blog',
                $post['title'] => 'blog/'.$post['id']
            )
        );

		$this->_view->render('blog/show', $data);
    }

```

### views

```html

<div class="row">
  <div class="col-md-12">
    <div class="breadcrumb"><?= $breadcrumb;?></div>
      <div class="feature_header text-center">
        <h3 class="feature_title"><?=$title;?></h3>

        <h4 class="feature_sub"><?=$subtitle;?></h4>

        <div class="divider"></div>

```
## class Controller

```php

class Controller {


    protected $_view;

    protected $_breadcrumb;
    
    function __construct()
    {
        $this->_view = new View();

        $this->_breadcrumb = new Breadcrumb();
    }


```

