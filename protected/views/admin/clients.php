


<table class="record">
    <tr>
        <th>姓名</th>
        <th>地址</th>
    </tr>
	<?php foreach($clients as $client): ?>
	<tr>
		<td><?php echo  $client->name;?></td>
		<td><?php echo  $client->location;?></td>
	</tr>
	<?php endforeach; ?>
</table>
