<table class="record">
    <tr>
        <th>姓名</th>
        <th>地址</th>
        <th>操作</th>
    </tr>
	<?php foreach($clients as $client): ?>
	<tr>
		<td><?php echo  $client->name;?></td>
		<td><?php echo  $client->location;?></td>
        <td><a href="<?php echo $this->baseUrl.'/admin/updateUser/id/'.$client->id;?>">修改信息</a></td>
	</tr>
	<?php endforeach; ?>
</table>
