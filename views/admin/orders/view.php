<?php
include_once VIEWS.'/shared/admin/header.php';
?>

    <h1><?= $title;?></h1>
    <article class='large'>
        <h3>Просмотр заказа #<?php echo $data['order']['id'];?></h3>
        <h4>Информация о заказе</h4>

        <table>
            <tr>
                <td>Номер заказа :</td>
                <td><?php echo $data['order']['id'];?></td>
            </tr>

            <tr>
                <td>Имя клиента:</td>
                <td><?php echo $data['order']['user_name'];?></td>
            </tr>

            <tr>
                <td>Телефон клиента :</td>
                <td><?php echo $data['order']['user_phone'];?></td>
            </tr>

            <tr>
                <td>ID клиента :</td>
                <td><?php echo $data['order']['user_id'];?></td>
            </tr>

            <tr>
                <td>Дата заказа :</td>
                <td><?php echo $data['order']['date'];?></td>
            </tr>

            <tr>
                <td>Статус заказа :</td>
                <td><?php echo Order::getStatusText($data['order']['status']);?></td>
            </tr>
        </table>

        <h3>Товары в заказе</h3>

        <table>

            <tr>
                <th>ID товара</th>
                <th>Код товара</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>

            <?php $i=0; foreach ($data['products'] as $product):?>
                <tr>
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['code'];?></td>
                    <td><?php echo $product['name'];?></td>
                    <td><?php echo $product['price'];?></td>
                    <td><?php echo $data['pQuantity'][$i][$product['id']]; $i++;?></td>
                    <td><?php print_r($data['pQuantity']);?></td>
                </tr>
            <?php endforeach;?>
        </table>
</article>

<?php

include_once VIEWS.'/shared/admin/footer.php';

