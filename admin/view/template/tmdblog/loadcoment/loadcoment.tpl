<table class="table table-bordered table-hover">
	<tbody class="inserdata">
		<?php if(isset($comments)){?>
				 <?php foreach($comments as $comnt){?>
				
				  <tr>
				  <td class="text-left"><?php echo $comnt['name']; ?></td>
				  <td class="text-left" style="word-wrap: break-word;width:70%"><?php echo $comnt['comment']; ?></td>
				 <td class="right">[ <a style="cursor:pointer" onclick="deletecomment(<?php echo $comnt['comment_id']; ?> )">Delete</a> ]</td>
					
					</tr>
					<?php } ?>
					<?php } else { ?>
					 <td class="text-center" colspan="4">No Comment </td>
					<?php } ?>
	</tbody>
</table>
