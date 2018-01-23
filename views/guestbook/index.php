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
                    <h3 class="feature_title">Cat's <b>GuestBook</b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="col-md-10">
                        <div class="content-box-large">
                            <div class="panel-heading">
                                <div class="panel-title">Enter your guestbook comments here:</div>
                              
                                <div class="panel-options">
                                  <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                  <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="">
                                  <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">Your Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="username" placeholder="Your Name" name="username">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Your Email</label>
                                    <div class="col-sm-10">
                                      <input type="email" class="form-control" id="email" placeholder="Your Email" name="email">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Your Comment</label>
                                    <div class="col-sm-10">
                                      <textarea class="form-control" placeholder="Your Comment" rows="3" name="comment"></textarea>
                                    </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary">Add Comment</button>
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>
            </div>
            
            <div class="clearfix"></div>

              Past comments.... 
                 count: <?php // echo $count;?>
                 <br>
                 <?php // echo $comments;
                 echo '<pre>';
                 
                 echo htmlspecialchars(print_r($comments, true));
                 
                 echo '</pre>';

                // foreach ($comments as $key => $value) {
                //      # code...

                // echo "<div class='top'><b>User ".$value[0]."</b> <a href='mailto:".$value[1]."'>".$value[1]."</a> Added this </div>"; 
                // echo "<div class='comment'>".strip_tags($value[2])."</div>"; 
                // echo "<div class='added_at'> At: ".strip_tags($value[3])."</div>"; 
                //  }
 

                 ?>


            <?php 
             // if($resCount>0){
             //    echo "<h3>$resCount comments:</h3> ";
             //      // print_r($comments);
             //    foreach ($comments as $row) {
             //      echo "<div class='top'><b>User ".$row["username"]."</b> <a href='mailto:".$row["email"]."'>".$row["email"]."</a> Added this </div>"; 
             //      echo "<div class='comment'>".strip_tags($row["comment"])."</div>"; 
             //      echo "<div class='added_at'> At: ".strip_tags($row["appended_at"])."</div>"; 
             //    }
             // }
             // else{
             //    echo "No comments.... ";
             // }
           ?>

        </div>
    </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php
require_once VIEWS.'shared/footer.php';
?>

