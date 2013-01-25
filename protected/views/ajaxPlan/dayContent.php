<div class="dayContent">
<h2>今日生产情况</h2>
<hr>
<table class="record">
    <tr>
        <td>货号</td>
        <td>类型</td>
        <td>色号</td>
        <td>针型</td>
        <td>颜色</td>
        <td>尺寸</td>
        <td>任务数</td>
        <td>已完成</td>
        <td>未完成</td>
        <td></td>
        <td></td>
    </tr>
    <?php foreach($dailyDatas as $dailyData):?>
    <tr>
        <td><?php echo $dailyData['goods_number']; ?></td>
        <td><?php echo $dailyData['type']; ?></td>
        <td><?php echo $dailyData['color_number']; ?></td>
        <td><?php echo $dailyData['needle_type']; ?></td>
        <td><?php echo $dailyData['color_name']; ?></td>
        <td><?php echo $dailyData['size']; ?></td>
        <td><?php echo $dailyData['total_count']; ?></td>
        <td><?php echo $dailyData['finished_sum']; ?></td>
        <td><?php echo $dailyData['total_count'] - $dailyData['finished_sum']; ?></td>
        <td><a href="<?php echo $this->baseUrl; ?>/storage/search?goodsNumber=<?php echo $dailyData['goods_number']; ?>&type=1">出货记录</a></td>
        <td><a href="<?php echo $this->baseUrl; ?>/storage/search?goodsNumber=<?php echo $dailyData['goods_number']; ?>&type=2">入货记录</a></td>
    </tr>
    <?php endforeach;?>
</table>
<div class="prepend-2">
<span class="span-2 last">类型:</span>
<span  class="span-15 last"><select name="type" id="J_type" >
    <?php foreach($type as $item):?>
    <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
    <?php endforeach;?>
</select></span>

<span class="span-2">货号：</span><span class="span-6"><input type="text" id="J_goodsNumber"></input></span>
<span class="span-2">色号：</span><span class="span-7 last"><input type="text" id="J_colorNumber"></input></span>
<span class="span-2">针型：</span><span class="span-6 "><input type="text" id="J_needleType"></input></span>
<span class="span-2">颜色：</span><span class="span-7 last"><input type="text" id="J_colorName"></input></span>
<span class="span-2">尺寸：</span><span class="span-6"><input type="text" id="J_size"></input></span>
<span class="span-2">吊线：</span><span class="span-7 last"><input type="text" id="J_diaoxian"></input></span>
<span class="span-2">任务数：</span><span class="span-6"><input type="text" id="J_total"></input></span>
<span class="span-2">已完成：</span><span class="span-7 last"><input type="text" id="J_finished"></input></span>
<span class="span-14 center"><button id="J_addButton">添加</button></span>
</div>
</div>
