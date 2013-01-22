
	<h2 class="prepend-1">客户信息</h2>
	<hr>
<div class="contant-container">
<table class="record">
    <tr>
        <th>客户名</th>
        <th>客户地址</th>
        <th>操作</th>
    </tr>
	<?php foreach($clients as $client): ?>
	<tr>
		<td><?php echo  $client->name;?></td>
		<td><?php echo  $client->location;?></td>
        <td><a href="<?php echo $this->baseUrl.'/admin/updateClient/id/'.$client->id;?>" class="J_update">修改信息</a></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
