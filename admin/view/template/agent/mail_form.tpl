<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-mail" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mail" class="form-horizontal">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab-mail">
					<ul class="nav nav-tabs" id="language">
						<?php foreach ($languages as $language) { ?>
							<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-growertype"><?php echo $lable_type; ?></label>
							<div class="col-sm-10">
								<select name="type" class="form-control">
									<option value=""><?php echo $text_select?></option>
									<?php foreach ($types as $result){ ?>
									<?php if ($type == $result['type']){ ?>
										<option value="<?php echo $result['type']; ?>" selected="selected"><?php echo $result['value']; ?></option> 
									<?php } else { ?>
										<option value="<?php echo $result['type']; ?>"><?php echo $result['value']; ?></option> 
									<?php } ?>
									<?php } ?>
								</select>
								<?php if ($error_type) { ?>
                        <div class="text-danger"><?php echo $error_type; ?></div>
                        <?php } ?>	
							</div>
						</div>
						<?php foreach ($languages as $language) { ?>
						<div class="tab-pane active" id="language<?php echo $language['language_id']; ?>">
								<div class="form-group required">
									<label class="col-sm-2 control-label" for="input-name[<?php echo $language['language_id']; ?>]"><?php echo $lable_name; ?></label>
									<div class="col-sm-10">
										<input type="text" name="seller_mail[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($seller_mail[$language['language_id']]) ? $seller_mail[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name[<?php echo $language['language_id']; ?>]" class="form-control" />
										<?php if(isset($error_name[$language['language_id']])) { ?>
										<div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-subject[<?php echo $language['language_id']; ?>]"><?php echo $lable_subject; ?></label>
									<div class="col-sm-10">
										<input type="text" name="seller_mail[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($seller_mail[$language['language_id']]) ? $seller_mail[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-subject[<?php echo $language['language_id']; ?>]" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-message[<?php echo $language['language_id']; ?>]"><?php echo $lable_message; ?></label>
									<div class="col-sm-10">
										<textarea type="text" name="seller_mail[<?php echo $language['language_id']; ?>][message]" value="" placeholder="<?php echo $entry_message; ?>" id="input-message[<?php echo $language['language_id']; ?>]" class="form-control summernote"><?php echo isset($seller_mail[$language['language_id']]) ? $seller_mail[$language['language_id']]['message'] : ''; ?></textarea>
									</div>
								</div>
						  </div>
						  <?php } ?>
							<div class="form-group ">
								<label class="col-sm-2 control-label" for="input-status"><?php echo $lable_status; ?></label>
								<div class="col-sm-10">
									<select name="status" id="input-status" class="form-control">
										<?php if ($status) { ?>
										<option value="1" selected="selected"><?php echo $text_enable; ?></option>
										<option value="0"><?php echo $text_disable; ?></option>
										<?php } else { ?>
										<option value="1"><?php echo $text_enable; ?></option>
										<option value="0" selected="selected"><?php echo $text_disable; ?></option>
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
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>

<?php echo $footer; ?>