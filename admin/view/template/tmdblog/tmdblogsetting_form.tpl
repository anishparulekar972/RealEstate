<?php echo $header; ?>
		<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
		<script src="view/javascript/bootstrap/js/highlight.js"></script>
		<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
    <script src="view/javascript/bootstrap/js/main.js"></script>
		<link href="view/javascript/bootstrap/css/bootstrap-switch.css" rel="stylesheet">
		<link href="view/stylesheet/suport.css" rel="stylesheet">
		<link type="text/css" href="view/stylesheet/blog.css" rel="stylesheet" media="screen" />
<?php echo $column_left; ?>

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
				<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_main ?></a></li>	
				<li class=""><a href="#tab-blogpage" data-toggle="tab"><i class="fa fa-newspaper-o"></i> <?php echo $text_blogpage ?></a></li>	
					
				<li class=""><a href="#tab-category" data-toggle="tab"><i class="fa fa-link"></i> <?php echo $text_categorypage ?></a></li>	
				
				
			</ul>
         
          <div class="tab-content col-sm-9">
            <div class="tab-pane active in" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_meta_title; ?>"><?php echo $entry_meta_title; ?></span></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
				  
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_meta_description; ?>"><?php echo $entry_meta_description; ?></span></label>
                    <div class="col-sm-10">
                      <textarea name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><span data-toggle="tooltip" title="<?php echo $help_meta_keyword; ?>"><?php echo $entry_meta_keyword; ?></span></label>
                    <div class="col-sm-10">
                      <textarea name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
			  <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="tmdblogsetting_image" value="<?php echo $tmdblogsetting_image; ?>" id="input-image" />
                </div>
              </div>
            </div>
			<div class="tab-pane fade" id="tab-category">
				<div class="tab-pane active in" id="tab-postseting">
						<div class="form-group">
						<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_article; ?>"><?php echo $entry_article; ?></span></label>
						<div class="col-sm-9"><label class="radio-inline">
						  <input type="radio" name="tmdblogsetting_blogarticle" value="1" <?php if ($tmdblogsetting_blogarticle) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
						</div>
						</div>	
					
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_descp; ?>"><?php echo $entry_descp; ?></span></label>
							<div class="col-sm-9"><label class="radio-inline">
							 <input type="radio" name="tmdblogsetting_blogdescp" value="1" <?php if ($tmdblogsetting_blogdescp) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_feedbackrow; ?>"><?php echo $entry_feedbackrow; ?></span></label>
							<div class="col-sm-9"><label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_blogfeedbackrow" value="1" <?php if ($tmdblogsetting_blogfeedbackrow) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_facebook; ?>"><?php echo $entry_facebook; ?></span></label>
							<div class="col-sm-9"><label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_blogfacebook" value="1" <?php if ($tmdblogsetting_blogfacebook) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_twitter; ?>"><?php echo $entry_twitter; ?></span></label>
							<div class="col-sm-9">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_blogtwitter" value="1" <?php if ($tmdblogsetting_blogtwitter) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_pinterest; ?>"><?php echo $entry_pinterest; ?></span></label>
							<div class="col-sm-9">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_blogpinterest" value="1" <?php if ($tmdblogsetting_blogpinterest) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_google; ?>"><?php echo $entry_google; ?></span></label>
							<div class="col-sm-9">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_bloggoogle" value="1" <?php if ($tmdblogsetting_bloggoogle) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
					</div>	
			</div>
			<div class="tab-pane fade" id="tab-blogpage">
				<div class="form-group">
						<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_article; ?>"><?php echo $entry_article; ?></span></label>
						<div class="col-sm-9">
						  <label class="radio-inline">
							<input type="radio" name="tmdblogsetting_article" value="1" <?php if ($tmdblogsetting_article) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
						</label>
						</div>
						</div>	
					
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_descp; ?>"><?php echo $entry_descp; ?></span></label>
							<div class="col-sm-9">
							  <label class="radio-inline">
								 <input type="radio" name="tmdblogsetting_descp" value="1" <?php if ($tmdblogsetting_descp) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_feedbackrow; ?>"><?php echo $entry_feedbackrow; ?></span></label>
							<div class="col-sm-9">
							 <label class="radio-inline">
							 <input type="radio" name="tmdblogsetting_feedbackrow" value="1" <?php if ($tmdblogsetting_feedbackrow) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							  
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_facebook; ?>"><?php echo $entry_facebook; ?></span></label>
							<div class="col-sm-9">
							 <label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_facebook" value="1" <?php if ($tmdblogsetting_facebook) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							   </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_twitter; ?>"><?php echo $entry_twitter; ?></span></label>
							<div class="col-sm-9">
							 <label class="radio-inline">

							 <input type="radio" name="tmdblogsetting_twitter" value="1" <?php if ($tmdblogsetting_twitter) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							 </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_pinterest; ?>"><?php echo $entry_pinterest; ?></span></label>
							<div class="col-sm-9">
							 <label class="radio-inline">

							  <input type="radio" name="tmdblogsetting_pinterest" value="1" <?php if ($tmdblogsetting_pinterest) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /> </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_google; ?>"><?php echo $entry_google; ?></span></label>
							<div class="col-sm-9"> <label class="radio-inline">

							 <input type="radio" name="tmdblogsetting_google" value="1" <?php if ($tmdblogsetting_google) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_articleimg; ?>"><?php echo $entry_articleimg; ?></span></label>
							<div class="col-sm-9"><label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_articleimg" value="1" <?php if ($tmdblogsetting_articleimg) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						
							<div class="form-group">
							<label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_articleimg; ?>"><?php echo $entry_articleimg; ?></span></label>
							<div class="col-sm-9">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_blogarticleimg" value="1" <?php if ($tmdblogsetting_blogarticleimg) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_blogcomment; ?>"><?php echo $entry_blogcomments; ?></span></label>
						  <div class="col-sm-9">
							<label class="radio-inline">
										<input type="radio" name="tmdblogsetting_globalcoment" value="1" <?php if ($tmdblogsetting_globalcoment) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							 </label>
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-3 control-label"><?php echo $entry_commentlimit; ?></label>
						  <div class="col-sm-9">
							<input type="text" name="tmdblogsetting_commentlimit" value="<?php echo $tmdblogsetting_commentlimit; ?>" placeholder="<?php echo $entry_blogcomments; ?>" id="input-image-comntthumb" class="form-control" />
						  </div>
						</div>

					<div class="form-group">
                <label class="col-sm-3 control-label" for="input-image-comntthumb"><?php echo $entry_thumbimg; ?></label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="tmdblogsetting_image_comntthumb_width" value="<?php echo $tmdblogsetting_image_comntthumb_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-comntthumb" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="tmdblogsetting_image_comntthumb_height" value="<?php echo $tmdblogsetting_image_comntthumb_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                    </div>
                  </div>
                  
                </div>
              </div>

			  <div class="form-group">
                <label class="col-sm-3 control-label" for="input-image-comntbanner"><?php echo $entry_comntbanner; ?></label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" name="tmdblogsetting_image_comntbanner_width" value="<?php echo $tmdblogsetting_image_comntbanner_width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-image-comntbanner" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="tmdblogsetting_image_comntbanner_height" value="<?php echo $tmdblogsetting_image_comntbanner_height; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                    </div>
                  </div>
                  
                </div>
              </div>	
			</div>
			
          </div>
        </form>
      </div>
    </div>
  </div>
 <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>

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

<?php echo $footer; ?>