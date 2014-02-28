<link rel='stylesheet'  href="styles/admin.css" type="text/css">

<script type="text/javascript" src="scrpits/main"></script>
<!-- turn on /off site -->
<?php if ($state) { ?>
<?php echo form_open('admin/overview/turn_off'); ?>
<?php echo form_submit('turnoff', 'выключить'); ?>
<?php echo form_close(); ?>
<?php } else { ?>
<?php echo form_open('admin/overview/turn_on'); ?>
<?php echo form_submit('turnon', 'включить'); ?>
<?php echo form_close(); ?>
<?php } ?>

<!-- CATEGORIES LIST -->
<div class="categories list-row">
<label>Список категорий</label>
<ul >
<?php foreach ($categories as $cat) { ?>
<li class="<?php echo $cat->class; ?>" >
<?php echo form_open($cat->href["update"]); ?>
<?php echo form_input('title', $cat->title, 'title="заголовок"'); ?>
<?php echo form_input('title_page', $cat->title_page, 'title="заголовок во вкладке браузера"'); ?>
<?php echo form_input('title_menu', $cat->title_menu, 'title="заголовок в меню"'); ?>
<?php echo form_submit('submit', 'submit', 'style="display:none;"'); ?>
<a href="#" class="update">обновить</a>
<a href="<?php echo $cat->href["toggle"]; ?> "title="вкл/выкл" class="enable"> &#9632;</a>
<a href="<?php echo $cat->href["edit"]; ?>" class="edit">изменить</a>		
<a href="<?php echo $cat->href["delete"]; ?>" class="delete">удалить</a>
<?php echo form_close(); ?>
<?php
	echo form_open($cat->href["reorder"]);
	echo form_dropdown('ord', $ords, $cat->ord, 'class="ord"');
	echo form_close(); 
?>	
</li>
<?php } ?>
</ul>
<!-- ADD CATEGORY HERE -->
<?php 
	echo form_open('admin/category/add/new');
	echo form_submit('add', 'добавить категорию');
	echo form_close();
?>
<!-- END OF CATEGORIES LIST -->
</div>

<!-- ACTIVE USERS INFO --> 
<div class="visits">
<?php include 'active_users.php' ?>
</div>
<!-- END ACTIVE USERS INFO -->

<!-- LAST VISITS INFO --> 
<div class="visits">
<?php include 'visitors.php' ?>
</div>
<!-- END LAST VISITS INFO -->

<!-- ARTICLES STATISTICS INFO -->

<div class="article-stat" ?>
<?php include 'article-stat.php' ?>
</div>
<!-- END OF ARTICLES STATISTICS INFO -->

<script type="text/javascript">
	// reduce count of data to send
	var formsCollection = document.getElementsByTagName("form");
	for ( var i = 0; i < formsCollection.length; ++i ) {
		submit_only_changed(formsCollection[i]);
	}

	$('.update').click(function() {
	  	var submit = $(this).siblings("input[type=submit]")[0];
	  	submit.click();
	  	return false;
	});
	$("select[name=ord]").change(function() {
		var form = $(this).closest("form")[0];
		if (form) form.submit();
	});
</script>

<!-- Сообщения -->
<div id="delete_confirm" title="Удалить категорию?" style="display:none">
    <p>
        <span class="" style="float: left; margin: 0 7px 20px 0;">
            Точно? Категорию не возможно будет восстановить! >_>
        </span>
    </p>
</div>
<!-- Конец сообщений -->
<!-- Скрипты для сообщений -->
<script type="text/javascript">
	$('.delete').click(function() {
		var a = this;
		$("#delete_confirm" ).dialog({
	      resizable: false,
	      modal: true,
	      show: {
	        effect: "fade",
	        duration: 300
	      },
	      hide: {
	        effect: "fade",
	        duration: 300
	      },
	      buttons: {
	        "Удалить": function() {
	          window.location = a.href;
	        },
	        "Отмена": function() {
	          $( this ).dialog( "close" );
	        }
	      }
	    });
	    return false;
  });
</script>
<!-- Конец скриптов для сообщений -->