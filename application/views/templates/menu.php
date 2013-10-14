<div class="mail"> 
	<script>"".contact('abc', 'htam.mliamm', 'mail.ru');</script></div>
<?php if (isset($menu)) { ?>
<ul>	
	<?php foreach ($menu as $category) {?>
   		<li>
   			<a href="<?php echo site_url().'/'.$category['controller']; ?>" 
   			<?php if(isset($category['active']) && $category['active']) echo 'class="active"'?>
   			>
   				<?php echo $category['title_menu']?>
   			</a>
			<?php if (isset($category['articles'])) { ?>
			<ul>
				<?php foreach ($category['articles'] as $article) {?>
   					<li>
   						<a href="<?php echo site_url().'/'.$category['controller'].'/'.$article['id']; ?>">
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
