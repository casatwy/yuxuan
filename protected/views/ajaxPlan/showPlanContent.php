<table  class="record">
    <tbody>
        <tr>
            <th>货号</th>
            <th>色号</th>
            <th>针型</th>
            <th>颜色</th>
            <th>尺寸</th>
            <th>任务数</th>

        </tr>
        <?php foreach($planList as $plan):?>
        <tr>
            <td><?php echo $plan['goods_number']?></td>
            <td><?php echo $plan['color_number']?></td>
            <td><?php echo $plan['needle_type']?></td>
            <td><?php echo $plan['color_name']?></td>
            <td><?php echo $plan['size']?></td>
            <td><?php echo $plan['quantity']?></td>

        </tr>
        <?php endforeach;?>
    </tbody>
</table>
                <a class="prepend-4 span-5"href="<?php echo $this->baseUrl; ?>/storage/search?goodsNumber=<?php echo $plan['goods_number']; ?>&type=1"
                    target="_blank">
                    查看相关出货记录
                </a>
                <a class="span-5" href="<?php echo $this->baseUrl; ?>/storage/search?goodsNumber=<?php echo $plan['goods_number']; ?>&type=2"
                    target="_blank">
                    查看相关入货记录
                </a>
<a class="span-5 last" href="<?php echo $this->baseUrl; ?>/plan/printPlan/id/<?php echo $plan_id; ?>" target="_blank">打印</a>
