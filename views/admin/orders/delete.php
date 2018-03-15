<?php
include_once VIEWS.'/shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>

        <div class="container_admin_del">
        <h4>Удалить заказ #<?php echo $data['id']; ?></h4>
        <p>Вы действительно хотите удалить этот заказ?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
    </div>

</main>
<?php

include_once VIEWS.'/shared/admin/footer.php';


