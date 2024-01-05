<div class="row">
	<div class="col-sm-12">
		<div class="recent">
			<div class="panel panel-default">
			  <div class="panel-heading hide">
				<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $heading_title; ?></h3>
			  </div>
			  <div class="table-responsive">
				<table class="table">
				  <thead>
					<tr>
					  <td class="text-center"><?php echo $column_image; ?></td>
					  <td class="text-left"><?php echo $column_name; ?></td>
					  <td class="text-left"><?php echo $column_property_status; ?></td>
					  <td class="text-left"><?php echo $column_price; ?></td>
					  <td class="text-left"><?php echo $column_status; ?></td>
					  <td class="text-right"><?php echo $column_view; ?></td>
					</tr>
				  </thead>
				 <?php if (isset($propertys)) { ?>
					<?php foreach ($propertys as $property) { ?>
					<tr>
					<td class="text-center"><?php if ($property['image']) { ?>
						<img src="<?php echo $property['image']; ?>" alt="<?php echo $property['image']; ?>" class="img-thumbnail" />
						<?php } else { ?>
						<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
						<?php } ?>
					</td>
					
					  <td class="text-left"><?php echo $property['name']; ?></td>
					  <td class="text-left"><?php echo $property['property_status']; ?></td>
					  <td class="text-left"><?php echo $property['price']; ?></td>
					  <td class="text-left"><?php echo $property['status']; ?></td>
					<td class="text-right"><a href="<?php echo $property['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								<?php if ($property['approve']) { ?>
								<a href="<?php echo $property['approve']; ?>" data-toggle="tooltip" title="<?php echo $button_approve; ?>" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></a>
								<?php } else { ?>
								<button type="button" class="btn btn-success" disabled><i class="fa fa-thumbs-o-up"></i></button>
								<?php } ?>
								</td>
					</tr>
					<?php } ?>
					<?php } else { ?>
					<tr>
					  <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
					</tr>
					<?php } ?>
				  </tbody>
				</table>
			  </div>
			</div>
		</div>
	</div>

</div>