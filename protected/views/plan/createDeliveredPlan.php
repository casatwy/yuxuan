<div id="J_container">
<h2 class="prepend-1">新增外发计划</h2>
<hr>
<div class="contant-container">
    <h5>
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </h5>
    <div class="J_row">
	<br />
        <span class="J_content">
            <span class="span-15 last">类型:
                <select name="type" class="J_type">
                    <?php foreach($productTypes as $item):?>
                    <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                    <?php endforeach;?>
                </select>
            </span>
            <span class="span-7 ">货号:<input type="text" class="J_goodsNumber"></input></span>
            <span class="span-8 last">色号:<input type="text" class="J_colorNumber"></input></span>
            <span class="span-7">颜色:<input type="text" class="J_colorName"></input></span>
            <span class="span-8 last">针型:<input type="text" class="J_needleType"></input></span>
            <span class="span-7">尺码:<input type="text" class="J_size"></input></span>
            <span class="span-8 last">数量:<input type="text" class="J_quentity"></input></span>
            <span class="prepend-13 last"><button class="J_deleteRecord">删除</button></span>
        </span>
    </div>

    <br />
    <span class="prepend-4 span-3"><button id="J_addRecord" rowcount="1">添加一条</button></span>
    <span class="span-8 last"><button id="J_saveRecord">保存全部</button></span>
</div>
</div>
