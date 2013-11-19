
<div class="mail"> 
	<script> 
            // mega panic encrypting :O
            "".contact('abc',
                     '<?php echo strrev(substr($mail, 0, strlen ($mail) - 7 - 1)); ?>',
                     '<?php echo substr($mail, -7); ?>' );
        </script>
       
</div>
<?php if (isset($menu)) { ?>
<ul>	
	<li>
		<a href="<?php echo site_url() ?>" <?php if ($category_id==0) echo 'class="active"';?> > <?php echo $top_article_info->title_menu; ?></a> 
	</li>
	<?php foreach ($menu as $category) {?>
   		<li>
   			<a href="<?php echo site_url()."/page/{$category['id_']}"; ?>" <?php if($category['id_'] == $category_id) echo 'class="active"'?>>
   				<?php echo $category['title_menu']?>
   			</a>
			<?php if (isset($category['articles'])) { ?>
			<ul>
				<?php foreach ($category['articles'] as $article) {?>
   					<li>
   						<a href="<?php echo site_url()."/page/{$category['id_']}/{$article['id']}"; ?>">
			   				<?php echo $article['title_menu']?>
			   			</a>
   					</li>
   				<?php } ?>
			</ul>
			<?php } ?>
   		</li>
	<?php } ?>	
</ul>
<?php } ?>
