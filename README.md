# shopping-cart

# CRUD-приложения

CRUD - Create, read, update and delete (Создание чтение обновление удаление).

## Синтаксис оператора DELETE

```sql
DELETE [LOW_PRIORITY | QUICK] FROM table_name
       [WHERE where_definition]
       [ORDER BY ...]
       [LIMIT rows]

```
или

```sql

DELETE [LOW_PRIORITY | QUICK] table_name[.*] [,table_name[.*] ...]
       FROM table-references
       [WHERE where_definition]
```
или

```sql
DELETE [LOW_PRIORITY | QUICK]
       FROM table_name[.*], [table_name[.*] ...]
       USING table-references
       [WHERE where_definition]
```

Оператор DELETE удаляет из таблицы table_name строки, удовлетворяющие заданным в where_definition условиям, и возвращает число удаленных записей.

Если оператор DELETE запускается без определения WHERE, то удаляются все строки. При работе в режиме AUTOCOMMIT это будет аналогично использованию оператора TRUNCATE. 

Если действительно необходимо знать число удаленных записей при удалении всех строк, и если допустимы потери в скорости, то можно использовать команду DELETE в следующей форме:

```sql
mysql> DELETE FROM table_name WHERE 1>0;

```
Следует учитывать, что эта форма работает намного медленнее, чем DELETE FROM table_name без выражения WHERE, поскольку строки удаляются поочередно по одной.

Если указано ключевое слово LOW_PRIORITY, выполнение данной команды DELETE будет задержано до тех пор, пока другие клиенты не завершат чтение этой таблицы.

Если задан параметр QUICK, то обработчик таблицы при выполнении удаления не будет объединять индексы - в некоторых случаях это может ускорить данную операцию.

## Выражение ORDER BY

Если применяется выражение ORDER BY, то строки будут удалены в указанном порядке. В действительности это выражение полезно только в сочетании с LIMIT. Например:

```sql
DELETE FROM somelog
        WHERE user = 'jcole'
        ORDER BY timestamp
        LIMIT 1
```
Данный оператор удалит самую старую запись (по timestamp), в которой строка соответствует указанной в выражении WHERE.

Специфическая для MySQL опция LIMIT для команды DELETE указывает серверу максимальное количество строк, которые следует удалить до возврата управления клиенту. Эта опция может использоваться для гарантии того, что данная команда DELETE не потребует слишком много времени для выполнения. Можно просто повторять команду DELETE до тех пор, пока количество удаленных строк меньше, чем величина LIMIT. 

## Синтаксис оператора TRUNCATE

```sql

TRUNCATE TABLE table_name

```

TRUNCATE TABLE имеет следующие отличия от DELETE FROM ...:

- Эта операция удаляет и воссоздает таблицу, что намного быстрее, чем поочередное удаление строк.
- Операция является нетранзакционной; если одновременно выполняется транзакция или активная блокировка таблицы, то можно получить ошибку.
- Не возвращает количество удаленных строк.
- Пока существует корректный файл 'table_name.frm', таблицу можно воссоздать с его с помощью, даже если файлы данных или индексов повреждены. 

TRUNCATE является расширением Oracle SQL. 

### admin/posts/index.php
```php

    <?php foreach ($posts as $post):?>
        <tr>
                             
            <a href="/admin/posts/delete/<?= $post['id']?>">
                <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button>
            </a>
          </td>
        </tr>
    <?php endforeach;?>

```

### routes.php

```php

    $router->get('admin/posts/delete/{id}', 'Admin\blog\PostsController@delete');

    $router->post('admin/posts/delete/{id}', 'Admin\blog\PostsController@delete');

```

## Admin\blog\PostsController

```php
    public function delete($vars) 
    {
        extract($vars);
        
        // Checking if form has been submitted    
        
        if (isset($_POST['submit'])) {
            Post::destroy($this->resource, $id);
            $this->redirect('/admin/posts');
            
        }
        
        // Checking if form has been reseted    

        elseif (isset($_POST['reset'])) {
            $this->redirect('/admin/posts');            
        }

        $data['title'] = 'Admin Delete Post ';
        $data['post'] = Post::getPostById($id);
        $this->_view->render('admin/posts/delete', $data);
    
    }

```

### admin/posts/delete

```php

  <form class="form-horizontal" role="form" method="POST">
    
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-12 control-label"><h2>This Post will be deleted! Are You Sure?</h2></label>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button name="submit" type="submit" class="save btn btn-danger">Delete Post</button>
            <button name="reset" class="save btn btn-info">Cansel</button>
        </div>
    </div>
  </form>

```
## class Post 

```php

    public static function destroy($resource, $id) 
    {
        $con = Connection::make();

        $sql = "DELETE FROM posts WHERE id = :id";
    
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        
        Meta::destroy($resource, $id);
        
        return $res->execute();
    }

```
## class Meta

```php

    public static function destroy($resource, $resourceId) 
    {
        $con = Connection::make();
        $sql = "DELETE FROM metas WHERE (resource_id = :resource_id AND resource = :resource)";
        $res = $con->prepare($sql);
        $res->bindParam(':resource_id', $resourceId, PDO::PARAM_INT);
        $res->bindParam(':resource', $resource, PDO::PARAM_STR);
        return $res->execute();
    }

```

# TinyMCE
TinyMCE (Tiny Moxiecode Content Editor) — платформонезависимый JavaScript HTML WYSIWYG редактор на основе Web. К основным характеристикам программы относятся поддержка тем/шаблонов, языковая поддержка и возможность подключения модулей (плагинов). Используется в различных системах управления содержимым (CMS).

