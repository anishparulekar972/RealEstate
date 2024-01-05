<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-megaheader" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
	 <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_add; ?></h2>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-megaheader" class="form-horizontal">
        
			
			<div class="form-group">
						<label class="col-sm-2 control-label" for="input-bg-color"><span data-toggle="tooltip" title="<?php echo $help_bg_color; ?>"><?php echo $entry_bg_color; ?></span></label>
							<div class="col-sm-10">								
									<input type="text" name="megaheader_bg_color" value="<?php echo $megaheader_bg_color; ?>" placeholder="<?php echo $entry_bg_color; ?>" id="input-bg-color" class="form-control demo" />
							</div>							
			</div>
			
			  <div class="form-group">
						<label class="col-sm-2 control-label" for="input-bg-color"><span data-toggle="tooltip" title="<?php echo $help_drpmebg; ?>"><?php echo $entry_drpmebg; ?></span></label>
							<div class="col-sm-10">								
									<input type="text" name="megaheader_drpmebg" value="<?php echo $megaheader_drpmebg; ?>" placeholder="<?php echo $entry_drpmebg; ?>" id="input-bg-color" class="form-control demo" />
							</div>							
			</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-title"><span data-toggle="tooltip" title="<?php echo $help_title; ?>"><?php echo $entry_title; ?></span></label>
							<div class="col-sm-10">								
									<input type="text" name="megaheader_title" value="<?php echo $megaheader_title; ?>" placeholder="<?php echo $entry_title; ?>" id="input-bg-color" class="form-control demo" />
								</div>							
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-hovtitle"><span data-toggle="tooltip" title="<?php echo $help_hovtitle; ?>"><?php echo $entry_hovtitle; ?></span></label>
						<div class="col-sm-10">								
							<input type="text" name="megaheader_hovtitle" value="<?php echo $megaheader_hovtitle; ?>" placeholder="<?php echo $entry_hovtitle; ?>" id="input-hov-title" class="form-control demo" />
						</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-bgtitle"><span data-toggle="tooltip" title="<?php echo $help_bgtitle; ?>"><?php echo $entry_bgtitle; ?></span></label>
						<div class="col-sm-10">								
							<input type="text" name="megaheader_bgtitle" value="<?php echo $megaheader_bgtitle; ?>" placeholder="<?php echo $entry_bgtitle; ?>" id="input-bg-title" class="form-control demo" />
						</div>							
					</div>	
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-bgtitle"><span data-toggle="tooltip" title="<?php echo $help_bghovetitle; ?>"><?php echo $entry_bghovtitle; ?></span></label>
						<div class="col-sm-10">								
							<input type="text" name="megaheader_bghovtitle" value="<?php echo $megaheader_bghovtitle; ?>" placeholder="<?php echo $entry_bghovtitle; ?>" id="input-bg-title" class="form-control demo" />
						</div>							
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-link"><span data-toggle="tooltip" title="<?php echo $help_link; ?>"><?php echo $entry_link; ?></span></label>
							<div class="col-sm-10">
									<input type="text" name="megaheader_link" value="<?php echo $megaheader_link; ?>" placeholder="<?php echo $entry_link; ?>" id="input-link" class="form-control demo" />
							</div>							
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-link-hover"><span data-toggle="tooltip" title="<?php echo $help_link_hover; ?>"><?php echo $entry_link_hover; ?></span></label>
							<div class="col-sm-10">							
									<input type="text" name="megaheader_link_hover" value="<?php echo $megaheader_link_hover; ?>" placeholder="<?php echo $entry_link_hover; ?>" id="input-link-hover" class="form-control demo" />
							</div>							
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-powered"><span data-toggle="tooltip" title="<?php echo $help_powered; ?>"><?php echo $entry_powered; ?></span></label>
							<div class="col-sm-10">
									<input type="text" name="megaheader_powered" value="<?php echo $megaheader_powered; ?>" placeholder="<?php echo $entry_powered; ?>" id="input-powered" class="form-control demo" />
						</div>							
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-title-font"><span data-toggle="tooltip" title="<?php echo $help_title_font; ?>"><?php echo $entry_title_font; ?></span></label>
							<div class="col-sm-10">
									<input type="text" name="megaheader_title_font" value="<?php echo $megaheader_title_font; ?>" placeholder="<?php echo $entry_title_font; ?>" id="input-title-font" class="form-control" />
							</div>							
					</div>	
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-sub-link"><span data-toggle="tooltip" title="<?php echo $help_sub_link; ?>"><?php echo $entry_sub_link; ?></span></label>
							<div class="col-sm-10">
									<input type="text" name="megaheader_sub_link" value="<?php echo $megaheader_sub_link; ?>" placeholder="<?php echo $entry_sub_link; ?>" id="input-sub-link" class="form-control" />
							</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-product-limit"><span data-toggle="tooltip" title="<?php echo $help_product_limit; ?>"><?php echo $entry_product_limit; ?></span></label>
							<div class="col-sm-10">
									<input type="text" name="megaheader_product_limit" value="<?php echo $megaheader_product_limit; ?>" placeholder="<?php echo $entry_product_limit; ?>" id="input-product-limit" class="form-control" />
							</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-category-limit"><span data-toggle="tooltip" title="<?php echo $help_category_limit; ?>"><?php echo $entry_category_limit; ?></span></label>
							<div class="col-sm-10">
									<input type="text" name="megaheader_category_limit" value="<?php echo $megaheader_category_limit; ?>" placeholder="<?php echo $entry_category_limit; ?>" id="input-category-limit" class="form-control" />
							</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-product-image"><span data-toggle="tooltip" title="<?php echo $help_product_image; ?>"><?php echo $entry_product_image; ?></span></label>
							<div class="col-sm-5">
									<input type="text" name="megaheader_product_height" value="<?php echo $megaheader_product_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-product-height" class="form-control" />
							</div>
							<div class="col-sm-5">
									<input type="text" name="megaheader_product_width" value="<?php echo $megaheader_product_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-product-height" class="form-control" />
							</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-category-image"><span data-toggle="tooltip" title="<?php echo $help_category_image; ?>"><?php echo $entry_category_image; ?></span></label>
							<div class="col-sm-5">
									<input type="text" name="megaheader_category_height" value="<?php echo $megaheader_category_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-category-height" class="form-control" />
							</div>
							<div class="col-sm-5">
									<input type="text" name="megaheader_category_width" value="<?php echo $megaheader_category_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-category-height" class="form-control" />
							</div>							
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-manufacture-image"><span data-toggle="tooltip" title="<?php echo $help_manufacture_image; ?>"><?php echo $entry_manufacture_image; ?></span></label>
							<div class="col-sm-5">
									<input type="text" name="megaheader_manufacture_height" value="<?php echo $megaheader_manufacture_height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-manufacture-height" class="form-control" />
							</div>
							<div class="col-sm-5">
									<input type="text" name="megaheader_manufacture_width" value="<?php echo $megaheader_manufacture_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-manufacture-height" class="form-control" />
							</div>							
					</div>
        </form>
      </div>
    </div>
  </div>
<script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/stylesheet/jquery.minicolors.css">
<script>
		$(document).ready( function() {
			
            $('.demo').each( function() {
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
</script></div>
