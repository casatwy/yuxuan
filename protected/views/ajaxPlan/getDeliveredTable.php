<table class="record span-15 last">
    <tbody>
        <tr>
            <th>颜色</th>
            <th>色号</th>
            <th>缸号</th>
            <th>重量</th>
        </tr>
        <?php foreach($silks as $silk): ?>
        <tr>
            <td><?php $silk->color_name; ?></td>
            <td><?php $silk->color_number; ?></td>
            <td><?php $silk->gang_number; ?></td>
            <td><input type="text" class="J_weightTable"></input>kg</td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<table class="record span-15 last">
    <tbody>
        <tr>
            <th>颜色</th>
            <th>尺码</th>
            <th>件数</th> 
        </tr>
        <?php foreach($products as $color => $productList): ?>
        <tr>
        <td rowspan="<?php echo count($productList)+1; ?>">红</td>
        </tr>
            <?php foreach($productList as $size): ?>
            <tr>
            <td><?php echo $size; ?></td>
                <td><input type="text" class="J_numberTable"></input> 
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
