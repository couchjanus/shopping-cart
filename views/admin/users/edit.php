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
                <div class="panel-title"><?= $title;?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>
          <form class="form-horizontal" role="form" method="POST">

            <div class="panel-body">
                <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']?>">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="email">User Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']?>">
                        </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-2 control-label" for="password">User Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" value="<?= $user['password']?>">
                        </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-2 control-label" for="role">User Role</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control" id="role">
                                <option value="0">Select ...</option>
                                <option value="1">Admin</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="status">User Status</label>
                        <div class="col-sm-10">
                            <input  class="form-control" type="checkbox" name="status" <?php if ($user['status'] == 1) echo ' checked'; ?>>
                        </div>
                </div>

                <hr>
                
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Update User</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
require_once VIEWS.'shared/admin/footer.php';
