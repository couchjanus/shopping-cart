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
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="items">
            <?php 
             
             if($resCount>0){
                echo "<h3>$resCount posts:</h3> ";
                  // print_r($comments);
                foreach ($posts as $row) {
                  echo "<h2>".$row["title"]."</h2>"; 
                  echo "<div class='added_at'> Added At: ".strip_tags($row["created_at"])."</div>"; 
                  echo "<div class='content'>".strip_tags($row["content"])."</div>"; 
                  
                }
             }
             else{
                echo "No posts yet.... ";
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

