<?php
include_once VIEWS.'/includes/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        
       

        <h2>Изменить заказ</h2>
        <form action="#" method="post" id="add_form">

            <p>Имя клиента</p>
            <input required type="text" name="name" value="<?php echo $data['order']['user_name']?>">

            <p>Телефон клиента</p>
            <input required type="text" name="phone" value="<?php echo $data['order']['user_phone']?>">

            <p>Комментарий к заказу</p>
            <input required type="text" name="comment" value="<?php echo $data['order']['user_comment']?>">

            <p>Статус заказа</p>
            <select name="status">

                <option value="1" <?php if($data['order']['status'] == 1) echo 'selected';?>>
                    Новый
                </option>

                <option value="2" <?php if($data['order']['status'] == 2) echo 'selected';?>>
                    В обработке
                </option>

                <option value="3" <?php if($data['order']['status'] == 3) echo 'selected';?>>
                    Доставляется
                </option>

                <option value="4" <?php if($data['order']['status'] == 4) echo 'selected';?>>
                    Закрыт
                </option>
            </select>


            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>

</main>
<?php

include_once VIEWS.'/includes/admin/footer.php';


