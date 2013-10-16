<link rel='stylesheet'  href="styles/admin.css" type="text/css">
<table class="categories">
<thead>
<tr>
	<th>Заголовок</th>
	<th>Заголовок браузера</th>
	<th>Заголовок в меню</th>
</tr>
</thead>
<tbody>
<?php foreach ($categories as $cat) { ?>
<tr>
<?php echo form_open('admin/categories/update/'.$cat->id_); ?>
<td><?php echo form_input('title', $cat->title); ?></td>
<td><?php echo form_input('title_page', $cat->title_page); ?></td>
<td><?php echo form_input('title_menu', $cat->title_menu); ?></td>
<td><?php echo form_submit('update', 'обновить'); ?></td>
<?php echo form_close(); ?>
	
<?php echo form_open('admin/categories/edit/'.$cat->id_); ?>
<td><?php echo form_submit('edit', 'изменить'); ?></td>
<?php echo form_close(); ?>
	
<?php echo form_open('admin/categories/delete/'.$cat->id_); ?>
<td><?php echo form_submit('delete', 'удалить'); ?></td>
<?php echo form_close(); ?>
</tr>

<?php } ?>
</tbody>
</table>
<?php 
	echo form_open('admin/categories/add');
	echo form_submit('add', 'add');
	echo form_close();
?>