<div class="contant-container" id="J_container">
	<h2 class="prepend-1">新增入库记录</h2>
	<hr>
    <h5 class="prepend-3">
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </h5>
    <div class="J_row">
        <br />
        <span  class="prepend-3">类型:</span>
        <select name="type" class="J_type">
            <?php foreach($type as $item):?>
            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
            <?php endforeach;?>
        </select>
	<br />
	<br />
        <span class="J_content ">
            <span class="prepend-3 span-8">货号:<input type="text" class="J_goodsNumber"></input></span>
            <span class="span-10 last">色号:<input type="text" class="J_colorNumber"></input></span>
            <span class="prepend-3 span-8" >颜色:<input type="text" class="J_colorName"></input></span>
            <span class="span-10 last">支数:<input type="text" class="J_zhiCount"></input></span>
            <span class="prepend-3 span-8">缸号:<input type="text" class="J_gangNumber"></input></span>
            <span class="span-10 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
            <span class="prepend-18 last"><button class="J_deleteRecord">删除</button></span>
        </span>
    </div>

    <br />
    <span class="prepend-7 span-3"><button id="J_addRecord" rowcount="1">添加一条</button></span>
    <span class="span-11 last"><button id="J_saveRecord">保存全部</button></span>
	<input type="hidden" value="<?php echo $sort; ?>" id="J_sort">



<span type="hidden" id="J_maosha" class="hide">
    <span class="prepend-3 span-8">货号:<input type="text" class="J_goodsNumber"></input></span>
    <span class="span-10 last">色号:<input type="text" class="J_colorNumber"></input></span>
    <span class="prepend-3 span-8 last">颜色:<input type="text" class="J_colorName"></input></span>
    <span class="span-10 last">支数:<input type="text" class="J_zhiCount"></input></span>
    <span class="prepend-3 span-8">缸号:<input type="text" class="J_gangNumber"></input></span>
    <span class="span-10 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
    <span class="prepend-18 last"><button class="J_deleteRecord">删除</button></span>
</span>

<span type="hidden" id="J_other" class="hide prepend-3">
    <span class="prepend-3 span-8">货号:<input type="text" class="J_goodsNumber"></input></span>
    <span class="span-10 last">色号:<input type="text" class="J_colorNumber"></input></span>
    <span class="prepend-3 span-8">颜色:<input type="text" class="J_colorName"></input></span>
    <span class="span-10 last">支数:<input type="text" class="J_zhiCount"></input></span>
    <span class="prepend-3 span-8">缸号:<input type="text" class="J_gangNumber"></input></span>
    <span class="span-10 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
    <span class="prepend-3 span-8">针型:<input type="text" class="J_needleType"></input></span>
    <span class="span-10 last">尺码:<input type="text" class="J_size"></input></span>
    <span class="prepend-3 span-18 last">数量:<input type="text" class="J_quentity"></input></span>
    <span class="prepend-18 last"><button class="J_deleteRecord">删除</button></span>
</span>
</div>