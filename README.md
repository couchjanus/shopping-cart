# shopping-cart

## Установка шаблонизатора Твиг

Рекомендованный способ установки Twig через Composer:

```bash
composer require twig/twig:1.*
```

## Основы использования API

Для начала работы c API достаточно подключить класс Twig_Autoloader:

```php
require_once '/path/to/vendor/autoload.php';

$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);

echo $twig->render('Hello {{ name }}!', array('name' => 'Fabien'));
```

## Установка шаблонизатора Твиг из tarball

Download the tarball from https://github.com/twigphp/Twig/tags

Необходимо вызвать метод register() у класса автозагрузки

```php
require_once realpath(__DIR__).'/./autoload.php';
// Регистрируем автозагрузчик
spl_autoload_register("autoloadsystem");

// Регистрируем twig

require_once realpath(__DIR__).'/../Twig/Autoloader.php';
Twig_Autoloader::register();

```
Twig использует загрузчик (Twig_Loader_String), чтобы найти шаблоны, и контекст (Twig_Environment) для хранения данных. 

## метод render()
render() (метод) загружает шаблон, переданный в качестве первого аргумента и контекст (данные), передаваемые в качестве второго аргумента. 

Шаблоны хранится в файловой системе, в Twig также есть файловый загрузчик:

```php
class Controller
{

    protected $_view;

    protected $_breadcrumb;
    protected $_twig;
    private $_loader;

    function __construct()
    {
        $this->_view = new View();
        $this->_breadcrumb = new Breadcrumb();

        // Specify our Twig templates location
        $this->_loader = new Twig_Loader_Filesystem(ROOT.'/templates');

        // Instantiate our Twig
        $this->_twig = new Twig_Environment($this->_loader);

    }

```

## Разработка шаблонов

Шаблон - это просто текстовый файл. Он может генерировать любой текстовый формат (HTML, XML, CSV, Latex, и т.д.). Он не обязан иметь особого расширения, .html, или .xml расширения подойдут.

Шаблон содержит переменные или выражения, которые будут заменяться значениями, когда шаблон вычисляется, и теги, которые контролируют логику шаблона.

## Минимальный шаблон:

```html
My Webpage

    {% for item in navigation %}
    {{ item.caption }}
    {% endfor %}

My Webpage

{{ a_variable }}

```
Есть два вида разделителей: {% ... %} И {{ ... }}. Первый из них используется для выполнения операторов, таких как for-циклы, последний печатает результат выражения в шаблон.

## Интеграция со средами разработки.

Многие среды разработки поддерживают подсветку синтаксиса и автодополнение для TWIG.

- Textmate с помощью Twig bundle
- Vim с помощью Jinja syntax plugin или vim-twig plugin
- Netbeans с помощью Twig syntax plugin (до версии 7.1, нативно , начиная с версии 7.2)
- PhpStorm (нативно , начиная с версии 2.1)
- Eclipse с помощью Twig plugin
- Sublime Text с помощью Twig bundle https://github.com/Anomareh/PHP-Twig.tmbundle
- GtkSourceView с помощью Twig language definition (используется в gedit и других проектах)
- Coda иSubEthaEdit с помощью Twig syntax mode
- Coda 2 с помощью other Twig syntax mode
- Komodo и Komodo Edit с помощью Twig highlight/syntax check mode
- Notepad++ с помощью Notepad++ Twig Highlighter https://github.com/Banane9/notepadplusplus-twig
- Emacs с помощью web-mode.el

## Переменные

Приложение передает переменные, с которыми вы можете работать в шаблоне. Переменные могут иметь атрибуты или элементы, к которым вы можете иметь доступ. Как выглядит переменная определяется приложением, которое ее предоставило. Вы можете использовать точку (.) чтобы получить доступ к аттрибутам переменной (методы или свойства PHP-объекта или элементы PHP-массива), или так называемый индекс ([]):

```php
{{ foo.bar }}
{{ foo['bar'] }}
```
Когда аттрибут содержит специальные символы, используйте функцию attribute вместо доступа к аттрибуту переменной.

```php
{# equivalent to the non-working foo.data-foo #}
{{ attribute(foo, 'data-foo') }}
```

## Глобальные переменные

Следующие переменные всегда доступны в шаблонах:

```php
    _self: ссылается на текущий шаблон;
    _context: ссылается на текущий контекст;
    _charset: ссылается на текущую кодировку.
```

## Присвоение переменных

