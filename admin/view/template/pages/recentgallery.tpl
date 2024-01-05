<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-rss"></i> <?php echo $heading_title; ?></h3>
  </div>
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td><?php echo $column_galleryid; ?></td>
          <td><?php echo $column_galleryname; ?></td>
          <td><?php echo $column_totalalbum; ?></td>
          <td><?php echo $column_status; ?></td>
          <td class="text-right"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
	    <?php if($recentgallerys){?>
	  <?php foreach($recentgallerys as $gallerys){?>
        <tr>
          <td><?php echo $gallerys['album_id']; ?></td>
           <td><?php echo $gallerys['name']; ?></td>
			<td><?php echo $gallerys['total']; ?></td>
            <td><?php echo $gallerys['status']; ?></td>
		   <td class="text-right"><a href="<?php echo $gallerys['href']?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" ><i class="fa fa-eye"></i></a></td>
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