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

                <form class="form-horizontal" role="form" method="POST"  id="idForm">

                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" <?php if($order['status'] == 1) echo 'selected';?>>
                                Новый
                                </option>

                                <option value="2" <?php if($order['status'] == 2) echo 'selected';?>>
                                    В обработке
                                </option>

                                <option value="3" <?php if($order['status'] == 3) echo 'selected';?>>
                                    Доставляется
                                </option>

                                <option value="4" <?php if($order['status'] == 4) echo 'selected';?>>
                                    Закрыт
                                </option>
                            </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button id="save" type="submit" class="save btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

<?php
require_once VIEWS.'shared/admin/footer.php';


