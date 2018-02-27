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
            <div class="col-md-2">
                <?php
                include_once VIEWS.'profile/_aside.php';
                ?>
            </div>
            <div class="col-md-10">
                <div class="content-box-large">
                    <div class="panel-heading">
                        <div class="panel-title"><h6><?= $subtitle;?></h6></div>
                    </div>

                    <div class="panel-body">
                    <?php if(count($orders)>0):?>
                      <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Дата оформления</th>
                                <th>Статус заказа</th>
                                <th>Action</th>
                                </tr>
                            </thead>

                          <tbody class="table-items">
                            <?php foreach ($orders as $order):?>
                              <tr>
                                <td><?= $order['id']?></td>
                                <td><?= $order['formated_date']?></td>

                                <td><?php echo Order::getStatusText($order['status']);?></td>

                                <td>
                                <a title="Show order" href="/profile/orders/view/<?= $order['id']?>">
                                <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button></a>

                                <a title="Edit Order" href="/profile/orders/edit/<?= $order['id']?>">
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>

                                <a title="Delete Order" href="/profile/orders/delete/<?= $order['id']?>">
                                <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></a></td>
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
            </div>
        </div>

    </div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
