
<!DOCTYPE html>
<html>
<!-- HEADER STARTS HERE -->
<?php include('templates/header.php'); ?>
<!-- HEADER ENDS HERE -->
<body>
<?php include "templates/enter.php" ?>
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
<!-- DESCRIPTION GOES HERE, IF ANY -->
<div class="description" ?>
<?php if( isset($description) && $description !== '' ) { ?>
<?php echo $description;?>
<?php } ?>
</div>
<!-- DESCRIPTION ENDS HERE -->
<hr>
<?php } ?>
<!-- TITLE ENDS HERE-->



<!-- CONTENT STARTS HERE -->
<?php 
	$view_name = $subview.'.php';
	if (file_exists(__DIR__.'/'.$view_name)) {
		if (isset($subview)) include($subview.'.php');
	} else {
		echo 'Oops, looks like I cant find template:<p style="margin:0.5em"><img src="images/crash.gif" />';
		log_message('error', "Template '$subview' is not exists");
	}
?>

<!-- CONTENT ENDS HERE -->

</div>

<!-- FOOTER START HERE -->
<?php include('templates/footer.php'); ?>
<!-- FOOTER ENDS HERE -->
</div>
</body>
</html>