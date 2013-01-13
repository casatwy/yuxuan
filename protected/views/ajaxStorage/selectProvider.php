<span id="J_pageForSelectProvider">
    <div>
        <span>客户地址:</span>
        <?php foreach($providerArray as $key => $provider): ?>
        <a href="javascript:void(0);" class="J_location"><?php echo $key; ?></a>
        <?php endforeach;?>
    </div>

    <?php foreach($providerArray as $key=>$providerList): ?>
    <div class="J_providerList" location="<?php echo $key; ?>">
        <?php foreach($providerList as $provider): ?>
        <span provider-id="<?php echo $provider["id"]; ?>" class="J_provider"><?php echo $provider["name"]; ?></span>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>

    <br />

    <div>
        <p>创建客户:</p>
        <p>客户名：<input id="J_providerName" type="text" class="J_createProvider"></input></p>
        <p>客户地址：<input id="J_providerLocation" type="text" class="J_createProvider"></input></p>
        <button id="J_submitProvider" disabled="true">使用</button>
    </div>
</span>
