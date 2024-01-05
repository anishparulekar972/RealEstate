<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-rss"></i> <?php echo $heading_title; ?></h3>
  </div>
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td><?php echo $column_sr_no; ?></td>
          <td><?php echo $column_post; ?></td>
          <td><?php echo $column_author; ?></td>
          <td><?php echo $column_totalcoment; ?></td>
          <td><?php echo $column_status; ?></td>
          <td class="text-right"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
	  <?php if($recentblogs){?>
	  <?php foreach($recentblogs as $recent){?>
        <tr>
			
        
          <td><?php echo $recent['blog_id']; ?></td>
          <td><?php echo $recent['name']; ?></td>
          <td><?php echo $recent['author']; ?></td>
          <td><?php echo $recent['total']; ?></td>
          <td><?php echo $recent['status']; ?></td>
          <td class="text-right"><a href="<?php echo $recent['href']?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" ><i class="fa fa-eye"></i></a></td>
		  
        </tr>
		<?php } ?>
		<?php } else{ ?>
		
        <tr>
          <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
        </tr>
		<?php } ?>
      </tbody>
    </table>
  </div>
</div>