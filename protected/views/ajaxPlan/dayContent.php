<div id="J_dailyPlanTab" class="daycontent">
    <ul>
        <?php foreach($productList as $goods_number=>$value): ?>
        <li><a href="#J_<?php echo $goods_number; ?>"><?php echo $goods_number; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php foreach($productList as $goods_number=>$product): ?>
    <div id="J_<?php echo $goods_number; ?>">
        <table>
            <tbody>
                <tr>
                    <th>颜色</th>
                    <th>尺码</th>
                    <th>今日产量</th>
                    <th>总产量</th>
                    <th>任务数</th>
                    <th>余数</th>
                </tr>
                <?php foreach($product as $color => $itemList): ?>
                <tr>
                <td rowspan="<?php echo count($itemList)+1; ?>"><?php echo $color; ?></td>
                </tr>
                    <?php foreach($itemList as $size => $item): ?>
                    <tr>  
                        <td><?php echo $size; ?></td>
                        <td><input type="text"></input></td>
                        <td><?php echo $item['finished_count']; ?></td>
                        <td><?php echo $item['total_count']; ?></td>
                        <td><?php echo $item['total_count'] - $item['finished_count']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button>生产结束</button>
        <button>查看出货记录</button>
        <button>查看入库记录</button>
        <button>查看生产历史</button>
    </div>
    <?php endforeach; ?>
</div>
<button>全部保存</button>

<?php
//'id' => string '1' (length=1)
//'needle_type' => string '0' (length=1)
//'color_name' => string '1' (length=1)
//'color_number' => string '1' (length=1)
//'goods_number' => string '1442124322' (length=10)
//'size' => string '1' (length=1)
//'order_id' => null
//'price' => null
//'total_count' => null
//'client_id' => null
//'status' => string '0' (length=1)
//'create_time' => string '1362141760' (length=10)
//'finished_time' => null
?>
