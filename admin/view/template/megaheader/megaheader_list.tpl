<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
			<a href="<?php echo $setting; ?>" data-toggle="tooltip" title="<?php echo $button_setting; ?>" class="btn btn-default"><i class="fa fa-cog fa-fw"></i></a>
			<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>			
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-logo').submit() : false;"><i class="fa fa-trash-o"></i></button>				
      </div>
      <h1><?php echo $heading_title; ?></h1>
      
    </div>
  </div>
  <div class="container-fluid">
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
	
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-logo">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>  
                      <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>   
					
				       <td class="text-left"><?php if ($sort == 'od.title') { ?>
                       <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                      <?php } else { ?>
                        <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                      <?php } ?></td>	
						<td class="text-left"><?php if ($sort == 'o.sort_order') { ?>
                       <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                      <?php } else { ?>
                        <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
                      <?php } ?></td>	
					   <td class="text-left"><?php if ($sort == 'o.status') { ?>
                       <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                      <?php } else { ?>
                        <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                      <?php } ?></td>	
			        <th class="text-right"><?php echo $column_edit ?> </th>
                </tr>
              </thead>
              <tbody>
			  <?php if ($megaheaders) { ?>
               <?php foreach ($megaheaders as $member) { ?>
		     <tr> 
                 <td class="text-center"><?php if (in_array($member['megaheader_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $member['megaheader_id']; ?>" checked="checkesd" />
                    <?php } else { ?>
                  <input type="checkbox" name="selected[]" value="<?php echo $member['megaheader_id']; ?>" />
                 <?php } ?></td>
                  		 
		         <td>
					<?php if($member['icon']==''){ ?>
					<?php echo $member['title'] ?>		
					<?php } else {?>
					<i class="<?php echo $member['icon'] ?> faicon" aria-hidden="true"></i> 
					<?php } ?> </td>
			     <td><?php echo $member['sort_order'] ?> </td>
			     <td><?php echo $member['status'] ?> </td>
			     <td class="text-right"><a href="<?php echo $member['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
		        </tr>
	         	<?php } ?>	
            <?php } else { ?>		
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
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
 <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/megaheader&token=<?php echo $token; ?>';

	var filter_title = $('input[name=\'filter_title\']').val();

	if (filter_title) {
		url += '&filter_title=' + encodeURIComponent(filter_title);
	}
	
	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	location = url;
});
//--></script>
</div>
<style>
.faicon{font-size:30px;}
</style>