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
      <div class="col-md-3">
        <?php require_once VIEWS.'profile/_aside.php';?>
      </div>
      <div class="col-md-9">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title"><h6><?= $subtitle;?></h6></div>
          </div>

          <div class="panel-body">
                    
            <div class="table-responsive">
              <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Дата заказа</th>
                        <th>Статус</th>
                        <th>Товары в заказе</th>
                    </tr>
                </thead>

                <tbody class="table-items">
                    <tr>
                        <td><?= $order['id']?></td>
                        <td><?= $order['order_date']?></td>
                        <td><?php echo Order::getStatusText($order['status']);?></td>
                        <td>
                            <?php 
                                // Преобразуем JSON  строку продуктов и их кол-ва в массив
                                $Products = json_decode(json_decode($order['products'], true));
                                        
                                for ($i=0; $i<count($Products); $i++) {
                                    $productArr = (array)$Products[$i];
                                    echo '<a href="/products/'.$productArr['Id'].'">';
                                    echo '<img src = "'.$productArr['Picture'].'" width=70 height=40>'.$productArr['Product']."</a></br>";
                                    echo "<span>Кол-во: </span>" . $productArr['Quantity'].'</br>';
                                    echo '<span>Цена: </span>' . $productArr['Price']. ' грн</br>';
                                    //считаем общую сумму всех товаров в заказе, с учетом их кол-ва
                                    echo '<span>Сумма: </span>' .  $productArr['Price'] * $productArr['Quantity']. ' грн</br>';
                                    //подсчитываем сумму по каждому товару и пишем в массив
                                    $arr[] = $productArr['Price'] * $productArr['Quantity'];
                                }
                                $totalValue = array_sum($arr);
                            ?>
                        </td>
                    </tr>
                    
                    <tr class="total_price">
                        <td colspan="4"><?php echo '<span>Сумма заказа: ' . $totalValue.' грн</span>';?></td>
                    </tr>
                    <?php
                        //Очищаем массив
                        $arr = array();
                    ?>
                                           
                </tbody>
            </table>
          </div>
                    
        </div>
      </div>
    </div>
</div>

</div> <!-- Conatiner product end -->
</section>  <!-- Section product End -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
