<div class="J_content ">
    <?php if($kind == 'add'):?>
	<h2 class="prepend-1">新增物料</h2>
	<hr>
	<div class="contant-container">
	<table>
	    <tr><th class="span-4">物料名称:</th><th class="span-11 last"><input type="text" id="J_typeName"></input></th></tr>
	<tr><td></td><td><input type="button" value="保存" id="J_typesubmit"></input></td></tr>
    </table>
    	</div>
     <?php endif;?>


    <?php if($kind == 'update'): ?>
	<h2>修改物料</h2>
	<hr>
    <input type="hidden" id="J_typeId" value="<?php echo $type->id; ?>">
	<table>
    	<tr><th class="span-2">物料名称:</th><th class="span-4"><input type="text" id="J_typeName" value="<?php echo $type->name;?>"></input></th></tr>
	<tr><td></td><td><input type="button" value="保存" id="J_typesubmit"></input></td></tr>
    </table>
    <?php endif;?>

<input type="hidden" id="J_kind" value="<?php echo $kind;?>">
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
</div>