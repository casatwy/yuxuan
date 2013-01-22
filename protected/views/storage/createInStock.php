<div id="J_container">
    <?php if($sort == 'outstock'): ?>
	<h2 class="prepend-1">新增出库记录</h2>
    <?php else: ?>
	<h2 class="prepend-1">新增入库记录</h2>
    <?php endif; ?>
	<hr>
<div class="contant-container">
    <h5>
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </h5>
    <div class="J_row">
        <br />
        <span>类型:</span>
        <select name="type" class="J_type">
            <?php foreach($type as $item):?>
            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
            <?php endforeach;?>
        </select>
	<br />
	<br />
        <span class="J_content ">
            <span class="span-7">货号:<input type="text" class="J_goodsNumber"></input></span>
            <span class="span-8 last">色号:<input type="text" class="J_colorNumber"></input></span>
            <span class="span-7" >颜色:<input type="text" class="J_colorName"></input></span>
            <span class="span-8 last">支数:<input type="text" class="J_zhiCount"></input></span>
            <span class="span-7">缸号:<input type="text" class="J_gangNumber"></input></span>
            <span class="span-8 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
            <span class="prepend-13"><button class="J_deleteRecord">删除</button></span>
        </span>
    </div>

    <br />
    <span class="prepend-4 span-3"><button id="J_addRecord" rowcount="1">添加一条</button></span>
    <span class="span-8 last"><button id="J_saveRecord">保存全部</button></span>
	<input type="hidden" value="<?php echo $sort; ?>" id="J_sort">

<span type="hidden" id="J_maosha" class="hide">
    <span class="span-7">货号:<input type="text" class="J_goodsNumber"></input></span>
    <span class="span-8 last">色号:<input type="text" class="J_colorNumber"></input></span>
    <span class="span-7 last">颜色:<input type="text" class="J_colorName"></input></span>
    <span class="span-8 last">支数:<input type="text" class="J_zhiCount"></input></span>
    <span class="span-7">缸号:<input type="text" class="J_gangNumber"></input></span>
    <span class="span-8 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
    <span class="prepend-13"><button class="J_deleteRecord">删除</button></span>
</span>

<span type="hidden" id="J_other" class="hide">
    <span class="span-7">货号:<input type="text" class="J_goodsNumber"></input></span>
    <span class="span-8 last">色号:<input type="text" class="J_colorNumber"></input></span>
    <span class="span-7">颜色:<input type="text" class="J_colorName"></input></span>
    <span class="span-8 last">支数:<input type="text" class="J_zhiCount"></input></span>
    <span class="span-7">缸号:<input type="text" class="J_gangNumber"></input></span>
    <span class="span-8 last">重量:<input type="text" class="J_weight"></input>(kg)</span>
    <span class="span-7">针型:<input type="text" class="J_needleType"></input></span>
    <span class="span-8 last">尺码:<input type="text" class="J_size"></input></span>
    <span class="span-15 last">数量:<input type="text" class="J_quentity"></input></span>
    <span class="prepend-13"><button class="J_deleteRecord">删除</button></span>
</span>
</div>
</div>
