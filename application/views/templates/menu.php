<div class="mainmenu">
	<div class="mail"> 
		<script>"".contact('abc', 'htam.mliamm', 'mail.ru');</script>	</div>
	<ul class="menu">
		<?php if (isset($menu)) { ?>
			<?php foreach ($menu as $category) {?>
		   		<li>
		   			<a href="<?php echo site_url().'/'.$category[1]; ?>" 
		   			<?php if(isset($category[3]) && $category[3]) echo 'class="active"'?>
		   			>
		   				<?php echo $category[0]?>
		   			</a>
					<?php if (isset($category[2])) { ?>
					<ul>
						<?php foreach ($category[2] as $article) {?>
		   					<li>
		   						<a href="<?php echo site_url().'/'.$category[1].'/'.$article[1]; ?>">
					   				<?php echo $article[0]?>
					   			</a>
		   					</li>
		   				<?php } ?>
					</ul>
					<?php } ?>
		   		</li>
			<?php } ?>	
		<?php } ?>
	</ul>
</div>
<div class="clear"></div>