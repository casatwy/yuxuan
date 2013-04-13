<div class="span-15">
    <h2>生产计划</h2>
    <hr>
    <span class="span-5">货号：<?php echo $planData['goods_number']; ?><span></span></span>
    <span class="span-5">客户名：<?php echo $planData['client']; ?><span></span></span>
    <span class="span-5 last">创建时间：<?php echo $planData['create_time']; ?><span></span></span>

    <table class="record span-15">
        <tbody>
            <tr>
                <th>颜色</th>
                <th>尺码</th>
                <th>总件数</th>
                <th>已完成件数</th>
                <th>剩余件数</th>
            </tr>
        </tbody>
        <tbody>
            <?php foreach($planData['data'] as $color => $productList):?>
            <tr>
            <td rowspan="<?php echo count($productList)+1; ?>"><?php echo $color; ?></td>
            </tr>
                <?php foreach($productList as $product): ?>
                <tr>
                    <td><?php echo $product->size; ?></td>
                    <td><?php echo $product->total_count; ?></td>
                    <td><?php echo $product->finished_count; ?></td>
                    <td><?php echo $product->total_count - $product->finished_count; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach;?>
        </tbody>
    </table>
<table class="record span-15">
    <tbody>
        <tr>
            <th>针型</th>
            <th>部位</th>
        </tr>
    </tbody>
    <tbody>        
        <tr>
            <td>1</td>
            <td>2</td>
        </tr>
        <tr>
            <td>3</td>
            <td>4</td>
        </tr>
        <tr>
            <td>5</td>
            <td>6</td>
        </tr>
    </tbody>
</table>

</div>

