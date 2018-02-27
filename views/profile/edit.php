<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>

<section class="product">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Jumbotron -->
            <div class="feature_header text-center">
              <h3 class="feature_title"><?=$title;?></h3>
              <h4 class="">Hello There <?= $user['name']; ?>!</h4>
              <div class="divider"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
                <?php require_once VIEWS.'profile/_aside.php';?>
          </div>
          <div class="col-md-9">
            <div class="content-box-large">
              <?php if($data['res']) :?>
                  <h4 id="edit_thanks">Данные успешно изменены!</h4>
                  <h3 id="to_cabinet">Вернуться в 
                    <a href="/profile" id="reg_main_a">Кабинет</a>
                  </h3>
              <?php else: ?>
                  <?php if (isset($data['errors']) && is_array($data['errors'])) :?>

                    <ul class="errors">
                        <?php foreach($data['errors'] as $error):?>
                            <li> - <?php echo $error;?></li>
                        <?php endforeach;?>
                    </ul>
                  <?php endif;?>
                
                  <form action="#" method="post">
                    <h5>Редактирование данных</h5>
                    <div class="form-group">
                        <label for="name">User name</label>
                        <input  class="form-controll" required type="text" name="name" value="<?= $data['user']['name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input required class="form-control" type="password" name="password" value="<?= $data['user']['password'] ?>">
                    </div>
                    <div class="form-group">
                      <input type=submit name="submit" value="Сохранить" class="btn btn-primary">
                    </div>
                  </form>
              <?php endif;?>
            </div>
          </div>
        </div>
    </div>
  </section>
<?php
require_once VIEWS.'/shared/footer.php';
