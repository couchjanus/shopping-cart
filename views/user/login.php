<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>
<section class="product">
    <div class="container">
        <div class="row">
          <div class="col-md-12">

          <?php if (isset($data['errors']) && is_array($data['errors'])):?>
            <div class="jumbotron">
              <h4>Eroors:</h4>
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
                    <div id="login">
                      <h1>Welcome Back!</h1>

                      <form method="post" autocomplete="off">

                        <div class="field-wrap">
                        <label for="email">Email Address 
                          <span class="req">*</span>
                        </label>
                        <input type="email" name="email" id="email" required autocomplete="new-password" placeholder = ''/>
                      </div>

                      <div class="field-wrap">
                        <label>
                          Password<span class="req">*</span>
                        </label>
                        <input type="password" name="password" required autocomplete="new-password"/>
                      </div>

                      <p class="forgot"><a href="#">Forgot Password?</a></p>

                      <input type="submit" class="button button-block" value="Log In" />

                      </form>
                  </div><!-- content -->

            </div> <!-- /form -->
      </div>
    </div>
  </div>
</div>
</section>
<?php

require_once VIEWS.'shared/footer.php';
