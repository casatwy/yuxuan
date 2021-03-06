<table>
<?php 
    if($type == StorageController::IN_RECORD){
        echo '<h3>入库记录</h3>';
    }
    if($type == StorageController::OUT_RECORD){
        echo '<h3>出库记录</h3>';
    }
?> 
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
