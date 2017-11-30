# shopping-cart 

## Table of Contents

- [Появление и иcчезновение элементов](#Появление-и-иcчезновение-элементов)
- [Выполнение пользовательской анимации](#Выполнение-пользовательской-анимации)
  - [Выполнение нескольких анимаций](#Выполнение-нескольких-анимаций)
  - [Параметр properties](#Параметр-properties)
  - [Обработчик завершения анимации](#Обработчик-завершения-анимации)
  - [Параметр easing](#Параметр-easing)
- [Позиция элемента](#Позиция-элемента)
- [Поиск элемента с заданным номером](#Поиск-элемента-с-заданным-номером)
- [Удаление объектов](#Удаление-объектов)
- [jQuery extend](#jQuery-extend)
- [Фильтрация выбранных элементов](#Фильтрация-выбранных-элементов)


# Появление и иcчезновение элементов

## Появление и иcчезновение элементов за счет прозрачности

### .fadeIn()  .fadeOut()

С помощью этих функций можно показывать и скрывать выбранные элементы на странице, за счет плавного изменения прозрачности. после скрытия элемента, его css-свойство display автоматически становится равным none, а перед появлением, оно получает свое прежнее значение обратно. 

Методы имеют два варианта использования:

## .fadeIn([duration],[callback])  .fadeOut([duration],[callback])

duration — продолжительность выполнения анимации (появления или скрытия). Может быть задана в миллисекундах или строковым значением 'fast' или 'slow' (200 и 600 миллисекунд). По умолчанию, анимация будет происходить за 400 миллисекунд.

callback — функция, заданная в качестве обработчика завершения анимации (появления или скрытия). Ей не передается никаких параметров, однако, внутри функции, переменная this будет содержать DOM-объект анимируемого элемента. Если таких элементов несколько, то обработчик будет вызван отдельно, для каждого элемента.


## .fadeIn([duration],[easing],[callback])  .fadeOut([duration],[easing],[callback])

easing — изменение скорости анимации (будет ли она замедляется к концу выполнения или наоборот ускорится). 


## Примеры использования:

```js
$("#leftFit").fadeOut() // элемент с идентификатором leftFit "растворится" за 400 мс.

$("#leftFit").fadeIn()  // элемент с идентификатором leftFit "прояснится" за 400 мс.

$("#leftFit").fadeOut(300)  // в течении 1/3 секунды элемент с идентификатором leftFit исчезнет.

$("#leftFit").fadeIn("slow")  // в течении 600 мс появится элемент с идентификатором leftFit.
```
## 01.html

```js
$('.addcart').click(function() {
        var y = 180;
        $('.contentItem').css({
          'transform': 'rotateY(' + y + 'deg)'
        });


        cart_trigger.fadeOut(1000);
        cart_trigger.fadeIn(500);
```

## callback — функция: 02.html

```js
$('.addcart').click(function() {
        var y = 180;
        $('.contentItem').css({
          'transform': 'rotateY(' + y + 'deg)'
        });

        $('.shopping-cart').fadeOut(1000, function() {
                $(this).css({
                    'backgroundColor':'rgba(255,0,0,0.5)',
                    'borderRadius': '50%',
                    'transform': 'scale(2, 2)'
                    });
            });

        $('.shopping-cart').fadeIn(500);

```

## Метод .fadeToggle()

Вызов этого метода приводит к плавному исчезновению (если элемент не скрыт) или появлению (если элемент скрыт) выбранных элементов на странице, за счет изменения прозрачности. после скрытия элемента, его css-свойство display становится равным none, а перед появлением, оно получает свое прежнее значение обратно. 

```js
.fadeToggle([duration],[easing],[callback])
```
duration — продолжительность выполнения анимации (появления или скрытия). Может быть задана в миллисекундах или строковым значением 'fast' или 'slow' (200 и 600 миллисекунд). По умолчанию, анимация будет происходить за 400 миллисекунд.

easing — изменение скорости анимации (будет ли она замедляется к концу выполнения или наоборот ускорится).

callback — функция, заданная в качестве обработчика завершения анимации (появления или скрытия). Ей не передается никаких параметров, однако, внутри функции, переменная this будет содержать DOM-объект анимируемого элемента. Если таких элементов несколько, то обработчик будет вызван отдельно, для каждого элемента.

## Примеры использования:
```js
$("#leftFit").fadeToggle()  // скроет/покажет элемент с идентификатором leftFit за 400 мс.

$("#leftFit").fadeToggle(300) // в течении 1/3 секунды скроет/покажет элемент с идентификатором leftFit.

$("#leftFit").fadeToggle("slow")  // в течении 600 мс скроет/покажет элемент с идентификатором leftFit.
```

# Выполнение пользовательской анимации

## .animate()

Выполняет заданную пользователем анимацию, с выбранными элементами. Анимация происходит за счет плавного изменения CSS-свойств у элементов. 

Функция имеет два варианта использования:

## .animate(properties, [duration], [easing], [callback])

properties — список CSS-свойств, участвующих в анимации и их конечных значений.

duration — продолжительность выполнения анимации. Может быть задана в миллисекундах или строковым значением 'fast' или 'slow' (200 и 600 миллисекунд).

easing — изменение скорости анимации (будет ли она замедляется к концу выполнения или наоборот ускорится). 

callback — функция, которая будет вызвана после завершения анимации.

## .animate(properties, options)

properties — список CSS-свойств, участвующих в анимации и их конечных значений.

options — дополнительные опции. Должны быть представлены объектом, в формате опция:значение. 

### Варианты опций:

- duration — продолжительность выполнения анимации
- easing — изменение скорости анимации (будет ли она замедляется к концу выполнения или наоборот ускориться). 
- complete — функция, которая будет вызвана после завершения анимации.
- step — функция, которая будет вызвана после каждого шага анимации.
- queue — булево значение, указывающее, следует ли помещать текущую анимацию в очередь функций. В случае false, анимация будет запущена сразу же, не вставая в очередь.
- specialEasing — позволяет установить разные значения easing, для разных CSS-параметров. Задается объектом, в формате параметр:значение. 


## Выполнение нескольких анимаций

При одновременном вызове нескольких эффектов, применительно к одному элементу, их выполнение будет происходить не одновременно, а поочередно. 

Например при выполнении следующих команд:
```js
  $("#my-div").animate({height: "hide"}, 1000);
  $("#my-div").animate({height: "show"}, 1000);
```
элемент с идентификатором my-div, в начале будет плавно исчезать с экрана, а затем начнет плавно появляться вновь. Однако, анимации, заданные на разных элементах, будут выполняться одновременно:

```js
  $("#my-div-1").animate({height: "hide"}, 1000);
  $("#my-div-2").animate({height: "show"}, 1000);
```

## Параметр properties

Задается объектом, в формате css-свойство:значение. Это очень похоже на задание группы параметров в методе .css(), однако, properties имеет более широкий диапазон типов значений. Они могут быть заданы не только в виде привычных единиц: чисел, пикселей, процентов и др., но еще и относительно: {height:"+=30", left:"-=40"} (увеличит высоту на 30 пикселей и сместит вправо на 40). Кроме того, можно задавать значения "hide", "show", "toggle", которые скроют, покажут или изменят видимость элемента на противоположную, за счет параметра, к которому они применены. 

Например
```js
$('div').animate(
  {
    opacity: "hide",
    height: "hide"
  },
5000);
```
Скроет div-элементы, за счет уменьшения прозрачности и уменьшения высоты (сворачиванием) элемента.

в параметре properties можно указывать только те css-свойства, которые задаются с помощью числовых значений. Например, свойство background-color использовать не следует.

Величины, которые в css пишутся с использованием дефиса, должны быть указаны без него (не margin-left, а marginLeft).

## Обработчик завершения анимации

Функция, заданная в качестве обработчика завершения анимации не получает параметров, однако, внутри функции, переменная this будет содержать DOM-объект анимируемого элемента. Если таких элементов несколько, то обработчик будет вызван отдельно, для каждого элемента.

## Параметр easing

Этот параметр определяет динамику выполнения анимации — будет ли она проходить с замедлением, ускорением, равномерно или как то еще. Параметр easing задают с помощью функции. В стандартном jQuery доступны лишь две такие функции: 'linear' и 'swing' (для равномерной анимации и анимации с ускорением). По умолчанию, easing равняется 'swing'. Другие варианты можно найти в плагинах, например, jQuery UI.

Существует возможность задавать разные значения easing для разных css-свойств, при выполнении одной анимации. Для этого нужно воспользоваться вторым вариантом функции animate() и задать опцию specialEasing. Например:

```js
$('#clickme').click(function() {
  $('#book').animate({
    opacity: 'toggle',
    height: 'toggle'
  }, {
    duration: 5000, 
    specialEasing: {
      opacity: 'linear',
      height: 'swing'
    }
  });
});
```
в этом случае изменение прозрачности будет происходить равномерно (linear), а высота будет изменяться с разгоном в начале и небольшим торможением в конце (swing).

# Позиция элемента

## .offset()  .position()

С помощью этих функций, можно узнавать координаты элемента на странице. Кроме этого, с помощью offset(), можно изменить координаты элемента. Имеется несколько вариантов использования функций:

## .offset() .position()

обе функции возвращают координаты выбранного элемента (JS объект с полями top и left). Если выбрано несколько элементов, то значение будет взято у первого. Метод offset возвращает координаты относительно начала страницы, а position относительно ближайшего родителя, у которого задан тип позиционирования (css-свойство position равно relative или absolute или fixed).

## .offset(value)

изменяет координаты всех выбранных элементов делая их равными value. Значение value должен быть объектом с двумя полями — {top:newTop, left:newLeft}.

## .offset(function(index, value))

устанавливает новое значение координат элементов, которое возвращает пользовательская функция. Функция вызывается отдельно для каждого из выбранных элементов. При вызове ей передаются следующие параметры: index — позиция элемента в наборе, value — текущие координаты элемента.

### Примеры использования:
```js
$("div.content").offset() // возвратит координаты первого div-элемента с классом content, относительно начала страницы.

$("div.content").position() // возвратит координаты первого div-элемента с классом content, относительно ближайшего родителя с заданным позиционированием.

$(".content").offset({top:30, left:100})  // устанавливает координаты относительно начала страницы, равные (100, 30) для всех элементов с классом content.
```

при изменении координат с помощью функции offset, все выбранные элементы, у которых не задан тип позиционирования (то есть position = static), автоматически изменят позиционирование на относительное (relative).


# Поиск элемента с заданным номером

```
.eq()
```
Возвращает элемент, идущий под заданным номером в наборе выбранных элементов. 
```js
.eq(index)
```
index — номер искомого элемента в наборе. Может быть задан двумя способами: стандартно, как в массиве, то есть нумерация будет начинаться с 0. Кроме этого, можно задать index отрицательным целым числом, и в таком случае, элементы будут браться с конца: -1 — последний элемент, -2 — предпоследний, и.т.д.

## Примеры использования:
```js
$("div").eq(0)  // вернет первый div-элемент на странице.
$("div").eq(-1) // вернет последний div-элемент на странице.
$("div.lBlock").eq(5) // вернет шестой по счету div-элемент с классом lBlock.
```

## 03.html

```js
$('.addcart').click(function() {
        var y = 180;
        $('.contentItem').css({
          'transform': 'rotateY(' + y + 'deg)'
        });

        var imgtodrag = $(this).parents('.singleMember').find("img").eq(0);
        
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
                .appendTo($('body'));
        }        
```
## 04.html

```js

$('.addcart').click(function() {
        var y = 180;
        $('.contentItem').css({
          'transform': 'rotateY(' + y + 'deg)'
        });

        var imgtodrag = $(this).parents('.singleMember').find("img").eq(0);
        
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
        
            .appendTo($('body'))
                .animate({
                'top': $('.shopping-cart').offset().top + 10,
                    'left': $('.shopping-cart').offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'linear');
        
        }        
        
        $('.shopping-cart').fadeOut(1000, function() {
                $(this).css({
                    'backgroundColor':'rgba(255,0,0,0.5)',
                    'borderRadius': '50%',
                    'transform': 'scale(2, 2)'
                    });
            });
      

        $('.shopping-cart').fadeIn(500);
```

# Удаление объектов

## Методы для удаления элементов страницы.
```
.remove([selector])  .detach([selector])
```
Удаляют выбранные элементы на странице. В качестве параметра можно указать селектор и тогда удалены будут только те выбранные элементы, которые ему удовлетворяют. 

Различие двух рассматриваемых методов заключается в том, что при использовании detach, jQuery не удаляет информацию о элементе и поэтому он может быть восстановлен. Например:
```js
var foo = jQuery('#foo');
 
foo.detach(); //удаляем элемент
 
//много-много кода
 
foo.appendTo('body'); //вставляем элемент обратно на страницу (не обязательно в то же место, где он был)
```

## 05.html
```js
$('.addcart').click(function() {
        var y = 180;
        $('.contentItem').css({
          'transform': 'rotateY(' + y + 'deg)'
        });

        var imgtodrag = $(this).parents('.singleMember').find("img").eq(0);
        
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
        
            .appendTo($('body'))
                .animate({
                'top': $('.shopping-cart').offset().top + 10,
                    'left': $('.shopping-cart').offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'linear');
        
        }        
        
        $('.shopping-cart').fadeOut(1000, function() {
                $(this).css({
                    'backgroundColor':'rgba(255,0,0,0.5)',
                    'borderRadius': '50%',
                    'transform': 'scale(2, 2)'
                    });
            });
      

        $('.shopping-cart').fadeIn(500);

        imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
```

# jQuery extend

```js

  jQuery.extend( jQuery.easing, {
  
      easeInOutExpo: function (x, t, b, c, d) {
            if (t==0) return b;
            if (t==d) return b+c;
            if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
            return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
        },
  });

```

## 06.html

```js
            .appendTo($('body'))
                .animate({
                'top': $('.shopping-cart').offset().top + 10,
                    'left': $('.shopping-cart').offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');

```
## 07.html

```html

    <script id="cartItem" type="text/template">
        
        <li>
        <span class="productInCart"></span>
           <span class="qty item-quantities">
            </span>

            <div class="item-prices">
            </div>
            <a class="item-remove img-replace" href="#0"></a>
        
        </li>

    </script>

```
## Javascript
```js
      $('.addcart').click(function() {
        var y = 180;
        $('.contentItem').css({
          'transform': 'rotateY(' + y + 'deg)'
        });

        var imgtodrag = $(this).parents('.singleMember').find("img").eq(0);
        
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
            })
        
            .appendTo($('body'))
                .animate({
                'top': $('.shopping-cart').offset().top + 10,
                    'left': $('.shopping-cart').offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
        
        }        
        
        $('.shopping-cart').fadeOut(1000, function() {
                $(this).css({
                    'backgroundColor':'rgba(255,0,0,0.5)',
                    'borderRadius': '50%',
                    'transform': 'scale(2, 2)'
                    });
            });
      

        $('.shopping-cart').fadeIn(500);

        imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });

    $('.contentItem').delay(3000).queue(function() {
      $(this).css({
        'transform': 'rotateY(0deg)'
      }).dequeue();
      $('.singleMember p').slideDown();
      $('.menu').css('top', '80%');
      $('.icon').toggle();
    });


    var $templateCart = $($('#cartItem').html());

    var productId = $(this).parents(".contentItem").attr("productId");

    $templateCart.attr('id', 'product_' + productId);
        
    $templateCart.find('.item-prices').attr('id', "price_"+productId);

    $templateCart.find(".item-quantities").attr('id', "qty_"+productId);

    $templateCart.find(".item-quantities").text($(this).parents(".singleMember").find(".quantity").val());
        
    $templateCart.find(".item-quantities").after(' '+$(this).parents(".singleMember").children(".product-name").attr("productName")); 
        
    $templateCart.find('.item-prices').text($(this).parents(".singleMember").children(".product-price").attr("productPrice"));

    $(".cart-items").append($templateCart);

    $('.singleMember .icon').css('display', 'block'); 
    $('.singleMember .buy').css('display', 'block'); 
    $('.singleMember .detail').css('display', 'none'); 
  });


```

# Фильтрация выбранных элементов
```
.filter()
```
Фильтрует набор выбранных элементов. 

Метод имеет два варианта использования:

## .filter(selector)

Фильтрует набор элементов, оставляя только те, которые удовлетворяют селектору selector.

## .filter(function(index))

Фильтрует набор элементов c помощью заданной функции. Эта функция вызывается отдельно, для каждого из выбранных элементов. Если она возвращает true, то текущий элемент будет включен в конечный результат. Сами элементы доступны в функции, в переменной this, а их порядковые номера в наборе — в переменной index.

Примеры использования:
```js
$("div").filter(".lBlock")  // вернет div-элементы с классом lBlock.

$("div").filter(filterDivs) // вернет div-элементы, "одобренные" функцией filterDivs.

```

## 08.html

```js
var $templateCart = $($('#cartItem').html());

    var productId = $(this).parents(".singleMember").attr("productId");
    
    var items = $(".cart-items").children();
    
    var $matched = null,  quantity = 0, $p=0;

    $matched = items.filter(function (index) {
         var $this = $(this);
        return $this.attr("id") === "product_"+productId;
    });
    
    if ($matched.length) {
        quantity = + parseInt($matched.find('.qty').text()) + parseInt($(this).parents(".singleMember").find(".quantity").val());
        $p = $matched.find('.item-prices').text();
        $matched.find('.qty').text(quantity);
    } else {

    $templateCart.attr('id', 'product_' + productId);
        
    $templateCart.find('.item-prices').attr('id', "price_"+productId);

    $templateCart.find(".item-quantities").attr('id', "qty_"+productId);

    $templateCart.find(".item-quantities").text($(this).parents(".singleMember").find(".quantity").val());
        
    $templateCart.find(".item-quantities").after(' '+$(this).parents(".singleMember").children(".product-name").attr("productName")); 
        
    $templateCart.find('.item-prices').text($(this).parents(".singleMember").children(".product-price").attr("productPrice"));

    $(".cart-items").append($templateCart);
    
  }
```

## 09.html

```js

$('body').on('click', '.cart-items .item-remove', function () {
        var $this = $(this),
        $item = $this.parents('li');
        $item.remove();
    });

```
