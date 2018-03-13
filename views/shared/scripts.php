<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
<script id="productTemplate" type="text/template">

  <div class="contentItem text-center">
    <div class="singleMember">
          <p class="product-name">Very&nbsp;Nice&nbsp;Cat</p>
          <div class="icon">
            <div class="icon_bg"></div>
            <i class="fa fa-shopping-cart fa-2x"></i>
          </div>
          <div class="image">
            <img src="images/1.jpg" alt="image" width="260" />
          </div>
          <div class="menu">
            <div class="price product-price">
              $9.99
            </div>
            <div class="buy">
              Buy now!
            </div>
            <div class="detail">
              Detail
            </div>

            <div class="howmany">
              <div class="quantity-input">
                <input class="minus btn" type="button" value="-">
                <input class="input-text quantity text" value="3" size="4">
                <input class="plus btn" type="button" value="+">
              </div>
            </div>
            <div class="cancel">
              Cancel
            </div>
            <div class="addcart">
              Add to Cart!
            </div>
          </div>
     </div>
     <div class="card_back">
          <i class="fa fa-check fa-4x"></i>
          <p>Success!</p>
     </div>
     <spam class="productDescription" hidden></spam> 
  </div>  <!-- item wrapper end -->
</script>

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

<script id="productDetail" type="text/template">

<figure class="singleMember item">                
    <h4 class="productName"></h4>
    <div class="image-detail">
      <img class="slide" src="images/1.jpg" />
      <img class="slide" src="images/2.jpg" style="display:none;" />
      <img class="slide" src="images/3.jpg" style="display:none;" />
      <img class="slide" src="images/4.jpg" style="display:none;" />
    </div>
    <button class="prev">&#10094;&#10094;</button>
    <button class="next">&#10095;&#10095;</button>
    <figcaption class="productPrice" productPrice="">
      <p class="productDescription"></p>    
      <span class="price">
        $00.00
      </span>
    </figcaption>
    <a class="add-to-cart addcart" href="#">Add to Cart</a>
  </figure>

</script>


<script id="step1" type="text/template">
  <div id="wrap">

    <div class="step">
      <div class="number">
        <span>1</span>
      </div>
      <div class="title">
        <h1>Order Information</h1>
      </div>
    </div>
    
    <div class="content order" id="address">
      
      <form class="go-right">
        
        <div>
        <input type="name" name="user_name" value="" id="first_name" placeholder="Your Name" data-trigger="change" data-validation-minlength="1" data-type="name" data-required="true" data-error-message="Enter Your First and Last Name"/><label for="first_name">Your Name</label>
        </div>

        <div>
        <input type="phone" name="telephone" value="" id="telephone" placeholder="Phone(555)-555-5555" data-trigger="change" data-validation-minlength="1" data-type="number" data-required="true" data-error-message="Enter Your Telephone Number"/><label for="telephone">Telephone</label>
        </div>
        <div class="content" id="final_products">
        <div id="ordered">
        <div class="totals">
          <span class="subtitle">Subtotal <span id="sub_price">$45.00</span></span>
          <span class="subtitle">Tax <span id="sub_tax">$2.00</span></span>
          <span class="subtitle">Shipping <span id="sub_ship">$4.00</span></span>
        </div>
        <div class="final">
          <span class="title">Total <span id="calculated_total">$51.00</span></span>
        </div>
        <br>
        </div>
        
      </form>
    <div class="complete">
    
          <a class="big_button" id="complete">Complete Order</a>
          <span class="sub">By selecting this button you agree to the purchase and subsequent payment for this order.</span>
    
        </div>
        
        </div>
    </div>
  </div>
</script>
  
  <script src="/js/app.js"></script>

  <script>
  
