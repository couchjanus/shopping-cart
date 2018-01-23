<?php
include_once VIEWS.'shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>
       

<article class='large'>
        <a href="/admin/category/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить категорию
        </a>
        <h4>Список категорий</h4>
        <table>
            <tr>
                <th>ID категории</th>
                <th>Название категории</th>
                
            </tr>

            <?php foreach ($categories as $category):?>
                <tr>
                    <td><?php echo $category['id']?></td>
                    <td><?php echo $category['name']?></td>
                    <td><a title="Редактировать" href="" class="del">
                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        </a></td>
                    <td><a title="Удалить" href="" class="del">
                            <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                        </a></td>
                </tr>
            <?php endforeach;?>
        </table>
</article>

<?php

include_once VIEWS.'shared/admin/footer.php';

