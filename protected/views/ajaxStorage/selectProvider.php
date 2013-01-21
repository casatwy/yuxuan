<span id="J_pageForSelectProvider">
    <div class="selectPr">
    <div class="span-8">
        <div class="span-2">客户地址:</div>

    <div class="span-6 last">
        <div class="address">
                <?php foreach($providerArray as $key => $provider): ?>
                <a href="javascript:void(0);" class="J_location prepend"><span><?php echo $key; ?></span></a>
                <?php endforeach;?>
        </div>
    </div>
  
        <?php foreach($providerArray as $key=>$providerList): ?>
            <div class="J_providerList selectNa span-7" location="<?php echo $key; ?>">
 
            <?php foreach($providerList as $provider): ?>
            <a provider-id="<?php echo $provider["id"]; ?>" class="J_provider prepend"><?php echo $provider["name"]; ?></a>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>


    <div class="span-5 last">
    <div class="selevtADD">
        <p>创建客户:</p>
        <p>客户名称：<input id="J_providerName" type="text" class="J_createProvider"></input></p>
        <p>客户地址：<input id="J_providerLocation" type="text" class="J_createProvider"></input></p>
        <button id="J_submitProvider" disabled="true">使用</button>
    </div>
 </div>

</span>
