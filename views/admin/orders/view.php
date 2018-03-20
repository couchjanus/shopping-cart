<?php

require_once VIEWS.'shared/admin/header.php';
?>
    <div class="page-content">
      <div class="row">
      <div class="col-md-3">
        <?php
          require_once VIEWS.'shared/admin/_aside.php';
        ?>

      </div>
      <div class="col-md-9">
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
                              <th>Order Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>


                          <tbody class="table-items">
                          
                            <tr>
                              <td><?php echo $order['id']?></td>
                              <td><?php echo $order['user_id']?></td>
                              <td><?= $order['order_date']?></td>
                              <td><?php echo Order::getStatusText($order['status']);?></td>
                              
                              <td>
                                <?php
                                

                                foreach ($products as $product) {
                                    $product = (array)$product; 
                                    echo '<img src = "'.$product['Picture'].'" width=70 height=40>'.$product['Product']."</a></br>";
                                    echo "<span>Кол-во: </span>" . $product['Quantity'].'</br>';
                                    echo '<span>Цена: </span>' . $product['Price']. ' грн</br>';
                                    //считаем общую сумму всех товаров в заказе, с учетом их кол-ва
                                    echo '<span>Сумма: </span>' .  $product['Price'] * $product['Quantity']. ' грн</br>';
                                    //подсчитываем сумму по каждому товару и пишем в массив
                                    $arr[] = $product['Price'] * $product['Quantity'];
                                }
                                ?>
                                </td>
                            </tr>
                            

                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

<?php
require_once VIEWS.'shared/admin/footer.php';
