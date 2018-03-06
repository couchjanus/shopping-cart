<?php
include_once VIEWS.'shared/admin/header.php';
?>
<div class="page-content">
   <div class="row">
        <div class="col-md-3">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
        ?>
        </div>
      <div class="col-md-9">
        <div class="content-box-large">
          <div class="panel-heading">
                <div class="panel-title"><?= $title;?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>
          <form class="form-horizontal" role="form" method="POST"  id="idForm" enctype="multipart/form-data">

            <div class="panel-body">
                <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Picture Title</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Picture Title">
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">Picture Description</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" id="description" name="description">Picture Description</textarea>
                        </div>
                </div>

                <div class="form-group" id="drop-area">
                    <label for="image" class="col-sm-2 control-label">Picture</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="fileElem" multiple accept="image/*" name="image"> 
                        <p>Drop Picture Here</p>
                    </div>
                </div>
                <hr>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Add Picture</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';
