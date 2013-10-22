<link rel='stylesheet'  href="styles/jquery-ui/smoothness/jquery-ui-1.10.3.custom.min.css" type="text/css">
<link rel='stylesheet'  href="styles/admin.css" type="text/css">

<script type="text/javascript" src="scrpits/main"></script>
<!-- CATEGORIES LIST -->
<div class="categories list-row">
<label>Список категорий</label>
<ul >
<?php foreach ($categories as $cat) { ?>
<li>
<?php echo form_open('admin/category/update/'.$cat->id_); ?>
<?php echo form_input('title', $cat->title, 'title="заголовок"'); ?>
<?php echo form_input('title_page', $cat->title_page, 'title="заголовок во вкладке браузера"'); ?>
<?php echo form_input('title_menu', $cat->title_menu, 'title="заголовок в меню"'); ?>
<?php echo form_submit('submit', 'submit', 'style="display:none;"'); ?>
<a href="#" class="update">обновить</a>
<a  href="<?php echo site_url()."/admin/category/toggle/$cat->id_/$cat->enabled"; ?>" 
	class=<?php echo $cat->enabled?'show':'hide'; ?>
	title="вкл/выкл"
>
	&#9632;
</a>
<a href="<?php echo site_url()."/admin/category/$cat->id_"; ?>" class="edit">изменить</a>		
<a href="<?php echo site_url()."/admin/category/delete/$cat->id_"; ?>" class="delete">удалить</a>
<?php echo form_close(); ?>
<?php
	echo form_open("/admin/category/reorder/{$cat->id_}/{$cat->ord}");
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
  <p><span class="" style="float: left; margin: 0 7px 20px 0;"></span>Точно? Категорию не возможно будет восстановить! >_></p>
</div>
<!-- Конец сообщений -->
<!-- Скрипты для сообщений -->
<script type="text/javascript" src="scripts/jquery-ui.js"></script>
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