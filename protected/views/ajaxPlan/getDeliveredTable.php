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
    </tbody>
    <?php foreach($products as $color => $productSizeList): ?>
        <tbody class="J_bignumberTable">
            <tr>
                <td rowspan="<?php echo count($productSizeList)+1; ?>" class="J_color_name">
                    <?php echo $color; ?>
                </td>
            </tr>
            <?php foreach($productSizeList as $size): ?>
                <tr class="J_smallnumberTable">
                    <td>
                        <?php echo $size; ?>
                    </td>
                    <td>
                        <input type="text"></input> 
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php endforeach; ?>
</table>
