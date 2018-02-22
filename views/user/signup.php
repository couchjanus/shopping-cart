<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>
<section class="product">
    <div class="container">
        <div class="row">
          <div class="col-md-12">

        <?php if($data['success']):?>
                    <!-- Jumbotron -->
                    <div class="jumbotron">
                      <h1 id="reg_thanks">Спасибо за регистрацию!</h1>
                      <h3 id="reg_main">Вернуться на <a href="/" id="reg_main_a">Главную</a></h3>
                    </div>
        <?php else: ?>

        <?php if (isset($data['errors'])):?>
          <div class="jumbotron">
            <h1>Eroors:</h1>
          </div>
          <div class="row">
            <ul class="errors">
                <?php foreach($data['errors'] as $error):?>
                    <li> - <?php echo $error;?></li>
                <?php endforeach;?>
            </ul>
          </div>  
        <?php endif;?>

        <div class="jumbotron">
           <h1><?=$title;?></h1>
        </div>

      <!-- Example row of columns -->
      <div class="row">

            <div class="form">
                    <div id="signup">
                      <h1>Sign Up for Free</h1>

                      <form method="post" action="">

                      <div class="top-row">
                        <div class="field-wrap">
                          <label>
                            First Name<span class="req">*</span>
                          </label>
                          <input type="text" name="name" value="" required autocomplete="off" />
                        </div>

                        <div class="field-wrap">
                          <label>
                            Last Name<span class="req">*</span>
                          </label>
                          <input type="text" name="lname" value="" required autocomplete="off"/>
                        </div>
                      </div>

                      <div class="field-wrap">
                        <label>
                          Email Address<span class="req">*</span>
                        </label>
                        <input type="email" name="email" value="" required autocomplete="off"/>
                      </div>

                      <div class="field-wrap">
                        <label>
                          Set A Password<span class="req">*</span>
                        </label>
                        <input type="password" name="password" value="" required autocomplete="off"/>
                      </div>

                      <input type="submit" class="button button-block" value="Get Started" />
                      </form>
                    <?php endif;?>
                    </div>
            </div> <!-- /form -->
           
      </div>
    </div>
  </div>
</div>
</section>       

<?php
require_once VIEWS.'shared/footer.php';
