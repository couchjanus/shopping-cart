# shopping-cart 

## Table of Contents
- [JavaScript Object Notation](#JavaScript-Object-Notation)
  - [Синтаксис JSON](#Синтаксис-JSON)
  - [Методы JSON](#Методы JSON)
- [Объекты sessionStorage и localStorage](#Объекты-sessionStorage-и-localStorage)
- [Объект localStorage](#Объект-localStorage)
- [Методы localStorage](#Методы-localStorage)

- [Реализация корзины покупок](#Реализация-корзины-покупок)
  - [Поддерживает ли браузер API localStorage](#Поддерживает-ли-браузер-API-localStorage)
  - [Загрузка данных из LocalStorage](#Загрузка-данных-из-LocalStorage)
  - [Где вызывать функцию showCart](#Где-вызывать-функцию-showCart)
  - [Подготовка данных для записи в localStorage](#Подготовка-данных-для-записи-в-localStorage)
  - [Добавляем или изменяем значение](#Добавляем-или-изменяем-значение)
  - [Сохраняем корзину в localStorage](#Сохраняем-корзину-в-localStorage)
  - [Просмотр содержимого корзины](#Просмотр-содержимого-корзины)
  - [Подсчет итоговых сумм](#Подсчет-итоговых-сумм)
  - [Обновление итогов](#Обновление-итогов)
  - [Удаляем товар из корзины](#Удаляем-товар-из-корзины)
  - [Очищаем все хранилище](#Очищаем-все-хранилище)


# JavaScript Object Notation

JSON (JavaScript Object Notation) — текстовый формат обмена данными, основанный на JavaScript. JSON формат считается независимым от языка и может использоваться практически с любым языком программирования.

## Синтаксис JSON

JSON-текст представляет собой одну из двух структур:

- Набор пар ключ: значение. В различных языках это реализовано как объект, запись, структура, словарь, хэш-таблица, список с ключом или ассоциативный массив. Ключом может быть только строка (регистрозависимая: имена с буквами в разных регистрах считаются разными), значением — любая форма.

- Упорядоченный набор значений. Во многих языках это реализовано как массив, вектор, список или последовательность.

Это универсальные структуры данных: как правило, любой современный язык программирования поддерживает их в той или иной форме. Они легли в основу JSON, так как он используется для обмена данными между различными языками программирования.

В качестве значений в JSON могут быть использованы:

### Объект

Объект — это неупорядоченное множество пар ключ:значение, заключённое в фигурные скобки «{ }». Ключ описывается строкой, между ним и значением стоит символ «:». Пары ключ-значение отделяются друг от друга запятыми.

### Массив

Массив (одномерный) — это упорядоченное множество значений. Массив заключается в квадратные скобки «[ ]». Значения разделяются запятыми.

### Число

Литералы true, false и null.

### Строка
Строка — это упорядоченное множество из нуля или более символов юникода, заключённое в двойные кавычки. Символы могут быть указаны с использованием escape-последовательностей, начинающихся с обратной косой черты «\» (поддерживаются варианты \", \\, \/, \t, \n, \r, \f и \b), или записаны шестнадцатеричным кодом в кодировке Unicode в виде \uFFFF.
Строка очень похожа на одноимённый тип данных в языках С и Java. Число тоже очень похоже на С- или Java-число, за исключением того, что используется только десятичный формат. Пробелы могут быть вставлены между любыми двумя синтаксическими элементами.

## Методы JSON

### JSON.parse()
Разбирает строку JSON, возможно с преобразованием получаемого значения и его свойств и возвращает разобранное значение.

### JSON.stringify()
Возвращает строку JSON, соответствующую указанному значению, возможно с включением только определённых свойств или с заменой значений свойств определяемым пользователем способом.

# Объекты sessionStorage и localStorage

Отличаются эти объекты друг от друга только тем, что имеют различный период времени хранения данных, помещённых в них. Объект sessionStorage хранит данные ограниченное время, они удаляются сразу после того как пользователь завершает свой сеанс или закрывает браузер. Объект localStorage в отличие от объекта sessionStorage хранит данные неограниченное время.

# Объект localStorage

localStorage это свойство глобального объекта браузера (window). К нему можно обращаться как window.localStorage или просто localStorage.

Контейнеры localStorage и sessionStorage хранят данные с помощью элементов (пар "ключ-значение"). Ключ представляет собой некоторый идентификатор, который связан со значением. Т.е. для того чтобы записать или получить некоторое значение необходимо знать его ключ. 
Значение представляет собой строку, это необходимо учитывать при работе с ним в коде JavaScript. 
 
## Устройство объектов sessionStorage и localStorage

в Google Chrome вам надо открыть DevTools (F12), перейти на вкладку «Resourses» и на левой панели вы увидите localStorage для данного домена и все значения, что оно содержит.

Для каждого домена браузер создает свой объект localStorage, и редактировать или просматривать его можно только на этом домене. Например, с домена mydomain-1.com нельзя получить доступ к localStorage вашего mydomain-2.com.

Работа с localStorage очень напоминает работу с объектами в JavaScript. 

# Методы localStorage

## .getItem(key)

Метод getItem(key) используется для получения значения элемента хранилища по его ключу (key).

## .setItem(key,value)

Метод setItem(key,value) предназначен для добавления в хранилище элемента с указанным ключом (key) и значением (value). Если в хранилище уже есть элемент с указанным ключом (key), то в этом случае произойдет изменения его значения (value).

## .key(индекс)

Метод key(индекс) возвращает ключ элемента по его порядковому номеру (индексу), который находится в данном хранилище.

## .removeItem(key)

Метод removeItem(key) удаляет из контейнера sessionStorage или localStorage элемент, имеющий указанный ключ.

## .clear()

Метод clear() удаляет все элементы из контейнера.

## .length

Свойство length возвращает количество элементов, находящихся в контейнере.

# Реализация корзины покупок

## Поддерживает ли браузер API localStorage

Проверить, поддерживает ли браузер API sessionStorage и localStorage можно с помощью следующей строки:

```js
if (window.sessionStorage && window.localStorage) {
  //объекты sessionStorage и localtorage поддерживаются
}
else {
  //объекты sessionStorage и localtorage не поддерживаются
}
```

В LocalStorage, мы можем записывать только строковые данные. 

Если нужно добавить массив или объект, то его можно предварительно преобразовать в JSON-строку (JSON.stringify(obj)), а после получения данных из LocalStorage - производим обратное преобразование (JSON.parse(json_string)). 

## Загрузка данных из LocalStorage

## 01.html

```js

var shoppingCart = [];

  $(function() {

    if (localStorage.shoppingCart){

      shoppingCart = JSON.parse(localStorage.shoppingCart);
    
    }
```

Свойство shoppingCart.length возвращает количество элементов, находящихся в shoppingCart.

```js

  function showCart(){
    if (shoppingCart.length == 0) {
      console.log("Your Shopping Cart is Empty!");
      return;
    }
  }
```

## Где вызывать функцию showCart

### 02.html

```js

    const cart_trigger = $('#cart-trigger');

    cart_trigger.on('click', () => {
       toggle_panel(cart, shadow_layer);

       showCart();
    });
```

### 03.html

## Подготовка данных для записи в localStorage

```js

$('.addcart').click(function() {

    let id = $(this).parents('.singleMember').attr("productId");

    let price = $(this).parents(".singleMember").find(".product-price").attr("productPrice");

    let name = $(this).parents(".singleMember").children(".product-name").text();
    
    let quantity = $(this).parents(".singleMember").find(".quantity").val();
    
    let picture = $(this).parents(".singleMember").find("img").attr('src');            

    console.log(id, price, name, quantity, picture);
```

## Добавляем или изменяем значение

### 04.html

```js
  let item = { 
      Id: id, 
      Product: name,  
      Price: price, 
      Quantity: quantity, 
      Picture: picture 
    }; 
    
    shoppingCart.push(item);

    console.log(shoppingCart);
```
## Сохраняем корзину в localStorage

```js
   
    saveCart();

```

Перед сохранением выполняем сериализацию данных в JSON с помощью функции JSON.stringify().

```js
  function saveCart() {
  
    if ( window.localStorage)
      {
        localStorage.shoppingCart = JSON.stringify(shoppingCart);
      }
  }
```
Если товар уже находится в корзине

```js

for (let i in shoppingCart) {
      if(shoppingCart[i].Product == name)
        {
         shoppingCart[i].Quantity += quantity;
         saveCart();
         return;
        }
    }
```

## Просмотр содержимого корзины

### 05.html 

```js

function showCart(){
    if (shoppingCart.length == 0) {
      console.log("Your Shopping Cart is Empty!");
      return;
    }

    $("#cartBody").empty();

    for (var i in shoppingCart) {
    
      var $templateCart = $($('#cartItem').html());
  
      var item = shoppingCart[i];
    
      $templateCart.attr('product_id', item.Id);
    
      $templateCart.find(".item-quantities").text(item.Quantity);
    
      $templateCart.find(".item-quantities").after(' '+ item.Product); 
    
      $templateCart.find('.item-price').text(item.Price);
    
      $templateCart.find('.item-prices').text(item.Quantity * item.Price);

      $templateCart.find('span.qty').attr('style', 'background-image:'+ 'url('+item.Picture+')');

      $(".cart-items").append($templateCart);
    }
  }

    cart_trigger.on('click', () => {
      toggle_panel(cart, shadow_layer);
      showCart();
    });
```

## Подсчет итоговых сумм

### 06.html

```js
  function showCart(){
    if (shoppingCart.length == 0) {
      console.log("Your Shopping Cart is Empty!");
      return;
    }

    $("#cartBody").empty();

    for (var i in shoppingCart) {
    
      var $templateCart = $($('#cartItem').html());
  
      var item = shoppingCart[i];
    
      $templateCart.attr('product_id', item.Id);
    
      $templateCart.find(".item-quantities").text(item.Quantity);
    
      $templateCart.find(".item-quantities").after(' '+ item.Product); 
    
      $templateCart.find('.item-price').text(item.Price);
    
      $templateCart.find('.item-prices').text(item.Quantity * item.Price);

      $templateCart.find('span.qty').attr('style', 'background-image:'+ 'url('+item.Picture+')');

      $(".cart-items").append($templateCart);
    }
    updateTotal();
  }
```

## Обновление итогов


## Вызов функции для элементов набора
```
.each()
```
Выполняет заданную функцию для каждого из выбранных элементов в отдельности. Это дает возможность обрабатывать выбранные элементы отдельно друг от друга.

```js
.each(callback(index, domElement))
```
Выполняет функцию callback для каждого из выбранных элементов. В callback передаются 2 параметра: номер элемента в наборе (нумерация начинается с нуля) и сам элемент в виде объекта DOM.

метод .each() возвращает исходный набор элементов.

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
  }
```

## Удаляем товар из корзины

## Метод find()

Метод find() возвращает значение первого найденного в массиве элемента, которое удовлетворяет условию переданному в callback функции.  В противном случае возвращается undefined.
```js
arr.find(callback[, thisArg])
```
### Параметры

- callback
Функция, вызывающаяся для каждого значения в масиве, принимает три аргумента:
- element
Текущий обрабатываемый элемент в массиве.
- index
Индекс текущего обрабатываемого элемента в массиве.
- array
Массив, по которому осуществляется проход.
- thisArg
Необязательный параметр. Значение, используемое в качестве this при выполнении функции callback.

### Возвращаемое значение

Значение элемента из массива, если элемент прошёл проверку, иначе undefined.


Метод find вызывает переданную функцию callback один раз для каждого элемента, присутствующего в массиве, до тех пор, пока она не вернёт true. Если такой элемент найден, метод find немедленно вернёт значение этого элемента. В противном случае, метод find вернёт undefined. 

Функция callback вызывается с тремя аргументами: значением элемента, индексом элемента и массивом, по которому осуществляется проход.

Если в метод find был передан параметр thisArg, при вызове callback он будет использоваться в качестве значения this. В противном случае в качестве значения this будет использоваться значение undefined.

Метод find не изменяет массив, для которого он был вызван.

```js

  console.log(shoppingCart.find(x => x.Id === index));

```


```js
   var result = shoppingCart.filter(function( obj ) 
   {
     if (obj.Id == index){
            console.log(obj);     
     }
     return obj.Id == index;
   });
      
   console.log(result);

```

## Метод findIndex()

Метод findIndex() возвращает индекс в массиве, если элемент удовлетворяет условию проверяющей функции. В противном случае возвращается -1.
```js
arr.findIndex(callback[, thisArg])
```
### Параметры

- callback
Функция, вызывающаяся для каждого значения в масиве, принимает три аргумента:
- element
Текущий обрабатываемый элемент в массиве.
- index
Индекс текущего обрабатываемого элемента в массиве.
- array
Массив, по которому осуществляется проход.
- thisArg
Необязательный параметр. Значение, используемое в качестве this при выполнении функции callback.

Метод findIndex вызывает переданную функцию callback один раз для каждого элемента, присутствующего в массиве, до тех пор, пока она не вернёт true. Если такой элемент найден, метод findIndex немедленно вернёт индекс этого элемента. В противном случае, метод findIndex вернёт -1. Функция callback вызывается только для индексов массива, имеющих присвоенные значения; она не вызывается для индексов, которые были удалены или которым значения никогда не присваивались.

Функция callback вызывается с тремя аргументами: значением элемента, индексом элемента и массивом, по которому осуществляется проход.

Если в метод findIndex был передан параметр thisArg, при вызове callback он будет использоваться в качестве значения this. В противном случае в качестве значения this будет использоваться значение undefined.

Метод findIndex не изменяет массив, для которого он был вызван.

```js

console.log(shoppingCart.indexOf(shoppingCart.find(x => x.Id === index)));

```

## Метод splice()

Метод splice() изменяет содержимое массива, удаляя существующие элементы и/или добавляя новые.
```js
array.splice(start, deleteCount[, item1[, item2[, ...]]])
```
### Параметры

- start
Индекс, по которому начинать изменять массив. Если больше длины массива, реальный индекс будет установлен на длину массива. Если отрицателен, указывает индекс элемента с конца.

- deleteCount
Целое число, показывающее количество старых удаляемых из массива элементов. Если deleteCount равен 0, элементы не удаляются. В этом случае вы должны указать как минимум один новый элемент. Если deleteCount больше количества элементов, оставшихся в массиве, начиная с индекса start, то будут удалены все элементы до конца массива.

- itemN
Необязательные параметры. Добавляемые к массиву элементы. Если вы не укажете никакого элемента, splice() просто удалит элементы из массива.

### Возвращаемое значение

Массив, содержащий удалённые элементы. Если будет удалён только один элемент, вернётся массив из одного элемента. Если никакие элементы не будут удалены, вернётся пустой массив.

Если количество указанных вставляемых элементов будет отличным от количества удаляемых элементов, массив изменит длину после вызова.

## Пример: использование метода splice()
```js

   shoppingCart.splice(shoppingCart.indexOf(shoppingCart.find(x => x.Id === index)),1); 
      
   console.log(shoppingCart);

```

### 07.html

```js
   $('body').on('click', '.cart-items .item-remove', function () {
      var $this = $(this);
      var index = $this.parent().attr("product_id");

      console.log(index);

      var result = shoppingCart.filter(function( obj ) {
          if (obj.Id == index){
            console.log(obj);     
          }
        return obj.Id == index;
      });
      
      console.log(result);

      console.log(shoppingCart.find(x => x.Id === index));

      console.log(shoppingCart.indexOf(shoppingCart.find(x => x.Id === index)));

      shoppingCart.splice(shoppingCart.indexOf(shoppingCart.find(x => x.Id === index)),1); 
      
      console.log(shoppingCart);
      var $item = $this.parents('li');
      $item.remove();
      saveCart();
      updateTotal();
    });

```
## item-remove

```js

   $('body').on('click', '.cart-items .item-remove', function () {
      var $this = $(this);
      var index = $this.parent().attr("product_id");

      shoppingCart.splice(shoppingCart.indexOf(shoppingCart.find(x => x.Id === index)),1); 
      
      var $item = $this.parents('li');
      $item.remove();
      saveCart();
      updateTotal();
    });

```

## Очищаем все хранилище
```js
localStorage.clear()
```

## 08.html

```js

$('body').on('click', '#cart .clear-cart', function () {
   
      localStorage.removeItem('shoppingCart');
      $("#cartBody").empty();
      shoppingCart = [];
      updateTotal();
   });

```
