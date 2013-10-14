<?php echo PHP_EOL;?>
<div class="content">
<?php if (isset($title) && $title !== '') { ?>
<hr>
<h1><?php echo $title;?></h1>
<hr>
<?php } ?>
<div class="plain_text">
<?php if (isset($articles_info)) echo $articles_info->text; ?>
</div>
</div>