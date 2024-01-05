<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-tmdfilterproduct" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-tmdfilterproduct" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_moduletitle; ?></label>
            <div class="col-sm-10">
              <input type="text" name="moduletitle" value="<?php echo $moduletitle; ?>" placeholder="<?php echo $entry_moduletitle; ?>" id="input-name" class="form-control" />
            </div>
          </div>
		  <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
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
				<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-module2" data-toggle="tab"><?php echo $tab_module; ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active in" id="tab-module2">
						<ul class="nav nav-tabs">
							<li  class="active"><a href="#tab-recentpost" data-toggle="tab"><?php echo $tab_recentpost; ?></a></li>
							<li><a href="#tab-popular" data-toggle="tab"><?php echo $tab_popular; ?></a></li>
							<li><a href="#tab-comment" data-toggle="tab"><?php echo $tab_comment; ?></a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active in" id="tab-recentpost">
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="recentpostlimit" value="<?php echo $recentpostlimit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
								</div>
							  </div>
							  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-recentposttitle"><?php echo $entry_title; ?></label>
									<div class="col-sm-10">
										<?php foreach ($languages as $language) { ?>
											<div class="input-group pull-left"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
												<input type="text" name="module_title[<?php echo $language['language_id']; ?>][recentposttitle]" value="<?php echo isset($module_title[$language['language_id']]) ? $module_title[$language['language_id']]['recentposttitle'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
											</div>
										<?php } ?>
									</div>
								  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="recentpostwidth" value="<?php echo $recentpostwidth; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
								  <?php if ($error_recentpostwidth) { ?>
								  <div class="text-danger"><?php echo $error_recentpostwidth; ?></div>
								  <?php } ?>
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="recentpostheight" value="<?php echo $recentpostheight; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
								  <?php if ($error_recentpostheight) { ?>
								  <div class="text-danger"><?php echo $error_recentpostheight; ?></div>
								  <?php } ?>
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
								<div class="col-sm-10">
								  <select name="recentpoststatus" id="input-status" class="form-control">
									<?php if ($recentpoststatus) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								  </select>
								</div>
							  </div>
								
							</div>
							<div class="tab-pane" id="tab-popular">
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="popularlimit" value="<?php echo $popularlimit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
								</div>
							  </div>
							  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-populartitle"><?php echo $entry_title; ?></label>
									<div class="col-sm-10">
										<?php foreach ($languages as $language) { ?>
											<div class="input-group pull-left"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
												<input type="text" name="module_title[<?php echo $language['language_id']; ?>][populartitle]" value="<?php echo isset($module_title[$language['language_id']]) ? $module_title[$language['language_id']]['populartitle'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
											</div>
										<?php } ?>
									</div>
								  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="popularwidth" value="<?php echo $popularwidth; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
								  <?php if ($error_popularwidth) { ?>
								  <div class="text-danger"><?php echo $error_popularwidth; ?></div>
								  <?php } ?>
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="popularheight" value="<?php echo $popularheight; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
								  <?php if ($error_popularheight) { ?>
								  <div class="text-danger"><?php echo $error_popularheight; ?></div>
								  <?php } ?>
								</div>
							  </div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
									<div class="col-sm-10">
									  <select name="popularstatus" id="input-status" class="form-control">
										<?php if ($popularstatus) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									  </select>
									</div>
								
								</div>
							
							</div>
							<div class="tab-pane" id="tab-comment">
								<div class="form-group">
								<label class="col-sm-2 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="commentlimit" value="<?php echo $commentlimit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
								</div>
							  </div>
							  <div class="form-group">
									<label class="col-sm-2 control-label" for="input-commenttitle"><?php echo $entry_title; ?></label>
									<div class="col-sm-10">
										<?php foreach ($languages as $language) { ?>
											<div class="input-group pull-left"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
												<input type="text" name="module_title[<?php echo $language['language_id']; ?>][commenttitle]" value="<?php echo isset($module_title[$language['language_id']]) ? $module_title[$language['language_id']]['commenttitle'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
											</div>
										<?php } ?>
									</div>
								  </div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
									<div class="col-sm-10">
									  <select name="commentstatus" id="input-status" class="form-control">
										<?php if ($commentstatus) { ?>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<option value="0"><?php echo $text_disabled; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enabled; ?></option>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<?php } ?>
									  </select>
									</div>
								
								</div>
							
							</div>
						
					</div>
					</div>
        </form>
      </div>
    </div>
  </div>
  </div>
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script> 
<?php echo $footer; ?>
