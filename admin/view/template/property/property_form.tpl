	<?php echo $header; ?><?php echo $column_left; ?>
	<div id="content">
		<div class="page-header">
			<div class="container-fluid">
				<div class="pull-right">
				<button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
								<li>
								<a href="#3a" data-toggle="tab">
								<?php echo $tab_Address_Map; ?>
								</a>
								</li>

								<li>
								<a href="#4a" data-toggle="tab">
								<?php echo $tab_image; ?>
								</a>
								</li>
								<li>
								<a href="#5a" data-toggle="tab">
								<?php echo $tab_feature; ?>
								</a>
								</li>

								<li>
								<a href="#6a" data-toggle="tab">
								<?php echo $tab_neareast_place; ?>
								</a>
								</li>
								<li>
								<a href="#custom" data-toggle="tab">
								<?php echo $tab_customfield; ?>
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
														<input type="text" name="Property_description[<?php echo $language['language_id']; ?>][name]" value="<?php if(isset($Property_description[$language['language_id']]['name'])){echo $Property_description[$language['language_id']]['name']; }?>" placeholder="<?php echo $entry_name;?>" id="input-name" class="form-control" />
														<?php if(isset($error_name[$language['language_id']])) { ?>
														<div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
														<?php } ?>
													</div>
												</div>
												<div class="form-group">
														<label class="col-sm-2 control-label" for="input-description">
														<?php echo $lable_description;?>
														</label>
														<div class="col-sm-10">
														<textarea name="Property_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control summernote"><?php if(isset($Property_description[$language['language_id']]['description'])) { echo $Property_description[$language['language_id']]['description']; }?></textarea>
														
														</div>
												</div>
												<div class="form-group required ">
													<label class="col-sm-2 control-label" for="input-meta_title"><?php echo $lable_meta_title; ?></label>
													<div class="col-sm-10">
													<input type="text" name="Property_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php if(isset($Property_description[$language['language_id']]['meta_title'])){echo $Property_description[$language['language_id']]['meta_title']; }?>" placeholder="<?php echo $entry_meta_title;?>" id="input-meta_title" class="form-control "/>
													<?php if(isset($error_meta_title[$language['language_id']])) { ?>
													<div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
													<?php } ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label" for="input-meta_description"><?php echo $lable_meta_descriptions; ?></label>
													<div class="col-sm-10">
													<textarea name="Property_description[<?php echo $language['language_id']; ?>][meta_description]" placeholder="<?php echo $entry_meta_descriptions; ?>" id="input-meta_description" class="form-control"><?php if(isset($Property_description[$language['language_id']]['meta_description'])) { echo $Property_description[$language['language_id']]['meta_description']; }?></textarea>
													</div>
												</div>								

												<div class="form-group">
													<label class="col-sm-2 control-label" for="input-meta_keyword"><?php echo $lable_meta_keyword; ?></label>
													<div class="col-sm-10">
													<textarea name="Property_description[<?php echo $language['language_id']; ?>][meta_keyword]" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta_keyword" class="form-control"><?php if(isset($Property_description[$language['language_id']]['meta_keyword'])) { echo $Property_description[$language['language_id']]['meta_keyword']; }?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label" for="input-tag"><?php echo $lable_tag; ?></label>
													<div class="col-sm-10">
													<textarea name="Property_description[<?php echo $language['language_id']; ?>][tag]" placeholder="<?php echo $entry_tag; ?>" id="input-tag" class="form-control"><?php if(isset($Property_description[$language['language_id']]['tag'])) { echo $Property_description[$language['language_id']]['tag']; }?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label" for="input-seo_url"><?php echo $lable_SEO_URL; ?></label>
													<div class="col-sm-10">
													<input type="text" name="seo_url" value="" placeholder="<?php echo $entry_SEO_URL;?>" id="seo_url" class="form-control"/>
													</div>
												</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<div class="tab-pane" id="2a">
									<div class="form-group required">
										<label class="col-sm-2 control-label" for="input-sort_order">
										<?php echo $lable_sort_order;?>
										</label>
										<div class="col-sm-10 ">
										<input type="text" name="sort_order" value="<?php echo $sort_order;?>" placeholder="<?php echo $entry_sort_order;?>" id="input-sort_order" class="form-control" />
										<?php if ($error_sort_order) { ?>
										<div class="text-danger"><?php echo $error_sort_order; ?></div>
										<?php } ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-agent"><?php echo $lable_agent; ?></label>
										<div class="col-sm-10">
											<input type="text" name="agent" value="<?php echo $agent;?>" placeholder="<?php echo $entry_agent; ?>" id="input-agent" class="form-control" />
											<input type="hidden" name="property_agent_id" value="<?php echo $property_agent_id; ?>" />
										</div>
   									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo $lable_image; ?></label>
											<div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" placeholder="<?php echo $placeholder; ?>" /></a>
												<input type="hidden" name="image_thumb" value="<?php echo $image; ?>" id="inputimage" />
										</div>
									</div>
									<div class="form-group">
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
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-approved"><?php echo $lable_approved;?></label>
										<div class="col-sm-10">
											<select name="approved" id="input-approved" class="form-control">
												<?php if ($approved) { ?>
												<option value="1" selected="selected"><?php echo $text_enable; ?></option>
												<option value="0"><?php echo $text_disable; ?></option>
												<?php } else { ?>
												<option value="1"><?php echo $text_enable; ?></option>
												<option value="0" selected="selected"><?php echo $text_disable; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-video"><?php echo $lable_video; ?></label>
										<div class="col-sm-10">
											<input type="text" name="video" value="<?php echo $video;?>" placeholder="<?php echo $entry_video;?>" id="input-video" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-property_status"><?php echo $lable_property_status; ?></label>
										<div class="col-sm-10">
											<input type="text" name="property_status" value="<?php echo $property_status;?>" placeholder="<?php echo $entry_property_status; ?>" id="input-property_status" class="form-control" />
											<input type="hidden" name="property_status_id" value="<?php echo $property_status_id; ?>" />
											<?php if ($error_property_status_id) { ?>
									<div class="text-danger"><?php echo $error_property_status_id; ?></div>
                			  <?php } ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-price"><?php echo $lable_Price; ?></label>
										<div class="col-sm-10">
											<input type="text" name="price" value="<?php echo $price;?>" placeholder="<?php echo $entry_Price;?>" id="input-price" class="form-control"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-category"><?php echo $lable_category; ?></label>
										<div class="col-sm-10">
											<input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
											<div id="property_category" class="well well-sm" style="height: 150px; overflow: auto;">
												<?php if(isset($categories)) {
												foreach($categories as $category){?>
													<div id="property_category<?php echo $category['category_id']?>">
													<i class="fa fa-minus-circle"></i>
													<?php echo $category['name']?>
													<input type="hidden" name="category_id[]" value="<?php echo $category['category_id']?>">
													</div>
													<?php
												}
												}?>
											</div>
										</div>
									</div>

								</div>
								<div class="tab-pane" id="3a">
									<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-country"><?php echo $lable_country; ?></label>
								<div class="col-sm-10">
									<select name="country_id" id="input-country" class="form-control">
										<option value=""><?php echo $text_select; ?></option>
										<?php foreach ($countrys as $country) { ?>
											<?php if ($country['country_id'] == $country_id) { ?>
												<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
									<?php if ($error_country_id) { ?>
										<div class="text-danger"><?php echo $error_country_id; ?></div>
									<?php } ?>
									
								</div>
							</div>
								<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-zone"><?php echo $lable_Zone_region; ?></label>
								<div class="col-sm-10">
									<select name="zone_id" id="input-zone" class="form-control">
									</select>
									<?php if ($error_zone_id) { ?>
										<div class="text-danger"><?php echo $error_zone_id; ?></div>
									<?php } ?>
								</div>
							</div>
							<!--select options -->
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-city"><?php echo $lable_city; ?></label>
										<div class="col-sm-10">
										<input type="text" name="city" value="<?php echo $city;?>" placeholder="<?php echo $entry_city;?>" id="input-city" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-local_area"><?php echo $lable_local_area; ?></label>
										<div class="col-sm-10">
											<textarea name="local_area" placeholder="<?php echo $entry_local_area; ?>" id="input-local_area" class="form-control"><?php echo $local_area; ?></textarea>
										</div>
									</div>
								<div class="form-group">
										<label class="col-sm-2 control-label" for="input-pincode"><?php echo $lable_pincode; ?></label>
										<div class="col-sm-10">
											<input type="text" name="pincode" value="<?php echo $pincode;?>" placeholder="<?php echo $entry_pincode;?>" id="input-pincode" class="form-control"/>
									   </div>
									</div>
									<!--map-->
									<div class="container">
						
										<div class="col-md-10">
										<button type="button"  id="addmap" class="btn btn-info"><?php echo $text_map; ?></button>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="input-latitude"><?php echo $lable_latitude; ?></label>
											<div class="col-sm-10">
												<input type="text" name="latitude" value="<?php echo $latitude;?>"placeholder="<?php echo $entry_latitude;?>" id="input-latitude" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="input-longitude"><?php echo $lable_longitude; ?></label>
											<div class="col-sm-10">
											<input type="text" name="longitude" value="<?php echo $longitude;?>" placeholder="<?php echo $entry_longitude;?>" id="input-longitude" class="form-control"/>
											</div>
										</div>
										</div>
										<div class="col-md-6" id="map_canvas">
										</div>
									</div><!--map-->
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-neighborhood"><?php echo $lable_neighborhood; ?></label>
										<div class="col-sm-10">
											<input type="text" name="neighborhood" value="<?php echo $neighborhood;?>" placeholder="<?php echo $entry_neighborhood;?>" id="input-neighborhood" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-area"><?php echo $lable_area; ?></label>
										<div class="col-sm-4">
											<input type="text" name="area" value="<?php echo $area;?>" placeholder="<?php echo $entry_area;?>" id="input-package-title" class="form-control"/>
										</div>
										<div class="col-sm-4">
											<select name="area_type" class="form-control" id="sel1">
									<?php foreach ($areatypes as $areatype){ ?>
										<?php if ($area_type == $areatype['name']){ ?>
										<option value="<?php echo $areatype['name']; ?>" selected="selected">
										<?php echo $areatype['name']; ?>
										</option> 
										<?php } else { ?>
										<option value="<?php echo $areatype['name']; ?>"><?php echo $areatype['name']; ?>
										</option> 
										<?php } ?>
									<?php } ?>
									</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-bedrooms"><?php echo $lable_bedrooms; ?></label>
										<div class="col-sm-10">
											<span class="form-group-btn">
												<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="bedrooms">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
											<input type="text" name="bedrooms" value="<?php echo$bedrooms?>" placeholder="<?php echo $entry_bedrooms;?>" id="input-bedrooms" class="input-small" size="12"  min="1" max="10000" size=""/>
											<span class="form-group-btn">
											<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="bedrooms">
											<span class="glyphicon glyphicon-minus"></span>
											</button>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-bathrooms"><?php echo $lable_bathrooms; ?></label>
										<div class="col-sm-10">
											<span class="form-group-btn">
											<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="bathrooms">
												<span class="glyphicon glyphicon-plus"></span>
											</button>
											</span>
											<input type="text" name="bathrooms" value="<?php echo$bathrooms?>" placeholder="<?php echo $entry_bathrooms;?>" id="ex2" class="" min="1" max="10000" size="12"/>
											<span class="form-group-btn">
											<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="bathrooms">
											<span class="glyphicon glyphicon-minus"></span>
											</button>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-roomcount"><?php echo $lable_roomcount; ?></label>
										<div class="col-sm-10">
											<input type="text" name="roomcount" value="<?php echo$roomcount?>" placeholder="<?php echo $entry_roomcount;?>" id="input-roomcount" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-Parkingspaces"><?php echo $lable_Parkingspaces; ?></label>
										<div class="col-sm-10">
											<input type="text" name="Parkingspaces" value="<?php echo $Parkingspaces;?>" placeholder="<?php echo $entry_Parkingspaces;?>" id="input-Parkingspaces" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="input-builtin"><?php echo $lable_builtin; ?></label>
										<div class="col-sm-10">
											<input type="text" name="builtin" value="<?php echo $builtin;?>" placeholder="<?php echo $entry_builtin;?>" id="input-builtin" class="form-control"/>
										</div>
									</div>
									
									
								</div>
								<div class="tab-pane" id="4a">
									<div class="table-responsive">
										<table id="images" class="table table-striped table-bordered table-hover">
												<thead>
												<tr>
												<td class="text-left"><?php echo $lable_images; ?></td>
												<td class="text-left"><?php echo $lable_titles; ?></td>
												<td class="text-left"><?php echo $lable_alt; ?></td>
												<td></td>
												</tr>
											</thead>
											<tbody>
												<?php $image_row = 0; ?>
												<?php if(isset($image_tabs)){?>
												<?php foreach ($image_tabs as $image_tabss) { ?>
									<tr id="image-row<?php echo $image_row;?>">
									<td class="text-center"><a href="" id="thumb-image-<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $image_tabss['thumbs']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
									<input type="hidden" name="images_tab[<?php echo $image_row; ?>][image]" value="<?php echo $image_tabss['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
									<td class="text-right"><input type="text" name="images_tab[<?php echo $image_row; ?>][title]" value="<?php echo $image_tabss['title']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
									<td class="text-right"><input type="text" name="images_tab[<?php echo $image_row; ?>][alt]" value="<?php echo $image_tabss['alt']; ?>" placeholder="<?php echo $entry_alt; ?>" class="form-control" /></td>
									<td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>

									</tr>
									<?php $image_row++;?>
									<?php } ?>				
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
						<div class="tab-pane" id="5a">
									<div class="table-responsive">
										<table id="feature" class="table table-striped table-bordered table-hover">
											<tbody>	
												<tr>
													<?php if ($feature) { ?>
														<?php foreach ($feature as $featureresult) {
     												?>	
													<?php 
													$check='';
													if(in_array($featureresult['feature_id'],$feature_c)){
														$check="checked";
													}
													?>
													<td style="width: 1px;" class="text-center">
													<input <?php echo $check;?> type="checkbox"  name="features[]" value="<?php echo $featureresult['feature_id']; ?>" />
													</td>

													<td class="text-center"><?php if ($featureresult['image']) { ?>
													<img src="<?php echo $featureresult['image']; ?>" alt="<?php echo $featureresult['image']; ?>" class="img-thumbnail" />
													<?php } else { ?>
													<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
													<?php } ?>
													</td>
													<td class="text-left"><?php echo $featureresult['name']; ?></td>
												</tr>
												<?php } ?> 
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="6a">
									<div class="table-responsive">
										<table id="nearestplace" class="table table-striped table-bordered table-hover">
											<tbody>
											<?php if ($nearestplace) { ?>
										   
											<?php foreach($nearestplace as $nearestplaceid) { ?>	
											<tr>
												<td>
												<div class="form-group">
													<div class="col-sm-10">
													<input type="text" name="nearestplace[<?php echo $nearestplaceid['nearest_place_id']; ?>]" value="<?php echo $nearestplaceid['destinies']?>" placeholder="<?php echo $entry_destinies;?>" id="input-package-titl" class="form-control"/>
													</div>
												</div>
												</td>
												<td class="text-center"><?php if ($nearestplaceid['image']) { ?>
												<img src="<?php echo $nearestplaceid['image']; ?>" alt="<?php echo $nearestplaceid['image']; ?>" class="img-thumbnail" />
												<?php } else { ?>
												<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
												<?php } ?>
												</td>
												<td class="text-left"><?php echo $nearestplaceid['name']; ?></td>
											</tr>
											<?php } ?> 
											<?php }?>
									</tbody>
								</table>			
							</div>
						</div>
						<div class="tab-pane" id="custom">
						<?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['type'] == 'select') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <select name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <?php if (isset($account_custom_field[$custom_field['name']]) && $custom_field_value['custom_field_id'] == $custom_field[$custom_field['custom_field_id']]) { ?>
                            <option value="<?php echo $custom_field_value['name']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $custom_field_value['name']; ?>"><?php echo $custom_field_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'radio') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <div class="radio">
                              <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['name'] == $account_custom_field[$custom_field['custom_field_id']]) { ?>
                              <label>
                                <input type="radio" name="custo_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['name']; ?>" checked="checked" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } else { ?>
                              <label>
                                <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['name']; ?>" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'checkbox') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <div class="checkbox">
                              <?php if(isset($account_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['name'], $account_custom_field[$custom_field['custom_field_id']])) { ?>
                              <label>
                                <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['name']; ?>" checked="checked" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } else { ?>
                              <label>
                                <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['name']; ?>" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'textarea') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'file') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                       	<a href="" id="thumb-imagefile" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumbimage; ?>" alt="" title="" placeholder="<?php echo $placeholder2; ?>" /></a>
                          <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : ''); ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'date') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group date">
                            <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]"  value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn date">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'time') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group time">
                            <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'datetime') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group datetime">
                            <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                     
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
	<script type="text/javascript"><!--
		var image_row = <?php echo $image_row; ?>;
		function addExtraoption() {
		html  = '<tr id="image-row' + image_row + '">';
		html += '<td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="images_tab[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
		html += '  <td class="text-right"><input type="text" name="images_tab[' + image_row + '][title]"  value="<?php echo $title;?>" placeholder="<?php echo $entry_titles; ?>" class="form-control" /></td>';
		html += '  <td class="text-right"><input type="text" name="images_tab[' + image_row + '][alt]" value="<?php echo $alt;?>" placeholder="<?php echo $entry_alt; ?>" class="form-control" /></td>';
		html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
		html += '</tr>';
		$('#images tbody').append(html);
		image_row++;
	}
	//--></script>


	<script type="text/javascript"><!--
		$('input[name=\'category\']').autocomplete({
		'source': function(request, response) {
		$.ajax({
		url: 'index.php?route=property/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
		dataType: 'json',
		success: function(json) {
		json.unshift({
		category_id: 0,
		name: '<?php echo $text_none; ?>'
		});

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
		$('input[name=\'category\']').val();

		$('#property_category' + item['value']).remove();

		$('#property_category').append('<div id="property_category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_id[]" value="' + item['value'] + '" /></div>');


		}
		});
		$('#property_category').delegate('.fa-minus-circle', 'click', function() {
		$(this).parent().remove();
		});
	//--></script>

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

	<script>
		$('input[name=\'property_status\']').autocomplete({
		'source': function(request, response) {
		$.ajax({
		url: 'index.php?route=property/property_status/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
		dataType: 'json',
		success: function(json) {
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
		$('input[name=\'property_status\']').val(item['label']);
		$('input[name=\'property_status_id\']').val(item['value']);
		}
		});
	</script>
	<script>
		$('.btn-number').click(function(e){
		e.preventDefault();
		fieldName = $(this).attr('data-field');
		type      = $(this).attr('data-type');
		var input = $("input[name='"+fieldName+"']");
		var currentVal = parseInt(input.val());
		if (!isNaN(currentVal)) {
		if(type == 'minus') {

		if(currentVal > input.attr('min')) {
		input.val(currentVal -1).change();
		} 
		if(parseInt(input.val()) == input.attr('min')) {
		$(this).attr('disabled', true);
		}
		} else if(type == 'plus') {

			if(currentVal < input.attr('max')) {
			input.val(currentVal +1).change();
			}
			if(parseInt(input.val()) == input.attr('max')) {
			$(this).attr('disabled', true);
			}

		}
		} else {
		input.val(0);
		}
		});

		$('.input-number').focusin(function(){
		$(this).data('oldValue', $(this).val());
		});
		$('.input-number').change(function() {

		minValue =  parseInt($(this).attr('min'));
		maxValue =  parseInt($(this).attr('max'));
		valueCurrent = parseInt($(this).val());

		name = $(this).attr('name');
		if(valueCurrent >= minValue) {
		$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
		alert('Sorry, the minimum value was reached');
		$(this).val($(this).data('oldValue'));
		}
		if(valueCurrent <= maxValue) {
		$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		} else {
		alert('Sorry, the maximum value was reached');
		$(this).val($(this).data('oldValue'));
		}
		});
	</script>
	

<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=property/property/country&token=<?php echo $token;?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>


<script>
$('#addmap').click(function(){
	$.ajax({
		url: 'index.php?route=property/property/getmapproperty&token=<?php echo $token;?>',
		type: 'post',
		data: $('select[name=\'country_id\'],select[name=\'zone_id\'],input[name=\'city\'],textarea[name=\'local_area\'],input[name=\'pincode\']'),
		dataType: 'json',
		beforeSend: function() {
		$('#addmap').after('<i class="fa fa-refresh fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
		},
		success: function(json) {
		$('.fa-spin').remove();
			if (json['success']) {
				$('#input-latitude').val(json['lat']);
				$('#input-longitude').val(json['lng']);
				
			}
		}
	 });					
	});	
</script>
<script>
	$('.time').datetimepicker({
		pickDate: false
	});	
		
	$('.datetime').datetimepicker({
		pickDate: true,
		pickTime: true
	});

	$('.date').datetimepicker({
		pickTime: false
	});
	
				
</script>
