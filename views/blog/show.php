<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>

<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="breadcrumb"><?= $breadcrumb;?></div>
                <div class="feature_header text-center">
                    <h3 class="feature_title"><?=$title;?></h3>
                    <h4 class="feature_sub"><?=$subtitle;?></h4>
                    <div class="divider"></div>

                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="items">
              <?php 
                  echo "<h2>".$post["title"]."</h2>"; 
                  echo "<div class='added_at'> Added At: ".$post["created_at"]."</div>"; 
                  echo "<div class='content'>".$post["content"]."</div>"; 
              ?>
            </div>
        </div>
    </div> <!-- Conatiner end -->
</section>  <!-- Section End -->

<!-- End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
