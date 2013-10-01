<?php echo PHP_EOL;?>
<div class="content">
<h1><?php echo $name;?></h1>
<hr>
<div class="plain_text">
<?php if (isset($articles_info)) echo $articles_info->text; ?>
</div>
</div>