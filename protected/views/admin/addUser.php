<?php if($type == 'updateUser'): ?>
<script type="text/javascript">
$(document).ready(function(){
    updateAuthority();
});
</script>
<div class="J_content add">
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
        <span class="span-3"><input type="checkbox" class="J_authority" value="2"></input>入库查看</span>
        <span class="span-4 last"><input type="checkbox" class="J_authority" value="3"></input>入库新建</span>
        <span class="span-3"><input type="checkbox" class="J_authority" value="5"></input>出库查看</span>
        <span class="span-4 last"><input type="checkbox" class="J_authority" value="7"></input>出库新建</span>
        <span class="span-3"><input type="checkbox" class="J_authority" value="11"></input>本厂生产计划查看</span>
        <span class="span-4 last"><input type="checkbox" class="J_authority" value="13"></input>本厂生产计划新建</span>
        <span class="span-3"><input type="checkbox" class="J_authority" value="17"></input>外发生产计划查看</span>
        <span class="span-4 last"><input type="checkbox" class="J_authority" value="19"></input>外发生产计划新建</span>
        <span class="span-3"><input type="checkbox" class="J_authority" value="23"></input>信息管理查看</span>
        <span class="span-4 last"><input type="checkbox" class="J_authority" value="29"></input>信息管理-用户</span>
        <span class="span-3"><input type="checkbox" class="J_authority" value="31"></input>信息管理-客户</span>
        <span class="span-4 last"><input type="checkbox" class="J_authority" value="37"></input>信息管理-物料</span>
        <span class="span-7 last center"><input type="button" value="保存" id="J_usersubmit"></input></span>
    <input type="hidden" id="J_userId" value="<?php echo $user->id;?>">
</div>
<div id="J_authoritys" style="display:none"><?php echo $authority; ?></div>
<?php endif; ?>
<?php if($type == 'addUser'): ?>
<div class="J_content">
	<h2 class="prepend-1">创建用户</h2>
	<hr>
	<div class="contant-container">
	<table>
            <tr><th class="span-4">用户名:</th><th class="span-6"><input type="text" id="J_name"></input></th>
                <th class="span-5 last"></th></tr>
        	<tr><td>输入密码:</td><td><input type="password" id="J_pwd1" ></input></td></tr>
        	<tr><td>再次输入密码:</td><td><input type="password" id="J_pwd2"></input></td></tr>
        	<tr><td>手机号码:</td><td><input type="text" id="J_tel"></input></td></tr>
            <tr>
                <td><input type="checkbox" class="J_authority" value="2"></input>入库查看</td>
                <td><input type="checkbox" class="J_authority" value="3"></input>入库新建</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="J_authority" value="5"></input>出库查看</td>
                <td><input type="checkbox" class="J_authority" value="7"></input>出库新建</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="J_authority" value="11"></input>本厂生产计划查看</td>
                <td><input type="checkbox" class="J_authority" value="13"></input>本厂生产计划新建</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="J_authority" value="17"></input>外发生产计划查看</td>
                <td><input type="checkbox" class="J_authority" value="19"></input>外发生产计划新建</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="J_authority" value="23"></input>信息管理查看</td>
                <td><input type="checkbox" class="J_authority" value="29"></input>信息管理-用户</td>
            </tr>
            <tr>
                <td><input type="checkbox" class="J_authority" value="31"></input>信息管理-客户</td>
                <td><input type="checkbox" class="J_authority" value="37"></input>信息管理-物料</td>
            </tr>
        	<tr><td></td><td></td><td><button class="J_deleUser">删除</button></td></tr>
    	</table>
	</div>
</div>
    <span class="prepend-7 span-6"><input type="button" value="添加一个用户" id="J_addOneUser"></span>
    <span class="span-7 last pad-6"><input type="button" value="保存" id="J_usersubmit"></input></span>
<div id="J_exOne"  style="display:none">
<div class="contant-container">
	<table>
        <tr><th class="span-4">用户名:</th><th class="span-6"><input type="text" id="J_name"></input></th>
            <th class="span-5 last"></th></tr>
		<tr><td>输入密码:</td><td><input type="password" id="J_pwd1" ></input></td></tr>
		<tr><td>再次输入密码:</td><td><input type="password" id="J_pwd2"></input></td></tr>
		<tr><td>手机号码:</td><td><input type="text" id="J_tel"></input></td></tr>
        <tr>
            <td><input type="checkbox" class="J_authority" value="2"></input>入库查看</td>
            <td><input type="checkbox" class="J_authority" value="3"></input>入库新建</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="J_authority" value="5"></input>出库查看</td>
            <td><input type="checkbox" class="J_authority" value="7"></input>出库新建</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="J_authority" value="11"></input>本厂生产计划查看</td>
            <td><input type="checkbox" class="J_authority" value="13"></input>本厂生产计划新建</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="J_authority" value="17"></input>外发生产计划查看</td>
            <td><input type="checkbox" class="J_authority" value="19"></input>外发生产计划新建</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="J_authority" value="23"></input>信息管理查看</td>
            <td><input type="checkbox" class="J_authority" value="29"></input>信息管理-用户</td>
        </tr>
        <tr>
            <td><input type="checkbox" class="J_authority" value="31"></input>信息管理-客户</td>
            <td><input type="checkbox" class="J_authority" value="37"></input>信息管理-物料</td>
        </tr>
		<tr><td></td><td></td><td class="last"><button class="J_deleUser">删除</button></td></tr>
	</table>
</div>
</div>
<div id="J_allUser" style="display:none"><?php echo $user;?></div>
<?php endif; ?>
<input type="hidden" id="J_type" value="<?php echo $type;?>">
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