Редактор позволяет вставлять рисунки, таблицы, указывать стили оформления текста, видео.

Заявлена поддержка следующих браузеров:

- Internet Explorer
- Mozilla Firefox
- Opera
- Safari
- Google Chrome

## Quick install

https://www.tinymce.com/

Copy & paste the snippet below into your HTML page.

```html

    <!DOCTYPE html>
    <html>
    <head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    </head>
    <body>
    <textarea>Next, start a free trial!</textarea>
    </body>
    </html>
```

This domain is not registered with TinyMCE Cloud. Start a free trial to discover our premium cloud services and pro support.
https://store.ephox.com/signup/


## Установка редактора TinyMCE 

1. Скачиваем пакет редактора TinyMCE с сайта https://www.tinymce.com/download/.

2. Распаковываем пакет в папку на вашем сайте. Пусть это будет /public/vendor/tiny_mce. Именно в этой папке должен оказаться файл tiny_mce.js.

3. Пакет редактора можно привязать к тегу textarea или div. 

Простейший html или php файл будет выглядеть так:

```html

  <head>
    <title>Подключение редактора TinyMCE</title>
    <!-- TinyMCE -->

    <script type="text/javascript" src="/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
			tinymce.init({
				selector : "textarea",
				theme : "modern"
			});
    </script>

    <!-- /TinyMCE -->
  </head>

```

Здесь mode:"textarea" и theme:"modern" - директивы конфигурации. 

## Настройка редактора TinyMCE

- width - директива явно определяет ширину окна редактора. Размерность указывается в пикселях, указывать ее явно не надо.

- height - директива явно определяет высоту окна редактора. Размерность указывается в пикселях, указывать ее явно не надо.

- selector - директива определяет способ подключения редактора к тэгу.

- theme - директива определяет "тему" редактора. Имеется 3 встроенных темы: inlite, mobile и modern. Темы можно создавать самостоятельно.

- skin - определяет оформление вашего редактора. доступно оформление lightgray.

```js
    <script>
			tinymce.init({
				selector: 'textarea',
				theme: 'modern',
				height: 300,
			});

    </script>

```
- plugins - определяет список подключаемых плугинов.

```js
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],

});
```
- toolbar

```js
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',

});
```
- content_css - прикрепляет пользовательский стиль.

```js
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    ]
});
```

## TinyMCE на Ukrane

TinyMCE большой визуальный wysiwyg редактор, который предоставляет локализованные файлы почти для всех известных языков.

Для начала, нужно скачать дополнительный пакет с языками и скопировать его в каталог редактора TinyMCE.
https://www.tinymce.com/download/language-packages/?ctrl=lang&act=download&pr_id=1


### Вы должны добавить const LANGUAGE:

```php

    define('ROOT', realpath(__DIR__.'/../'));
    define('VIEWS', ROOT.'/views/');
    define('CONTROLLERS', ROOT.'/controllers/');
    define('CONFIG', ROOT.'/config/');
    define('MODELS', ROOT.'/models/');

    define('CORE', ROOT.'/core/');
    define('DB', ROOT.'/db/');
    define('EXT', '.php');
    define('APPNAME', 'Great Shopaholic');
    define('SLOGAN', 'Lets Build Cool Site');

    define('LANGUAGE', 'uk');

```

Нам нужно импортировать нашу const LANGUAGE в наш JS код:

```js
<script>

var cur_lang = "<?= LANGUAGE; ?>"; // не забывайте двойные кавычки

tinyMCE.init({
...

```

Дальше, мы добавим параметры языка:

```js
<script>

    var cur_lang = "<?= LANGUAGE; ?>";

	tinymce.init({
		selector: 'textarea',
	    theme: 'modern',
		height: 300,
				
		language : cur_lang, // Здесь добавлен параметр языка, значение которого соответствует языку сайта

		plugins: 'image media table link paste contextmenu textpattern autolink codesample',
				
		insert_toolbar: 'quickimage quicktable media codesample',
		selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
			
		paste_data_images: true,
		content_css: [
			'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		]
	});

```

После этого, интерфейс вашего редактора TinyMCE будет отображаться на языке вашего веб-сайта или веб-приложения. 

## Image Upload

## plugins/filemanager

```php

//**********************
//Path configuration
//**********************
// In this configuration the folder tree is
// root
//   |- tinymce
//   |    |- source <- upload folder
//   |    |- js
//   |    |   |- tinymce
//   |    |   |    |- plugins
//   |    |   |    |-   |- filemanager
//   |    |   |    |-   |-      |- thumbs <- folder of thumbs [must have the write permission]

$base_url=""; //url base of site if you want only relative url leave empty

$upload_dir = '/media/'; // path from base_url to upload base dir
$current_path = '../../../../media'; // relative path from filemanager folder to upload files folder

$MaxSizeUpload=100; //Mb
```
## admin/header.php

```php

<script src="/js/tinymce/tinymce.min.js"></script>

    <script>

			tinymce.init({
					selector: "textarea", theme: "modern", height: 300,
					plugins: [
							"advlist autolink link image lists charmap print preview hr anchor pagebreak",
							"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
							"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
				],
				toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
				toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
				image_advtab: true ,

				external_filemanager_path:"/filemanager/",
				filemanager_title:"Responsive Filemanager" ,
				external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
			});

```
