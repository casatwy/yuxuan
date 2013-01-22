
	<h2 class="span-3 prepend-1">用户信息</h2>
	<a class="span-17 last" id="plus" href="<?php echo $this->baseUrl;?>/admin/addUser"></a>
	<hr>
<div class="contant-container">
<table class="record">
    <tr>
        <th>姓名</th>
        <th>电话</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
	<?php foreach($users as $user): ?>
	<tr>
        <td><?php echo $user->name;?></td>
		<td><?php echo  $user->telephone;?></td>
		<td><?php echo  $user->authority;?></td>
        <td><a href="<?php echo $this->baseUrl.'/admin/updateUser/id/'.$user->id;?>" class="J_update">修改信息</a>
        &nbsp;<a href="<?php echo $this->baseUrl.'/admin/deleteUser/id/'.$user->id;?>" >删除</a></td>
	</tr>
	<?php endforeach; ?>
</table>
