
    <div>
	<form method="post" action="<?php echo $this->baseUrl; ?>/admin/insertUser">
		<table>
            <tr><th>用户名:</th><th><input type="text" name="name"></input></th></tr>
            <tr><td>输入密码:</td><td><input type="password" name="pwd1"></input></td></tr>
            <tr><td>再次输入密码:</td><td><input type="password" name="pwd2"></input></td></tr>
			<tr><td>手机号码:</td><td><input type="text" name="tel"></input></td></tr>
			<tr><td><input type="submit" value="保存"></input></td></tr>
		</table>
	</form>
    </div>
