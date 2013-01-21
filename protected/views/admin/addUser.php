<?php if($type == 'updateUser'): ?>
<div class="J_content addU">
	<h3>修改资料</h3>
	<hr>
	<span class="span-3">用户名:</span>
	<span class="span-4 last"><input type="text" id="J_name" value="<?php echo $user->name; ?>" disabled="disabled"></input></span>
    	<span class="span-3">输入密码:</span>
	<span class="span-4 last"><input type="password" id="J_pwd1" ></input></span>
        <span class="span-3">再次输入密码:</span>
	<span class="span-4 last"><input type="password" id="J_pwd2"></input></span>
        <span class="span-3">手机号码:</span>
	<span class="span-4 last"><input type="text" id="J_tel" value="<?php echo $user->telephone; ?>"></input></span>
        <span class="span-7 last center"><input type="button" value="保存" id="J_usersubmit"></input></span>
    <input type="hidden" id="J_userId" value="<?php echo $user->id;?>">
</div>
<?php endif; ?>
<?php if($type == 'addUser'): ?>
<div class="J_content contant-container">
	<h2 class="prepend-1">创建用户</h2>
	<hr>
	<table class="prepend-3">
        	<tr><th class="span-4">用户名:</th><th class="span-6"><input type="text" id="J_name"></input></th><th class="span-8 last"></th></tr>
        	<tr><td>输入密码:</td><td><input type="password" id="J_pwd1" ></input></td></tr>
        	<tr><td>再次输入密码:</td><td><input type="password" id="J_pwd2"></input></td></tr>
        	<tr><td>手机号码:</td><td><input type="text" id="J_tel"></input></td></tr>
        	<tr><td></td><td></td><td><button class="J_deleUser">删除</button></td></tr>
    </table>
</div>
    <span class="prepend-7 span-6"><input type="button" value="添加一个用户" id="J_addOneUser"></span>
    <span class="span-7 last pad-8"><input type="button" value="保存" id="J_usersubmit"></input></span>
<div id="J_exOne" style="display:none">
	<table class="prepend-3">
		<tr><th class="span-4">用户名:</th><th class="span-6"><input type="text" id="J_name"></input></th><th class="span-8 last"></th></tr>
		<tr><td>输入密码:</td><td><input type="password" id="J_pwd1" ></input></td></tr>
		<tr><td>再次输入密码:</td><td><input type="password" id="J_pwd2"></input></td></tr>
		<tr><td>手机号码:</td><td><input type="text" id="J_tel"></input></td></tr>
		<tr><td></td><td></td><td class="last"><button class="J_deleUser">删除</button></td></tr>
	</table>
</div>
<div id="J_allUser" style="display:none"><?php echo $user;?></div>
<?php endif; ?>
<input type="hidden" id="J_type" value="<?php echo $type;?>">
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
