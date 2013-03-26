<?php
$totalCount = 0;
$totalWeight = 0;
?>
<div class="container font-2" id="J_page">
<h1 class="center big"><?php echo Yii::app()->params["companyName"]; ?><h1>
<?php 
    if($info['type'] == Record::IN_RECORD){
        echo '<h2 class="center">'.$recordList[0]['recordType'].'入库单</h2>';
    }
    if($info['type'] == Record::OUT_RECORD){
        echo '<h2  class="center">'.$recordList[0]['recordType'].'出库单</h2>';
    }
?> 

	<span class="span-18 prepend-1" >客户：<span><?php echo $info['record']->getClient();?></span></span>
	<span class="span-5 last">单据号：<span></span>
	<?php 
    	if($info['type'] == Record::IN_RECORD){
    	    echo 'RC'.$info['record']->id;
    	}elseif($info['type'] == Record::OUT_RECORD){
    	    echo 'DL'.$info['record']->id;
    	}
	?></span>
    <span class="span-18 prepend-1">发货仓库：
        <span>
            <?php 
                if($info['type'] == Record::IN_RECORD){
                    echo $recordList[0]['recordType'].'库';
                }
                if($info['type'] == Record::OUT_RECORD){
                    echo $recordList[0]['recordType'].'库';
                }
            ?> 
        </span>
    </span>
	<span class="span-5 last"><span></span></span>
	<span class="span-18 prepend-1"><span></span></span>
	<span class="span-5 last small"></span>


<table class="record">

    <tr>
        <th>货号</th>
        <th>生产种类</th>
        <th>色号</th>
        <th>色名</th>
        <th>缸号</th>
        <th>针型</th>
        <th>尺寸</th>
        <th>重量</th>
        <th>数量</th>
    </tr>
    <?php foreach($recordList as $record): ?>
    <?php
        $totalCount += $record['count'];
        $totalWeight += $record['weight'];
    ?>
    <tr>
        <td><?php echo $record['goods_number'];?></td>
        <td><?php echo $record['product_type'];?></td>
        <td><?php echo $record['color_number'];?></td>
        <td><?php echo $record['color_name'];?></td>
        <td><?php echo $record['gang_number'];?></td>
        <td><?php echo $record['needle_type'];?></td>
        <td><?php echo $record['size'];?></td>
        <td><?php echo $record['weight'];?> kg</td>
        <td><?php echo $record['count'];?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td>合计</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $totalWeight; ?> kg</td>
        <td><?php echo $totalCount; ?></td>
    </tr>
</table>
<br />
	<span class="span-23 last prepend-1">如有疑问，请您联系我:
		<span><?php echo $info['record']->getMaker(); ?></span>&nbsp;&nbsp;
		<span><?php echo $info['user']->telephone; ?></span>
	</span>

<span class="span-5">制单人：<span><?php echo $info['record']->getMaker(); ?></span></span>
<span class="span-5">发货人：<span></span></span>
<span class="span-5">审核人：<span></span></span>
<span class="span-5">送货人：<span></span></span>
<span class="span-4 last">客户签收：<span></span></span>
<span class="span-5">制单日期：<span><?php echo date('Y-m-d', $info['record']->record_time); ?></span></span>
<span class="span-5">发货日期：<span></span></span>
<span class="span-5">审核日期：<span></span></span>
<span class="span-5">送货日期：<span></span></span>
<span class="span-4 last">签收日期：<span></span></span>

</div>
