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
        <?php if($record['type'] == Record::SILK): ?>
            <td><?php echo "毛纱";?></td>
        <?php else: ?>
            <td><?php echo "衣服";?></td>
        <?php endif; ?>
        <td><?php echo $record['goods_number'];?></td>
        <td><?php echo $record['color_number'];?></td>
        <td><?php echo $record['color_name'];?></td>
        <td><?php echo $record['gang_number'];?></td>
        <td><?php echo $record['needle_type'];?></td>
        <td><?php echo $record['size'];?></td>
        <td><?php echo $record['weight'];?> kg</td>
        <td><?php echo $record['quantity'];?></td>
    </tr>
    <?php endforeach; ?>
</table>
	<a class="span-19 center J_listPrinter" href="<?php echo $this->baseUrl; ?>/storage/printRecordList/<?php echo 'type/'.$record_type.'/id/'.$record_id; ?>" 
		target="_blank">打印表单</a>
