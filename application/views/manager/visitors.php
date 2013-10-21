<label>Список последних посетителей</label>
<?php if (isset($visitors)) { ?>
	<table>
		<tr>
			<th>IP</th>
			<th>Дата</th>
			<th>Клиент</th>
			<th>Ссылка</th>
		</tr>
	<?php foreach($visitors as $v) {?>
		
		<tr>
			<td>
				<?php echo $v->ip?>
			</td>
			<td>
				<?php echo date('H:i - d/m/Y',$v->timestamp);?>
			</td>
			<td>
				<?php echo $v->agent ;?>
			</td>	
			<td>
				<?php if($v->referrer) { ?>			
				<a href="<?php echo $v->referrer ;?>"><?php echo $v->referrer ;?></a>
				<?php } else {?>
				
				<?php } ?>
			</td>	
		</tr>
	<?php } ?>
	</table>
<?php } ?>