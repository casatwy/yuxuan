<div class="contant-container" id="J_container">
    <h5>
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </h5>
    <div class="J_row">
	<br />
        <span class="J_content">
            <span class="span-7">货号:<input type="text" class="J_goodsNumber"></input></span>
            <span class="span-7">色号:<input type="text" class="J_colorNumber"></input></span>
            <span class="span-7 last">颜色:<input type="text" class="J_colorName"></input></span>
            <span class="span-7">针型:<input type="text" class="J_needleType"></input></span>
            <span class="span-7">尺码:<input type="text" class="J_size"></input></span>
            <span class="span-7 last">数量:<input type="text" class="J_quentity"></input></span>
            <span class="prepend-19 last"><button class="J_deleteRecord">删除</button></span>
        </span>
    </div>

    <br />
    <button id="J_addRecord" rowcount="1">添加一条</button>
    <button id="J_saveRecord">保存全部</button>
</div>

<span type="hidden" id="J_other" class="hide">
    <span class="span-7">货号:<input type="text" class="J_goodsNumber"></input></span>
    <span class="span-7">色号:<input type="text" class="J_colorNumber"></input></span>
    <span class="span-7 last">颜色:<input type="text" class="J_colorName"></input></span>
    <span class="span-7">支数:<input type="text" class="J_zhiCount"></input></span>
    <span class="span-7">缸号:<input type="text" class="J_gangNumber"></input></span>
    <span class="span-7 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
    <span class="span-7">针型:<input type="text" class="J_needleType"></input></span>
    <span class="span-7">尺码:<input type="text" class="J_size"></input></span>
    <span class="span-7 last">数量:<input type="text" class="J_quentity"></input></span>
    <span class="prepend-19 last"><button class="J_deleteRecord">删除</button></span>
</span>
