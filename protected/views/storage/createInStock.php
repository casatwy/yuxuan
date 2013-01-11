<div class="container" id="J_container">
    <h5>客户：<a href="javascript:void(0);" id="J_selectProvider" privider="123">点击选择客户</a></h5>
    <div class="J_row">
        <br />
        类型:
        <select name="type" class="J_type">
            <?php foreach($type as $item):?>
            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
            <?php endforeach;?>
        </select>
        <span class="J_content">
            <span>货号:<input type="text" class="J_goodsNumber"></input></span>
            <span>色号:<input type="text" class="J_colorNumber"></input></span>
            <span>颜色:<input type="text" class="J_colorName"></input></span>
            <span>支数:<input type="text" class="J_zhiCount"></input></span>
            <br />
            <span>缸号:<input type="text" class="J_gangNumber"></input></span>
            <span>重量(kg):<input type="text" class="J_weight"></input></span>
            <button class="J_deleteRecord">删除</button>
        </span>
    </div>

    <br />
    <button id="J_addRecord" rowcount="1">添加一条</button>
    <button id="J_saveRecord">保存全部</button>
</div>

<span type="hidden" id="J_maosha" style="display:none;">
    <span>货号:<input type="text" class="J_goodsNumber"></input></span>
    <span>色号:<input type="text" class="J_colorNumber"></input></span>
    <span>颜色:<input type="text" class="J_colorName"></input></span>
    <span>支数:<input type="text" class="J_zhiCount"></input></span>
    <br />
    <span>缸号:<input type="text" class="J_gangNumber"></input></span>
    <span>重量(kg):<input type="text" class="J_weight"></input></span>
    <button class="J_deleteRecord">删除</button>
</span>

<span type="hidden" id="J_other" style="display:none;">
    <span>货号:<input type="text" class="J_goodsNumber"></input></span>
    <span>色号:<input type="text" class="J_colorNumber"></input></span>
    <span>颜色:<input type="text" class="J_colorName"></input></span>
    <span>支数:<input type="text" class="J_zhiCount"></input></span>
    <br />
    <span>缸号:<input type="text" class="J_gangNumber"></input></span>
    <span>重量(kg):<input type="text" class="J_weight"></input></span>
    <span>针型:<input type="text" class="J_needleType"></input></span>
    <span>尺码:<input type="text" class="J_size"></input></span>
    <span>数量:<input type="text" class="J_quentity"></input></span>
    <button class="J_deleteRecord">删除</button>
</span>