Вы можете придать значения переменных внутри блоков кода. Присвоения используют тег set :

```php
{% set foo = 'foo' %}

{% set list = ['foo', 'baz', 'bar'] %}

{{ list[2] }}

{% set foo = {'foo': 'bar'} %}

```

## class ContactController

```php

<?php

class ContactController extends Controller
{
    public function index()
    {
        $title = "Contact Page";
        // Render our view
        echo $this->_twig->render('contact/index.html', ['title' => $title] );

    }
}

```

## Включение других шаблонов

Тэг include используется для включения шаблона и включению использованного контента к текущему:

```php
{% include 'sidebar.html' %}
```
По умолчанию включенные шаблоны передаются в текущий контекст.

Вы можете включить шаблоны в ниже лежащих директориях используя знак слэша:

```php
{% include "sections/articles/sidebar.html" %}

```


## layouts/app.html

```html

        {% include 'layouts/sections/_styles.html' %}
        {% include 'layouts/sections/_navigation.html' %}
        {% include 'layouts/sections/_footer.html' %}
        {% include 'layouts/sections/_scripts.html' %}

```

## Наследование шаблонов

Наиболее мощное средство Twig это наследование шаблонов. Оно позволяет вам построить базовый “скелет” шаблона,который содержит все общие элементы вашего сайта и определяет блоки, которые дочерние шаблоны могут замещать.

Давайте определим базовый шаблон, app.html, который определяет простой HTML скелетный документ, который вы можете использовать для простой страницы:

```html

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="icon" href="/favicon.ico">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Shopaholic Layout App</title>
        <!-- CSS -->
        {% include 'layouts/sections/_styles.html' %}
    </head>

 <body data-spy="scroll" data-target=".navbar-fixed-top">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        {% include 'layouts/sections/_navigation.html' %}
        {% block content %}
        {% endblock %}

        {% include 'layouts/sections/_footer.html' %}

        {% include 'layouts/sections/_scripts.html' %}

    </body>
</html>

```
## Шаблон-ребенок может выглядеть так:

```html
{% extends "layouts/app.html" %}

{% block content %}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="feature_header text-center">
                <h3 class="feature_title">{{ title }}</h3>
                <h4 class="feature_sub">Hello There</h4>
                <div class="divider"></div>
            </div>
        </div>  <!-- Col-md-12 End -->
    </div>
</div> <!-- Conatiner product end -->

{% endblock %}

```
## Тег extends
Тег extends говорит механизму шаблонов, что этот шаблон “расширяет” другой шаблон. Когда система шаблонов вычисляет этот шаблон, сначала он ищет родителя. Тег extends должен быть первым тегом в шаблоне. 

## Комментарии

