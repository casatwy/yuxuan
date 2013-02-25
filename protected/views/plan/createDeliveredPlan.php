<h2 class="prepend-1 span-16">新增外发计划</h2>
<span class="span-3"><button id="J_saveAll">保存全部</button></span>
<hr>
<div class="contant-container">
    <span class="span-15">
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </span>
    <div id="J_deliverdPlanDiv">
        <div class="J_deliverdPlan">
            <span class="span-11">货号:<input type="text" id="J_goodsNumber"></span>
            <span class="span-3 last"><button class="J_goOn">继续</button></span>
            <div class="J_show"></div>
            <span class="prepend-3 span-5"><button class="J_addPlan">添加</button></span>
            <span class="span-6 last"><button class="J_delPlan">删除</button></span>
            
        </div>
    </div>
</div>
<div class="hide" id="J_addDeliverdPlan">
    <div class="J_deliverdPlan">
        <span class="span-11">货号:<input type="text" id="J_goodsNumber"></span>
        <span class="span-3 last"><button class="J_goOn">继续</button></span>
        <div class="J_show"></div>
        <span class="prepend-3 span-5"><button class="J_addPlan">添加</button></span>
        <span class="span-6 last"><button class="J_delPlan">删除</button></span>
    </div>
</div>
