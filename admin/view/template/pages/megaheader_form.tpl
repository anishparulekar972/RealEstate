<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-megaheader" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-megaheader" class="form-horizontal">
			<div class="form-group required">
				<label class="col-sm-2 control-label"><?php echo $text_title; ?></label>
				<div class="col-sm-10">
					<?php foreach ($languages as $language) { ?>
					<div class="input-group pull-left"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
						<input type="text" name="megaheader_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($megaheader_description[$language['language_id']]) ? $megaheader_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
					</div>
					<?php if (isset($error_title[$language['language_id']])) { ?>
					<div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
					<?php } ?>
					<?php } ?>
					
					
				</div>
				
				
			</div>
		
			<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $text_icontitle; ?></label>
			<div class="col-sm-10">
			 <input type="text" name="title_icon" value="<?php echo $title_icon?>" placeholder="<?php echo $entry_icontitle; ?>" class="form-control" />
			</div>
			</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $text_selectimagetype; ?></label>
			<div class="col-sm-10">
				<select class="form-control" name="bgimagetype" id="menubackground">
					<option value=""><?php echo $text_select ?> </option> 
					<option value="uploadimage" <?php if($bgimagetype=='uploadimage') {?> selected="selected" <?php } ?>>Upload Background Image</option> 
					<option value="selectpattern" <?php if($bgimagetype=='selectpattern') {?> selected="selected" <?php } ?>>Select Pattern</option> 
				</select>
			</div>
		</div>
		
		<div id="uploadimage" class="form-group colors" style="display:none;border-top:solid 5px #ddd; margin-bottom:10px; padding:15px;">
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_image; ?></label>
				<div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
				  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
				</div>
			</div>
		</div>
		<div id="selectpattern" class="form-group colors" style="display:none;border-top:solid 5px #ddd; margin-bottom:10px; padding:15px;">
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo $text_patternimage; ?></label>
				<div class="col-sm-10">
					<?php $chec = 'checked="checked"';?>
					
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage"  value="p1"  <?php if($patternimage=='p1') { echo $chec; }?> class="patrnradio"/>
					
					<img src="view/image/pattern/p1.png" class="img-responsive patterns  <?php if($patternimage=='p1') { echo 'bordered'; }?>"/>
					</label>
					</div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p2" <?php if($patternimage=='p2') { echo $chec; }?> class="patrnradio"/>
					<img src="view/image/pattern/p2.png" class="img-responsive patterns  <?php if($patternimage=='p2') { echo 'bordered'; }?>" />
					</label>
					</div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p3" <?php if($patternimage=='p3') { echo $chec; }?> class="patrnradio"/>
					<img src="view/image/pattern/p3.png" class="img-responsive patterns <?php if($patternimage=='p3') { echo 'bordered'; }?> "/>
					</label>
					</div>
					<div class="pull-left">
					<label>
					<input type="radio"name="patternimage" value="p4" <?php if($patternimage=='p4') { echo $chec; }?> class="patrnradio"/>
					<img src="view/image/pattern/p4.png" class="img-responsive patterns <?php if($patternimage=='p4') { echo 'bordered'; }?>"/>
					</label>
					</div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p5" <?php if($patternimage=='p5') { echo $chec; }?>class="patrnradio"/>
					<img src="view/image/pattern/p5.png" class="img-responsive patterns <?php if($patternimage=='p5') { echo 'bordered'; }?>"/>
					</label>
					</div>
					<div class="pull-left">
					<label>					
					<input type="radio"name="patternimage" value="p6" <?php if($patternimage=='p6') { echo $chec; }?> class="patrnradio"/>
					<img src="view/image/pattern/p6.png" class="img-responsive patterns <?php if($patternimage=='p6') { echo 'bordered'; }?>"/>
					</label>
					</div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p7" <?php if($patternimage=='p7') { echo $chec; }?> class="patrnradio"/>
					<img src="view/image/pattern/p7.png" class="img-responsive patterns <?php if($patternimage=='p7') { echo 'bordered'; }?>"/>
					</label>
					</div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p8" <?php if($patternimage=='p8') { echo $chec; }?>class="patrnradio"/>
					<img src="view/image/pattern/p8.png" class="img-responsive patterns <?php if($patternimage=='p8') { echo 'bordered'; }?>"/>
					</label></div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p9" <?php if($patternimage=='p9') { echo $chec; }?> class="patrnradio"/>
					<img src="view/image/pattern/p9.png" class="img-responsive patterns <?php if($patternimage=='p9') { echo 'bordered'; }?>"/>
					</label></div>
					<div class="pull-left">
					<label>
					<input type="radio" name="patternimage" value="p10" <?php if($patternimage=='p10') { echo $chec; }?>class="patrnradio"/>
					<img src="view/image/pattern/p10.png" class="img-responsive patterns  <?php if($patternimage=='p10') { echo 'bordered'; }?>"/>
					</label></div>
					
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $text_type; ?></label>
			<div class="col-sm-10">
				<select class="form-control" name="type" id="menuselector">
					<option value=""><?php echo $text_select ?> </option> 
					<option value="category" <?php if($type=='category') {?> selected="selected" <?php } ?>><?php echo $text_category; ?></option> 
					<option value="information" <?php if($type=='information') {?> selected="selected" <?php } ?>><?php echo $text_info; ?></option> 
					<option value="customtype" <?php if($type=='customtype') {?> selected="selected" <?php } ?>><?php echo $text_custom; ?></option> 
					<option value="editor" <?php if($type=='editor') {?> selected="selected" <?php } ?>><?php echo $text_editor; ?></option>
					 
				</select>
			</div>
				
		</div>	
			
			<!--ajex-->
				<div style="width:100%;border:solid 5px #ddd; margin-bottom:10px; display:none"></div>
				
			<!--Start Category-->
				<div id="category" class="form-group colors" style="display:none;border-top:solid 5px #ddd; margin-bottom:10px; padding:15px;">
						<label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
						<div class="col-sm-10">
							<input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
							<div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
								<?php foreach ($product_categories as $product_category) { ?>
								<div id="product-category<?php echo $product_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_category['name']; ?>
									<input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
								</div>
								<?php } ?>
							</div>
						</div>
					<div class="form-group license_cate">
            <label class="col-sm-2 control-label" for="input-sort-order"></label>
								<div class="col-sm-6">
								
								<label class="checkbox-inline col-sm-12 ">
							   <input type="checkbox" name="productsetting[category][categoryimage]" <?php echo isset($productsetting['category']['categoryimage'])? 'checked="checked"':''; ?> value="1"  />
								<?php echo $text_category_image; ?>
								 </label>
					 
					 
					
					 
					 
					 
					<label class="checkbox-inline col-sm-12">
                   <input type="checkbox" name="productsetting[category][subcategory]" <?php echo isset($productsetting['category']['subcategory'])? 'checked="checked"':''; ?>  value="1"  />
                    <?php echo $text_subcategory; ?>
                     </label>
                  <label class="checkbox-inline col-sm-12">
                   
                    <input type="checkbox" name="productsetting[category][product]" value="1"  <?php echo isset($productsetting['category']['product'])? 'checked="checked"':''; ?>   />
                    <?php echo $text_product1; ?>
                  
                  </label>

			<label class="checkbox-inline col-sm-12">
				<input type="checkbox" name="productsetting[category][name]" <?php echo isset($productsetting['category']['name'])? 'checked="checked"':''; ?>  value="1"/>
					<?php echo $text_pname; ?>
			</label>
			<label class="checkbox-inline col-sm-12">
				<input type="checkbox" name="productsetting[category][image]" <?php echo isset($productsetting['category']['image'])? 'checked="checked"':''; ?> value="1" />
					<?php echo $text_image; ?>
			</label>
			
			
			
			
			<label class="checkbox-inline col-sm-12">
				<input type="checkbox" name="productsetting[category][price]" <?php echo isset($productsetting['category']['price'])? 'checked="checked"':''; ?>  value="1"/>
					<?php echo $text_price; ?>
			</label>
			
                </div>
          </div>
				</div>
			  <!--End Category-->
			  
			   <!--Start Information-->
			  <div id="information" class="form-group colors" style="display:none">
					<label class="col-sm-2 control-label" for="input-information"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $text_information ?></span></label>
					<div class="col-sm-10">
						<input type="text" name="information" value="" placeholder="<?php echo $entry_information; ?>" id="input-information" class="form-control" />
						<div id="header-information" class="well well-sm" style="height: 150px; overflow: auto;">
							<?php foreach ($header_informationies as $header_information) { ?>
							<div id="header-information<?php echo $header_information['information_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $header_information['name']; ?>
								<input type="hidden" name="header_information[]" value="<?php echo $header_information['information_id']; ?>" />
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			  <!--End Information-->
			  
			   
			  
				<!--Start Custom-->
				<div id="customtype" class="form-group colors" style="display:none">
				<div class="table-responsive">
							<table id="customs" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<td class="text-left"><?php echo $text_custname; ?></td>
										<td class="text-left"><?php echo $text_custurl; ?></td>
										<td class="text-right"><?php echo $text_sort_order; ?></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php $custom_row = 0; ?>
									<?php foreach ($custom_types as $custom_type) { ?>
									<tr id="custom-row<?php echo $custom_row; ?>">
					<td class="text-left"><?php foreach ($languages as $language) { ?>
					<div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
					 
					<input type="text" name="custom_type[<?php echo $custom_row; ?>][megaheader_ctype_desc][<?php echo $language['language_id']; ?>][custname]" value="<?php echo isset($custom_type['megaheader_ctype_desc'][$language['language_id']]) ? $custom_type['megaheader_ctype_desc'][$language['language_id']]['custname'] : ''; ?>"  placeholder="<?php echo $entry_custname; ?>" class="form-control" />
						</div>
					 <?php } ?>
					 
					</td> 
					
					
					
					<td class="text-left"><input type="text" name="custom_type[<?php echo $custom_row; ?>][custurl]" value="<?php echo $custom_type['custurl']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
										<td class="text-right"><input type="text" name="custom_type[<?php echo $custom_row; ?>][sort_order]" value="<?php echo $custom_type['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
										<td class="text-left"><button type="button" onclick="$('#custom-row<?php echo $custom_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
									</tr>
									<?php $custom_row++; ?>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="3"></td>
										<td class="text-left"><button type="button" onclick="addCustom();" data-toggle="tooltip" title="<?php echo $button_custom; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
									</tr>
								</tfoot>
							</table>
						</div>
                </div>
				<!--End Custom-->
				<!--start Editor-->
				<div id="editor" class="form-group colors" style="display:none">
				
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
               <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />  <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
			  
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-customcode<?php echo $language['language_id']; ?>"><?php echo $text_customcode; ?></label>
                    <div class="col-sm-10">
                      <textarea name="customcode_description[<?php echo $language['language_id']; ?>][customcode]" placeholder="<?php echo $entry_customcode; ?>" id="input-customcode<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($customcode_description[$language['language_id']]) ? $customcode_description[$language['language_id']]['customcode'] : ''; ?></textarea>
                    
                    </div>
                  </div>
                  
                </div>
                <?php } ?>
              </div>
              </div>         
			
				<!--end Editor-->
				
								
			  <!--ajex-->	 
						<div class="form-group hide">
							<label class="col-sm-2 control-label" for="input-row"><?php echo $text_row; ?></label>
							<div class="col-sm-10">
								<input type="text" name="row" value="<?php echo $row; ?>" placeholder="<?php echo $entry_row; ?>" id="input-row" class="form-control" />
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-col"><?php echo $text_col; ?></label>
							<div class="col-sm-10">
								<input type="text" name="col" value="<?php echo $col; ?>" placeholder="<?php echo $entry_col; ?>" id="input-col" class="form-control" />
								</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-sort_order"><?php echo $text_sort_order; ?></label>
							<div class="col-sm-10">
								<input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort_order" class="form-control" />
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-url"><?php echo $text_url; ?></label>
							<div class="col-sm-10">
								<input type="text" name="url" value="<?php echo $url; ?>" placeholder="<?php echo $entry_url; ?>" id="input-url" class="form-control" />
								</div>
						</div>
						 <div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $text_open; ?></label>
							<div class="col-sm-10">
								<label class="radio-inline">
									<?php if ($open) { ?>
									<input type="radio" name="open" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="open" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								</label>
								<label class="radio-inline">
									<?php if (!$open) { ?>
									<input type="radio" name="open" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="open" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								</label>
							</div>
						</div>
					 <div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $text_enable; ?></label>
							<div class="col-sm-10">
								<label class="radio-inline">
									<?php if ($enable) { ?>
									<input type="radio" name="enable" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="enable" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								</label>
								<label class="radio-inline">
									<?php if (!$enable) { ?>
									<input type="radio" name="enable" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="enable" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								</label>
							</div>
						</div>
					 <div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $text_showicon; ?></label>
							<div class="col-sm-10">
								<label class="radio-inline">
									<?php if ($showicon) { ?>
									<input type="radio" name="showicon" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="showicon" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								</label>
								<label class="radio-inline">
									<?php if (!$showicon) { ?>
									<input type="radio" name="showicon" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="showicon" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								</label>
							</div>
						</div>
						<!-- //// new changes  27-10-2016/// -->
			   <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_store; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        <?php if (in_array(0, $meagaheader_store)) { ?>
                        <input type="checkbox" name="meagaheader_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="meagaheader_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($store['store_id'], $meagaheader_store)) { ?>
                        <input type="checkbox" name="meagaheader_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="meagaheader_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
			    <!-- //// new changes  27-10-2016/// -->
					 <div class="form-group">
						<label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
						<div class="col-sm-10">
							<select class="form-control" name="status" id="input-status" >
								<option  <?php if($status == '1'){echo 'selected="selected"';}?>value="1"><?php echo $text_enable; ?></option>
							<option <?php if($status == '0'){echo 'selected="selected"';}?>value="0"><?php echo $text_disable; ?></option>					
						 </select>	
						</div>
					</div>					
			</div>
		</div>
		</form>
	</div> 	
 <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
 <script>
    $(function() {
        $('#menuselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
		$('#'+$('#menuselector option:selected').val()).show();
    });
</script>

<script>
    $(function() {
        $('#menubackground').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
		$('#'+$('#menubackground option:selected').val()).show();
    });
</script>



<script type="text/javascript"><!--
var custom_row = <?php echo $custom_row; ?>;

function addCustom() {
	html  = '<tr id="custom-row' + custom_row + '">';	
	html += '  <td class="text-left">';
	<?php foreach ($languages as $language) { ?>
	html += '    <div class="input-group">';
	html += '      <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span><input type="text" name="custom_type[' + custom_row + '][megaheader_ctype_desc][<?php echo $language['language_id']; ?>][custname]" value="" placeholder="<?php echo $entry_custname; ?>" class="form-control" />';
	 html += '    </div>';
	<?php } ?>
	html += '  </td>';
	
	html += '  <td class="text-left"><input type="text" name="custom_type[' + custom_row + '][custurl]" value="" placeholder="<?php echo $entry_custurl; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="custom_type[' + custom_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#custom-row' + custom_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#customs tbody').append(html);

	custom_row++;
}
//--></script>

<script type="text/javascript"><!--
// Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=property/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#product-category' + item['value']).remove();
		
		$('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Informations
$('input[name=\'information\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=megaheader/megaheader/infoautocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['information_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'information\']').val('');
		
		$('#header-information' + item['value']).remove();
		
		$('#header-information').append('<div id="header-information' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="header_information[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#header-information').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});


$('.patterns').click(function(){
	$('.patterns').removeClass('bordered');
	$(this).addClass('bordered');
})

//--></script>
 <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>  
</div>
<style>
.bordered{border:solid 1px green !important}
.borderedactive{border:solid 1px green !important}
.patterns{width:50px;height:50px; border:solid 1px #ddd;margin-right:10px;}
.patrnradio{display:none}
</style>
