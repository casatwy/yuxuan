<button>
<a href="<?php echo $this->baseUrl;?>/admin/addUser">创建用户</a>
</button>

<table class="record">
    <tr>
        <th>姓名</th>
        <th>电话</th>
        <th>权限</th>
    </tr>
	<?php foreach($users as $user): ?>
	<tr>
		<td><?php echo  $user->name;?></td>
		<td><?php echo  $user->telephone;?></td>
		<td><?php echo  $user->authority;?></td>
	</tr>
	<?php endforeach; ?>
</table>
