<ul class="lessons_list">
<?php foreach($articles as $article) { ?>
   	<li>
    <a href="<?php echo site_url()."page/$category_id/$article->id_";?>"><?php echo $article->title ?></a>
    </li>
<?php } ?>
</ul>
<div class="clear"></div>