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
				<li class="active"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
				<li><a href="#tab-header" data-toggle="tab"><?php echo $tab_header; ?></a></li>
				<li><a href="#tab-footer" data-toggle="tab"><?php echo $tab_footer; ?></a></li>
          	</ul>
			<div class="tab-content">
            	<div class="tab-pane active" id="tab-setting">
					<div class="table-responsive">
						<table id="stng" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td style="width: 1px;" class="text-center">
									<input type="radio"  name="layout1" value="" />
									</td>

									<td class="text-center">
									<img src="smb://server/htdocs/sep/realstate/admin/view/image/headers/h3.jpg" alt="" class="img-thumbnail" > 
									<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
								</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="layout2" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="layout3" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="layout4" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="layout5" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane " id="tab-header">
					<div class="table-responsive">
						<table id="hdr" class="table table-striped table-bordered table-hover">
							<tbody>	
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="header1" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="header2" value="" />
									</td>

									<td class="text-center">
										<img src="catalog/demo/iphone_6.jpg" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="header3" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="header4" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
								</tr>
								<tr>
									<td style="width: 1px;" class="text-center">
									<input  type="radio"  name="header5" value="" />
									</td>

									<td class="text-center">
										<img src="" alt="" class="img-thumbnail" />
										<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
									</td>
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