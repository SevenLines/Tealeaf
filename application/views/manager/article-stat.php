
<?php if (isset($articles_stat)) { ?>
	<label>Список первых <b><?php echo count($articles_stat); ?></b> самых посещаемых статей</label>
	<table>
		<tr>
			<th>Статья</th>
			<th>Кол-во посещений</th>
			<th>Дата создания</th>
			<th>Дата обновления</th>
		</tr>
	<?php foreach($articles_stat as $a) { ?>
		<tr>
			<td><a href="<?php echo site_url()."/page/$a->category_id/$a->id_" ?>"><?php echo $a->title; ?></a></td>
			<td><?php echo $a->visits; ?> </td>
			<td><?php echo date('H:i - d/m/Y',$a->date_create); ?> </td>
			<td><?php echo date('H:i - d/m/Y',$a->date_update); ?> </td>
		</tr>
	<?php } ?>
	</table>
<?php } ?>