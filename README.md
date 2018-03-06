# shopping-cart


```sql
CREATE TABLE `pictures` (
  `id` int(10) NOT NULL auto_increment,
  `filename` varchar(50) NOT NULL,
  `resource` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY  (`id`)
);
```

# Загрузка файлов на сервер

Загрузка файлов методом POST позволяет загружать как текстовые, так и бинарные файлы. 
PHP способен получать загруженные файлы из любого браузера, совместимого со стандартом RFC-1867.

## Форма для загрузки файлов
```html
<!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
<form enctype="multipart/form-data" action="__URL__" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

 <!-- __URL__ необходимо заменить ссылкой на PHP-скрипт. -->

```
## Скрытое поле MAX_FILE_SIZE
Скрытое поле MAX_FILE_SIZE (значение необходимо указывать в байтах) должно предшествовать полю для выбора файла, и его значение является максимально допустимым размером принимаемого файла в PHP. Рекомендуется всегда использовать эту переменную, так как она предотвращает тревожное ожидание пользователей при передаче огромных файлов, только для того, чтобы узнать, что файл слишком большой и передача фактически не состоялась. 

Обойти это ограничение на стороне браузера достаточно просто, следовательно, вы не должны полагаться на то, что все файлы большего размера будут блокированы при помощи этой возможности. 

Однако настройки PHP (на сервере) максимального размера обойти невозможно.

Поэтому, единственным нормальным способом ограничивать размер файлов, загружаемых на сервер, являются настройки в конфигурационном файле php на сервере. 

Рассмотрим необходимые настройки файла php.ini.

Конфигурационный файл PHP php.ini имеет три параметра, связанные с загрузкой файлов на сервер:
```php

; file_uploads=On - разрешает загрузку файлов на сервер по протоколу HTTP;
; upload_tmp_dir=/tmp - устанавливает каталог для временного хранения загруженных файлов;
; Максимальное время выполнения каждого скрипта в секундах 
max_execution_time = 3000 
; Максимальная количество времени каждый сценарий может потратить разбора запроса данных 
max_input_time = 400
; Максимальный объем памяти, скрипт может потреблять (8 МБ)  
memory_limit = 500M  
; Максимальный размер данных POST, что PHP будет принимать. 
post_max_size = 500M 
; Максимально допустимый размер для загружаемых файлов. 
upload_max_filesize = 200M

upload_max_filesize = 2M
# по умолчанию файлы больше 2Мб загружаться не будут. 
```

Установить максимальное количество загружаемых на сервер файлов мы можем с помощью специальной функции ini_set(). 

```php
ini_set('max_file_uploads','5'); 
# за один раз никто не сможет загрузить на сервер более 5 файлов.

```

## Multipart-формы

Загрузка файла на сервер осуществляется с помощью multipart-формы, в которой есть поле загрузки файла. 

В качестве параметра enctype указывается значение multipart/form-data:

```html
<form action=upload.php method=post enctype=multipart/form-data>
<!-- Multipart-формы обычно используют метод передачи POST.  -->
<input type=file name=uploadfile> <!-- Поле выбора файла для закачки -->
<input type=submit value=Загрузить></form>
```

## Обработка multipart-форм

По умолчанию принятые файлы сохраняются на сервере в стандартной временной папке до тех пор, пока не будет задана другая директория при помощи директивы upload_tmp_dir конфигурационного файла php.ini. 

Директорию сервера по умолчанию можно сменить, установив переменную TMPDIR для окружения, в котором выполняется PHP. Установка этой переменной при помощи функции putenv() внутри PHP-скрипта работать не будет. Эта переменная окружения также может использоваться для того, чтобы удостовериться, что другие операции также работают с принятыми файлами.

Получив файл, PHP сохраняет его во временном каталоге upload_tmp_dir, имя файла выбирается случайным образом. 

Затем PHP создает четыре переменных суперглобального массива $_FILES. 

## Глобальный массив $_FILES
Глобальный массив $_FILES содержит всю информацию о загруженных файлах. 

```php

$_FILES['userfile']['name']
    Оригинальное имя файла на компьютере клиента.

$_FILES['userfile']['type']
    Mime-тип файла, в случае, если браузер предоставил такую информацию. В качестве примера можно привести "image/gif". Этот mime-тип не проверяется на стороне PHP, так что не полагайтесь на его значение без проверки.

$_FILES['userfile']['size']
    Размер в байтах принятого файла.

$_FILES['userfile']['tmp_name']
    Временное имя, с которым принятый файл был сохранен на сервере.

$_FILES['userfile']['error']
    Код ошибки, которая может возникнуть при загрузке файла.
```

