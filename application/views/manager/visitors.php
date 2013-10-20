<label>Список последних посетителей</label>
<?php if (isset($visitors)) { ?>
	<table>
		<tr>
			<th>IP</th>
			<th>Дата</th>
			<th>Клиент</th>
		</tr>
	<?php foreach($visitors as $v) {?>
		
		<tr>
			<td>
				<?php echo $v->ip?>
			</td>
			<td>
				<?php echo date('l jS \of F Y H:i A',$v->timestamp);?>
			</td>
			<td>
				<?php echo $v->agent ;?>
			</td>	
		</tr>
	<?php } ?>
	</table>
<?php } ?>