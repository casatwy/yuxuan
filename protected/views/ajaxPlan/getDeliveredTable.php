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
        <tr>
            <td class="J_color_name">黄</td>
            <td class="J_color_number">321</td>
            <td class="J_gang_number">456</td>
            <td><input type="text"></input>kg</td>
        </tr>
        <tr>
            <td class="J_color_name">蓝</td>
            <td class="J_color_number">213</td>
            <td class="J_gang_number">456</td>
            <td><input type="text"></input>kg</td>
        </tr>
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
    <tbody class="J_bignumberTable">
        <tr>
            <td rowspan="3" class="J_color_name">红</td>
        </tr>
        <tr class="J_smallnumberTable">
            <td>S</td>
            <td><input type="text"></input> 
        </tr>
        <tr class="J_smallnumberTable">
            <td>M</td>
            <td><input type="text"></input>
                          
        </tr>
    </tbody>
    <tbody class="J_bignumberTable">
        <tr>
            <td rowspan="3" class="J_color_name">紫</td>
        </tr>
        <tr class="J_smallnumberTable">
            <td>L</td>
            <td><input type="text"></input> 
        </tr>
        <tr class="J_smallnumberTable">
            <td>XL</td>
            <td><input type="text"></input>
                          
        </tr>
        <!--<?php foreach($products as $key=>$product): ?>
        <tr>
            <td rowspan="4"><?php echo $key; ?></td> 
        </tr>
            <?php foreach($product as $pd): ?>
            <tr>
                <td><?php echo $pd; ?></td>
                <td><input type="text"></input></td>
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>-->
    </tbody>
</table>
