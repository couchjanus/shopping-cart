<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>

<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title"><?=$title;?></h3>
                    <h4 class="feature_sub"><?=$subtitle;?></h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="items">
            <?php 
             if(count($posts)>0){
                foreach ($posts as $post) {
                  echo "<h2>".$post["title"]."</h2>"; 
                  echo "<div class='added_at'> Added At: ".strip_tags($post["created_at"])."</div>"; 
                  echo "<div class='content'>".strip_tags($post["content"])."</div>"; 
                }
             }
             else{
                echo "No posts yet.... ";
             }
           ?>
            </div>
        </div>
    </div> <!-- Conatiner end -->
</section>  <!-- Section End -->

<!-- End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
