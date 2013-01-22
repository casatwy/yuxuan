<table>
    <tbody>
        <tr>
            <th>货号</th>
            <th>色号</th>
            <th>针型</th>
            <th>颜色</th>
            <th>尺寸</th>
            <th>任务数</th>
            <th>已完成</th>
            <th>未完成</th>
        </tr>
        <?php foreach($planList as $plan):?>
        <tr>
            <td><?php echo $plan['goods_number']?></td>
            <td><?php echo $plan['color_number']?></td>
            <td><?php echo $plan['needle_type']?></td>
            <td><?php echo $plan['color_name']?></td>
            <td><?php echo $plan['size']?></td>
            <td><?php echo $plan['quantity']?></td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<a href="javascript:void(0);">查看相关出货记录</a>
