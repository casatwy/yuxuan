<table class="record span-15 last">
    <tbody id="J_silkTable">
        <tr>
            <th>颜色</th>
            <th>色号</th>
            <th>缸号</th>
            <th>重量</th>
        </tr>
        <?php foreach($silks as $silk): ?>
        <tr>
            <td><?php echo $silk->color_name; ?></td>
            <td><?php echo $silk->color_number; ?></td>
            <td><?php echo $silk->gang_number; ?></td>
            <td><input type="text" class="J_weightTable" data-silk-id="<?php echo $silk->id; ?>"></input>kg</td>
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
    <?php foreach($products as $color => $productList): ?>
        <tbody id="J_productTable">
            <tr>
                <td rowspan="<?php echo count($productList)+1; ?>" class="J_color_name">
                    <?php echo $color; ?>
                </td>
            </tr>
            <?php foreach($productList as $product): ?>
                <tr class="J_smallnumberTable">
                    <td>
                        <?php echo $product->size; ?>
                    </td>
                    <td>
                    <input type="text" data-product-id="<?php echo $product->id; ?>"></input> 
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php endforeach; ?>
</table>
