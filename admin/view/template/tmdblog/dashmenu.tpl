<link type="text/css" href="view/stylesheet/blog.css" rel="stylesheet" media="screen" />
<ul id="dashmenu" class="list-inline">
			<li class="yellow <?php if($dashboard_menu==1){ ?> active <?php } ?>"><a href="<?php echo $dashboard; ?>"><i class="fa fa-dashboard"></i> 
			<div><?php echo $text_dash; ?></div></a></li>
			<li class="blue<?php if($setting_menu==1){ ?> active <?php } ?>"><a href="<?php echo $tmdblogsetting; ?>"><i class="fa fa-cogs"></i> 
			<div><?php echo $text_sett; ?></div></a></li>
			<li class="orange<?php if($category_menu==1){ ?> active <?php } ?>"><a  href="<?php echo $blogcategory; ?>"><i class="fa fa-link"></i>
			<div><?php echo $text_cate; ?></div></a></li>
			<li class="green<?php if($blogs_menu==1){ ?> active <?php } ?>"><a href="<?php echo $blog; ?>"><i class="fa fa-pencil-square-o"></i> 
			<div><?php echo $text_blog; ?></div></a></li>
			<li class="pink<?php if($comment_menu==1){ ?> active <?php } ?>"><a href="<?php echo $comment; ?>"><i class="fa fa-comments-o"></i> 
			<div><?php echo $text_comm; ?></div></a></li>
			<li class="pink<?php if($module_menu==1){ ?> active <?php } ?>"><a href="<?php echo $addmodule; ?>"><i class="fa fa-puzzle-piece"></i> 
			<div><?php echo $text_addmodule; ?></div></a></li>
			
		</ul>
<script>
$("#dashmenu").on('click','li',function(){
    $("#dashmenu li.active").removeClass("active"); 
    $(this).addClass("active"); 
});
</script>



