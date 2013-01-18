<div class="J_content">
    <?php if($type == 'update'): ?>
	<table>
    <tr><th>用户名:</th><th><input type="text" id="J_name" value="<?php echo $user->name; ?>" disabled="disabled"></input></th></tr>
    <tr><td>输入密码:</td><td><input type="password" id="J_pwd1" ></input></td></tr>
        <tr><td>再次输入密码:</td><td><input type="password" id="J_pwd2"></input></td></tr>
        <tr><td>手机号码:</td><td><input type="text" id="J_tel" value="<?php echo $user->telephone; ?>"></input></td></tr>
		<tr><td><input type="button" value="保存" id="J_submit"></input></td></tr>
    </table>
    <input type="hidden" id="J_userId" value="<?php echo $user->id;?>">
    <?php endif; ?>
    <?php if($type == 'add'): ?>
	<table>
    <tr><th>用户名:</th><th><input type="text" id="J_name"></input></th></tr>
    <tr><td>输入密码:</td><td><input type="password" id="J_pwd1" ></input></td></tr>
        <tr><td>再次输入密码:</td><td><input type="password" id="J_pwd2"></input></td></tr>
        <tr><td>手机号码:</td><td><input type="text" id="J_tel"></input></td></tr>
		<tr><td><input type="button" value="保存" id="J_submit"></input></td></tr>
    </table>
    <?php endif; ?>
</div>
<input type="hidden" id="J_type" value="<?php echo $type;?>">
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
