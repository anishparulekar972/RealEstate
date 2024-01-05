<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-zone').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
					<div class="well">
					<div class="row">
						<div class="col-sm-4">
								<div class="form-group">
                <label class="col-sm-2 control-label" for="input-package-title">
                  <?php echo $column_country;?>
                </label>
               
                  <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $column_country; ?>" id="input-name" class="form-control" />
									<input type="hidden" name="country_id" value="">
									</div>
                </div>
            <div class="col-sm-4">
						<div class="form-group">
								<label class="control-label" for="input-name"><?php echo $column_name; ?></label>
								<input type="text" name="filter_zone" value="<?php echo $filter_zone; ?>" placeholder="<?php echo $column_name; ?>" id="input-name" class="form-control" />
								<input type="hidden" name="zone_id" value="">
							</div>
							</div>
							<button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
					</div>
					</div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-zone">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'c.name') { ?>
                    <a href="<?php echo $sort_country; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_country; ?>"><?php echo $column_country; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'z.name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'z.code') { ?>
                    <a href="<?php echo $sort_code; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_code; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_code; ?>"><?php echo $column_code; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($zones) { ?>
                <?php foreach ($zones as $zone) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($zone['zone_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $zone['zone_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $zone['zone_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $zone['country']; ?></td>
                  <td class="text-left"><?php echo $zone['name']; ?></td>
                  <td class="text-left"><?php echo $zone['code']; ?></td>
                  <td class="text-right"><a href="<?php echo $zone['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$('#button-filter').on('click', function() {
	
	var url = 'index.php?route=localisation/zone&token=<?php echo $token; ?>';

  var filter_name = $('input[name=\'filter_name\']').val();

  if (filter_name) {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  }
  
  location = url;

	var filter_zone = $('input[name=\'filter_zone\']').val();

	if (filter_zone) {
		url += '&filter_zone=' + encodeURIComponent(filter_zone);
	}
	
  location = url;
	
});

</script>

<script type="text/javascript">

$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=localisation/country/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					country_id: 0,
					name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['country_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
		$('input[name=\'country_id\']').val(item['value']);
	}
});

</script>
<script type="text/javascript">
$('input[name=\'filter_zone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=localisation/zone/zoneautocomplete&token=<?php echo $token; ?>&filter_zone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					zone_id: 0,
					name:'<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['zone_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_zone\']').val(item['label']);
		$('input[name=\'zone_id\']').val(item['value']);
	}
});

</script>
