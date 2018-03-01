<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>
 <!-- Start -->
<section class="product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="feature_header text-center">
          <h2 class="feature_title"><?= $title;?></h2>

          <div class="divider"></div>
        </div>
      </div>  <!-- Col-md-12 End -->
      
      <div class="items">
    
        <?php if ($success == true) :?>
          <h3><?= $num_rows;?></h3>
          <ul>
            <?php foreach($posts as $singleItem): ?>
              <li>
                <h3><?php echo $singleItem['title']?></h3>
                  <p><?php echo $singleItem['formated_date'];?></p>
                  <a href="/blog/<?php echo $singleItem['id']; ?>">Read More</a>
              </li>
            <?php endforeach; ?>
          </ul> 

        <?php else : ?>
          <ul>
            <?php foreach($errors as $error): ?>
              <li>
                <?php echo $error;?>
              </li>
            <?php endforeach; ?>
          </ul> 
        <?php endif;?>
      </div>
    </div>
  </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>
<?php require_once VIEWS.'shared/footer.php';
