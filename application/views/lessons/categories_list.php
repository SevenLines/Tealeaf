<?php echo PHP_EOL;?>
<div class="content">
<h1><?php echo $title;?></h1>
<hr>
<ul class="lessons_list">
<?php foreach($categories as $category) { ?>
   	<li>
    <a href="<?php echo site_url().$category->controller;?>"><?php echo $category->name ?></a>
    </li>
<?php } ?>
</ul>
<div class="clear"></div>
</div>