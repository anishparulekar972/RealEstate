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
			

					</div>
			
    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-newssubscriber">
      <div class="table-responsive">
            <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
						
						<td class="text-left"><?php if ($sort == 'property_id') { ?>
                <a href="<?php echo $sort_property_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_property; ?></a>
                 <?php } else { ?>
                    <a href="<?php echo $sort_property_id; ?>"><?php echo $column_property; ?></a>
                    <?php } ?></td>
										
											<td class="text-left"><?php if ($sort == 'name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                 <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
										
									<td class="text-left"><?php if ($sort == 'name') { ?>
									<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_agentname; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_name; ?>"><?php echo $column_agentname; ?></a>
									<?php } ?></td>
								
						
								<td class="text-left"><?php if ($sort == 'email') { ?>
                <a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
                 <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_email; ?></a>
                    <?php } ?></td>
										
										<td class="text-left"><?php if ($sort == 'name') { ?>
									<a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_description; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_name; ?>"><?php echo $column_description; ?></a>
									<?php } ?></td>
			
            <td class="text-left"><?php echo $column_action; ?></td>
          </tr>
        </thead>
				<thead>
						<?php if ($enquiry) { ?>
                <?php foreach ($enquiry as $result) { ?>
                <tr>
								<td style="width: 1px;" class="text-center"><input type="checkbox"  name="selected[]" value="<?php echo $result['enquiry_id']; ?>" /></td>
                 <td class="text-left"><?php echo $result['property_enquery']; ?></td>
                 <td class="text-left"><?php echo $result['name']; ?></td>
					<td class="text-left"><?php echo $result['agentnames']; ?></td>
                 <td class="text-left"><?php echo $result['email']; ?></td>
                 <td class="text-left"><?php echo $result['description']; ?></td>
                   <td class="text-right"><a href="<?php echo $result['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?> 
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
								 </thead>
        <tbody>
				
         
         
        </tbody>
      </table>
	  </div>
    </form>
		 <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
  </div>
</div>
<script type="text/javascript">
$('#button-filter').on('click', function() {
	
	var url = 'index.php?route=property/agent&token=<?php echo $token; ?>';

	var filter_agentname = $('input[name=\'filter_agentname\']').val();

	if (filter_agentname) {
		url += '&filter_agentname=' + encodeURIComponent(filter_agentname);
	}
	
	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

  location = url;
});

</script>
