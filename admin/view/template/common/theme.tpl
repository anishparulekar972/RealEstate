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
			 <ul class="nav nav-tabs">
				<li class="hide"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
				<li class="active"><a href="#tab-header" data-toggle="tab"><?php echo $tab_header; ?></a></li>
				<li><a href="#tab-footer" data-toggle="tab"><?php echo $tab_footer; ?></a></li>
				<li class="hide"><a href="#tab-prolayout" data-toggle="tab"><?php echo $tab_prolayout; ?></a></li>
				<li><a href="#tab-agent" data-toggle="tab"><?php echo $tab_agent; ?></a></li>
				<li><a href="#tab-properites" data-toggle="tab"><?php echo $tab_properites; ?></a></li>
				<li><a href="#tab-search" data-toggle="tab"><?php echo $tab_search; ?></a></li>
				<li><a href="#tab_socialmedia" data-toggle="tab"><?php echo $tab_socialmedia; ?></a></li>
				<li><a href="#tab-theme" data-toggle="tab">Theme</a></li>
          	</ul>
			<div class="tab-content">
            	<div class="tab-pane hide" id="tab-setting">
					<div class="table-responsive">
						<table id="stng" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio" name="tmdrealstate_layout" value="layout1" <?php if($tmdrealstate_layout =='layout1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/logo.png"></td>
								</tr>
								<tr>
									<td><input type="radio" name="tmdrealstate_layout" value="layout2" <?php if($tmdrealstate_layout =='layout2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/logo.png" alt="" ></td>
								</tr>
								<tr>
									<td><input type="radio" name="tmdrealstate_layout" value="layout3" <?php if($tmdrealstate_layout =='layout3') { echo "checked='checked'"; }?>/></td>
									<td class="text-center"><img src="view/image/logo.png" alt="" ></td>
								</tr>
								<tr>
									<td><input type="radio" name="tmdrealstate_layout" value="layout4" <?php if($tmdrealstate_layout =='layout4') { echo "checked='checked'"; }?>/></td>
									<td class="text-center"><img src="view/image/logo.png" alt="" ></td>
								</tr>
								<tr>
									<td><input type="radio" name="tmdrealstate_layout" value="layout5" <?php if($tmdrealstate_layout =='layout5') { echo "checked='checked'"; }?>/></td>
									<td class="text-center"><img src="view/image/logo.png" alt="" ></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane active" id="tab-header">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="tmdrealstate_header" value="header1" <?php if($tmdrealstate_header =='header1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h1.jpg" alt="" /></td>
									<td class="text-left"><?php echo $text_header1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_header" value="header2" <?php if($tmdrealstate_header =='header2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h2.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_header2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_header" value="header3" <?php if($tmdrealstate_header =='header3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h3.jpg" alt="" /></td>
									<td class="text-left"><?php echo $text_header3; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_header" value="header4" <?php if($tmdrealstate_header =='header4') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h4.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_header4; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_header" value="header5" <?php if($tmdrealstate_header =='header5') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/headers/h5.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_header5; ?></td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
				<div class="tab-pane " id="tab-footer">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="tmdrealstate_footer" value="footer1" <?php if($tmdrealstate_footer =='footer1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f1.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_footer1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_footer" value="footer2" <?php if($tmdrealstate_footer =='footer2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f2.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_footer2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_footer" value="footer3" <?php if($tmdrealstate_footer =='footer3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f3.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_footer3; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_footer" value="footer4" <?php if($tmdrealstate_footer =='footer4') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/footer/f4.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_footer4; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane hide" id="tab-prolayout">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="tmdrealstate_prolayout" value="1" <?php if($tmdrealstate_prolayout =='1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/prolayouts/h1.jpg" alt=""/></td>
									<td class="text-left">Layout1</td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_prolayout" value="2" <?php if($tmdrealstate_prolayout =='2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/prolayouts/h2.jpg" alt=""/></td>
									<td class="text-left">Layout2</td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_prolayout" value="3" <?php if($tmdrealstate_prolayout =='3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/prolayouts/h3.jpg" alt=""/></td>
									<td class="text-left">Layout3</td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_prolayout" value="4" <?php if($tmdrealstate_prolayout =='4') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/prolayouts/h4.jpg" alt=""/></td>
									<td class="text-left">Layout4</td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_prolayout" value="5" <?php if($tmdrealstate_prolayout =='5') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/prolayouts/h5.jpg" alt=""/></td>
									<td class="text-left">Layout5</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane " id="tab-agent">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="tmdrealstate_agent" value="1" <?php if($tmdrealstate_agent =='1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/agent/a1.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_agent1; ?></td>
								</tr>
								
								<tr>
									<td><input  type="radio"  name="tmdrealstate_agent" value="2" <?php if($tmdrealstate_agent =='2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/agent/a3.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_agent2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_agent" value="3" <?php if($tmdrealstate_agent =='3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/agent/a2.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_agent3; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane " id="tab-properites">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="tmdrealstate_properites" value="1" <?php if($tmdrealstate_properites =='1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/proprties/p1.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_proprties1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_properites" value="2" <?php if($tmdrealstate_properites =='2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/proprties/p2.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_proprties2; ?></td>
								</tr>
								
								<tr>
									<td><input  type="radio"  name="tmdrealstate_properites" value="3" <?php if($tmdrealstate_properites =='3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/proprties/p3.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_proprties3; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane " id="tab-search">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td><input  type="radio"  name="tmdrealstate_search" value="1" <?php if($tmdrealstate_search =='1') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/searchs/s1.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_search1; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_search" value="2" <?php if($tmdrealstate_search =='2') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/searchs/s2.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_search2; ?></td>
								</tr>
								<tr>
									<td><input  type="radio"  name="tmdrealstate_search" value="3" <?php if($tmdrealstate_search =='3') { echo "checked='checked'"; }?> /></td>
									<td class="text-center"><img src="view/image/searchs/s3.jpg" alt=""/></td>
									<td class="text-left"><?php echo $text_search3; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="tab-pane" id="tab_socialmedia">
					<div class="form-group">
					<label class="col-sm-2 control-label" for="input-image"><?php echo $lable_footericon; ?></label>
					<div class="col-sm-10"><a href="" id="thumb-image2" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
					  <input type="hidden" name="tmdrealstate_footericon" value="<?php echo $tmdrealstate_footericon; ?>" id="input-image2" />
					</div>
				</div>
				<div class="form-group">
                <label class="col-sm-2 control-label" for="input-aboutdes"><?php echo $lable_aboutdes; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_aboutdes" value="<?php echo $tmdrealstate_aboutdes; ?>"  id="input-aboutdes" class="form-control" />
                </div>
               </div>
				<div class="form-group">
                <label class="col-sm-2 control-label" for="input-title"><?php echo $lable_title; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_title" value="<?php echo $tmdrealstate_title; ?>"  id="input-name" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-phoneno"><?php echo $lable_phoneno; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_phoneno" value="<?php echo $tmdrealstate_phoneno; ?>"  id="input-phoneno" class="form-control" />
                </div>
               </div>
			    <div class="form-group">
                <label class="col-sm-2 control-label" for="input-mobile"><?php echo $lable_mobile; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_mobile" value="<?php echo $tmdrealstate_mobile; ?>"  id="input-mobile" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-email"><?php echo $lable_email; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_email_soci" value="<?php echo $tmdrealstate_email_soci; ?>"  id="input-email" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-email"><?php echo $lable_address2; ?></label>
                <div class="col-sm-10">
                  <textarea name="tmdrealstate_address2" rows="5" id="input-address2" class="form-control"><?php echo $tmdrealstate_address2; ?></textarea>
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-fburl"><?php echo $lable_fburl; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_fburl" value="<?php echo $tmdrealstate_fburl; ?>"  id="input-fburl" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-google"><?php echo $lable_google; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_google" value="<?php echo $tmdrealstate_google; ?>"  id="input-google" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-twet"><?php echo $lable_twet; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_twet" value="<?php echo $tmdrealstate_twet; ?>"  id="input-twet" class="form-control" />
                </div>
               </div>
			   <div class="form-group hide">
                <label class="col-sm-2 control-label" for="input-in"><?php echo $lable_in; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_in" value="<?php echo $tmdrealstate_in; ?>"  id="input-in" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-instagram"><?php echo $lable_instagram; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_instagram" value="<?php echo $tmdrealstate_instagram; ?>"  id="input-instagram" class="form-control" />
                </div>
               </div>
			   <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pinterest"><?php echo $lable_pinterest; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_pinterest" value="<?php echo $tmdrealstate_pinterest; ?>"  id="input-pinterest" class="form-control" />
                </div>
               </div>
			   <div class="form-group hide">
                <label class="col-sm-2 control-label" for="input-youtube"><?php echo $lable_youtube; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_youtube" value="<?php echo $tmdrealstate_youtube; ?>"  id="input-youtube" class="form-control" />
                </div>
               </div>
			   <div class="form-group hide">
                <label class="col-sm-2 control-label" for="input-youtube"><?php echo $lable_blogger; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdrealstate_blogger" value="<?php echo $tmdrealstate_blogger; ?>"  id="input-blogger" class="form-control" />
                </div>
               </div>
               
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-youtube"><?php echo $lable_twittercode; ?></label>
					<div class="col-sm-10">
						<textarea name="tmdrealstate_twittercode" rows="5" placeholder="<?php echo $entry_twittercode; ?>" id="input-twitter-code" class="form-control"><?php echo $tmdrealstate_twittercode; ?></textarea>
					</div>
				</div>
			</div>

			<div class="tab-pane" id="tab-theme">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="green"<?php if($tmdrealstate_theme =='green') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#20C063;height:29px; width:100px;"></td>
										<td class="text-left">Green</td>
								</tr>

								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="blue"<?php if($tmdrealstate_theme =='blue') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#3498db;height:29px; width:100px;"></td>
										<td class="text-left">Blue</td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="sky"<?php if($tmdrealstate_theme =='sky') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#4BC7D2;height:29px; width:100px;"></td>
										<td class="text-left">Sky Blue</td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="orange"<?php if($tmdrealstate_theme =='orange') { echo "checked='checked'"; }?>/></td>
								
									<td class="text-left" style="background:#e67f22;height:29px; width:100px;"></td>
										<td class="text-left">Orange </td>
								</tr>	
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="purple"<?php if($tmdrealstate_theme =='purple') { echo "checked='checked'"; }?>/></td>
									<td class="text-left" style="background:#8e44ad;height:29px; width:100px;"></td>
									<td class="text-left">Purple </td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="pink"<?php if($tmdrealstate_theme =='pink') { echo "checked='checked'"; }?>/></td>
									<td class="text-left" style="background:#ff1493;height:29px; width:100px;"></td>
									<td class="text-left">Pink </td>
								</tr>
								<tr>
									<td style="height:20px; width:20px;"><input  type="radio"  name="tmdrealstate_theme" value="default"<?php if($tmdrealstate_theme =='default') { echo "checked='checked'"; }?>/></td>
									<td class="text-left" style="background:#f55a4e;height:29px; width:100px;"></td>
									<td class="text-left">Default </td>
								</tr>
								
							</tbody>
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
$('#language a:first').tab('show');
//--></script>
 
<?php echo $footer; ?></div>
