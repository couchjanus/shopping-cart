  <!-- Footer Area Start -->

<footer id="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <h3 class="menu_head">Main Menu</h3>
                    <div class="footer_menu">
                        <ul>
                            <li><a href="#about">Home</a></li>
                            <li><a href="#service">Service</a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#blog">Blog</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h3 class="menu_head">Useful Links</h3>
                    <div class="footer_menu">
                        <ul>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#"> inventore natus ullam eum</a></li>
                            <li><a href="#">consectetur adipisicing elit.</a></li>
                            <li><a href="#">Frequently Asked Questions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h3 class="menu_head">Contact us</h3>
                    <div class="footer_menu_contact">
                        <ul>
                            <li> <i class="fa fa-home"></i>
                                <span><?=APPNAME;?>, 1 Kyiv </span></li>
                            <li><i class="fa fa-globe"></i>
                                <span> +099-12345678</span></li>
                            <li><i class="fa fa-phone"></i>
                                <span> info@gmail.com</span></li>
                            <li><i class="fa fa-map-marker"></i>
                            <span> www.shopaholic.com</span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <h3 class="menu_head">Tags</h3>
                    <div class="footer_menu tags">
                        <a href="#"> Mice</a>
                        <a href="#"> Cats</a>
                        <a href="#"> Dogs</a>
                        <a href="#"> Rabbits</a>
                        <a href="#"> Crocodiles</a>
                        <a href="#"> Chicks</a>
                        <a href="#"> Dinosaurs</a>
                        <a href="#"> Skunks</a>
                        <a href="#"> Rats</a>
                        <a href="#"> Crows</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer_b">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer_bottom">
                        <p class="text-block"> &copy; Copyright reserved to <span>Janus </span></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer_mid pull-right">
                        <ul class="social-contact list-inline">
                            <li> <a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li> <a href="#"><i class="fa fa-rss"></i></a></li>
                            <li> <a href="#"><i class="fa fa-google-plus"></i> </a></li>
                            <li><a href="#"> <i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"> <i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
<div id="shadow-layer"></div>

    <div id="cart">
        <h2>Cart</h2>
        
        <ul class="cart-items" id="cartBody">

        </ul> <!-- cd-cart-items -->

        <div class="cart-total" id="cart_total">
            <p>Total <span id="allTotal">$00.00</span></p>
        </div> <!-- cd-cart-total -->

        <a href="#" class="checkout-btn">Checkout</a>

        <p class="clear-cart">Clear your shopping cart</p>
    </div> <!-- cd-cart -->

    <div class="mega-menu">
        <div class="mega-menu-top">
          <div class="mega-search">
            <label for="mega-search">Search</label>
            <input type="search" id="mega-search" placeholder="Search" />
          </div>
          <div class="close">
            <span>&#10006;</span> 
          </div>
        </div>
        <h3>Catalog</h3>
        <ul class="nav themes">
          <li>Curabitur</li>
          <li>Commodo</li>
          <li>Development</li>
          <li>Environment</li>
          <li>Diversity</li>
          <li>Ornared</li>
          <li>Faciisis</li>
          <li>Health</li>
          <li>Dignissim</li>          
          <li>Science & Tech</li>          
          <li>Visas</li>
          <li>Women & Girls</li>
        </ul>
        <footer>
          <div class="logo_footer">  
          <img src="images/logo.png" class="logo">
          </div>
          <ul class="nav footer">
            <li>Contact Us</li>
            <li>About Us</li>
            <li>Privacy Policy</li>
          </ul>
        </footer>
      </div>


<?php
require_once VIEWS.'shared/scripts.php';
?>

</body>

</html>