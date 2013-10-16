<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<script type="text/javascript">
$(function() {
	submit_only_changed($('.category form')[0]);
	
	$('.article_list .delete').click(function() {
		if (!confirm("I u sure? This action can't be undone.")) {
			return false;
		}
	});
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
<table>
	<?php foreach($articles as $a) {?>
	<tr>	
		<td>
			<a href="<?php echo site_url()."/admin/preview/$a->id_"; ?>" >
				<?php
					$_title = $a->title;  
					if (empty($title)) $_title =  $a->title_menu;
					if (empty($title)) $_title =  $a->title_page;
					if (empty($title)) $_title = 'без имени';
					echo $_title; 
				?>
			</a>
		</td>
		<td>
			<a href="<?php echo site_url()."/admin/article/".$a->id_; ?>" >
				edit
			</a>
		</td>
		<td>
			<a href="<?php echo site_url()."/admin/article/toggle/$a->id_/$a->enabled"; ?>" class=<?php echo $a->enabled?'show':'hide'; ?>>
				<?php echo $a->enabled?'hide':'show'; ?>
			</a>
		</td>
		<td>
			<a href="<?php echo site_url().'/admin/article/delete/'.$a->id_ ?>" class='delete'>
				delete
			</a>	
		</td>
		<td>
			<?php
				echo form_open("/admin/article/reorder/{$a->id_}/{$a->category_id}/{$a->ord}");
				echo form_input('ord', $a->ord, 'style="width:30px; margin-left:0.5em"');
				echo form_close(); 
			?>			
		</td>
	</tr>
	<?php } ?>
	<tr >
		<td>
			<?php
				echo form_open('/admin/article/add/new/'.$category2->id_);
				echo form_submit('add', 'add');
				echo form_close(); 
			?>
		</td>
	</tr>
</table>
</div>
<!-- КОНЕЦ СПИСКА СТАТЕЙ-->
<div class="clear"></div>
