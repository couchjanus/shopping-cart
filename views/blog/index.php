<?php
    require_once VIEWS.'shared/head.php';
    require_once VIEWS.'shared/navigation.php';
?>
<!-- product Start -->
<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb"><?= $breadcrumb;?></div>
                <div class="feature_header text-center">
                    <h2 class="feature_title"><?=$title;?></h2>
                    <div class="container">
                        <div class="row">
                          <h4>Search Blog</h4>
                            <form action="/blog/search" method="post">
                            <div id="custom-search-input">
                              <div class="input-group col-md-12">
                                <input type="text" class="search-query form-control" placeholder="Search" name="query" />
                                <span class="input-group-btn">
                                  <button class="btn btn-danger" type="submit">
                                    <span class=" glyphicon glyphicon-search"></span>
                                  </button>
                                </span>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->
            <div class="items">
             
              <?php foreach($posts as $post): ?>
               <h2 class="sub-heading-a u-align-center"><?php echo $post['title']?></h3>
               <p class="body-a u-align-center"> Added At: <?php echo $post['formated_date'];?></p>
               <p class="body-a u-align-center"><?php echo substr($post['content'], 0, 100);?>... <a href="/blog/<?php echo $post['id']; ?>">Read More</a></p>
              <?php endforeach; ?>
           
            </div>
            <div class="middle">
              <?php //echo $data['pagination']->get();?>
            </div>
        </div>
        
    </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php
require_once VIEWS.'shared/footer.php';
?>