## Проверка загружаемых на сервер файлов

PHP-скрипт, принимающий загруженный файл, должен реализовывать логику, необходимую для определения дальнейших действий над принятым файлом. 

```html
<?php

$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

echo 'Некоторая отладочная информация:';
print_r($_FILES);

print "</pre>";

?>
```
вы можете проверить переменную $_FILES['userfile']['size'], чтобы отсечь слишком большие или слишком маленькие файлы. 

Также вы можете использовать переменную $_FILES['userfile']['type'] для исключения файлов, которые не удовлетворяют критерию касательно типа файла, однако, принимайте во внимание, что это поле полностью контролируется клиентом, используйте его только в качестве первой из серии проверок. 

Также вы можете использовать $_FILES['userfile']['error'] и коды ошибок при реализации вашей логики. 

Независимо от того, какую модель поведения вы выбрали, вы должны удалить файл из временной папки или переместить его в другую директорию.

В случае, если при отправке формы файл выбран не был, PHP установит переменную $_FILES['userfile']['size'] значением 0, а переменную $_FILES['userfile']['tmp_name'] - none.

По окончанию работы скрипта, если загруженный файл не был переименован или перемещен, он будет автоматически удален из временной папки.

Это означает, что мы должны его скопировать в другое место до завершения работы скрипта. То есть алгоритм работы сценария загрузки файла на сервер такой:

Если кнопка "Submit" нажата, то файл будет загружен на сервер и его имя будут в переменной $_FILES['uploadfile']['name']. 

В этом случае скрипт должен сразу скопировать файл с именем $_FILES['uploadfile']['tmp_name'] в какой-нибудь каталог (необходимы права на запись в этот каталог).

## форма:

```html
 <form class="form-horizontal" role="form" method="POST"  id="idForm" enctype="multipart/form-data">

    <div class="form-group" id="drop-area">
        <label for="image" class="col-sm-2 control-label">Picture</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="fileElem" multiple accept="image/*" name="image"> 
            <p>Drop Picture Here</p>
        </div>
    </div>
```

## самый простой php-обработчик:

```php
<?php
if (isset($_FILES['image'])) // если была произведена отправка формы
{
  // копируем файл из временной директории
  copy($_FILES['image']['tmp_name'], $_FILES['image']['name']);
  echo 'Файл успешно загружен';
}

```
## copy — Копирует файл

Копирует файл source в файл с именем dest.
```
bool copy ( string $source , string $dest [, resource $context ] )
```
Копирование файла производится функцией copy():

Используйте только функцию копирования copy(), а не перемещения, поскольку:

- Временный файл будет удален автоматически;
- Если временный каталог находится на другом носителе, будет выведено сообщение об ошибке.

Если вы хотите переименовать файл, используйте функцию rename().

## Обработаем ситуации
- пользователь может просто не выбрать файл на форме. В итоге функция copy() попытается скопировать из временной директории файл, которого нет, что приведёт к ошибке.

- пользователь может выбрать фотографию, которая весит, допустим, мегабайт 20. 

```php
// если была произведена отправка формы
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type= $_FILES['image']['type'];

    // если имя файла пустое 
    if ($file_name == '') {
        $errors[] = 'File name must have name';
    } elseif ($file_size > 2097152) {
        // если размер файла превышает 2 Мб
        $errors[] = 'File size must be excately 2 MB';
        } 
               
    if (empty($errors)==true) {
        // копируем файл из временной директории
        copy($file_tmp, "media/".$file_name);
        $options['filename'] = $file_name;
    } else {
        print_r($errors);
    }
}
```


## Проверка расширения загружаемого файла

```php

$file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
  
$expensions= array("jpeg","jpg","png");

// если имя файла пустое 
if ($file_name == '') {
    $errors[] = 'File name must have name';
} elseif ($file_size > 2097152) {
    // если размер файла превышает 2 Мб
    $errors[] = 'File size must be excately 2 MB';
    } elseif (in_array($file_ext, $expensions)=== false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }
                
```

## Проверяем тип файла

