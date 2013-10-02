<?php echo PHP_EOL;?>
<div class="content">
<h1><?php echo $title;?></h1>
<hr>
<ul class="lessons_list">
<?php foreach($articles as $article) { ?>
   	<li>
    <a href="<?php echo site_url().'/'.$controller_path.'/'.$article->id_;?>"><?php echo $article->title ?></a>
    </li>
<?php } ?>
</ul>
<div class="clear"></div>
</div>