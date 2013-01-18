<div class="J_content">
    <input type="hidden" id="J_providerId" value="<?php echo $client->id; ?>">
	<table>
    <tr><th>客户名:</th><th><input type="text" id="J_providerName" value="<?php echo $client->name;?>" ></input></th></tr>
    <tr><td>客户地址:</td><td><input type="text" id="J_providerLocation" value="<?php echo $client->location; ?>"></input></td></tr>
	<tr><td><input type="button" value="保存" id="J_providersubmit"></input></td></tr>
    </table>
</div>
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
