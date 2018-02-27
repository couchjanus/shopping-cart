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
                                //Преобразуем JSON  строку продуктов и их кол-ва в массив
                                $productQuantity = json_decode(json_decode($order['products'], true));

                                $productArr = (array)$productQuantity[0];
                                $productIds = [];
                                array_push($productIds, $productArr['Id'] );
                               
                                $products = Product::getProductsByIds($productIds);

                                $totalValue = 0;

                                foreach ($products as $product): ?>

                                <a href="/products/<?= $product['id'];?>"><?= $product['name'];?></a></br>
                                
                                <?php
                                echo "<span>Кол-во: </span>" . $product['id'].'</br>';
                                
                                echo '<span>Цена: </span>' . $product['price']. ' грн</br>';
                               
                                //подсчитываем сумму по каждому товару и пишем в массив
                                $arr[] = $product['price'] * $product['id'];

                                //считаем общую сумму всех товаров в заказе, с учетом их кол-ва
                                $totalValue = array_sum($arr);
                                
                                endforeach; ?>
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
