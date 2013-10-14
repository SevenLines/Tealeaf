<?php echo PHP_EOL;?>
<div class="content">
<?php if( isset($title) && $title !== '' ) { ?>
<h1><?php echo $title;?></h1>
<hr>
<?php } ?>
<div class="plain_text">
<?php if (isset($text)) echo $text; ?>
</div>
</div>