$(function() {

try {
    
  var url = '/api/shop';

  fetch(url).then((response) => response.json())
    .then((data) => {

      var shoppingCart = [];
      console.log(data);
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

    function saveCart() {
    
      if (window.localStorage)
        {
          localStorage.shoppingCart = JSON.stringify(shoppingCart);
          
        }
    }
      if (localStorage.shoppingCart){

      shoppingCart = JSON.parse(localStorage.shoppingCart);
    
    }

    function makeItem($template, product){

      $template.find('.singleMember').attr('productId', product["id"]);


      $template.find('.product-name').text(product.name.replace(/ /g, '\u00a0')).attr('productName', product["name"]);
            
      $template.find('img').attr('src', "/media/"+ product.picture);
      $template.find('.product-price').text('$' + product["price"]).attr('productPrice', product["price"]);

      $template.find('.productDescription').text( product["description"]);

      return $template;
    }

    const cart_trigger = $('#cart-trigger'),
          cart = $('#cart'),
          shadow_layer = $('#shadow-layer');

    const close = $('.close');
    const megacatalog = $('#megacatalog');
    const mega = $('.mega-menu');

    megacatalog.click(() => {
      mega.addClass('active');
    });

    close.click(() => {
      mega.removeClass('active');
    });

    cart_trigger.on('click', () => {
      toggle_panel(cart, shadow_layer);
      showCart();
    });

    for (var i=0; i<Object.keys(data).length; i++){
        var $template = $($('#productTemplate').html());

        $(".product-items").append(makeItem($template, data[i]));
    }
  
  $('body').on('click', '.buy', function() {

        $(this).parents('.singleMember').find('p').slideUp();
        $(this).parents('.singleMember').find('.menu').css('top', '40%');
        $(this).parents('.singleMember').find('.icon').css('display', 'none'); 
        $(this).parents('.singleMember').find('.buy').css('display', 'none'); 
        $(this).parents('.singleMember').find('.detail').css('display', 'block'); 
        
      });
    
      $('.cancel').click(function() {
        $(this).parents('.singleMember').find('p').slideDown();
        $(this).parents('.singleMember').find('.menu').css('top', '80%');
        $(this).parents('.singleMember').find('.icon').css('display', 'block'); 
        $(this).parents('.singleMember').find('.buy').css('display', 'block'); 
        $(this).parents('.singleMember').find('.detail').css('display', 'none'); 
      });
    
      $('.addcart').click(function() {

        let id = $(this).parents('.singleMember').attr("productId");
        let price = $(this).parents(".singleMember").find(".product-price").attr("productPrice");
        let name = $(this).parents(".singleMember").children(".product-name").text();
        let quantity = $(this).parents(".singleMember").find(".quantity").val();
        let picture = $(this).parents(".singleMember").find("img").attr('src');

        $(this).parents('.contentItem').css({
          'transform': 'rotateY(180deg)'
        });

        let imgtodrag = $(this).parents('.singleMember').find("img").eq(0);
        
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

    

    for (let i in shoppingCart) {
      if(shoppingCart[i].Product == name)
        {
         shoppingCart[i].Quantity = parseInt(shoppingCart[i].Quantity) + parseInt(quantity);
         saveCart();
         return;
        }
    }
   
    let item = { 
      Id: id, 
      Product: name,  
      Price: price, 
      Quantity: quantity, 
      Picture: picture 
    }; 
    
    shoppingCart.push(item);

    saveCart();

    $('.singleMember .icon').css('display', 'block');
    $('.singleMember .buy').css('display', 'block'); 
    $('.singleMember .detail').css('display', 'none'); 
  });

   $('body').on('click', '.cart-items .item-remove', function () {
      var $this = $(this);
      var index = $this.parent().attr("product_id");

      shoppingCart.splice(shoppingCart.indexOf(shoppingCart.find(x => x.Id === index)),1); 
      
      var $item = $this.parents('li');
      $item.remove();
      saveCart();
      updateTotal();
    });

   $('body').on('click', '#cart .clear-cart', function () {
   
      localStorage.removeItem('shoppingCart');
      $("#cartBody").empty();
      shoppingCart = [];
      updateTotal();
   });

  $('body').on('click', '.detail', function() {

    var $template = $($('#productDetail').html());
    
    $template.find('.productPrice').attr('productPrice', $(this).parents(".singleMember").find(".product-price").attr("productPrice"));

    $template.find('.price').text('$' + $(this).parents(".singleMember").find(".product-price").attr("productPrice"));

    $template.find('.productDescription').text($(this).parents(".contentItem").find(".productDescription").text());

    $template.find('.productName').attr('productName', $(this).parents(".singleMember").children(".product-name").attr("productName")).text($(this).parents(".singleMember").children(".product-name").attr("productName"));

    $template.find('.productId').attr('productId', $(this).parents(".singleMember").attr("productId"));

    $(".product-items").empty();
    
    $(".product-items").append($template);


  let slideIndex = 1;

        const prev = $(".prev");
        const next = $(".next");

        function showSlide(n) {
          let i;
          let x = $(".slide");
          if (n > x.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = x.length}
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";  
          }

          x[slideIndex-1].style.display = "block";  
        }

        showSlide(slideIndex);

        function nextPrev(n) {
          showSlide(slideIndex += n);
        }

        next.click(function () {
            nextPrev(1);
        });

        prev.click(function () {
            nextPrev(-1);
        });
  
  });

  $('.dialog__trigger').on('click',function(){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'check',
            success: function(d) {
                if(d.r == "fail") {
                    window.location.href = d.url;
                } else {
                    console.log(d.msg);
                    toggle_panel(cart, shadow_layer);
                    $('.product-items').empty();
                    let $template = $($('#step1').html());
                    $(".product-items").append($template);
                    $('#complete').on('click',function(){
                      $.ajax({
                           type: 'POST',
                           url: 'cart',
                           dataType: 'json',
                           data: { 'val': JSON.stringify(shoppingCart) }
                          })
                          .then( function(data){
                              console.log('succsess');
                              localStorage.removeItem('shoppingCart');
                              $("#cartBody").empty();
                              shoppingCart = [];
                              updateTotal();
                              $(location).attr('href', 'profile')
                           }
                      );
                
                    });
                }
              }
            });
     });

     $(".plus").click(function() {
           var val = parseInt($(this).prev().attr('value'));
           $(this).prev().attr('value', val+1);
           });

     $(".minus").click(function() {
           var val = parseInt($(this).next().attr('value'));
           $(this).next().attr('value', val-1);
           });


  });

} catch (error) { throw error; };  

 });

</script>

  