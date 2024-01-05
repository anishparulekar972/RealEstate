<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-news" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
       <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
    </div>
	<div class="panel-body">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-news" class="form-horizontal">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
				<li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
			</ul>
			<div class="tab-content">
				 <div class="tab-pane active in" id="tab-general">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?><span data-toggle="tooltip" title="<?php echo $help_name; ?>"> 
									</span></label>
								<div class="col-sm-10">
									<input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
									<?php if ($error_name) { ?>
									<div class="text-danger"><?php echo $error_name; ?></div>
									<?php } ?>
								</div>
						</div>
						<div class="form-group">
										<label class="col-sm-2 control-label" for="input-text"><?php echo $entry_text; ?><span data-toggle="tooltip" title="<?php echo $help_text; ?>"> 
									</span></label>
										<div class="col-sm-10">
											<input type="text" name="newslatertext" value="<?php echo $newslatertext; ?>" placeholder="<?php echo $entry_text; ?>" id="input-text" class="form-control" />
										</div>
							</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_unsubscribe; ?><span data-toggle="tooltip" title="<?php echo $help_unsubscribe; ?>"> 
									</span></label>
								<div class="col-sm-10">
									<select name="option_unsubscribe" class="form-control">
										<?php if ($option_unsubscribe) { ?>
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
								<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_mail; ?></label>
								<div class="col-sm-10">
								 <select name="newslettersubscribe_mail_status" class="form-control">
									<?php if ($newslettersubscribe_mail_status) { ?>
									<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
									<option value="0"><?php echo $text_disabled; ?></option>
									<?php } else { ?>
									<option value="1"><?php echo $text_enabled; ?></option>
									<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
									<?php } ?>
								 </select>
								</div>
						 </div>
					 <!-- <div class="form-group">
						<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_popup; ?></label>
						<div class="col-sm-10">
						 <select name="newslettersubscribe_thickbox" class="form-control">
							 <?php if ($newslettersubscribe_thickbox) { ?>
								<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								<option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
								<option value="1"><?php echo $text_enabled; ?></option>
								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
						 </select>
						</div>
					 </div>-->
	   
					 <div class="form-group">
							<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_popup; ?><span data-toggle="tooltip" title="<?php echo $help_popup; ?>"> 
									</span></label>
							<div class="col-sm-10">
							 <select name="newslettersubscribe_popup" class="form-control">
								 <?php if ($newslettersubscribe_popup) { ?>
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
							<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_registered; ?></label>
							<div class="col-sm-10">
							 <select name="newslettersubscribe_registered" class="form-control">
								 <?php if ($newslettersubscribe_registered) { ?>
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
								<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_options; ?></label>
										<div class="col-sm-10">
								<?php 
											$tmp_option_list = array('Select','1','2','3','4','5','6');
										?>
						 <select name="newslettersubscribe_option_field" class="form-control" onchange=	"load_options(this.value)">
								 <?php  
												foreach($tmp_option_list as $key => $opt){
													if($newslettersubscribe_option_field == $key){
														echo("<option value='".$key."' selected='selected'>".$opt."</option>");
													}else{
														echo("<option value='".$key."'>".$opt."</option>");
													}
												}
								?>    
						 </select>
						</div>
					</div>
	  
					<div class="form-group appendss">
							<?php  for($l=1;$l<=$newslettersubscribe_option_field;$l++){ 
										$field_var = "newslettersubscribe_option_field".$l;
								 ?>
						 <?php echo("Option".$l); ?>
						 <label class="col-sm-2 control-label" for="input-option">option<?php echo $l ?></label>
						 <div class="col-sm-10">
							<input type='text' class="form-control" name='newslettersubscribe_option_field<?php echo($l); ?>' value='<?php echo($field_var); ?>'>
						</div>
						<?php } ?>
					</div>
					<div class="form-group">
							<label class="col-sm-2 control-label" for="input-unsubscribe"><?php echo $entry_status; ?><span data-toggle="tooltip" title="<?php echo $help_status; ?>"> 
									</span></label>
								<div class="col-sm-10">
									 <select name="status" class="form-control">
										<?php if($newslettersubscribe_status){ ?>
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
					
					<div class="tab-pane" id="tab-data">						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-text_color"><?php echo $entry_text_color; ?><span data-toggle="tooltip" title="<?php echo $help_text_color; ?>"> 
							</span></label>
							<div class="col-sm-4">
								<div class="input-group demo2">
									<input type="text" name="newstext_color" value="<?php echo $newstext_color; ?>" placeholder="<?php echo $entry_text_color; ?>" id="input-text_color"  class="form-control " />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						 </div>
						 <div class="form-group">
							<label class="col-sm-2 control-label" for="input-text_color1"><?php echo $entry_text_color1; ?><span data-toggle="tooltip" title="<?php echo $help_text_color1; ?>"> 
							</span></label>
							<div class="col-sm-4">
								<div class="input-group demo2">
									<input type="text" name="newstextnopop_color" value="<?php echo $newstextnopop_color; ?>" placeholder="<?php echo $entry_text_color1; ?>" id="input-text_color1"  class="form-control " />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						 </div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bgtop"><?php echo $entry_bgtop_color; ?><span data-toggle="tooltip" title="<?php echo $help_bgtop; ?>"> 
							</span></label>
							<div class="col-sm-4">
									<div class="input-group demo2">
											<input type="text" name="pupbutoncolor" value="<?php echo $pupbutoncolor; ?>" placeholder="<?php echo $entry_bgtop_color; ?>" id="input-bgtop" class="form-control" />
											<span class="input-group-addon"><i></i></span>
									</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-bgbottom"><?php echo $entry_bgbottom_color; ?><span data-toggle="tooltip" title="<?php echo $help_bgbottom; ?>"> 
							</span></label>
							<div class="col-sm-4">
								<div class="input-group demo2">
									<input type="text" name="butontextcolor" value="<?php echo $butontextcolor; ?>" placeholder="<?php echo $entry_bgbottom_color; ?>" id="input-bgbottom" class="form-control" />
									<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						</div>
						<div class="form-group">
									<label class="col-sm-2 control-label" for="input-border"><?php echo $entry_border_color; ?><span data-toggle="tooltip" title="<?php echo $help_border; ?>"> 
									</span></label>
									<div class="col-sm-4">
										<div class="input-group demo2">
											<input type="text" name="buttonbg" value="<?php echo $buttonbg; ?>" placeholder="<?php echo $entry_border_color; ?>" id="input-border" class="form-control" />
											<span class="input-group-addon"><i></i></span>
										</div>
									</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-hover"><?php echo $entry_hover_color; ?><span data-toggle="tooltip" title="<?php echo $help_hover; ?>"> 
							</span></label>
							<div class="col-sm-4">
								<div class="input-group demo2">
										<input type="text" name="newsbutonhover" value="<?php echo $newsbutonhover; ?>" placeholder="<?php echo $entry_hover_color; ?>" id="input-hover" class="form-control" />
										<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-container"><?php echo $entry_container_color; ?><span data-toggle="tooltip" title="<?php echo $help_container; ?>"> 
							</span></label>
							<div class="col-sm-4">
								<div class="input-group demo2">
										<input type="text" name="containerbg" value="<?php echo $containerbg; ?>" placeholder="<?php echo $entry_container_color; ?>" id="input-container" class="form-control" />
										<span class="input-group-addon"><i></i></span>
								</div>
							</div>
						</div>
				</div>
			</div>
			</form>
	</div>
  </div>
</div>
<script language="javascript">
function load_options(cnt){
   var html="";
   for(i=1;i<=cnt;i++) {
     html +='<label class="col-sm-2 control-label" for="input-option">option'+i+'</label><div class="col-sm-10 '+i+'"><input  class="form-control" type="text" name="newslettersubscribe_option_field'+i+'" value=""><br/></div>';
	 }	
  $('.appendss').html(html);
}
</script>
<link href="view/javascript/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="view/javascript/colorpicker/css/docs.css" rel="stylesheet">
<script src="view/javascript/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="view/javascript/colorpicker/js/docs.js"></script>
<script>
$(function(){
    $('.demo2').colorpicker();
});
</script>