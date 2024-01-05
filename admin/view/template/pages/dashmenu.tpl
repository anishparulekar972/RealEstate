<link type="text/css" href="view/stylesheet/gallery.css" rel="stylesheet" media="screen" />
<ul id="dashmenu" class="list-inline">
			<li class="yellow <?php if($dashboard_menu==1){ ?> active <?php } ?>"><a href="<?php echo $dashboard; ?>"><i class="fa fa-dashboard"></i> 
			<div><?php echo $text_dash; ?></div></a></li>
			<li class="blue<?php if($setting_menu==1){ ?> active <?php } ?>"><a href="<?php echo $gallerysetting; ?>"><i class="fa fa-cogs"></i> 
			<div><?php echo $text_sett; ?></div></a></li>
			<li class="orange<?php if($photo_menu==1){ ?> active <?php } ?>"><a  href="<?php echo $galleryphoto; ?>"><i class="fa fa-camera"></i>
			<div><?php echo $text_photo; ?></div></a></li>
			<li class="green<?php if($gallery_menu==1){ ?> active <?php } ?>"><a href="<?php echo $gallery; ?>"><i class="fa fa-picture-o"></i> 
			<div><?php echo $text_gallery; ?></div></a></li>
			<li class="darkpink<?php if($module_menu==1){ ?> active <?php } ?>"><a href="<?php echo $addmodule; ?>"><i class="fa fa-puzzle-piece"></i> 
			<div><?php echo $text_addmodule; ?></div></a></li>
		
		</ul>
<script>
$("#dashmenu").on('click','li',function(){
    $("#dashmenu li.active").removeClass("active"); 
    $(this).addClass("active"); 
});
</script>



