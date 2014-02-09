<!DOCTYPE html>
<html>
<base href="<?php echo base_url(); ?>www/" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<meta charset="utf-8">
<title><?php echo $title_page; ?></title>
<style>
    body{
	margin:0;
	padding:0;
	/*background-color: #EDEDED;*/
	background-image: url("styles/images/pw_maze_gray.png");
	font-family: Georgia, 'Times New Roman', Times, serif;
    }   
    
    .plain_text {
	margin:0;
	padding:0;        
    }
    
    #login form {
        text-align: center;
    }
    #login input {
        margin:1em 0.4em;
        padding: 0.2em;
    }
    #login input[type=password] {
        border: 1px solid gray;
    }
    #login {
        background:white;
        padding:0;
        margin:0;
    }
    #login hr {
        margin:0;
        padding:0;
    }

</style>
<body>
<div class="wrapper">
<?php 
	$view_name = $subview.'.php';
	if (file_exists(__DIR__.'/'.$view_name)) {
            if (isset($subview)) include($subview.'.php');
	} else {
            echo 'Oops, looks like I cant find template:<p style="margin:0.5em"><img src="images/crash.gif" />';
            log_message('error', "Template '$subview' is not exists");
	}
?>
</div>
<div id="login">
<hr>
<?php
    echo form_open('login');
    echo form_label('Пароль', 'pass');
    echo form_password('pass');
    echo form_submit('sumbit', 'войти');
    echo form_close();
?>
<hr>
</div>

</body>
</html>