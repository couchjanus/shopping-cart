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
                    <h3 class="feature_title">Our <b>Cats Blog</b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="items">
            <?php 

            foreach ($rhyme as $k=>$v) {
                echo('<h5>'.$rhyme[$k][0].'</h5>');
                echo '<br>';
                echo('<div>'.$rhyme[$k][1].'</div>');
                echo '<br>';
            }

            ?>

            </div>
        </div>
    </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php

require_once VIEWS.'shared/footer.php';

?>

