<link rel='stylesheet'  href="styles/admin.css" type="text/css">
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
	echo '<hr>';
	echo form_submit('submit','Сохранить');
	
	echo form_close();
?>

</div>

<div class='article_list'>
<h2>Список статей</h2>
<ul>
<?php foreach($articles as $a) {?>
<li>
	<a href="<?php echo site_url()."/admin/article/".$a->id_; ?>" >
		<?php
			$_title = $a->title;  
			if (empty($title)) $_title =  $a->title_menu;
			if (empty($title)) $_title =  $a->title_page;
			if (empty($title)) $_title = 'без имени';
			echo $_title; 
		?>
	</a>
</li>
<?php } ?>
</ul>
</div>
<div class="clear"></div>