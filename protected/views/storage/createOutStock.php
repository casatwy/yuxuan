<div class="container" id="J_container">
    <h5>客户：<a href="#J_pageForSelectProvider" id="J_selectProvider" provider="123">点击选择客户</a></h5>
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

<span type="hidden" id="J_maosha" class="hide">
    <span>货号:<input type="text" class="J_goodsNumber"></input></span>
    <span>色号:<input type="text" class="J_colorNumber"></input></span>
    <span>颜色:<input type="text" class="J_colorName"></input></span>
    <span>支数:<input type="text" class="J_zhiCount"></input></span>
    <br />
    <span>缸号:<input type="text" class="J_gangNumber"></input></span>
    <span>重量(kg):<input type="text" class="J_weight"></input></span>
    <button class="J_deleteRecord">删除</button>
</span>

<span type="hidden" id="J_other" class="hide">
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

<span id="J_pageForSelectProvider" class="hide">
    地址:
    <a href="javascript:void(0);" class="J_location">A</a>
    <a href="javascript:void(0);" class="J_location">B</a>
    <a href="javascript:void(0);" class="J_location">C</a>

    <div class="J_providerList" location="A">
        <span provider-id="1" class="J_provider">providerA1</span>
        <span provider-id="2" class="J_provider">providerA2</span>
        <span provider-id="3" class="J_provider">providerA3</span>
        <span provider-id="4" class="J_provider">providerA4</span>
    </div>

    <div class="J_providerList" location="B">
        <span provider-id="5" class="J_provider">providerB1</span>
        <span provider-id="6" class="J_provider">providerB2</span>
        <span provider-id="7" class="J_provider">providerB3</span>
        <span provider-id="8" class="J_provider">providerB4</span>
    </div>

    <div class="J_providerList" location="C">
        <span provider-id="9" class="J_provider">providerC1</span>
        <span provider-id="10" class="J_provider">providerC2</span>
        <span provider-id="11" class="J_provider">providerC3</span>
        <span provider-id="12" class="J_provider">providerC4</span>
    </div>

    <br />

    <div>
        <p>创建客户:</p>
        <p>客户名：<input id="J_providerName" type="text"></input></p>
        <p>客户地址：<input id="J_providerLocation" type="text"></input></p>
        <button id="J_submitProvider">提交</button>
    </div>
</span>
