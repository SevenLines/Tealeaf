<div id="admin" <?php if ($logged) echo 'class="fixed"'?>>
	<div id="slider">
		<?php if ($logged) { ?> 
	 		<a href = "<?php echo site_url()."/login/logout"; ?>" >выйти</a>
	 		<?php if ($category_id != 0) { ?>
	 			<?php if($flag == '') { ?>
	 				<a href = "<?php echo site_url()."/admin/category/$category_id"; ?>" >категория</a>
 				<?php } else { ?>
 					<a href = "<?php echo site_url()."/admin/preview/$category_id"; ?>">категория</a>
 				<?php } ?>
	 		<?php } ?>
	 		<?php if(isset($article_id) ) { ?>
	 			<?php if($flag == '') { ?>
	 				<a href = "<?php echo site_url()."/admin/article/$article_id"; ?>" >статья</a>
	 			<?php } else if($flag == 'manager') { ?>
	 				<a href = "<?php echo site_url()."/admin/preview/$category_id/$article_id"; ?>">статья</a>
	 			<?php } ?>
	 		<?php } ?>
 		<?php } else { ?>
 			<a href = "<?php echo site_url()."/admin"; ?>" >войти</a>
 		<?php } ?>
	 </div>
</div>