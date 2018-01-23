<?php
include_once VIEWS.'shared/admin/header.php';
?>
<div class="page-content">
   <div class="row">
        <div class="col-md-2">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
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
          <form class="form-horizontal" role="form" id="idForm">
            
            <div class="panel-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Product Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                        </div>
                </div>
                <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Product Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Product Price">
                        </div>
                </div>
                <div class="form-group">
                        <label for="category" class="col-sm-2 control-label">Product Category</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category" name="category" placeholder="Product category">
                        </div>
                </div>
                <div class="form-group">
                        <label for="brand" class="col-sm-2 control-label">Product Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="brand" name="brand" placeholder="Product brand">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">Product Description</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="description" name="description" placeholder="Product Description">
                        </div>
                </div>

                <div class="form-group">
                        <label for="is_new" class="col-sm-2 control-label">Is New</label>
                        <div class="col-sm-10">
                            <select name="is_new" class="form-control">
                                <option value="1" selected>Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" selected>Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Add Product</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';
