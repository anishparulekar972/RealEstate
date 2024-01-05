<link type="text/css" href="view/stylesheet/gallery.css" rel="stylesheet" media="screen" />
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
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
			  <button type="submit" form="form-addphotos" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-addphotos" class="form-horizontal">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
					<li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
					<li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
					
				</ul>
			<div class="tab-content">  
				<div class="tab-pane active" id="tab-general">
					<ul class="nav nav-tabs" id="language">
						<?php foreach ($languages as $language) { ?>
						<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
					<?php foreach ($languages as $language) { ?>
					<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
						<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
											<div class="col-sm-10">
												<input type="text" name="photo_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($photo_description[$language['language_id']]) ? $photo_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
												<?php if (isset($error_name[$language['language_id']])) { ?>
												<div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
												<?php } ?>
											</div>
										</div>
						 <div class="form-group">
											<label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
											<div class="col-sm-10">
												<textarea name="photo_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($photo_description[$language['language_id']]) ? $photo_description[$language['language_id']]['description'] : ''; ?></textarea>
											</div>
										</div>
					</div>
					<?php } ?>
				</div>
			 </div>
			<div class="tab-pane" id="tab-data">
						<div class="form-group">
										<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
										<div class="col-sm-10">
											<select name="album_id" class="form-control">
								<option value=""><?php echo $text_select; ?></option>
								<?php foreach($albums as $album){ ?>
								<?php if($album_id == $album['album_id']){ ?>
								<option value="<?php echo $album['album_id'];?>" selected="selected"><?php echo $album['name']; ?></option>
								<?php } else{ ?>
								<option value="<?php echo $album['album_id'];?>"><?php echo $album['name']; ?></option>
								<?php } }?>
							</select>
							<?php if($error_album_id){?>
							<span class="error"><?php echo $error_album_id; ?></span>
							<?php } ?>
										</div>
						</div>
								
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
					<div class="col-sm-3">
					<input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
					</div>
				</div>
			
						
			</div>
			
			<div class="tab-pane" id="tab-image">
			<?php if(!empty($album_photos_id)){?>
			<div class="form-group">
                <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
			<?php } else { ?>
			<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-uploader"><?php echo $entry_images; ?></label>
					<div class="col-sm-10">
						<div id="uploader"></div>
						<?php if(!empty($error_images)) { ?>
						<div class="text-danger"><?php echo $error_images; ?></div>
						<?php } ?>
					</div>
			</div>
			<?php } ?>
				
				
				
			</div>
			
		</div>
		</form>
    </div>
  </div>
</div>
</div>
 <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
  
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>
<link rel="stylesheet" href="view/javascript/uploader/jquery.ui.plupload.css" type="text/css" />
<link rel="stylesheet" href="view/javascript/uploader/jquery.plupload.queue.css" type="text/css" />
<script type="text/javascript" src="view/javascript/uploader/browserplus-min.js"></script>
<script type="text/javascript" src="view/javascript/uploader/plupload.js"></script>
<script type="text/javascript" src="view/javascript/uploader/plupload.gears.js"></script>
<script type="text/javascript" src="view/javascript/uploader/plupload.silverlight.js"></script>
<script type="text/javascript" src="view/javascript/uploader//plupload.flash.js"></script>
<script type="text/javascript" src="view/javascript/uploader/plupload.browserplus.js"></script>
<script type="text/javascript" src="view/javascript/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="view/javascript/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="view/javascript/uploader/jquery.ui.plupload.js"></script>
<script type="text/javascript" src="view/javascript/uploader/jquery.plupload.queue.js"></script>
<script type="text/javascript">

$(function() {
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : '<?php echo HTTP_CATALOG ?>admin/controller/pages/upload.php',
		max_file_size : '10mb',
		chunk_size : '1mb',
		unique_names : true,
		multi_selection:true,
		multiple_queues: true,
		filters : [
			{title : "Image files", extensions : "jpg,jpeg,gif,png"},
			/* {title : "Zip files", extensions : "zip"} */
		],
		// Duplicate images Remove
		init: {
			FilesAdded: function (up, files) {
				//Newly loaded Function
				for (var i = 0; i < up.files.length; i++) {
					for (var j = 1; j < up.files.length; j++) {
						if (up.files[i].name == up.files[j].name && i != j) {
							alert('Error File ' + up.files[i].name + ' already exists. !');
							up.splice(i, 1);
							//Here I am to delete duplicate files exists

						}
					}
				}
			}
		},

	});
	// Client side form validation
	$('form').submit(function(e) {
		var uploader = $('#uploader').pluploadQueue();

   
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form')[0].submit();
                }
            });
			   uploader.start();
	
		
	
    });
});
</script>