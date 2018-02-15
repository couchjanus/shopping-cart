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
                <div class="panel-title"><?= $title;?> <?= $product['name']?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>

          <form class="form-horizontal" role="form" method="POST" id="idForm">

            <div class="panel-body">
                
                <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Product Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']?>">
                        </div>
                </div>
                <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Product Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="<?= $product['price']?>">
                        </div>
                </div>
 
                <div class="form-group">
                  <label for="category" class="col-sm-2 control-label">Product Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="category" name="category">
                        <?php if (is_array($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"
                                    <?php if ($product['category_id'] == $category['id']) echo ' selected'; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                        <label for="brand" class="col-sm-2 control-label">Product Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="brand" name="brand" value="<?= $product['brand']?>">
                        </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">Product Description</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="description" name="description" value="<?= $product['description']?>">
                        </div>
                </div>

                <div class="form-group">
                        <label for="is_new" class="col-sm-2 control-label">Is New</label>
                        <div class="col-sm-10">
                            <select name="is_new" class="form-control">
                                <option value="1" <?php if($product['is_new'] == 1) echo 'selected'?>>Да</option>
                                <option value="0" <?php if($product['is_new'] == 0) echo 'selected'?>>Нет</option>
                            </select>
                        </div>
                </div>

                <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" <?php if($product['status'] == 1) echo 'selected'?>>Отображается</option>
                                <option value="0" <?php if($product['status'] == 0) echo 'selected'?>>Скрыт</option>
                            </select>
                        </div>
                </div>
            
                
            </div>
            <hr>
            <div class="panel-body">
                
                <div class="form-group">
                <label for="meta_title" class="col-sm-2 control-label">Page Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $metas['title']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="col-sm-2 control-label">Page meta description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?= $metas['description']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keywords" class="col-sm-2 control-label">Page meta keywords</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?= $metas['keywords']?>">
                </div>
            </div>
            <div class="form-group">
                <label for="meta_links" class="col-sm-2 control-label">Page meta links</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_links" name="meta_links" value="<?= $metas['links']?>">
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
