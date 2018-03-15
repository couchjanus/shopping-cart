<?php

require_once VIEWS.'shared/admin/header.php';
?>
    <div class="page-content">
      <div class="row">
      <div class="col-md-2">
        <?php
          require_once VIEWS.'shared/admin/_aside.php';
        ?>

      </div>
      <div class="col-md-10">
        <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title"><h3><?= $title;?></h3></div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>User Name</th>
                              <th>Order Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>


                          <tbody class="table-items">
                          <?php foreach ($orders as $order):?>
                            <tr>
                              <td><?php echo $order['id']?></td>
                              <td><?php echo $order['user_id']?></td>
                              <td><?php echo Order::getStatusText($order['status']);?></td>
                              <td>
                              <a title="Редактировать" href="/admin/orders/view/<?= $order['id']?>">
                              <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button></a>
                              
                              <a title="Редактировать" href="/admin/orders/edit/<?= $order['id']?>">
                              <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
                              <a title="Редактировать" href="/admin/orders/delete/<?= $order['id']?>">
                              <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></a></td>
                            </tr>
                            <?php endforeach;?>

                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

<?php
require_once VIEWS.'shared/admin/footer.php';
