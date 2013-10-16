<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function() {
	     /*CKEDITOR.replace( 'editor1', {
		    toolbar: 'Basic',
		    contentsCss: 'styles/main.css',
		    height: '400px',
		    autoParagraph: false
		});*/
		
		
		
    };		
$(function() {
	// save content values, to check for changed
	var $textArea = $('.article textarea[name=text]');
	var $textAreaInitContent = $textArea.val();
	
	var $title = $('.article input[name=title]');
	var $titleContent = $title.val();
	
	var $title_menu = $('.article input[name=title_menu]');
	var $title_menuContent = $title_menu.val();
	
	var $title_page = $('.article input[name=title_page]');
	var $title_pageContent = $title_page.val();
	
	var $title_page = $('.article input[name=title_page]');
	var $title_pageContent = $title_page.val();
	
	var $category_id= $('.article select[name=category_id]');
	var $category_idValue= $category_id.val();
	
	// disable on submit not changed controllers
	$('.article form').submit(function() {
		if ($textArea.val() === $textAreaInitContent ) {
			$textArea.prop("disabled", true);
		}
		if ($title.val() === $titleContent ) {
			$title.prop("disabled", true);
		}
		if ($title_menu.val() === $title_menuContent ) {
			$title_menu.prop("disabled", true);
		}
		if ($title_page.val() === $title_pageContent ) {
			$title_page.prop("disabled", true);
		}
		if ($category_id.val() === $category_idValue ) {
			$category_id.prop("disabled", true);
		}
	});
});
</script>
<div class='article'>
<?php
	echo form_open('admin/article/update/'.$article2->id_);
	
	echo form_dropdown('category_id', $categories_list, $article2->category_id);
	
	echo form_checkbox('enabled', 'enabled', $article2->enabled);	
	
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