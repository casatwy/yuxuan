



<table class="record">
    <tr>
        <th>名称</th>
    </tr>
	<?php foreach($types as $type): ?>
	<tr>
		<td><?php echo  $type->name;?></td>
	</tr>
	<?php endforeach; ?>
</table>
