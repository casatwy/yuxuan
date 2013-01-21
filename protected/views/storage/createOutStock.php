<div class="container" id="J_container">
	<h2 class="prepend-1">新增出库记录</h2>
	<hr>
    <h5>
        客户：
        <a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
    </h5>

    <table>
        <tbody>
            <tr>
                <td>类型</td>
                <td>货号</td>
                <td>色号</td>
                <td>颜色</td>
                <td>支数</td>
                <td>缸号</td>
                <td>重量</td>
                <td>针型</td>
                <td>尺码</td>
                <td>数量</td>
            </tr>
            <tr class="J_recordItem">
                <td>
                    <select name="type" class="J_type">
                        <?php foreach($type as $item):?>
                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td><input type="text" class="J_goodsNumber"></input></td>
                <span class="J_ajaxRecordContent">
                    <td>待填充</td>
                    <td>待填充</td>
                    <td>待填充</td>
                    <td>待填充</td>
                    <td>待填充</td>
                    <td>待填充</td>
                    <td>待填充</td>
                    <td>待填充</td>
                </span>
            </tr>
        </tbody>
    </table>
</div>

<span id="J_recordItemTemplate">
     <td>
        <select name="type" class="J_type">
            <?php foreach($type as $item):?>
            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
            <?php endforeach;?>
        </select>
    </td>
    <td><input type="text" class="J_goodsNumber"></input></td>
    <span class="J_ajaxRecordContent">
        <td>待填充</td>
        <td>待填充</td>
        <td>待填充</td>
        <td>待填充</td>
        <td>待填充</td>
        <td>待填充</td>
        <td>待填充</td>
        <td>待填充</td>
    </span>   
</span>
