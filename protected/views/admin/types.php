<div >
	<h2 class="prepend-1 span-3">物料类型</h2>
	<a id="plus" class="span-17 last" href="<?php echo $this->baseUrl;?>/admin/addType"></a>
	<hr>
<table class="record">
    <tr>
        <th>名称</th>
        <th>操作</th>
    </tr>
	<?php foreach($types as $type): ?>
	<tr>
		<td><?php echo $type->name;?></td>
        <td><a href="<?php echo $this->baseUrl.'/admin/updateType/id/'.$type->id; ?>" class="J_update" >修改名称</a></td>
	</tr>
	<?php endforeach; ?>
</table>
    <input type="hidden" id="J_baseUrl" value="<?php $this->baseUrl; ?>">
</div>
