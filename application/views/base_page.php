<!DOCTYPE html>
<html>
<!-- HEADER STARTS HERE -->
<?php include('templates/header.php'); ?>
<!-- HEADER ENDS HERE -->
<body>
<div class="wrapper">
	
<!-- MENU STARTS HERE -->
<div class="nav">
<?php include('templates/menu.php'); ?>
</div>
<div class="clear"></div>
<!-- MENU ENDS HERE -->

<!-- BREADCRUMBS -->
<?php if (isset($breadcrumbs) && $breadcrumbs !== '') { ?>
<div class="breadcrumbs"> <?php echo $breadcrumbs; ?></div>
<?php } ?>
<!-- BREADCRUMBS END -->

<div class="content">
	
<!-- TITLE GOES HERE, IF ANY -->
<?php if( isset($title) && $title !== '' ) { ?>
<h1><?php echo $title;?></h1>
<hr>
<?php } ?>
<!-- TITLE ENDS HERE-->

<!-- CONTENT STARTS HERE -->
<?php if (isset($subview)) include($subview.'.php'); ?>

<!-- CONTENT ENDS HERE -->

</div>

<!-- FOOTER START HERE -->
<?php include('templates/footer.php'); ?>
<!-- FOOTER ENDS HERE -->
</div>
</body>
</html>