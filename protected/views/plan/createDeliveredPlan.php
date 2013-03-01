<h2 class="prepend-1 span-18">新增外发计划</h2>

<hr>
<div class="contant-container">
    <span class="span-15">
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </span>
    <div id="J_deliverdPlanDiv">
        <div class="J_deliverdPlan J_note">
            <span class="span-11">货号:<input type="text" id="J_goodsNumber" class="J_goodsNum"></span>
            <span class="span-3 last"><button class="J_goOn J_goOnButton" disabled>继续</button></span>
            <div class="J_show"></div>
            <span class="prepend-3 span-5"><button class="J_addPlan">添加</button></span>
            <span class="span-6 last"><button class="J_delPlan">删除</button></span>
            
        </div>
    </div>
    <hr>
    <span class="prepend-11 span-3"><button id="J_saveAll">保存全部</button></span>
</div>
<div class="hide" id="J_addDeliverdPlan">
    <div class="J_deliverdPlan J_note">
        <span class="span-11">货号:<input type="text" id="J_goodsNumber"  class="J_goodsNum"></span>
        <span class="span-3 last"><button class="J_goOn J_goOnButton" disabled>继续</button></span>
        <div class="J_show"></div>
        <span class="prepend-3 span-5"><button class="J_addPlan">添加</button></span>
        <span class="span-6 last"><button class="J_delPlan">删除</button></span>
    </div>
</div>
