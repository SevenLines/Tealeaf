<?php echo PHP_EOL;?>
<div class="content">
<h1><?php echo $name;?></h1>
<hr>
<ul class="lessons_list">
<?php foreach($articles_info as $article) { ?>
   	<li>
    <a href="<?php echo site_url().'/lessons/csharp/'.$article->id_;?>"><?php echo $article->name ?></a>
    </li>
<?php } ?>
</ul>
<div class="clear"></div>
</div>