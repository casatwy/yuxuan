<div class="container">
<h1 class="center big">有限有限有限有限公司<h1>
<?php 
    if($type == StorageController::IN_RECORD){
        echo '<h2 class="center">入库记录</h2>';
    }
    if($type == StorageController::OUT_RECORD){
        echo '<h2  class="center">出库记录</h2>';
    }
?> 

	<span class="span-16 prepend-1" >客户：<span>xxxxx</span></span>
	<span class="span-7 last">单据日期：<span>xxxxxx</span></span>
	<span class="span-16 prepend-1">发货仓库：<span>xxxxxx</span></span>
	<span class="span-7 last">单据号：<span>xxxxxx</span></span>
	<span class="span-16 prepend-1">摘要：<span> xxxxxx</span></span>
	<span class="span-7 last small">第1页/共1页</span>


<table class="record">

    <tr>
        <th>类型</th>
        <th>货号</th>
        <th>色号</th>
        <th>色名</th>
        <th>缸号</th>
        <th>针型</th>
        <th>尺寸</th>
        <th>重量</th>
        <th>数量</th>
    </tr>
    <?php foreach($recordList as $record): ?>
    <tr>
        <td><?php echo $record['type'];?></td>
        <td><?php echo $record['goods_number'];?></td>
        <td><?php echo $record['color_number'];?></td>
        <td><?php echo $record['color_name'];?></td>
        <td><?php echo $record['gang_number'];?></td>
        <td><?php echo $record['needle_type'];?></td>
        <td><?php echo $record['size'];?></td>
        <td><?php echo $record['weight'];?></td>
        <td><?php echo $record['quantity'];?></td>
    </tr>
    <?php endforeach; ?>
</table>
	<span class="span-23 last prepend-1">如有疑问，请你回传给我们！
		<span>xxxxxx</span>或<span>xxxxxx</span>
	</span>

<span class="span-5">制单人：<span>xxxxxx</span></span>
<span class="span-5">发货人：<span>xxxxxx</span></span>
<span class="span-5">审核人：<span>xxxxxx</span></span>
<span class="span-5">进货人：<span>xxxxxx</span></span>
<span class="span-4 last">客户签收：<span>xxxxxx</span></span>
<span class="span-5">制单日期：<span>xxxxxx</span></span>
<span class="span-5">发货日期：<span>xxxxxx</span></span>
<span class="span-5">审核日期：<span>xxxxxx</span></span>
<span class="span-5">进货日期：<span>xxxxxx</span></span>
<span class="span-4 last">签收日期：<span>xxxxxx</span></span>

</div>
