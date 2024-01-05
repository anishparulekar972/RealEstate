<?php echo $header; ?><link type="text/css" href="view/stylesheet/blog.css" rel="stylesheet" media="screen" /><?php echo $column_left; ?>
<div id="content">
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="row">
	<div class="logopart">
      <div class="col-lg-3 col-md-3 col-sm-3">
		<h1><?php echo $heading_title; ?></h1>
	  </div>
      <div class="col-lg-9 col-md-9 col-sm-9">
		<?php echo $dashmenu; ?>
	  </div>
    </div>
    </div>
	<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-blog" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-blog" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
           
			 
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
           	  
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-customername"><?php echo $entry_customername; ?></label>
                <div class="col-sm-10">
                  <select name="property_agent_id" id="input-customername" class="form-control">
                    <option value=""><?php echo $text_select;?></option>
					<?php foreach($customers as $customer) { ?>
						<?php if ($property_agent_id == $customer['property_agent_id']) { ?>
						<option value="<?php echo $customer['property_agent_id']?>" selected="selected"><?php echo $customer['customername'];?></option>
						<?php } else {?>
						<option value="<?php echo $customer['property_agent_id']?>"><?php echo $customer['customername'];?></option>
					<?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
			  
			  <div class="form-group">
                <label class="col-sm-2 control-label" for="input-blogname"><?php echo $entry_tmdblog; ?></label>
                <div class="col-sm-10">
                  <select name="blog_id" id="input-blogname" class="form-control">
                    <option value=""><?php echo $text_select;?></option>
					<?php foreach($blogsinfo as $info) { ?>
						<?php if ($blog_id == $info['blog_id']) { ?>
						<option value="<?php echo $info['blog_id']?>" selected="selected"><?php echo $info['name'];?></option>
						<?php } else {?>
						<option value="<?php echo $info['blog_id']?>"><?php echo $info['name'];?></option>
					<?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
			  
			  
			  
             
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
			  
               <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_comment; ?></label>
                <div class="col-sm-10">
				<textarea name="comment" placeholder="<?php echo $entry_comment; ?>" id="input-comment" class="form-control"><?php echo $comment; ?></textarea>
				  
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
          </div>
        </form>
      </div>
    </div>
  </div>
 
 <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>
 
 <script type="text/javascript"><!--
// Category
$('input[name=\'blogcategory\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=tmdblog/blogcomment/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['blog_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'blogcategory\']').val('');
		
		$('#blog-blogcategory' + item['value']).remove();
		
		$('#blog-blogcategory').append('<div id="blog-blogcategory' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="blog_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#blog-blogcategory').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

//--></script> 

<?php echo $footer; ?>