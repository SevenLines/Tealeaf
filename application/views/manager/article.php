<link rel='stylesheet'  href="styles/admin.css" type="text/css">

<script type="text/javascript">
$(function() {
    // для каждой формы применим это действие
    $('.article form').each(function(){
	submit_only_changed(this);        
    });
});
</script>
<div class='article'>
<div style="float:left;clear:none">
<?php
    if ( $this->OptionsModel->off_article_id() != $articleInfo->id_) {
        echo form_open("admin/article/set_as_off_page/$articleInfo->id_");
        echo form_submit("useAsOffPage", "тех. перерыв");
        echo form_close();
    }
?>  
</div>
<div style="float:right;clear:none;font-size: 0.8em">обновлялось: <?php echo date('H:i - d/m/Y', $articleInfo->date_update); ?> </div>
<?php
    echo form_open("admin/article/update/$articleInfo->id_");

    echo form_label('категория', 'category_id');
    echo form_dropdown('category_id', $categories_list, $articleInfo->category_id);
?>
<table >
    <tr>
        <td width="33%">
            <?php
                    echo form_label('заголовок', 'title');
                    echo form_input('title', $articleInfo->title);
            ?>
        </td>
        <td width="33%">
            <?php
                    echo form_label('заголовок во вкладке браузера', 'title_page');
                    echo form_input('title_page', $articleInfo->title_page);
            ?>
        </td>
        <td width="33%">	
            <?php
                    echo form_label('заголовок в меню', 'title_menu');
                    echo form_input('title_menu', $articleInfo->title_menu);
            ?>
        </td>
    </tr>
</table>
<?php
    echo form_hidden('pos', isset($textarea_pos)?$textarea_pos:0);
?>

<textarea name="text" style="">
<?php
echo $articleInfo->text; 
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

<?php
    echo form_submit('submit', 'сохранить');
    echo form_close();
?>

</div>