Чтобы закомментировать часть строки шаблона, используйте комментарий {# ... #}. Это полезно для отладки или для добавления информации для других разработчиков или для себя:

```php
{# note: disabled template because we no longer use this
    {% for user in users %}
        ...
    {% endfor %}
#}
```

## Фильтры

Переменные могут быть изменены с помощью фильтров filters. Фильтры отделяются от переменных с помощью pipe-символа (|) и могут иметь дополнительные аргументы в скобках. Можно объединять несколько фильтров. Выход одного фильтра направляется в следующий.

## class ContactController
```php
    public function index()
    {
        $title = "Contact <strong>Page</strong>";
        // Render our view
        echo $this->_twig->render('contact/index.html', ['title' => $title] );

    }

```
Следующий пример удаляет все HTML-теги из title:

## templates/contact/index

```php
{{ title|striptags }}
```

Фильтры, которые принимают аргументы, имеют круглые скобки вокруг аргументов.

```php
{{ random(['apple', 'orange', 'citrus']) }} {# врнет 'orange' #}
{{ random('ABC') }}                         {# вернет: C #}
{{ random() }}                              {# вернет: 15386094 (работает как PHP функция mt_rand) #}
{{ random(5) }}                             {# вернет: 3 #}
```

Чтобы применить фильтр для секции в коде, оберните его с тегом filter:

```php
{% filter upper %}
    This text becomes uppercase
{% endfilter %}
```

## Функции

Можно вызывать функции чтобы генерировать контент. Функции могут быть вызваны по имени со скобками после него и могут иметь аргументы.

Например, функция range возвращает список, содержащий арифметическую прогрессию целых чисел:
```php
{% for i in range(0, 3) %}
    {{ i }},
{% endfor %}
```

## Именованные аргументы

```php
{% for i in range(low=1, high=10, step=2) %}
    {{ i }},
{% endfor %}
```

Использование именованных аргументов помогает понять значение переменных, которые вы передаете как аргументы.

Именованные аргументы также позволяют пропустить некоторые аргументы, для которых вы не хотите изменять значение по умолчанию:

```php
{# the first argument is the date format, which defaults to the global date format if null is passed #}
{{ "now"|date(null, "Europe/Paris") }}

{# or skip the format value by using a named argument for the timezone #}
{{ "now"|date(timezone="Europe/Paris") }}
```
Вы также можете использовать позиционные и именованные аргументы в одном вызове, и в этом случае позиционные аргументы должны идти впереди именованных аргументов.

```php
{{ "now"|date("d/m/Y H:i", timezone="Europe/Paris") }}

```

## Управляющая структура

Управляющая структура относится к тем вещам, которые управляют программой - условия (i.e. if/elseif/else), for-циклы и блоки. Управляющая структура появляется внутри блоков {% ... %}.

Например, чтобы показать список всех пользователей, которые записаны в переменной users, используйте тег for:

```php 
<h3>Members</h3>
            {% set users = ['foo', 'baz', 'bar'] %}

            {% set users = [
                {'id': 0, 'username': 'Bar'},
                {'id': 1, 'username': 'Foo'},
                {'id': 2, 'username': 'Bax'},
                ]
                %}

            {% for user in users %}
                {{ user.username|e }}
            {% endfor %}

```
## Тег if 

Тег if можно использовать чтобы проверить выражение:

```php
        {% if users|length > 0 %}

                {% for user in users %}
                    {{ user.username|e }}
                {% endfor %}

        {% endif %}
```

## Экранирование HTML

При генерации HTML из шаблонов всегда есть риск, что переменная будет включать символы, которые будут влиять на конечный HTML. Существует два подхода: вручную сохранять каждую переменную или автоматически сохранить все по умолчанию.

Twig поддерживает оба, автоматическое сохранение включено по умолчанию.


## Работа с экранированием вручную

Если сохранение вручную включено, это ваша обязанность сохранить все переменные если это нужно. Что нужно сохранить? Все переменные, которым вы не доверяете.

Сохранение работает, если пропустить переменную через escape или e фильтр:

```php
{{ user.username|e }}
```
По умолчанию, фильтр escape использует html метод, но в зависимости от сохраняемого контекста, вы возможно захотите использовать другие методы:

```php
{{ user.username|e('js') }}
{{ user.username|e('css') }}
{{ user.username|e('url') }}
{{ user.username|e('html_attr') }}
```
## Автоматическое экранирование

Вне зависимости от того, включено ли автоматическое сохранение или нет, вы можете выделить секцию шаблона, которую нужно или не нужно сохранить, используя тег autoescape:

```php
{% autoescape %}
    Everything will be automatically escaped in this block (using the HTML strategy)
{% endautoescape %}
```
По умолчанию, авто-сохранение сохраняет html. Если выводить переменные в других контекстах, нужно явно сохранить их, используя подходящий метод:

```php
{% autoescape 'js' %}
    Everything will be automatically escaped in this block (using the JS strategy)
{% endautoescape %}
```

## Экранирование

Иногда желательно или даже необходимо заставить Twig игнорировать autoescape.

```php

    <h3>{{ title|raw }}</h3>
```


## Выражения

Twig позволяет выражения везде. Такая работа очень похожа на обычный PHP и даже если вы не работаете с PHP, вы почувствуете себя с ним комфортно.

Приоритет операторов выглядит следующим образом, начиная с самых низко-приоритетных операторов:
```
b-and, b-xor, b-or, or, and, ==,!=, <, >, >=, <=, in, matches, starts with, ends with, .., +, -, ~, *, /, //, %, is, **, |, [], and .:

```

```php
    {% set greeting = 'Hello' %}
    {% set name = 'Fabien' %}

    {{ greeting ~ name|lower }}   {# Hello fabien #}

    {# use parenthesis to change precedence #}
    {{ (greeting ~ name)|lower }} {# hello fabien #}
```

## Литеры

Самой простой формой выражений являются литералы. Литералы представлены для таких типов PHP, как строки, числа и массивы. Существуют следующие литералы:


- "Hello World" : Все между двумя двойными или одинарными кавычками является строкой. Они полезны, когда вам нужна строка в шаблоне (например, как аргументы функций,фильтры или для того чтобы просто расширить или включить шаблон). Строка может содержать разделитель, если ему предшествует обратный слеш () -- как в 'It's good'
- 42 / 42,23: Целые числа и числа с плавающей точкой создаются написанием чисел . Если точка есть в числе то это float, в противном случае integer.
- ["foo", "bar"]: Массивы определяются последовательностью выражений, разделенных запятыми (,) и окруженных квадратными скобками ([]).
- {"foo": "bar"}: Хэши определяется списком ключей и значений, разделенных запятыми (,) и взятых в фигурные скобки ({}):

```php
    {# keys as string #}
    { 'foo': 'foo', 'bar': 'bar' }

    {# keys as names (equivalent to the previous hash) -- as of Twig 1.5 #}
    { foo: 'foo', bar: 'bar' }

    {# keys as integer #}
    { 2: 'foo', 4: 'bar' }

    {# keys as expressions (the expression must be enclosed into parentheses) -- as of Twig 1.5 #}
    { (1 + 1): 'foo', (a ~ 'b'): 'bar' }	
```
- true/false: true представляет истинное значение, false представляет ложное значение.
- null: null не представляет никакого определенного значения. Это значение возвращается, когда переменной не существует. none является синонимом null.

Массивы и хэши могут быть вложенными:

```
{% set foo = [1, {"foo": "bar"}] %}
```
Использование двойных кавычек или одиночных кавычек не имеет никакого ьвлияния на производительность, но строки интерполяции поддерживается только для строк в двойных кавычках.

## Логика

Вы можете объединить несколько выражений со следующими операторами:

- and: Возвращает истину, если левый и правый операнды оба истинны.
- or: Возвращает истину, если левый или правый операнд истинны.
- not: Отрицает выражение.
- (expr): Свертывает выражение.

Twig также поддерживает побитовые операторы (b-and, b-xor, and b-or).

## Сравнения

Следующие операторы сравнения поддерживаются в любом выражении:
```
 ==, !=, <,>,> = и <=.
```
Вы также можете проверить, если строка начинается или заканчивается другой строкой:

```php
            <h3>Сравнения</h3>

            {% if 'Fabien' starts with 'F' %}
            <H4>starts Fabien</H4>
            
            {% endif %}

            {% if 'Fabien' ends with 'n' %}
            <H4>ends Fabien</H4>
            {% endif %}

```

Для сложных сравнений строк, оператор matches позволяет вам использовать regular expressions:

```php
    {% if phone matches '{^[d.]+$}' %}
    {% endif %}
```
## Оператор содержания

Оператор in осуществляет проверку содержания.

Он возвращает true если левый операнд содержится в правом:
```php
{# returns true #}

{{ 1 in [1, 2, 3] }}

{{ 'cd' in 'abcde' }}
```
Вы можете использовать этот фильтр, чтобы выполнить проверку на содержание со строками, массивами или объектами, осуществляющих Traversable интерфейс.

Чтобы выполнить проверку на то, что левый операнд не содержится в правом, нужно использовать not in оператор.

```php
{% if 1 not in [1, 2, 3] %}

{# is equivalent to #}
{% if not (1 in [1, 2, 3]) %}
```

## Управление пробелами

Первый символ новой строки после тэга удаляется автоматически (как в PHP.) Пробелы в дальнейшем не изменили механизма шаблонов, так что каждый пробел (пробелы, табуляции, новые строки и т.д.) возвращаются без изменений.

Используйте теги spaceless чтобы удалить пробелы между HTML-тегами:

```php
{% spaceless %}
    

foo bar

{% endspaceless %} {# output will be

foo bar

#}
```
В дополнение к тегам без пробелов, вы также можете управлять пробелами на уровне тегов. Используя модификатор управления пробелами для ваших тегов, вы можете убирать начальные или конечные пробелы:

```php
{% set value = 'no spaces' %}
{#- No leading/trailing whitespace -#}
{%- if true -%}
    {{- value -}}
{%- endif -%}

{# output 'no spaces' #}
```
Приведенный пример показывает управление модификатором пробелов по умолчанию и то, как вы можете использовать его для удаления пробелов вокруг тегов. Обрезание пространства удалит все пробелы для одной стороны тега. Возможно использовать обрезание пробелов с одной стороны тега:

```php
{% set value = 'no spaces' %}

    {{- value }}
    {# outputs '
    no spaces
    ' #}
```