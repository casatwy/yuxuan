<div class="contant-container">
<span class="span-7">客户：<span><?php echo $client_name; ?></span></span>
<span class="span-8 last">货号：<span><?php echo $goods_number; ?></span></span>
    <table class="record">
        <tbody>
            <tr>
                <th>类型</th>
                <th>颜色</th>
                <th>缸号</th>
                <th>色号</th>
                <th>尺寸</th>
                <th>总重量</th>
                <th>总数量</th>
            </tr>
        </tbody>
        <?php foreach($resultArray as $result): ?>
        <tbody>
            <tr>
                <td rowspan="<?php echo count($result['itemArray'])+1; ?>"><?php echo $result['product_type']; ?></td>
                <td rowspan="<?php echo count($result['itemArray'])+1; ?>"><?php echo $result['color_name']; ?></td> 
                <td rowspan="<?php echo count($result['itemArray'])+1; ?>"><?php echo $result['gang_number']; ?></td>
                <td rowspan="<?php echo count($result['itemArray'])+1; ?>"><?php echo $result['color_number']; ?></td>              
            </tr>
            <?php foreach($result['itemArray'] as $item): ?>
                <tr>
                    <td><?php echo $item['size']; ?></td>
                    <td><?php echo $item['weight']; ?></td>
                    <td><?php echo $item['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <?php endforeach; ?>
    </table>
</div>
