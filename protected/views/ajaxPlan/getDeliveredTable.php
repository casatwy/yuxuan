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
            <td><input type="text"></input>kg</td>
        </tr>
        <?php endforeach;?>
        <tr>
            <td>黄</td>
            <td>321</td>
            <td>456</td>
            <td><input type="text"></input>kg</td>
        </tr>
        <tr>
            <td>蓝</td>
            <td>213</td>
            <td>456</td>
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
        <?php foreach($products as $key=>$product): ?>
        <tr>
            <td rowspan="4"><?php echo $key; ?></td> 
        </tr>
            <?php foreach($product as $pd): ?>
            <tr>
                <td><?php echo $pd; ?></td>
                <td><input type="text"></input></td>
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>
