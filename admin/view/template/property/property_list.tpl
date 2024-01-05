<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
 <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="row">
	
    </div>
	<div class="page-header">
	<div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-newssubscriber').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
    </div>
 <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
			<div class="well">
			<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
				<label class="control-label" for="input-name"><?php echo $filterlablel_name; ?></label>
				<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $filterlablel_name; ?>" id="input-name" class="form-control" />
				</div>
			</div> 
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-sort_order">
					<?php echo $filterlablel_price_range; ?></label>
					<input type="text" name="filter_price_from" value="<?php echo $filter_price_from; ?>" placeholder="<?php echo $filterlablel_price_range; ?>" id="input-sort_order" class="form-control" />
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label class="control-label" for="input-sort_order">
				<?php echo $filterlablel_price_from; ?></label>
				<input type="text" name="filter_price_to" value="<?php echo $filter_price_to; ?>" placeholder="<?php echo $filterlablel_price_from; ?>" id="input-sort_order" class="form-control" />
			</div>

			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label" for="input-status"><?php echo $filterlablel_status; ?></label>
					<select name="filter_status" id="input-filter_payment_mode" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enable; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enable; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disable; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disable; ?></option>
                  <?php } ?>
                </select>
				</div>
			</div>
		 </div>
						 
			<div class="row">
			<div class="col-sm-3">
			<div class="form-group">
					<label class="control-label" for="input-name"><?php echo $filterlablel_agent; ?></label>
					<input type="text" name="filter_agent" value="<?php echo $filteragent; ?>" placeholder="<?php echo $filterlablel_agent; ?>" id="input-name" class="form-control" />
				<input type="hidden" value="" name="property_agent_id">
				</div>
			</div> 

			<div class="col-sm-3">
				<div class="form-group">
						<label class="control-label" for="input-name"><?php echo $filterlablel_property_status; ?></label>
					<input type="text" name="filter_propertystatus" value="<?php echo $statusname; ?>" placeholder="<?php echo $filterlablel_property_status; ?>" id="input-name" class="form-control" />
					<input type="hidden" value="" name="property_status_id">
				</div>
			</div>

			<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
			<div class="col-sm-3">
				<div class="form-group">
			</div>
		</div> 	
	</div>
 </div>
			
	<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-newssubscriber">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
				
						
						<td class="text-left"><?php if ($sort == 'p.image') { ?>
						<a href="<?php echo $sort_image; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_image; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_image; ?>"><?php echo $column_image; ?></a>
						<?php } ?></td>
				
					<td class="text-left"><?php if ($sort == 'p.agent') { ?>
						<a href="<?php echo $sort_agent; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_agent; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_agent; ?>"><?php echo $column_agent; ?></a>
						<?php } ?></td>

						<td class="text-left"><?php if ($sort == 'ppd.name') { ?>
						<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
						<?php } ?></td>

						<td class="text-left"><?php if ($sort == 'p.property_status_id') { ?>
						<a href="<?php echo $sort_propertystatus; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_property_status; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_propertystatus; ?>"><?php echo $column_property_status; ?></a>
						<?php } ?></td>

						<td class="text-left"><?php if ($sort == 'p.price') { ?>
						<a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
						<?php } ?></td>

						<td class="text-left"><?php if ($sort == 'p.status') { ?>
						<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
						<?php } ?></td>

						
						<td class="text-right"><?php echo $column_action; ?> </td>
					</tr>
				</thead>
				<thead>
					<?php if ($propert) { ?>
						<?php foreach ($propert as $result) { ?>
							<tr>
								<td style="width: 1px;" class="text-center"><input type="checkbox"  name="selected[]" value="<?php echo $result['property_id']; ?>" /></td>
								<td class="text-center"><?php if ($result['image']) { ?>
								<img src="<?php echo $result['image']; ?>" alt="<?php echo $result['image']; ?>" class="img-thumbnail" />
								<?php } else { ?>
								<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
								<?php } ?>
								</td>
								<td class="text-left"><?php echo $result['agentname']; ?></td>
								<td class="text-left"><?php echo $result['name']; ?></td>
								<td class="text-left"><?php echo $result['property_status']; ?></td>
								<td class="text-left"><?php echo $result['price']; ?></td>
								<td class="text-left"><?php echo $result['status']; ?></td>
								<td class="text-right">

								<?php if ($result['approve']) { ?>
								<a href="<?php echo $result['approve']; ?>" data-toggle="tooltip" title="<?php echo $button_approve; ?>" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></a>
								<?php } else { ?>
								<button type="button" class="btn btn-success" disabled><i class="fa fa-thumbs-o-up"></i></button>
								<?php } ?>

								<a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								
								<?php if ($result['disapproved']) { ?>
		                        <a href="<?php echo $result['disapproved']; ?>" data-toggle="tooltip" title="<?php echo $button_desapprove; ?>" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a>
		                        <?php } else { ?>
		                        <button type="button" class="btn btn-danger" disabled><i class="fa fa-thumbs-o-down"></i></button>
		                        <?php } ?>
								
								</td>
							</tr>
							<?php } ?> 
							<?php } else { ?>
					<tr>
						<td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
					</tr>
					<?php } ?>
				</thead>
				</tbody>
			</table>
		</div>
	</form>
		 <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
  </div>
</div>
	<script type="text/javascript"><!--
	$('#button-filter').on('click', function() {
	var url = 'index.php?route=property/property&token=<?php echo $token; ?>';
	var filter_name = $('input[name=\'filter_name\']').val();
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	var filter_sort_order = $('input[name=\'filter_sort_order\']').val();
	if (filter_sort_order) {
		url += '&filter_sort_order=' + encodeURIComponent(filter_sort_order);
	}
	var filter_price_from = $('input[name=\'filter_price_from\']').val();
	if (filter_price_from != '') {
		url += '&filter_price_from=' + encodeURIComponent(filter_price_from);
	}
	var filter_price_to = $('input[name=\'filter_price_to\']').val();
	if (filter_price_to != '') {
		url += '&filter_price_to=' + encodeURIComponent(filter_price_to);
	}
	var filter_propertystatus = $('input[name=\'property_status_id\']').val();
	if (filter_propertystatus) {
		url += '&filter_propertystatus=' + encodeURIComponent(filter_propertystatus);
	}
	var filter_agent = $('input[name=\'property_agent_id\']').val();
	if (filter_agent) {
		url += '&filter_agent=' + encodeURIComponent(filter_agent);
	}
	var filter_status = $('select[name=\'filter_status\']').val();
  if (filter_status != '*') {
    url += '&filter_status=' + encodeURIComponent(filter_status); 
  } 
	location = url;
   });
	</script>
	<script type="text/javascript">
		$('input[name=\'filter_propertystatus\']').autocomplete({
			'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=property/property_status/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
				json.unshift({
				property_status_id: 0,
				name:'<?php echo $text_none; ?>'
				});
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['property_status_id']
					}
				}));
				}
			});
			},
			'select': function(item) {
				$('input[name=\'filter_propertystatus\']').val(item['label']);
				$('input[name=\'property_status_id\']').val(item['value']);
			}
		});
	</script>

	<script>
	$('input[name=\'filter_agent\']').autocomplete({
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
			$('input[name=\'filter_agent\']').val(item['label']);
			$('input[name=\'property_agent_id\']').val(item['value']);
		}
	});
	</script>


