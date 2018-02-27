<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>
<!-- product Start -->
<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title"><?=$title;?></h3>
                    <h4 class="feature_sub">Hello There <?= $user['name']; ?>!</h4>
                    <div class="divider"></div>
                </div>
      
            </div>  <!-- Col-md-12 End -->
        </div>
        <div class="row">
            <div class="col-md-3">
                <?php
                include_once VIEWS.'profile/_aside.php';
                ?>
            </div>
            <div class="col-md-9">
                <div class="content-box-large">
                    <div class="panel-heading">
                        <div class="panel-title"><h6><?= $subtitle;?></h6></div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
