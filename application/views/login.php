<?php echo PHP_EOL;?>
<div class="content">
<?php if( isset($title) && $title !== '' ) { ?>
<h1><?php echo $title;?></h1>
<hr>
<?php } ?>

<div class="login">
<?php 
if ( isset($logged) && $logged) {
	echo form_open('login/logout');
	echo form_submit('sumbit', 'выйти');
	echo form_close();
} else {
	echo form_open('login');
	echo form_label('Пароль', 'pass');
	echo form_password('pass');
	echo form_submit('sumbit', 'войти');
	echo form_close();	
}
?>
</div>

</div>