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