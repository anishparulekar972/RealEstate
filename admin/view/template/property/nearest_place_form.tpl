<?php echo $header; ?><?php echo $column_left; ?>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
          <ul  class="nav nav-tabs">
            <li class="active">
              <a  href="#1a" data-toggle="tab">
                <?php echo $tab_general; ?>
              </a>
            </li>
            <li>
              <a href="#2a" data-toggle="tab">
                <?php echo $tab_data; ?>
              </a>
            </li>
          </ul>
          <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
								 <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
							
							<div class="form-group required">
                <label class="col-sm-2 control-label" for="input-name">
                  <?php echo $lable_name;?>
                </label> 
                <div class="col-sm-10">
                  <input type="text" name="nearest_placename[<?php echo $language['language_id']; ?>][name]" value="<?php if(isset($nearest_placename[$language['language_id']]['name'])){echo $nearest_placename[$language['language_id']]['name']; }?>" placeholder="<?php echo $entry_name;?>" id="input-name" class="form-control" />
									<?php if(isset($error_name[$language['language_id']])) { ?>
                  <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                  <?php } ?>
                </div>
              </div>
           	</div>
								<?php } ?>
							
            </div>
            </div>
						
            <div class="tab-pane" id="2a">
						
							
						<div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $lable_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort_order">
                  <?php echo $lable_sort_order;?>
                </label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $sort_order;?>" placeholder="<?php echo $entry_sort_order;?>" id="input-sort_order" class="form-control" />
									
									<?php if ($error_sortorder) { ?>
                  <div class="text-danger"><?php echo $error_sortorder; ?></div>
                  <?php } ?>
									
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="status">
                  <?php echo $lable_status;?>
                </label>
                <div class="col-sm-10">
                  <select class="form-control" id="status" name="status">
                    <option value="1" <?php if(isset($status) && $status=1) { echo "selected"; }?>><?php echo $text_enable?></option>
                    <option value="0" <?php if(isset($status) && $status=0) { echo "selected"; }?>><?php echo $text_disable?></option>
                  </select>
										<?php if ($error_status) { ?>
                  <div class="text-danger"><?php echo $error_status; ?></div>
                  <?php } ?>
								
                </div>
              </div>
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
