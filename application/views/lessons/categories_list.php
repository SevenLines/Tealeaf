<ul class="lessons_list">
<?php foreach($categories as $category) { ?>
   	<li>
    <a href="<?php echo site_url().$category->controller;?>"><?php echo $category->name ?></a>
    </li>
<?php } ?>
</ul>
<div class="clear"></div>