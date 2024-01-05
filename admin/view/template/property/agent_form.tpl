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
                  <div class="form-group required">
                     <label class="col-sm-2 control-label" for="input-agentname"><?php echo $entry_Agent;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="agentname" value="<?php echo $agentname; ?>" placeholder="<?php echo $entry_Agent;?>" id="input-agentname" class="form-control" />
                        <?php if ($error_agentname) { ?>
                        <div class="text-danger"><?php echo $error_agentname; ?></div>
                        <?php } ?>
                     </div>
                  </div>
									
				<div class="form-group">
                     <label class="col-sm-2 control-label" for="input-positions"><?php echo $entry_positions;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="positions" value="<?php echo $positions; ?>" placeholder="<?php echo $entry_positions;?>" id="input-positions" class="form-control" />
                      </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                     <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" ></a>
                        <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                     </div>
                  </div>
                  <div class="form-group required">
                     <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="email" value="<?php echo $email;?>" placeholder="<?php echo $entry_email;?>" id="input-email" class="form-control" />
                        <?php if ($error_email) { ?>
                        <div class="text-danger"><?php echo $error_email; ?></div>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_address;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="address" value="<?php echo $address;?>" placeholder="<?php echo $entry_address;?>" id="input-address" class="form-control" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password;?></label>
                     <div class="col-sm-10">
                        <input type="password" name="password" value="" placeholder="<?php echo $entry_password;?>" id="input-password" class="form-control" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="input-city"><?php echo $entry_city;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="city" value="<?php echo $city;?>" placeholder="<?php echo $entry_city;?>" id="input-city" class="form-control" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="input-contact"><?php echo $entry_contact;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="contact" value="<?php echo $contact;?>" placeholder="<?php echo $entry_contact;?>" id="input-contact" class="form-control" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="input-pincode"><?php echo $entry_pincode;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="pincode" value="<?php echo $pincode;?>" placeholder="<?php echo $entry_pincode;?>" id="input-pincode" class="form-control" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="input-sort_order"><?php echo $entry_sort_order;?></label>
                     <div class="col-sm-10">
                        <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order;?>" id="input-sort_order" class="form-control" />
                     </div>
                  </div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-description"><?php echo $entry_descriptions; ?></label>
						<div class="col-sm-10">
						<textarea name="description" placeholder="<?php echo $entry_descriptions; ?>" id="input-description" class="form-control"> <?php echo $description;?></textarea>
						</div>
					</div>	
									
									
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="country">
                     <?php echo $entry_country;?>
                     </label>
                     <div class="col-sm-10">
                        <select class="form-control" id="country" name="country_id">
                           <?php if(isset($countries)){ ?>
                           <?php foreach ($countries as $result) {
                              $sel='';
                              if($country==$result['country_id'])
                              {
                              $sel="selected";
                              }
                               ?>
                           <option <?php echo $sel?> value="<?php echo $result['country_id'];?>">
                              <?php echo $result['name']?>
                           </option>
                           <?php }?>				
                           <?php }?>				
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label" for="status">
                     <?php echo $entry_status;?>
                     </label>
                     <div class="col-sm-10">
                        <select class="form-control" id="status" name="status" value="<?php echo $status; ?>">
                           <option value="1" <?php if(isset($status) && $status=1) { echo "selected"; }?>><?php echo $text_enable?></option>
                           <option value="0" <?php if(isset($status) && $status=0) { echo "selected"; }?>><?php echo $text_disable?></option>
                        </select>
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