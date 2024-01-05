<link type="text/css" href="view/stylesheet/gallery.css" rel="stylesheet" media="screen" />
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="container-fluid">
   <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="row">
	<div class="logopart">
      <div class="col-lg-3 col-md-3 col-sm-3">
		 <h1><?php echo $heading_title; ?></h1>
	  </div>
      <div class="col-lg-9 col-md-9 col-sm-9">
		<?php echo $dashmenu; ?>
	  </div>
    </div>
    </div>
	<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-gallery').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-gallery">
		<div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="text-left"><?php echo $column_image; ?></td>
              <td class="text-left"><?php echo $column_name; ?></td>
              <td class="text-right"><?php echo $column_sort_order; ?></td>
              <td class="text-right"><?php echo $column_status; ?></td>
              <td class="text-right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($gallaries) { ?>
            <?php foreach ($gallaries as $gallery) { ?>
            <tr>
              <td class="text-center;"><?php if ($gallery['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $gallery['album_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $gallery['album_id']; ?>" />
                <?php } ?></td>
              <td class="text-left"><img style="padding: 1px; border: 1px solid #DDDDDD;" src="<?php echo $gallery['image']; ?>"></td>
              <td class="text-left"><?php echo $gallery['name']; ?></td>
              <td class="text-right"><?php echo $gallery['sort_order']; ?></td>
              <td class="text-right"><?php echo $gallery['status']; ?></td>
              <td class="text-right">
			  <a href="<?php echo $gallery['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
				</td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
		</div>
      </form>
      <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
    </div>
  </div>
</div>
</div>