<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
		<script src="view/javascript/bootstrap/js/highlight.js"></script>
		<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
    <script src="view/javascript/bootstrap/js/main.js"></script>
		<link href="view/javascript/bootstrap/css/bootstrap-switch.css" rel="stylesheet">
		<link href="view/stylesheet/suport.css" rel="stylesheet">
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
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
			<ul id="setting_menu" class="nav nav-tabs menu col-sm-3">	
					
				<li class="active"><a href="#tab-blogpage" data-toggle="tab"><?php echo $tab_setting ?></a></li>
				<li class=""><a href="#tab-color" data-toggle="tab"><i class="fa fa-pencil"></i>&nbsp;<?php echo $tab_color; ?></a></li>
			</ul>
         
          <div class="tab-content col-sm-9">
			<div class="tab-pane fade active in" id="tab-blogpage">
				<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-image-popup-width"><?php echo $entry_image_popup; ?></label>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-sm-3">
										<input type="text" name="gallerysetting_popup_width" value="<?php echo $gallerysetting_popup_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-popup-width" class="form-control" />
									</div>
									<div class="col-sm-3">
										<input type="text" name="gallerysetting_popup_height" value="<?php echo $gallerysetting_popup_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-thumb-popup-width"><?php echo $entry_thumb_popup; ?></label>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-sm-3">
										<input type="text" name="gallerysetting_thumb_width" value="<?php echo $gallerysetting_thumb_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-thumb-popup-width" class="form-control" />
									</div>
									<div class="col-sm-3">
										<input type="text" name="gallerysetting_thumb_height" value="<?php echo $gallerysetting_thumb_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
									</div>
								</div>
							</div>
						</div>	
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-thumb-limtofgallery"><?php echo $entry_limtofgallery; ?></label>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-sm-6">
										<input type="text" name="gallerysetting_limtofgallery" value="<?php echo $gallerysetting_limtofgallery; ?>" placeholder="<?php echo $entry_limtofgallery; ?>" id="input-thumb-limtofgallery" class="form-control" />
									</div>
									
								</div>
							</div>
						</div>	
			</div>
			<div class="tab-pane fade" id="tab-color">
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-namecolor"><?php echo $entry_namecolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="gallerysetting_namecolor" value="<?php echo $gallerysetting_namecolor; ?>"  id="input-namecolor" class="form-control color" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-desccolor"><?php echo $entry_desccolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="gallerysetting_desccolor" value="<?php echo $gallerysetting_desccolor; ?>"  id="input-desccolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-4 control-label" for="input-totalphotocolor"><?php echo $entry_totalphotocolor; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="gallerysetting_totalphotocolor" value="<?php echo $gallerysetting_totalphotocolor; ?>"  id="input-totalphotocolor" class="form-control color" />
                    </div>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/stylesheet/jquery.minicolors.css">
<script>
		$(document).ready( function() {
			
            $('.color').each( function() {
               		$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					change: function(hex, opacity) {
						if( !hex ) return;
						if( opacity ) hex += ', ' + opacity;
						try {
							console.log(hex);
						} catch(e) {}
					},
					theme: 'bootstrap'
				});
                
            });
			
		});
</script>
<style>
.minicolors-theme-bootstrap .minicolors-input{width:100%; height:35px;}
</style>