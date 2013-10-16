<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function() {
	submit_only_changed($('.article form')[0]);
});
</script>
<div class='article'>
<?php
	echo form_open('admin/article/update/'.$article2->id_);

	echo form_dropdown('category_id', $categories_list, $article2->category_id);

	echo form_label('заголовок', 'title');
	echo form_input('title', $article2->title);
	
	echo form_label('заголовок во вкладке брузера', 'title_page');
	echo form_input('title_page', $article2->title_page);
	
	echo form_label('заголовок в меню', 'title_menu');
	echo form_input('title_menu', $article2->title_menu);	
	

?>

<textarea name="text" style="min-width:100%;max-width:100%;height:300px;">
<?php echo $article2->text; ?>
</textarea>


<?php

	echo form_submit('submit', 'сохранить');
	echo form_close();
?>

</div>