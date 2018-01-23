<?php
include_once VIEWS.'shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>

<article class='large'>
        <h1>Добавить новню категорию</h1>
        <form action="" method="post" id="add_form">
            <p>Название категории</p>
            <input required type="text" name="name">

            <p>Статус отображения</p>
            <select name="status">
                <option value="1" selected>Отображать</option>
                <option value="0">Скрыть</option>
            </select>

            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>

</article>

<?php

include_once VIEWS.'shared/admin/footer.php';

