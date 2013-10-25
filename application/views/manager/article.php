<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<script type="text/javascript">
$(function() {
	submit_only_changed($('.article form')[0]);
});
</script>
<div class='article'>
<div style="float:right;clear:none;font-size: 0.8em">обновлялось: <?php echo date('H:i - d/m/Y', $article2->date_update); ?> </div>
<?php
	echo form_open("admin/article/update/$article2->id_");

	echo form_label('категория', 'category_id');
	echo form_dropdown('category_id', $categories_list, $article2->category_id);
?>
<table >
	<tr>
		<td width="33%">
			<?php
				echo form_label('заголовок', 'title');
				echo form_input('title', $article2->title);
			?>
		</td>
		<td width="33%">
			<?php
				echo form_label('заголовок во вкладке браузера', 'title_page');
				echo form_input('title_page', $article2->title_page);
			?>
		</td>
		<td width="33%">	
			<?php
				echo form_label('заголовок в меню', 'title_menu');
				echo form_input('title_menu', $article2->title_menu);
			?>
		</td>
	</tr>
</table>
<?php
	echo form_hidden('pos', isset($textarea_pos)?$textarea_pos:0);
?>

<textarea name="text" style="">
<?php
echo $article2->text; 
?>
</textarea>

<script type="text/javascript" >
	var textarea = $("textarea")[0];
	var pos = $("input[name=pos]")[0];
	textarea.addEventListener('change', function() {
		pos.value = getCaretPosition(this);
		return false;
	});
	setCaretPosition(textarea, pos.value); 
</script>


<!--
<script type="text/javascript" src="scripts/nicEdit.js"></script>
<script type="text/javascript">
	nicEditors.allTextAreas({fullPanel : true});
</script>
<script type="text/javascript" src="scripts/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    body_class: "wrapper, content",
    content_css: "styles/main.css, styles/editor.css",
    plugins: "code",
    document_base_url: "<?php echo base_url(); ?>www", 
 });
</script>
-->

<?php

	echo form_submit('submit', 'сохранить');
	echo form_close();
?>

</div>
