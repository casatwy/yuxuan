<div class="J_content add">
    <input type="hidden" id="J_providerId" value="<?php echo $client->id; ?>">
	<h2>修改信息</h2>
	<hr>
	<table>
    	<span class="span-3">客户名:</span>
	<span class="span-4 last"><input type="text" id="J_providerName" value="<?php echo $client->name;?>" ></span>
    	<span class="span-3">客户地址:</span>
	<span class="span-4 last"><input type="text" id="J_providerLocation" value="<?php echo $client->location; ?>"></span>
	<span class="span-7 last center"><input type="button" value="保存" id="J_providersubmit"></span>
</div>
<input type="hidden" id="J_baseUrl" value="<?php echo $this->baseUrl;?>">
