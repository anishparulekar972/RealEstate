<?php echo $header; ?>
		<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
		<script src="view/javascript/bootstrap/js/highlight.js"></script>
		<script src="view/javascript/bootstrap/js/bootstrap-switch.js"></script>
    <script src="view/javascript/bootstrap/js/main.js"></script>
		<link href="view/javascript/bootstrap/css/bootstrap-switch.css" rel="stylesheet">
		<link href="view/stylesheet/suport.css" rel="stylesheet">
<?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"> <i class="fa fa-list"></i>&nbsp;<?php echo $tab_main; ?></a></li>
            <li><a href="#tab-setting" data-toggle="tab"> <i class="fa fa-cog fa-fw"></i>&nbsp;<?php echo $tab_setting; ?></a></li>
            <li><a href="#tab-color" data-toggle="tab"> <i class="fa fa-pencil"></i>&nbsp;<?php echo $tab_color; ?></a></li>
			
            <!--<li><a href="#tab-support" data-toggle="tab"> <i class="fa fa-life-ring"></i>&nbsp; <?php echo $tab_support; ?></a></li>-->
			
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
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
                      <textarea name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="tmdblogsetting_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($tmdblogsetting_description[$language['language_id']]) ? $tmdblogsetting_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
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
            <div class="tab-pane fade" id="tab-setting">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab-postseting" data-toggle="tab"><?php echo $tab_postseting; ?></a></li>
					<li><a href="#tab-blogseting" data-toggle="tab"><?php echo $tab_blogseting; ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active in" id="tab-postseting">
						<div class="form-group">
						<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_article; ?>"><?php echo $entry_article; ?></span></label>
						<div class="col-sm-10">
						  <label class="radio-inline">
							
						
							
							<input type="radio" name="tmdblogsetting_article" value="1" <?php if ($tmdblogsetting_article) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
						</label>
						</div>
						</div>	
					
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_descp; ?>"><?php echo $entry_descp; ?></span></label>
							<div class="col-sm-10">
							  <label class="radio-inline">
								 <input type="radio" name="tmdblogsetting_descp" value="1" <?php if ($tmdblogsetting_descp) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_feedbackrow; ?>"><?php echo $entry_feedbackrow; ?></span></label>
							<div class="col-sm-10">
							 <label class="radio-inline">
							 <input type="radio" name="tmdblogsetting_feedbackrow" value="1" <?php if ($tmdblogsetting_feedbackrow) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							  
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_facebook; ?>"><?php echo $entry_facebook; ?></span></label>
							<div class="col-sm-10">
							 <label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_facebook" value="1" <?php if ($tmdblogsetting_facebook) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							   </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_twitter; ?>"><?php echo $entry_twitter; ?></span></label>
							<div class="col-sm-10">
							 <label class="radio-inline">

							 <input type="radio" name="tmdblogsetting_twitter" value="1" <?php if ($tmdblogsetting_twitter) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							 </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_pinterest; ?>"><?php echo $entry_pinterest; ?></span></label>
							<div class="col-sm-10">
							 <label class="radio-inline">

							  <input type="radio" name="tmdblogsetting_pinterest" value="1" <?php if ($tmdblogsetting_pinterest) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /> </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_google; ?>"><?php echo $entry_google; ?></span></label>
							<div class="col-sm-10"> <label class="radio-inline">

							 <input type="radio" name="tmdblogsetting_google" value="1" <?php if ($tmdblogsetting_google) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_articleimg; ?>"><?php echo $entry_articleimg; ?></span></label>
							<div class="col-sm-10"><label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_articleimg" value="1" <?php if ($tmdblogsetting_articleimg) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						
							<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_articleimg; ?>"><?php echo $entry_articleimg; ?></span></label>
							<div class="col-sm-10">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_blogarticleimg" value="1" <?php if ($tmdblogsetting_blogarticleimg) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_blogcomment; ?>"><?php echo $entry_blogcomments; ?></span></label>
						  <div class="col-sm-10">
							<label class="radio-inline">
										<input type="radio" name="tmdblogsetting_globalcoment" value="1" <?php if ($tmdblogsetting_globalcoment) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							 </label>
						  </div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-2 control-label"><?php echo $entry_commentlimit; ?></label>
						  <div class="col-sm-10">
							<input type="text" name="tmdblogsetting_commentlimit" value="<?php echo $tmdblogsetting_commentlimit; ?>" placeholder="<?php echo $entry_blogcomments; ?>" id="input-image-comntthumb" class="form-control" />
						  </div>
						</div>

					<div class="form-group">
                <label class="col-sm-2 control-label" for="input-image-comntthumb"><?php echo $entry_thumbimg; ?></label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 control-label" for="input-image-comntbanner"><?php echo $entry_comntbanner; ?></label>
                <div class="col-sm-10">
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
						

					<div class="tab-pane fade" id="tab-blogseting">
						<div class="tab-pane active in" id="tab-postseting">
						<div class="form-group">
						<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_article; ?>"><?php echo $entry_article; ?></span></label>
						<div class="col-sm-10"><label class="radio-inline">
						  <input type="radio" name="tmdblogsetting_blogarticle" value="1" <?php if ($tmdblogsetting_blogarticle) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
						</div>
						</div>	
					
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_descp; ?>"><?php echo $entry_descp; ?></span></label>
							<div class="col-sm-10"><label class="radio-inline">
							 <input type="radio" name="tmdblogsetting_blogdescp" value="1" <?php if ($tmdblogsetting_blogdescp) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_feedbackrow; ?>"><?php echo $entry_feedbackrow; ?></span></label>
							<div class="col-sm-10"><label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_blogfeedbackrow" value="1" <?php if ($tmdblogsetting_blogfeedbackrow) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_facebook; ?>"><?php echo $entry_facebook; ?></span></label>
							<div class="col-sm-10"><label class="radio-inline">
							  <input type="radio" name="tmdblogsetting_blogfacebook" value="1" <?php if ($tmdblogsetting_blogfacebook) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  /></label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_twitter; ?>"><?php echo $entry_twitter; ?></span></label>
							<div class="col-sm-10">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_blogtwitter" value="1" <?php if ($tmdblogsetting_blogtwitter) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_pinterest; ?>"><?php echo $entry_pinterest; ?></span></label>
							<div class="col-sm-10">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_blogpinterest" value="1" <?php if ($tmdblogsetting_blogpinterest) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_google; ?>"><?php echo $entry_google; ?></span></label>
							<div class="col-sm-10">
							  <label class="radio-inline">
								<input type="radio" name="tmdblogsetting_bloggoogle" value="1" <?php if ($tmdblogsetting_bloggoogle) { ?> checked <?php } ?>data-radio-all-off="true" class="switch-radio2"  />
							  </label>
							</div>
						</div>
						
						
						
					</div>
						
					</div>
				
				</div>
			</div>		
            <div class="tab-pane fade" id="tab-color">
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-titletextcolor"><?php echo $entry_titletextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_titletextcolor" value="<?php echo $tmdblogsetting_titletextcolor; ?>"  id="input-titletextcolor" class="form-control color" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-blogtextcolor"><?php echo $entry_blogtextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_blogtextcolor" value="<?php echo $tmdblogsetting_blogtextcolor; ?>"  id="input-blogtextcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-titlebgcolor"><?php echo $entry_titlebgcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_titlebgcolor" value="<?php echo $tmdblogsetting_titlebgcolor; ?>"  id="input-titlebgcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-containerbgcolor"><?php echo $entry_containerbgcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_containerbgcolor" value="<?php echo $tmdblogsetting_containerbgcolor; ?>"  id="input-containerbgcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-postboxbgcolor"><?php echo $entry_postboxbgcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_postboxbgcolor" value="<?php echo $tmdblogsetting_postboxbgcolor; ?>"  id="input-postboxbgcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-articletextcolor"><?php echo $entry_articletextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_articletextcolor" value="<?php echo $tmdblogsetting_articletextcolor; ?>"  id="input-articletextcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-descptextcolor"><?php echo $entry_descptextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_descptextcolor" value="<?php echo $tmdblogsetting_descptextcolor; ?>"  id="input-descptextcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-feedbacktextcolor"><?php echo $entry_feedbacktextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_feedbacktextcolor" value="<?php echo $tmdblogsetting_feedbacktextcolor; ?>"  id="input-feedbacktextcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-feedbackbgcolor"><?php echo $entry_feedbackbgcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_feedbackbgcolor" value="<?php echo $tmdblogsetting_feedbackbgcolor; ?>"  id="input-feedbackbgcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-recntposttextcolor"><?php echo $entry_recntposttextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_recntposttextcolor" value="<?php echo $tmdblogsetting_recntposttextcolor; ?>"  id="input-recntposttextcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-recntpostlinkcolor"><?php echo $entry_recntpostlinkcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_recntpostlinkcolor" value="<?php echo $tmdblogsetting_recntpostlinkcolor; ?>"  id="input-recntpostlinkcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-recntposthovercolor"><?php echo $entry_recntposthovercolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_recntposthovercolor" value="<?php echo $tmdblogsetting_recntposthovercolor; ?>"  id="input-recntposthovercolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-commenttextcolor"><?php echo $entry_commenttextcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_commenttextcolor" value="<?php echo $tmdblogsetting_commenttextcolor; ?>"  id="input-commenttextcolor" class="form-control color" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-commentlinkcolor"><?php echo $entry_commentlinkcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_commentlinkcolor" value="<?php echo $tmdblogsetting_commentlinkcolor; ?>"  id="input-commentlinkcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-commenttimecolor"><?php echo $entry_commenttimecolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_commenttimecolor" value="<?php echo $tmdblogsetting_commenttimecolor; ?>"  id="input-commenttimecolor" class="form-control color" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-commenttextcolor"><?php echo $entry_commentcolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_commentcolor" value="<?php echo $tmdblogsetting_commentcolor; ?>"  id="input-commenttextcolor" class="form-control color" />
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label" for="input-commentusercolor"><?php echo $entry_commentusercolor; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="tmdblogsetting_commentusercolor" value="<?php echo $tmdblogsetting_commentusercolor; ?>"  id="input-commentusercolor" class="form-control color" />
                    </div>
                </div>
				
				
				
            </div>
			
			 <!--<div class="tab-pane fade" id="tab-support">
				<div id="getsupport">
	<div class="row ">
		<div class="col-sm-8">
			<h3><span class="get-support"></span>&nbsp;Get Support</h3>
				<div class="shadow_top"></div>
					<div class="row padding">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="product-thumb">
											<div class="image"><a><span class="community"></span></a>
											</div>
											<div class="caption">
												<h4>Community</h4>
												<p>Ask the community about your issue on the iSenseLabs forum</p>
											</div>
											<div class="browse">
											<button type="button">Browse forms</button>
											</div>
										</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="product-thumb">
											<div class="image"><a><span class="Tickets"></span></a>
											</div>
											<div class="caption">
												<h4>Tickets</h4>
												<p>Want to comminicate one-to-one with our tech people?then open a support ticket.</p>
											</div>
											<div class="browse">
											<button type="button">Open a support ticket</button>
											</div>
										</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="product-thumb">
											<div class="image"><a><span class="Pre-sale"></span></a>
											</div>
											<div class="caption">
												<h4>Pre-sale</h4>
												<p>Have a brilliant idea for your webstore?Our team of top-notch developers make it real </p>
											</div>
											<div class="browse">
												<button type="button">Bump the sales</button>
											</div>
										</div>
							</div>
					</div>
		</div>
		
				<div class="col-sm-4">
				<h3><span class="your-licence"></span>&nbsp;Your License</h3>
					<div class="shadow_top"></div>
					<div class="row padding">
						<div class="col-sm-12 ">
									<div class="product-thumb">
										<div class="lic">
										<p>Please enter your product purchase license code</p>
										<input type="text" name="search"  placeholder="Enter code" class="btn-block form-control input-lg" />
										</div>
											<div class="activate pull-right">
											<a href="exp.html"><button class="pull-right" type="button">Activate License</button></a>
											</div>
											<p class="pull-right"><span class="youlic">Not having a code?Get it from here.</span></p>
									</div>
							</div>
					</div>
				</div>
	</div>
	</div>
			 
			 </div>-->
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({
	height: 300
});
<?php } ?>
//--></script> 
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