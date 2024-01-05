<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-gallery" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
  <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-gallery" class="form-horizontal">
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $text_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-album"><?php echo $text_album; ?></label>
            <div class="col-sm-10">
              <select name="album_id" id="input-album" class="form-control">
                <?php foreach ($albums as $album) { ?>
                <?php if ($album['album_id'] == $album_id) { ?>
                <option value="<?php echo $album['album_id']; ?>" selected="selected"><?php echo $album['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $album['album_id']; ?>"><?php echo $album['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>	
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-limit"><?php echo $text_limit; ?></label>
            <div class="col-sm-10">
              <input type="text" name="limit" value="<?php echo $limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
            <div class="col-sm-10">
              <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
              <?php if ($error_width) { ?>
              <div class="text-danger"><?php echo $error_width; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-height"><?php echo $text_height; ?></label>
            <div class="col-sm-10">
              <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
              <?php if ($error_height) { ?>
              <div class="text-danger"><?php echo $error_height; ?></div>
              <?php } ?>
            </div>
          </div>  
		<div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
<script type="text/javascript"><!--
function addModule() {	
	var token = Math.random().toString(36).substr(2);
	html  = '<tr id="module-row' + token + '">';
	html += '    <td class="text-left"><input class="form-control" type="text" name="tmdgallery_module[' + token + '][limit]" value="5" style="width:41px;" /></td>';
	html += '    <td class="text-left"><input class="form-control" type="text" name="tmdgallery_module[' + token + '][width]" value="80" size="3" /> <input class="form-control" type="text" name="tmdgallery_module[' + token + '][height]" value="80" size="3" /></td>';
	html += '    <td class="text-left"><select name="tmdgallery_module[' + token + '][album_id]" class="form-control">';
	html += '    <option value="">--Please Select--</option>';
	<?php foreach ($albums as $album) { ?>
	html += '      <option value="<?php echo $album['album_id']; ?>"><?php echo addslashes($album['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#module-row' + token + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	
	$('#module tbody').append(html);
}
//--></script> 
