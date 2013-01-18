<div class="J_content">
    <?php if($kind == 'add'):?>
	<table>
    <tr><th>名称:</th><th><input type="text" id="J_typeName"></input></th></tr>
	<tr><td><input type="button" value="保存" id="J_typesubmit"></input></td></tr>
    </table>
    <?php endif;?>
    <?php if($kind == 'update'): ?>
    <input type="hidden" id="J_typeId" value="<?php echo $type->id; ?>">
	<table>
    <tr><th>名称:</th><th><input type="text" id="J_typeName" value="<?php echo $type->name;?>"></input></th></tr>
	<tr><td><input type="button" value="保存" id="J_typesubmit"></input></td></tr>
    </table>
    <?php endif;?>
</div>
<input type="hidden" id="J_kind" value="<?php echo $kind;?>">
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
