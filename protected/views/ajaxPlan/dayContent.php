<div class="dayContent">
<h2>今日生产情况</h2>
<hr>
<table class="record">
    <tr>
        <td>货号</td>
        <td>色号</td>
        <td>针型</td>
        <td>颜色</td>
        <td>尺寸</td>
        <td>任务数</td>
        <td>已完成</td>
        <td>未完成</td>
    </tr>
    <?php foreach($dailyDatas as $dailyData):?>
    <tr>
        <td><?php echo $dailyData['goods_number']; ?></td>
        <td><?php echo $dailyData['color_number']; ?></td>
        <td><?php echo $dailyData['needle_type']; ?></td>
        <td><?php echo $dailyData['color_name']; ?></td>
        <td><?php echo $dailyData['size']; ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php endforeach;?>
</table>
<span class="prepend-12 span-3"><a href="javascript:void(0);">查看相关出货记录</a></span>
<span class="span-2">货号：</span><span class="span-6"><input type="text" id="J_goodsNumber"></input></span>
<span class="span-2">色号：</span><span class="span-5 last"><input type="text" id="J_colorNumber"></input></span>
<span class="span-2">针型：</span><span class="span-6"><input type="text" id="J_needleType"></input></span>
<span class="span-2">颜色：</span><span class="span-5 last"><input type="text" id="J_colorName"></input></span>
<span class="span-2">尺寸：</span><span class="span-6"><input type="text" id="J_size"></input></span>
<span class="span-2">任务数：</span><span class="span-5 last"><input type="text" id="J_total"></input></span>
<span class="span-2">已完成：</span><span class="span-6"><input type="text" id="J_finished"></input></span>
<span class="span-7 center"><button id="J_addButton">添加</button></span>
</div>
