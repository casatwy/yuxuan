<a href="<?php echo $this->baseUrl;?>/admin/addType">添加类型</a>
<table class="record">
    <tr>
        <th>名称</th>
        <th>操作</th>
    </tr>
	<?php foreach($types as $type): ?>
	<tr>
		<td><?php echo $type->name;?></td>
        <td><a href="<?php echo $this->baseUrl.'/admin/updateType/id/'.$type->id; ?>" id="J_update" >修改名称</a></td>
	</tr>
	<?php endforeach; ?>
</table>
    <input type="hidden" id="J_baseUrl" value="<?php $this->baseUrl; ?>">
