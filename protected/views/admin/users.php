<a href="<?php echo $this->baseUrl;?>/admin/addUser">创建用户</a>
<table class="record">
    <tr>
        <th>姓名</th>
        <th>电话</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo  $user->name;?></td>
		<td><?php echo  $user->telephone;?></td>
		<td><?php echo  $user->authority;?></td>
        <td><a href="<?php echo $this->baseUrl.'/admin/updateUser/id/'.$user->id;?>" id="J_update">修改信息</a>
        &nbsp;<a href="<?php echo $this->baseUrl.'/admin/deleteUser/id/'.$user->id;?>" >删除</a></td>
	</tr>
	<?php endforeach; ?>
</table>
