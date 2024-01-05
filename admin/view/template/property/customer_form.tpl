<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" id="btnSubmit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
          <i class="fa fa-save">
          </i>
        </button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default">
          <i class="fa fa-reply">
          </i>
        </a>
      </div>
      <h1>
        <?php echo $heading_title; ?>
      </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li>
          <a href="<?php echo $breadcrumb['href']; ?>">
            <?php echo $breadcrumb['text']; ?>
          </a>
        </li>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
				<div class="col-sm-10">
					<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
					<?php if ($error_firstname) { ?>
					<div class="text-danger"><?php echo $error_firstname; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
				<div class="col-sm-10">
					<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
					<?php if ($error_lastname) { ?>
					<div class="text-danger"><?php echo $error_lastname; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
				<div class="col-sm-10">
					<input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
					<?php if ($error_email) { ?>
					<div class="text-danger"><?php echo $error_email; ?></div>
					<?php  } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
				<div class="col-sm-10">
					<input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
					<?php if ($error_telephone) { ?>
					<div class="text-danger"><?php echo $error_telephone; ?></div>
					<?php  } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_fax; ?></label>
				<div class="col-sm-10">
					<input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
				<div class="col-sm-10">
					<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" autocomplete="off" />
					<?php if ($error_password) { ?>
					<div class="text-danger"><?php echo $error_password; ?></div>
					<?php  } ?>
				</div>
			</div>
			<div class="form-group required">
				<label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
				<div class="col-sm-10">
					<input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" autocomplete="off" id="input-confirm" class="form-control" />
					<?php if ($error_confirm) { ?>
					<div class="text-danger"><?php echo $error_confirm; ?></div>
					<?php  } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-plans"><?php echo $entry_plans; ?></label>
				<div class="col-sm-10">
					<input type="text" name="plans" value="<?php echo $plans;?>" placeholder="<?php echo $entry_plans; ?>" id="input-plans" class="form-control" />
					<input type="hidden" name="plans_id" value="<?php echo $plans_id;?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-newsletter"><?php echo $entry_newsletter; ?></label>
				<div class="col-sm-10">
					<select name="newsletter" id="input-newsletter" class="form-control">
						<?php if ($newsletter) { ?>
						<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					</select>
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
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-approved"><?php echo $entry_approved; ?></label>
				<div class="col-sm-10">
					<select name="approved" id="input-approved" class="form-control">
						<?php if ($approved) { ?>
						<option value="1" selected="selected"><?php echo $text_yes; ?></option>
						<option value="0"><?php echo $text_no; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_yes; ?></option>
						<option value="0" selected="selected"><?php echo $text_no; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-safe"><?php echo $entry_safe; ?></label>
				<div class="col-sm-10">
					<select name="safe" id="input-safe" class="form-control">
						<?php if ($safe) { ?>
						<option value="1" selected="selected"><?php echo $text_yes; ?></option>
						<option value="0"><?php echo $text_no; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_yes; ?></option>
						<option value="0" selected="selected"><?php echo $text_no; ?></option>
						<?php } ?>
					</select>
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
//--></script>


<?php echo $footer; ?></div>