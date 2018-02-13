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
          <form class="form-horizontal" role="form" method="POST"  id="idForm">

            <div class="panel-body">
                <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Post Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Post Title">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="content">Post Content</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" id="content" name="content">Post Content</textarea>
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
                
                <hr>
            <div class="panel-body">
                
                <div class="form-group">
                    <label for="meta_title" class="col-sm-2 control-label">Page Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Page Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_description" class="col-sm-2 control-label">Page meta description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Page meta description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_keywords" class="col-sm-2 control-label">Page meta keywords</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Page meta keywords">
                    </div>
                </div>
                <div class="form-group">
                    <label for="meta_links" class="col-sm-2 control-label">Page meta links</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="meta_links" name="meta_links" placeholder="Page meta links">
                    </div>
                </div>                
                
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Add Post</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';
