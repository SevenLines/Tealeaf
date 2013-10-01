<div class="mainmenu">
	<ul class="menu">
		<?php if (isset($menu)) { ?>
			<?php foreach ($menu as $category) {?>
		   		<li>
		   			<a href="<?php echo site_url().'/'.$category[1]; ?>">
		   				<?php echo $category[0]?>
		   			</a>
					<ul>
						<?php foreach ($category[2] as $article) {?>
		   					<li>
		   						<a href="<?php echo site_url().'/'.$category[1].'/'.$article[1]; ?>">
					   				<?php echo $article[0]?>
					   			</a>
		   					</li>
		   				<?php } ?>
					</ul>
		   		</li>
			<?php } ?>	
		<?php } ?>
	</ul>
</div>
<div class="clear"></div>