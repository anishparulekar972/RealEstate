<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="container-fluid">
	    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="row">
	</div>
	<div class="page-header">
		<div class="container-fluid">
		  <div class="pull-right">
			<button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
			<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			
			</div>
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
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-newssubscriber" class="form-horizontal">
	
							
							<div class="form-group">
										<label class="col-sm-2 control-label" for="input-property_enquery"><?php echo $lable_property; ?></label>
																			 
							    	<div class="col-sm-10">
										<input type="text" name="property_enquery" value="<?php echo $property_enquery;?>" placeholder="<?php echo $entry_property; ?>" id="input-property_enquery" class="form-control" />
										<input type="hidden" name="property_id" value="<?php echo $property_id; ?>" />
															 
									 </div>
										
								</div>
						<div class="form-group">
										<label class="col-sm-2 control-label" for="input-agent"><?php echo $lable_agent; ?></label>
										<div class="col-sm-10">
											<input type="text" name="agent" value="<?php echo $agent;?>" placeholder="<?php echo $entry_agent; ?>" id="input-agent" class="form-control" />
											<input type="hidden" name="property_agent_id" value="<?php echo $property_agent_id; ?>" />
										</div>
   									</div>
					
					<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $lable_name;?></label>

					<div class="col-sm-10">
					<input type="text" name="name" value="<?php echo $name;?>" placeholder="<?php echo $entry_name;?>" id="input-name" class="form-control" />
						<?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
					</div>
					
					</div>
					
							<div class="form-group">
					<label class="col-sm-2 control-label" for="input-description"><?php echo $lable_description;?></label>

					<div class="col-sm-10">
					
					<textarea name="description" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control"><?php echo $description;?></textarea>
					
					</div>
					</div>
					
					
					
								
					<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-email"><?php echo $lable_email;?></label>

					<div class="col-sm-10">
					<input type="text" name="email" value="<?php echo $email;?>" placeholder="<?php echo $entry_email;?>" id="input-email" class="form-control" />
					<?php if ($error_email) { ?>
                  <div class="text-danger"><?php echo $error_email; ?></div>
                  <?php } ?>
					</div>
					</div>

		</form>
		</div>
		</div>
	</div>
</div>
</div>

  
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
	
	<script>
$('input[name=\'property_enquery\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=property/property/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					property_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['property_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'property_enquery\']').val(item['label']);
		$('input[name=\'property_id\']').val(item['value']);
	}
});


</script>

<script>
		$('input[name=\'agent\']').autocomplete({
		'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=agent/agent/autocomplete&token=<?php echo $token; ?>&filter_agentname=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					property_agent_id: 0,
					agentname: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['agentname'],
						value: item['property_agent_id']
					}
				}));
			}
		});
	 },
		'select': function(item) {
			$('input[name=\'agent\']').val(item['label']);
			$('input[name=\'property_agent_id\']').val(item['value']);
		}
	});


	</script>

