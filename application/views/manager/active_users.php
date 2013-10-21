<label>Список активных посетителей</label>
<?php if (isset($active_users)) { ?>
	<table>
		<tr>
			<th>IP</th>
			<th>Дата</th>
			<th>Клиент</th>
		</tr>
	<?php foreach($active_users as $u) {?>
		
		<tr>
			<td>
				<?php echo $u->ip_address?>
			</td>
			<td>
				<?php echo date('l jS \of F Y H:i A',$u->last_activity);?>
			</td>
			<td>
				<?php echo $u->user_agent ;?>
			</td>	
		</tr>
	<?php } ?>
	</table>
<?php } ?>