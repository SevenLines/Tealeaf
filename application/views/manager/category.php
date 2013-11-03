
<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<script type="text/javascript">
$(function() {
	submit_only_changed($('.category form')[0]);
});
</script>

<div class="category">
<?php if ( isset($category2->id_) ) { ?>
<?php
	echo form_open('admin/category/update/'.$category2->id_);
	
	echo form_label('заголовок', 'title');
	echo form_input('title',$category2->title);
	
	echo form_label('заголовок для меню', 'title_menu');
	echo form_input('title_menu', $category2->title_menu);
	
	echo form_label('заголовок во вкладке браузера', 'title_page');
	echo form_input('title_page', $category2->title_page);
	
	echo form_label('описание', 'description');
	echo form_textarea('description', $category2->description);
	
	echo form_label('контроллер', 'controller');
	echo form_input('controller', $category2->controller);

	echo form_submit('submit','Сохранить');
	
	echo form_close();
?>
<?php } else { ?>
Это список статей, в поле <b>category_id</b> которых стоит <b>NULL</b>	
<?php } ?>
</div>

<!-- СПИСОК СТАТЕЙ-->
<div class='list-row article_list'>
<?php if(isset($status) && $status ) { ?>
<div class="status">
	<?php echo $status; ?>
</div>
<?php } ?>
<label>Список статей</label>
<ul>
	<?php foreach($articles as $a) {?>
		<li>
			<a href="<?php echo site_url()."/admin/preview/$category_id/$a->id_"; ?>" class='preview'>
				<?php
					$_title = $a->title;  
					if (empty($_title)) $_title =  $a->title_menu;
					if (empty($_title)) $_title =  $a->title_page;
					
					if (empty($_title)) $_title = 'без имени';
					echo $_title; 
				?>
			</a>
			<a href="<?php echo site_url()."/admin/article/".$a->id_; ?>" title="редактор" class="edit">
				
			</a>
			<a href="<?php echo site_url()."/admin/article/toggle/$a->id_/$a->enabled"; ?>" class=<?php echo $a->enabled?'show':'hide'; ?>title="вкл/выкл">&#9632;
			</a>
			<a href="<?php echo site_url().'/admin/article/delete/'.$a->id_ ?>" class='delete'>
				rmv
			</a>
			<a href="<?php echo site_url()."/admin/article/top/$a->id_"; ?>" class=<?php echo $a->top?'top':'ntop'; ?> title="set as top">
				&#9679;
			</a>
			<?php
				echo form_open("/admin/article/reorder/{$a->id_}/{$a->category_id}/{$a->ord}");
				echo form_dropdown('ord', $ords, $a->ord, 'class="ord"');
				echo form_close(); 
			?>	
			
		</li>
	<?php } ?>
</ul>
<?php
	$category_id = isset($category2->id_)?$category2->id_:-1;
	echo form_open("admin/article/add/$category_id/new", 'id="add"');
	echo form_submit('submit', 'Добавить статью');
	echo form_close();
?>
</div>
<script type="text/javascript">
	$("select[name=ord]").change(function() {
		var form = $(this).closest("form")[0];
		if (form) form.submit();
	});
</script>
<!-- КОНЕЦ СПИСКА СТАТЕЙ-->

<!-- Сообщения -->
<div id="delete_confirm" title="Удалить cтатью?" style="display:none">
  <p><span class="" style="float: left; margin: 0 7px 20px 0;"></span>Точно? Статью не возможно будет восстановить! :O</p>
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
<div class="clear"></div>
