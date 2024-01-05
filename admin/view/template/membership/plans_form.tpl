<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-plans" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-plans" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
            <li><a href="#tab-variation" data-toggle="tab"><?php echo $tab_variation; ?></a></li>
            <li><a href="#tab-extraoptions" data-toggle="tab"><?php echo $tab_extraoptions; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
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
                      <input type="text" name="plans_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($plans_description[$language['language_id']]) ? $plans_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="plans_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote"><?php echo isset($plans_description[$language['language_id']]) ? $plans_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane" id="tab-data">
             
			  <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-price"><?php echo $entry_price; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="price" value="<?php echo $price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>
                </div>
              </div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-price"><?php echo $enter_validate; ?></label>
					<div class="row">
						<div class="form-group col-lg-3">
							<div class="col-sm-10">
								<input type="text" name="number" value="<?php echo $number;?>" placeholder="<?php echo $enter_number; ?>" id="input-price" class="form-control" />
							</div>                  
						</div>

						<div class="form-group col-lg-3">
							<div class="col-sm-10">
								<select name="type" id="input-status" class="form-control">
									<option value=""><?php echo $text_select; ?></option>
									<option value="day" <?php if ($type == 'day') echo 'selected';?>><?php echo $text_day; ?></option>
									<option value="month" <?php if ($type == 'month') echo 'selected';?>><?php echo $text_month; ?></option>
									<option value="year" <?php if ($type == 'year') echo 'selected';?>><?php echo $text_years; ?></option>
								</select>
							</div>
						</div>
					</div>
				</div>
            
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
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
            </div>           
		    <div class="tab-pane" id="tab-variation">             
			   <div class="table-responsive">
                <table id="variation" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_variation; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $variation_row = 0; ?>
                    <?php foreach ($plans_variations as $plans_variation) { ?>
                    <tr id="variation-row<?php echo $variation_row; ?>">
                      <td class="text-left" style="width: 40%;"><input type="text" name="plans_variation[<?php echo $variation_row; ?>][name]" value="<?php echo $plans_variation['name']; ?>" placeholder="<?php echo $entry_variation; ?>" class="form-control" />
                        <input type="hidden" name="plans_variation[<?php echo $variation_row; ?>][variation_id]" value="<?php echo $plans_variation['variation_id']; ?>" /></td>
                     
                      <td class="text-left"><button type="button" onclick="$('#variation-row<?php echo $variation_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $variation_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="1"></td>
                      <td class="text-left"><button type="button" onclick="addVariation();" data-toggle="tooltip" title="<?php echo $button_variation_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>			  
            </div>
			
		    <div class="tab-pane" id="tab-extraoptions">             
			   
			   <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_title; ?></td>
                      <td class="text-left"><?php echo $entry_price; ?></td>
                      <td class="text-right"><?php echo $entry_sort_order; ?></td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $image_row = 0; ?>
                    <?php foreach ($plans_optionss as $plans_options) { ?>
                    <tr id="image-row<?php echo $image_row; ?>">
                    
                      <td class="text-right"><input type="text" name="plans_options[<?php echo $image_row; ?>][title]" value="<?php echo $plans_options['title']; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" /></td>
					  
                      <td class="text-right"><input type="text" name="plans_options[<?php echo $image_row; ?>][price]" value="<?php echo $plans_options['price']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
					  
                      <td class="text-right"><input type="text" name="plans_options[<?php echo $image_row; ?>][sort_order]" value="<?php echo $plans_options['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
					  
                      <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $image_row++; ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3"></td>
                      <td class="text-left"><button type="button" onclick="addExtraoption();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
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
var variation_row = <?php echo $variation_row; ?>;

function addVariation() {
    html  = '<tr id="variation-row' + variation_row + '">';
	html += '  <td class="text-left" style="width: 50%;"><input type="text" name="plans_variation[' + variation_row + '][name]" value="" placeholder="<?php echo $entry_variation; ?>" class="form-control" /><input type="hidden" name="plans_variation[' + variation_row + '][variation_id]" value="" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#variation-row' + variation_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

	$('#variation tbody').append(html);

	variationautocomplete(variation_row);

	variation_row++;
}

function variationautocomplete(variation_row) {
	$('input[name=\'plans_variation[' + variation_row + '][name]\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=membership/variation/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['variation_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'plans_variation[' + variation_row + '][name]\']').val(item['label']);
			$('input[name=\'plans_variation[' + variation_row + '][variation_id]\']').val(item['value']);
		}
	});
}

$('#variation tbody tr').each(function(index, element) {
	variationautocomplete(index);
});
//--></script>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addExtraoption() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-right"><input type="text" name="plans_options[' + image_row + '][title]" value="" placeholder="<?php echo $entry_title; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="plans_options[' + image_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="plans_options[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

	image_row++;
}
//--></script>

  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