Тип файла укажем в виде массива:
```php
$types = array('image/png', 'image/jpeg');
```
Функция in_array проверяет присутствие значения в массиве.

```php
// Проверяем тип файла

elseif (!in_array($file_type, $types)){
    $errors[] = 'Запрещённый тип файла';
}

```


## move_uploaded_file

move_uploaded_file — Перемещает загруженный файл в новое место

```
bool move_uploaded_file ( string $filename , string $destination )
```

Эта функция проверяет, является ли файл filename загруженным на сервер (переданным по протоколу HTTP POST). Если файл действительно загружен на сервер, он будет перемещён в место, указанное в аргументе destination.


## pathinfo

pathinfo() возвращает информацию о path в виде ассоциативного массива или строки, в зависимости от options.

### Список параметров

- path - Анализируемый путь.
- options - Если указан, то задает, какой из элементов пути будет возвращен: PATHINFO_DIRNAME, PATHINFO_BASENAME, PATHINFO_EXTENSION и PATHINFO_FILENAME. 

```php

 if (empty($errors)) {
                
    $type = pathinfo($_FILES['image']['name']);
                    
    $name = uniqid('files_') .'.'. $type['extension'];
    // копируем файл из временной директории
    // copy($file_tmp, "media/".$name);
    move_uploaded_file($file_tmp, "media/".$name);
                      
    $options['filename'] = $name;
 }
```
## class GalleryController

```php

public function create() 
    {
        if (isset($_POST) and !empty($_POST)) {
            $options['title'] = trim(strip_tags($_POST['title']));
            $options['description'] = trim($_POST['description']);
            
            $options['resource'] = $this->_resource;
            
            // если была произведена отправка формы
            if (isset($_FILES['image'])) {
                
                //Каталог загрузки картинок
                $uploadDir = 'media';
                
                //Вывод ошибок
                $errors = array();
                
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];

                // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
                $type = pathinfo($_FILES['image']['name']);
                $file_ext = strtolower($type['extension']);

                $expensions= array("jpeg","jpg","png",'gif');
                //Определяем типы файлов для загрузки
                $fileTypes = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );

                //Проверяем пустые данные или нет
                if (empty($_FILES)) {
                    $errors[] = 'File name must have name';
                } elseif ($_FILES['image']['error'] > 0) {
                    // Проверяем на ошибки
                    $errors[] = $_FILES['image']['error'];
                } elseif ($file_size > 2097152) {
                    // если размер файла превышает 2 Мб
                    $errors[] = 'File size must be excately 2 MB';
                } elseif (in_array($file_ext, $expensions)=== false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                } elseif (!in_array($file_type, $fileTypes)) {
                    // Проверяем тип файла
                    $errors[] = 'Запрещённый тип файла';
                }
                
                if (empty($errors)) {
                
                    $type = pathinfo($_FILES['image']['name']);
                    
                    $name = uniqid('files_') .'.'. $type['extension'];
                    // копируем файл из временной директории
                    // copy($file_tmp, "media/".$name);
                    move_uploaded_file($file_tmp, "media/".$name);
                      
                    $options['filename'] = $name;
                } else {
                    print_r($errors);
                }
            }
  
            Picture::store($options);
        
            $this->redirect('/admin/gallery');
        
        }
        $data['title'] = 'Admin Add Picture ';

        $this->_view->render('admin/gallery/create', $data);

    }
```



## unlink

unlink — Удаляет файл

```
bool unlink ( string $filename [, resource $context ] )
```
Удаляет файл filename. Функция похожа на функцию unlink() Unix в C. При неудачном выполнении будет вызвана ошибка уровня E_WARNING.


Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки.

## Пример простого использования unlink()
```php
<?php
$fh = fopen('test.html', 'a');
fwrite($fh, '<h1>Привет, мир!</h1>');
fclose($fh);

unlink('test.html');
?>
```

## class GalleryController

```php

public function delete($vars) 
    {
        extract($vars);
        
        $picture = Picture::getPictureById($id);

        if (isset($_POST['submit'])) {
            
            unlink('media/'.$picture['filename']);            

            Picture::destroy($id);
            $this->redirect('/admin/gallery');
            
        } elseif (isset($_POST['reset'])) {
            $this->redirect('/admin/gallery');            
        }

        $data['title'] = 'Admin Delete Picture ';
        $data['picture'] = $picture;
        $this->_view->render('admin/gallery/delete', $data);
    
    }
```