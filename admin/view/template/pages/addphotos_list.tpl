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
      <div class="pull-right">
				<a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a> 
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-addphotos').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
    <div class="panel-body">
		<div class="well">
          <div class="row">
		    <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-albumname"><?php echo $entry_albumname; ?></label>
                <select name="filter_albumname" id="input-albumname" class="form-control">
                  <option value=""></option>
						<?php foreach($albums as $album){?>
						<?php if($filter_albumname == $album['album_id']){?>
						<option value="<?php echo $album['album_id'];?>" selected="selected"><?php echo $album['name'];?></option>
						<?php } else {?>
						<option value="<?php echo $album['album_id'];?>"><?php echo $album['name'];?></option>
						<?php }}?>
                </select>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
		  
		  </div>
		</div>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-addphotos">
		<div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="1" class="text-center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              
            				
				 <td class="text-left"><?php if ($sort == 'image') { ?>
                <a href="<?php echo $sort_image; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_image; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_image; ?>"><?php echo $column_image; ?></a>
                <?php } ?></td>
      
      <td class="text-left"><?php if ($sort == 'title') { ?>
                <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                <?php } ?></td>
			
				
				<td class="text-right"><?php if ($sort == 'sort_order') { ?>
                <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
                <?php } ?></td>
				
              <td class="text-right"><?php echo $column_action; ?></td>
            </tr>
          </thead>	
          <tbody>
            <?php if ($addphotoss) { ?>
            <?php foreach ($addphotoss as $addphotos) { ?>
			
            <tr>
			  <td style="text-align: center;"><?php if ($addphotos['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $addphotos['album_photos_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $addphotos['album_photos_id']; ?>" />
                <?php } ?></td>
			  <td class="text-left"><img style="padding: 1px; border: 1px solid #DDDDDD;" src="<?php echo $addphotos['image']; ?>"></td>
			  <td class="text-left"><?php echo $addphotos['adname'] ?></td>
              <td class="text-right"><?php echo $addphotos['sort_order']; ?></td>
              <td class="text-right"><a href="<?php echo $addphotos['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=pages/addphotos&token=<?php echo $token; ?>';
	
	
	var filter_albumname = $('select[name=\'filter_albumname\']').val();

	if (filter_albumname != '') {
		url += '&filter_albumname=' + encodeURIComponent(filter_albumname);
	}

	location = url;
});
//--></script> 