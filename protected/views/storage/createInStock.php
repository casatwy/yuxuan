<h2 class="prepend-1">创建<?php echo $actionType; ?>库记录</h2>
<hr>
<div id="J_container" class="contant-container prepend">
    <span class="span-15 last">客户：
        <a provider="none" id="J_selectProvider" href="http://yuxuan.dev/ajaxStorage/selectprovider">点击选择客户</a>
    </span>

    <div class="J_record" data-id="1">
        <span class="span-6">货号:
            <input type="text" class="J_goodsNumber" ></input>
        </span>
        <span class="span-3"><span data-id="1" class="J_selector select_b active" data-type="0">毛纱</span></span>
        <span class="span-3"><span data-id="1" class="J_selector select_b" data-type="1">产品</span></span>
        <span class=" span-3 last"><button class="J_continue">继续</button></span>    
        <div class="J_recordContent" data-id="1">
    
        </div>
    </div>

    <div class="hide" id="J_template">
        <div class="J_recordTemplate" data-id="">
            <span class="span-6">货号:<input type="text" class="J_goodsNumber" ></input></span>
            <span class="span-3"><span data-id="" class="J_selector select_b active" data-type="0">毛纱</span></span>
            <span class="span-3"><span data-id="" class="J_selector select_b" data-type="1">产品</span></span>
            <span class=" span-3 last"><button class="J_continue">继续</button></span>    
            <div class="J_recordContent" data-id="">
            </div>
        </div>
    </div>

    <span id="J_next" next-id="2"></span>

    <div id="J_templateSilkOrProduct" class="hide">
    </div>

    <hr>
    <span class="prepend-3 span-5"><button id="J_creatNewRecord">添加一条</button></span>
    <span class="span-6"><button id="J_saveRecord">保存全部</button></span>
</div>
