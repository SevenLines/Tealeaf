<li <?php if(isset($item['current'])) echo 'class="current"';?> >
	<a href="<?php if (isset($item['href']))echo $item['href']; ?>">
		<?php if (isset($item['title'])) echo $item['title']; ?>
	</a>
</li>