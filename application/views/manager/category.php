<link rel='stylesheet'  href="styles/jquery-ui/smoothness/jquery-ui-1.10.3.custom.min.css" type="text/css">
<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<script type="text/javascript">
$(function() {
	submit_only_changed($('.category form')[0]);
});
</script>
<div class="category">
<?php
	echo form_open('admin/category/update/'.$category2->id_);
	
	echo form_label('Заголовок', 'title');
	echo form_input('title',$category2->title);
	
	echo form_label('Заголовок для меню', 'title_menu');
	echo form_input('title_menu', $category2->title_menu);
	
	echo form_label('Заголовок во вкладке браузера', 'title_page');
	echo form_input('title_page', $category2->title_page);
	
	echo form_label('Описание', 'description');
	echo form_textarea('description', $category2->description);
	
	echo form_label('Контроллер', 'controller');
	echo form_input('controller', $category2->controller);

	echo form_submit('submit','Сохранить');
	
	echo form_close();
?>

</div>
<!-- СПИСОК СТАТЕЙ-->
<div class='article_list'>
<h2>Список статей</h2>
<ul>
	<?php foreach($articles as $a) {?>
		<li>
			<a href="<?php echo site_url()."/admin/preview/$a->id_/$a->title"; ?>" class='preview'>
				<?php
					$_title = $a->title;  
					if (empty($title)) $_title =  $a->title_menu;
					if (empty($title)) $_title =  $a->title_page;
					if (empty($title)) $_title = 'без имени';
					echo $_title; 
				?>
			</a>
			<a href="<?php echo site_url()."/admin/article/".$a->id_; ?>" title="редактор" >
				edit
			</a>
			<a href="<?php echo site_url()."/admin/article/toggle/$a->id_/$a->enabled"; ?>" class=<?php echo $a->enabled?'show':'hide'; ?>
				title="вкл/выкл">
				<?php echo $a->enabled?'hide':'show'; ?>
			</a>
			<a href="<?php echo site_url().'/admin/article/delete/'.$a->id_ ?>" class='delete'>
				rmv
			</a>
			<?php
				echo form_open("/admin/article/reorder/{$a->id_}/{$a->category_id}/{$a->ord}");
				echo form_input('ord', $a->ord, 'style="width:30px; margin-left:0.5em" title="Порядковый номер"');
				echo form_close(); 
			?>	
		</li>
	<?php } ?>
</ul>
</div>
<script type="text/javascript">
	$(".article_list li:even").css("background-color","#F2F2F2");
</script>
<!-- КОНЕЦ СПИСКА СТАТЕЙ-->
<!-- Сообщения -->
<div id="delete_confirm" title="Удалить cтатью?" style="display:none">
  <p><span class="" style="float: left; margin: 0 7px 20px 0;"></span>Точно? Статью не возможно будет восстановить! :O</p>
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
	$( document ).tooltip( {
		
		show: {
			effect: "fade",
			duration: 300,
		},
		hide: {
			effect: "fade",
			duration: 0,
		},
	});	
	
</script>
<!-- Конец скриптов для сообщений -->
<div class="clear"></div>
