# shopping-cart 

## Table of Contents

- [Асинхронный JavaScript и XML](#Асинхронный-JavaScript-и-XML)

  - [Как послать HTTP запрос](#Как-послать-HTTP-запрос)
  - [Создание объекта XMLHttpRequest](#Создание-объекта-XMLHttpRequest)

- [Свойства объекта XMLHttpRequest](#Свойства-объекта-XMLHttpRequest)
  - [Обрабатываем ответ сервера](#Обрабатываем-ответ-сервера)

- [Методы объекта XMLHttpRequest](#Методы-объекта-XMLHttpRequest)


# Safari, in Private Browsing Mode

```js
  $(function() {

    // Safari, in Private Browsing Mode, looks like it supports localStorage but all calls to setItem
    // throw QuotaExceededError. We're going to detect this and just silently drop any calls to setItem
    // to avoid the entire page breaking, without having to do a check at each usage of Storage.
    if (typeof localStorage === 'object') {
        try {
            localStorage.setItem('localStorage', 1);
            localStorage.removeItem('localStorage');
        } catch (e) {
            Storage.prototype._setItem = Storage.prototype.setItem;
            Storage.prototype.setItem = function() {};
            alert('Your web browser does not support storing settings locally. In Safari, the most common cause of this is using "Private Browsing Mode". Some settings may not save or some features may not work properly for you.');
        }
    }
    
    if (localStorage.shoppingCart){

      shoppingCart = JSON.parse(localStorage.shoppingCart);
    
    }
```
## Total

```js

  function updateTotal() {
      var quantities = 0,
      total = 0,
      
      $cartTotal = $('#cart_total span'),
      items = $('.cart-items').children();

      items.each(function (index, item) {
          var $item = $(item);
          total += parseFloat($item.find('.item-prices').text());
      });

      $cartTotal.text('$' + parseFloat(Math.round(total * 100) / 100).toFixed(2));

      if (total === 0 ){
        
        $('.shopping-cart').fadeOut(500, function() {
                $(this).css({
                    'backgroundColor':'',
                    'borderRadius': '0%',
                    'transform': 'scale(1, 1)'
                    });
            });
      
        $('.shopping-cart').fadeIn(500);        
      }
  }

```


# Асинхронный JavaScript и XML

AJAX, Ajax (Asynchronous Javascript and XML — «асинхронный JavaScript и XML») — подход к построению интерактивных пользовательских интерфейсов веб-приложений, заключающийся в «фоновом» обмене данными браузера с веб-сервером. 

В основе технологии лежит использование нестандартного объекта XMLHttpRequest, необходимого для взаимодействия со скриптами на стороне сервера. 

Объект может как отправлять, так и получать информацию в различных форматах включая XML, HTML и даже текстовые файлы. Самое привлекательное в Ajax — это его асинхронный принцип работы. С помощью этой технологии можно осуществлять взаимодействие с сервером без необходимости перезагрузки страницы. Это позволяет обновлять содержимое страницы частично, в зависимости от действий пользователя.


## Как послать HTTP запрос

Для того, чтобы послать HTTP запрос на сервер используя JavaScript, вам необходим экземпляр класса, который позволит это сделать. Такой класс впервые был введен в Internet Explorer как объект ActiveX, называемый XMLHTTP. Позже в Mozilla, Safari и другие броузеры был введен класс XMLHttpRequest, который поддерживал методы и свойства изначального объекта ActiveX от Microsoft.

чтобы создать кросс-броузерный объект требуемого класса:

```js
var httpRequest;
if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    httpRequest = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE
    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
}

```

Некоторые версии некоторых броузеров Mozilla не будут корректно работать, если ответ сервера не содержит заголовка XML mime-type. Чтобы решить эту проблему вы можете использовать вызовы дополнительных методов для переопределения заголовка полученного от сервера, если он отличен от text/xml.

```js
httpRequest = new XMLHttpRequest();
httpRequest.overrideMimeType('text/xml');

```

## Создание объекта XMLHttpRequest

для создания объекта в Gecko-совместимых браузерах, Konqueror`е и Safari, нужно использовать следующее выражение:

```js
var Request = new XMLHttpRequest(); 
```

для Internet Explorer используется следующее:

```js
var Request = new ActiveXObject("Microsoft.XMLHTTP"); 
```
Либо
```js
var Request = new ActiveXObject("Msxml2.XMLHTTP"); 
```

### Создание объекта httpRequest:

```js
    function CreateRequest()
    {
        var httpRequest = false;

        if (window.XMLHttpRequest)
        {
            //Gecko-совместимые браузеры, Safari, Konqueror
            httpRequest = new XMLHttpRequest();
            httpRequest.overrideMimeType('text/xml');
        }
        else if (window.ActiveXObject)
        {
            //Internet explorer
            try
            {
                 httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }    
            catch (CatchException)
            {
                 httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
        }
     
        if (!httpRequest)
        {
            console.log("Невозможно создать XMLHttpRequest");
        }
        
        return httpRequest;
    } 

    //Создаём запрос
    
    var Request = CreateRequest();
    
    //Проверяем существование запроса
    
    if (!Request)
    {
        console.log("Невозможно создать XMLHttpRequest");
    }
    
    console.log("Ура! Мы создали XMLHttpRequest. Что с ним делать?");

```

# Свойства объекта XMLHttpRequest

- onreadystatechange — С помощью этого свойства задаётся обработчик, который вызывается всякий раз при смене статуса объекта.
- readyState — число, обозначающее статус объекта.
- responseText — представление ответа сервера в виде обычного текста (строки).
- responseXML — объект документа, совместимый с DOM, полученного от сервера.
- status — состояние ответа от сервера.
- statusText — текстовое представление состояния ответа от сервера.

## Обрабатываем ответ сервера

после получения ответа сервера необходимо указать объекту, какая JavaScript функция будет обрабатывать ответ. Это делается путем присваивания свойству onreadystatechange имени JavaScript функции, которую вы собираетесь использовать:

```js
httpRequest.onreadystatechange = nameOfTheFunction;
```
после названия функции нет скобок и не указано параметров, потому что вы просто присваиваете ссылку на функцию, а не вызываете ее. К тому же, вместо указания имени функции, вы можете использовать возможность JavaScript объявлять функции на лету (так называемые «анонимные функции») и указывать действия, которые тотчас же будут обрабатывать ответ:

```js
httpRequest.onreadystatechange = function(){
    // какой-нибудь код
};
```
функция должна проверять статус запроса. Если значение переменной статуса 4, то это означает, что ответ от сервера получен и его можно обрабатывать.

```js
if (httpRequest.readyState == 4) {
    // все в порядке, ответ получен
} else {
    // все еще не готово
}
```
## Полный список значений кодов readyState:

- 0 — Объект не инициализирован.
- 1 — Объект загружает данные.
- 2 — Объект загрузил свои данные.
- 3 — Объек не полностью загружен, но может взаимодействовать с пользователем.
- 4 — Объект полностью инициализирован; получен ответ от сервера.


Следующее, что нужно проверить — это статус HTTP-ответа. Все возможные коды можно посмотреть на [сайте W3C](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html). Для наших целей нам интересен только код ответа 200 OK.

```js
if (httpRequest.status == 200) {
    // великолепно!
} else {
    // с запросом возникли проблемы,
    // например, ответ может быть 404 (Не найдено)
    // или 500 (Внутренняя ошибка сервера)
}
```
Теперь, после проверки состояния запроса и статуса HTTP-ответа, вы можете делать с данными, полученными от сервера, все что угодно. Есть два способа получить доступ к данным:

- httpRequest.responseText – возвращает ответ сервера в виде строки текста.
- httpRequest.responseXML – возвращает ответ сервера в виде объекта XMLDocument, который вы можете обходить используя функции JavaScript DOM

опираясь на состояние готовности объекта можно представить посетителю информацию о том, на какой стадии находится процесс обмена данными с сервером и, возможно, оповестить его об этом визуально.

```js
  request.onreadystatechange = function(){
      
      switch (request.readyState) {
        
        case 1: print_console('<div class="alert alert-secondary" role="alert">1: Подготовка к отправке...</div>'); break
        
        case 2: print_console('<div class="alert alert-primary" role="alert">2: Отправлен...</div>'); break
        
        case 3: print_console('<div class="alert alert-warning" role="alert">3: Идет обмен...</div>'); break
        
        case 4:{
        
           if(request.status==200){
              print_console('<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
              document.getElementById("printResult").innerHTML = "<b>"+request.responseText+"</b>";
              }else if(request.status==404){
                print_console('<div class="alert alert-danger" role="alert">Ошибка: запрашиваемый скрипт не найден!</div>');
              }
        
           else {
            print_console('<div class="alert alert-danger" role="alert">Ошибка: сервер вернул статус: '+ request.status +'</div>');
           }
          break
        }
     }
  }

```

# Методы объекта XMLHttpRequest

- abort() — отмена текущего запроса к серверу.
- getAllResponseHeaders() — получить все заголовки ответа от сервера.
- getResponseHeader(«имя_заголовка») — получить указаный заголовок.
- open(«тип_запроса»,«URL»,«асинхронный»,«имя_пользователя»,«пароль») — инициализация запроса к серверу, указание метода запроса. Тип запроса и URL — обязательные параметры. Третий аргумент — булево значение. Обычно всегда указывается true или не указывается вообще (по умолчанию — true). Четвертый и пятый аргументы используются для аутентификации (это очень небезопасно, хранить данные об аутентификации в скрипте, так как скрипт может посмотреть любой пользователь).
- send(«содержимое») — послать HTTP запрос на сервер и получить ответ.
- setRequestHeader(«имя_заголовка»,«значение») — установить значения заголовка запроса.

после того как вы объявили что будет происходить после получения ответа, вам необходимо сделать запрос. Вы должны вызвать методы класса open() и send():

```js
httpRequest.open('GET', 'http://www.example.org/some.file', true);
httpRequest.send(null);
```

Первый параметр вызова функции open() — метод HTTP запроса (GET, POST, HEAD или любой другой метод, который вы хотите использовать). Используйте методы в соответствии с HTTP стандартами, иначе некоторые браузеры (такие как Firefox) могут не обработать запрос. 

Информация о допустимых HTTP запросах доступна по адресу [спецификации W3C](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html)

Второй параметр — URL запрашиваемой страницы. Из соображений безопасности возможность запрашивать страницы сторонних доменов недоступна. Убедитесь, что вы используете одинаковое доменное имя на всех страницах, иначе вы получите ошибку 'доступ запрещен' при вызове функции open().

Третий параметр указывает, является ли запрос асинхронным. Если он TRUE, то выполнение JavaScript продолжится во время ожидания ответа сервера. В этом и заключается асинхронность технологии.

Параметром метода send() могут быть любые данные, которые вы хотите послать на сервер. 

Данные должны быть сформированы в строку запроса:

```
name=value&anothername=othervalue&so=on
```

если вы хотите отправить данные методом POST, вы должны изменить MIME-тип запроса с помощью следующей строки:

```js
httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
```

Иначе сервер проигнорирует данные отправленные методом POST.


## Простой пример 02.html

```html
    <div class="card text-center">
      <div class="card-header">
        Hello, AJAX!
      </div>
      <div class="card-body">
        <h4 class="card-title">Консоль выполнения запроса:</h4>
        <p class="card-text" id="console">Обрабатываем ответ сервера.</p>
        <a href="#" class="btn btn-primary btnGo">Запустить скрипт</a>
      </div>
      <div class="card-footer text-muted" id="printResult">
        ответ сервера
      </div>
    </div>

```

### JS

```js
function CreateRequest()
    {
        var httpRequest = false;

        if (window.XMLHttpRequest)
        {
            //Gecko-совместимые браузеры, Safari, Konqueror
            httpRequest = new XMLHttpRequest();
            httpRequest.overrideMimeType('text/xml');
        }
        else if (window.ActiveXObject)
        {
            //Internet explorer
            try
            {
                 httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }    
            catch (CatchException)
            {
                 httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }
        }
     
        if (!httpRequest)
        {
            console.log("Невозможно создать XMLHttpRequest");
        }
        
        return httpRequest;
    } 
```

Пользователь нажимает на ссылку "Запустить скрипт" в броузере;
Это вызывает функцию CreateRequest();

```js
    document.querySelector('.btnGo').addEventListener('click', function(){

    //Создаём запрос
    
    var request = CreateRequest();
```

### Проверяем существование запроса


```js
    
    //Проверяем существование запроса
    
    if (!request)
    {
        console.log("Невозможно создать XMLHttpRequest");
    }
    else{
    
    console.log("Ура! Мы создали XMLHttpRequest. Что с ним делать?");

```
Пишем функцию, которая сработает, когда сервер вернет данные. В объекте XMLHttpRequest есть свойство onreadystatechange, в котором хранится данная функция. Когда состояние запроса изменяется, будет выполняться эта функция.

```js

//Назначаем пользовательский обработчик

    request.onreadystatechange = function(){

// Первое свойство, readyState определяет состояние запроса. На протяжении всего AJAX запроса меняется его состояние от 0 до 4 (4 означает, что мы получили ответ с данными). 

      switch (request.readyState) {
        case 1: print_console('<div class="alert alert-secondary" role="alert">1: Подготовка к отправке...</div>'); break
        case 2: print_console('<div class="alert alert-primary" role="alert">2: Отправлен...</div>'); break
        case 3: print_console('<div class="alert alert-warning" role="alert">3: Идет обмен...</div>'); break

// Второе свойство, status показывает успешность или неуспешность запроса (200 означает, что запрос успешно прошел). В этом примере предполагается, что мы вытянули данные, а AJAX запрос прошел успешно, мы обновили контент нужного элемента. 

 //Если обмен данными завершен

        case 4:{
           if(request.status==200){
              print_console('<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
              document.getElementById("printResult").innerHTML = "<b>"+request.responseText+"</b>";
              }else if(request.status==404){
                print_console('<div class="alert alert-danger" role="alert">Ошибка: запрашиваемый скрипт не найден!</div>');
              }

// Если запрос не прошел, мы отображаем сообщение с текстом из объекта XMLHttpRequest.

           else {
            print_console('<div class="alert alert-danger" role="alert">Ошибка: сервер вернул статус: '+ request.status +'</div>');
           }
           break
           }
         }
       }
```


## Test

http://headers.jsontest.com/

```js
{
   "X-Cloud-Trace-Context": "ad9ca4570da8325dd5c2f2dd205a1d7c/15696983810162188201",
   "Upgrade-Insecure-Requests": "1",
   "Accept-Language": "en-US,en;q=0.9,uk;q=0.8,ru;q=0.7",
   "Host": "headers.jsontest.com",
   "User-Agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36",
   "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8"
}
```


```js
    
// Задаем тип запроса с помощью метода open. Этот метод принимает два обязательных параметра и 3 опциональных. 


// Первый параметр задает HTTP метод (GET или POST). 

// Во втором параметре указывается URL страницы, куда мы посылаем запрос. 

    var url = 'http://headers.jsontest.com/';

// В третьем параметре можно указать тип запроса синхронный или асинхронный (значение по-умолчанию true). 

//Инициализируем соединение

       request.open ('GET', url, true);

// Для аутентификации можно использовать два дополнительных параметра.       

// Отправляет запрос по клику на кнопку с помощью метода send. 

// Также на этом этапе мы прячем кнопку.
  
  this.style.display = 'none';

//Если это GET-запрос
//Посылаем нуль-запрос

  request.send();

   }
 })

    function print_console(text){
        document.getElementById("console").innerHTML += text;
    }

```
### 03.html

Конструкция try...catch помечает блок инструкций как try, и в зависимости от того, произошла ошибка или нет, вызывает дополнительный блок инструкций catch.

```js
  try {
     try_statements
  }
  [catch (exception_var_1 if condition_1) { // не стандартно
     catch_statements_1
  }]
  ...
  [catch (exception_var_2) {
     catch_statements_2
  }]
  [finally {
     finally_statements
  }]
```  
  
- try_statements - Инструкция, которая будет выполнена.
- catch_statements_1, catch_statements_2 - Инструкции, которые будут выполнены, если произойдёт ошибка в блоке try.
- exception_var_1, exception_var_2 - Идентификатор для хранения объекта ошибки, который впоследствии используется в блоке catch
- condition_1 - Выражение состояния
- finally_statements - Инструкции, которые выполняются после завершения блока try. Выполнение происходит независимо от того, была ошибка или нет.

Конструкция try содержит блок try, в котором находится одна или несколько инструкций ({} должно быть всегда использовано, даже для одиночных инструкций), и как минимум один блок catch, или один блок finally, или оба. Здесь приведены три возможных варианта использования конструкции try:

```js
try...catch
try...finally
try...catch...finally
```

Блок catch содержит инструкции, которые будут выполнены, если в блоке try произошла ошибка. Это сделано для того, чтобы была возможность обработать ошибку в блоке catch, при её возникновении. Если какая-либо инструкция вызывает ошибку в try блоке, то управление незамедлительно переходит в блок catch. Если в try блоке не будет никакой ошибки, то блок catch пропустится.

Блок finally выполнится после выполнения блоков try и catch, но перед инструкциями, следующими за конструкцией try...catch. Этот блок всегда выполняется независимо от того, была ошибка или нет.

Вы можете размещать один или более try оператор. Если внутренний try оператор не имеет catch блок, будет использован сatch внешнего оператора try.

Вы также можете использовать оператор try для обработки JavaScript исключений. 

## Специальный вызов ошибки

При специальном вызове ошибки, вход в блок catch происходит тогда, когда ошибка вызвана. Для примера, когда ошибка 'myException вызывается в следующем коде, управление переходит в блок catch незамедлительно:
```js
try {
   throw 'myException'; // создание ошибки
}
catch (e) {
   // инструкции для работы с ошибками
   logMyErrors(e); // передает объект ошибки для управления им
}

```
Блок catch задает идентификатор (e) который содержит заданное оператором throw. Блок catch в JavaScript создает идентификатор когда произошел вход в блок и добавляет его в область видимости блока; идентификатор действителен только во время исполнения блока catch; после того, как catch блок заканчивает свое исполнение идентификатор перестаёт быть доступным.

## Условные обработчики

```js
        try {
           if(request.status==200){
              print_console('<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
              document.getElementById("printResult").innerHTML = "<b>"+request.responseText+"</b>";
              }else if(request.status==404){
                print_console('<div class="alert alert-danger" role="alert">Ошибка: запрашиваемый скрипт не найден!</div>');
              }
           else {
            print_console('<div class="alert alert-danger" role="alert">Ошибка: сервер вернул статус: '+ request.status +'</div>');
           }

        }
        catch( e ) {
          print_console('<div class="alert alert-danger" role="alert">Произошло исключение:  '+ e.description +'</div>');
        }

```


# Ajax-запрос jQuery.ajax()

Осуществляет запрос к серверу без перезагрузки страницы. Это низкоуровневый метод, обладающий большим количеством настроек. Он лежит в основе работы всех остальных методов ajax. 


## jQuery.ajax(url,[settings])
- url — адрес запроса.
- settings — в этом параметре можно задать настройки для данного запроса. Задается с помощью объекта в формате {имя:значение, имя:значение...}. Ни одна из настроек не является обязательной. Установить настройки по умолчанию можно с помощью метода $.ajaxSetup().

## jQuery.ajax(settings)

Отличие от предыдущего варианта метода заключается лишь в том, что свойство url здесь является частью настроек, а не отдельным параметром.


## Список настроек

### async:boolean(true)
По умолчанию, все запросы без перезагрузки страницы происходят асинхронно (то есть после отправки запроса на сервер, страница не останавливает свою работу в ожидании ответа). Если вам понадобиться синхронное выполнение запроса, то установите параметр в false. Кроссдоменные запросы и запросы типа "jsonp" не могут выполняться в синхронном режиме.
Имейте ввиду, что выполнение запросов в синхронном режиме может привести к блокировке страницы, пока запрос не будет полностью выполнен.


## Обработчики событий

Настройки beforeSend, error, dataFilter, success и complete позволяют установить обработчики событий, которые происходят в определенные моменты выполнения каждого ajax-запроса.

- beforeSend происходит непосредственно перед отправкой запроса на сервер.
- error происходит в случае неудачного выполнения запроса.
- dataFilter происходит в момент прибытия данных с сервера. Позволяет обработать "сырые" данные, присланные сервером.
- success происходит в случае удачного завершения запроса.
- complete происходит в случае любого завершения запроса.


## url:string(адрес текущей страницы)

Определяет адрес, на который будет отправлен запрос.
```js

  url: 'http://headers.jsontest.com/',

```

## success(data, textStatus, jqXHR):function,array

Функция, которая будет вызвана в случае удачного завершения запроса к серверу. Ей будут переданы три параметра: данные, присланные сервером и уже прошедшие предварительную обработку (которая отлична для разных dataType). Второй параметр — строка со статусом выполнения. Третий параметр содержит объект jqXHR (в более ранних версиях библиотеки (до 1.5), вместо jqXHR используется XMLHttpRequest). Начиная с jQuery-1.5, вместо одной функции, этот параметр может принимать массив функций.
success относится к ajax-событиям

## Выведем сообщение при удачном выполнении запроса:

```js
$('.btnGo').on('click', function(){

        //Создаём запрос
        $.ajax({
          url: 'http://headers.jsontest.com/',
          success: function(){
            $('#console').html('<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
          }
        });
 
   });
```

метод $.ajax() возвращает объект jqXHR, который помимо прочего реализует интерфейс deferred, что позволяет задавать дополнительные обработчики выполнения. 

Помимо стандартных для объекта deferred методов .done(), .fail() и .then(), с помощью которых можно устанавливать обработчики, в jqXHR реализованы .success(), .error() и .complete(). Это сделано для соответствия привычным названиям методов, с помощью которых устанавливаются обработчики выполнения ajax-запросов. 


Для некоторых типов запросов, таких как jsonp или кроссдоменных GET-запросов, не предусматривается использование объектов XMLHttpRequest. В этом случае, передаваемые в обработчики XMLHttpRequest и textStatus будут содержать значение undefined.

Внутри обработчиков, переменная this будет содержать значение параметра context. В случае, если он не был задан, this будет содержать объект настроек.

## Параметр dataType

Функция $.ajax() узнает о типе присланных сервером данных от самого сервера (средствами MIME). Кроме этого, существует возможность лично указать (уточнить), как следует интерпретировать эти данные. Это делается с помощью параметра dataType. 

Возможные значения этого параметра:

- "xml" — полученный xml-документ будет доступен в текстовом виде. С ним можно работать стандартными средствами jQuery (также как и с документом html).
- "html" — полученный html будет доступен в текстовом виде. Если он содержит скрипты в тегах script, то они будут автоматически выполнены, только когда html-текст будет помещен в DOM.
- "script" — полученные данные будут исполнены как javascript. Переменные, которые обычно содержат ответ от сервера будут содержать объект jqXHR.
- "json", "jsonp" — полученные данные будут предварительно преобразованы в javascript-объект. Если разбор окажется неудачным (что может случиться, если json содержит ошибки), то будет вызвано исключение ошибки разбора файла. Если сервер, к которому вы обращаетесь, находится на другом домене, то вместо json следует использовать jsonp. 
- "text" — полученные данные окажутся доступными в виде обычного текста, без предварительной обработки.


## Отправка данных на сервер

По умолчанию, запрос к серверу осуществляется HTTP-методом GET. При необходимости сделать запрос методом POST, нужно указать соответствующее значение в настройке type. Данные, отправляемые методом POST будут преобразованы в UTF-8, если они находятся в другой кодировке, как того требует стандарт W3C XMLHTTPRequest.

Параметр data может быть задан либо строкой в формате key1=value1&key2=value2 (формат передачи данных в url), либо объектом с набором пар {имя:значение} — {key1: 'value1', key2: 'value2'}. В последнем случае, перед отправкой данных jQuery преобразует заданный объект в строку, с помощью $.param(). Однако, это преобразование можно отменить, указав в настройке processData значение false. Преобразование в строку нежелательно, например, в случае отправки на сервер xml-объекта. В этом случае, желательно изменить настройку contentType с application/x-www-form-urlencoded на более подходящий mime-тип.

большинство браузеров не позволяют проводить ajax-запросы на ресурсы с доменами, поддоменами и протоколами, отличными от текущего. Однако, это ограничение не распространяется на запросы типа jsonp и script.

## Получение данных с сервера

### data:object,string
Данные, которые будут отправлены на сервер. Если они заданы не строчным значением, то будут предварительно преобразован в строку. Избежать этого преобразования можно изменив параметр processData.

В случае запроса методом GET, строка с данными добавляется в конец url. Если данные задаются с помощью объекта, то он должен соответствовать формату: {fName1:value1, fName2:value2, ...}.

Полученные от сервера данные, могут быть предоставлены в виде строки или объекта, в зависимости от значения параметра dataType. Эти данные всегда доступны в первом параметре обработчика выполнения ajax-запроса:

```js
$('.btnGo').on('click', function(){

        //Создаём запрос
        $.ajax({
          url: 'http://headers.jsontest.com/',
          success: function(data){
            $('#console').html('<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
            $("#printResult").html("<b>Прибыли данные: "+data+"</b>");
            console.log(data);
          }
        });
    });
```

## Object
```json
Accept: "*/*"
Accept-Language: "en-US,en;q=0.9,uk;q=0.8,ru;q=0.7"
Host: "headers.jsontest.com"
Origin: "null"
User-Agent: "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36"
X-Cloud-Trace-Context: "412c08ee6b308b4b3b6227eefb1fcbc2/6601633340221848952"
```
## 05.html

```js
$('.btnGo').on('click', function(){

        //Создаём запрос
        $.ajax({
          url: 'http://headers.jsontest.com/',
          success: function(data){
            $('#console').html('<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
            $("#printResult").html("<b>Прибыли данные: "+data['User-Agent']+"</b>");
            console.log(data);
          }
        });
    });
```

## beforeSend(jqXHR, settings):function

Это поле содержит функцию, которая будет вызвана непосредственно перед отправкой ajax-запроса на сервер. Такая функция может быть полезна для модификации jqXHR-объекта (в ранних версиях библиотеки (до 1.5), вместо jqXHR используется XMLHttpRequest). 

Например, можно изменить/указать нужные заголовки (headers) и.т.д. Объект-jqXHR будет передан в функцию первым аргументом. Вторым аргументом передаются настройки запроса.
beforeSend относится к ajax-событиям. Поэтому если указанная в нем функция вернет false, ajax-запрос будет отменен.

Начиная с jQuery-1.5, beforeSend вызывается независимо от типа запроса.

```js
$('.btnGo').on('click', function(){

        //Создаём запрос
        $.ajax({
          url: 'http://headers.jsontest.com/',
          beforeSend: function(){
            $('#console').html('<div class="alert alert-secondary" role="alert">1: Подготовка к отправке...</div>');
        },
          success: function(data){
            var text = $('#console').html();
            $('#console').html(text + '<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
            $("#printResult").html("<b>Прибыли данные: "+data['User-Agent']+"</b>");
            console.log(data);
          }
        });
   });

```

Для типов text и xml, присланные сервером данные будут доступны так же и в jqXHR, а именно в его полях responseText или responseXML соответственно.


## error(jqXHR, textStatus, errorThrown):function,array

Функция, которая будет вызвана в случае неудачного завершения запроса к серверу. Ей предоставляются три параметра: jqXHR, строка с описанием произошедшей ошибки, а так же объект исключения, если такое произошло. Возможные значения второго аргумента: "timeout", "error", "notmodified" и "parsererror" (в непредвиденных случаях, может быть возвращено значение null). 
Начиная с jQuery-1.5, этот параметр может принимать как одну функцию, так и массив функций.

Событие error не определено для dataType равных script и JSONP.
error относится к ajax-событиям.

## 07.html

```js
$('.btnGo').on('click', function(){

        //Создаём запрос
        $.ajax({
          url: 'http://headers.jsontest.com/',
          beforeSend: function(){
            $('#console').html('<div class="alert alert-secondary" role="alert">1: Подготовка к отправке...</div>');
        },
        error: function(xhr){
            $('#console').html('<div class="alert alert-danger" role="alert">Ошибка: сервер вернул статус: '+ xhr.statusText +'</div>');
            $("#printResult").html("<b>Прибыли данные: "+xhr.responseText+"</b>");
        },
        success: function(data){
            var text = $('#console').html();
            $('#console').html(text + '<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
            $("#printResult").html("<b>Прибыли данные: "+data['User-Agent']+"</b>");
            console.log(data);
          }
        });
   });

```

## complete(jqXHR, textStatus):function, array

функция, которая будет вызвана после завершения ajax-запроса (вызывается позднее функций-обработчиков успешного (success) или аварийного (error) завершения запроса). В функцию передаются два параметра: jqXHR и статус выполнения запроса (строковое значение:"success", "notmodified", "error", "timeout", "abort", или "parsererror").
Начиная с jQuery-1.5, в параметр complete можно передать не одну функцию, а массив функций. Все функции будут вызваны в той очередности, в которой заданы в этом массиве.

```js

    $('.btnGo').on('click', function(){
        //Создаём запрос
        $.ajax({
          url: 'http://headers.jsontest.com/',
          beforeSend: function(){
            $('#console').html('<div class="alert alert-secondary" role="alert">1: Подготовка к отправке...</div>');
        },
        error: function(xhr){
            $('#console').html('<div class="alert alert-danger" role="alert">Ошибка: сервер вернул статус: '+ xhr.statusText +'</div>');
            $("#printResult").html("<b>Прибыли данные: "+xhr.responseText+"</b>");
        },
        success: function(data){
            var text = $('#console').html();
            $('#console').html(text + '<div class="alert alert-success" role="alert">4: Обмен завершен!</div>');
            $("#printResult").html("<b>Прибыли данные: "+data['User-Agent']+"</b>");
            console.log(data);
        },
        complete: function() {
           var text = $('#console').html(); 
           $('#console').html(text + '<div class="alert alert-primary" role="alert">5: AJAX завершен!</div>');
        }
     });
    });

```

## Предварительная очистка ответных данных

С помощью параметра dataFilter можно задать функцию, которая будет вызвана для предварительной очистки данных, возвращаемых сервером. Это средство незаменимо в тех случаях, когда пересылаемые сервером данные не совсем вас устраивают либо из-за того, что отформатированы неподходящим образом, либо из-за того, что среди них есть данные, которые вы не хотите обрабатывать.

## dataFilter(data, type):function

Функция, которая будет осуществлять предварительную обработку данных, присланных сервером. В функцию эту передаются два параметра: упомянутые данные и значение параметра dataType. Указанная в dataFilter функция, должна возвращать обработанные данные.

```js

  dataFilter: function (data, dataType)
         {

          var text = $('#console').html();
            $('#console').html(text + '<div class="alert alert-warning" role="alert">3: Идет data Filter...</div>');

          if (dataType == "json") {
                    var filteredData = $.parseJSON(data);
                    return JSON.stringify(filteredData);
                } else {
                   return data;
                }
        },
```

# JSON Formatter

https://www.freeformatter.com/json-formatter.html

```json

[
   {
      "id": 0,
      "name": "Cool Cat",
      "price": 177,
      "picture": "1.jpg",
      "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus dignissimos, maxime ea excepturi veritatis itaque."
   },

```

## myjson.com

http://myjson.com/ex0b3

URI to access this JSON directly.

https://api.myjson.com/bins/ex0b3

## 10.html

```js
    //Создаём запрос
    var request = CreateRequest();

    var url = 'https://api.myjson.com/bins/ex0b3';
    
    //Проверяем существование запроса
    
    if (!request)
    {
        console.log("Невозможно создать XMLHttpRequest");
    }
    else
    {
    
    console.log("Ура! Мы создали XMLHttpRequest. Что с ним делать?");

    request.onreadystatechange = function(){
      if (request.readyState === 4 ) {
        try {
           if(request.status==200){
              var json_data = request.responseText;
              json_data = JSON.parse(json_data);
              console.log(json_data);
            
              for(var i in json_data)
                data.push(json_data[i]);

              console.log(data);
        }
           else if(request.status==404){
                console.log('Ошибка: запрашиваемый скрипт не найден!');
              }
           else {
            console.log('Ошибка: сервер вернул статус: '+ request.status);
           }
          }
        catch( e ) {
          console.log('Произошло исключение:  '+ e.description);
        }
      }
     }

       request.open ('GET', url, true);
       request.send ('');
 }

```

## 12.html

```js
  var data = [];

  var url = 'https://api.myjson.com/bins/ex0b3';

    $.ajax({
      url: url,
      method: 'GET'
    }).then(
      function(json_data) {

        console.log(json_data);
        
        for(var i in json_data)
                data.push(json_data[i]);

```