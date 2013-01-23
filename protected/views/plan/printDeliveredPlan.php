<div class="container font-2">
	<h1 class="center big">上海星位针织服装有限公司<h1>
	<h2 class="center">XXXXXXX</h2>

	<span class="span-16 prepend-1" >客户：<span>xxxxxx</span></span>
	<span class="span-7 last">单据号：<span>xxxxxx</span></span>
	<span class="span-16 prepend-1">摘要：<span>xxxxxxxxx</span></span>
	<span class="span-7 last"><span></span></span>
	<span class="span-16 prepend-1"><span></span></span>
	<span class="span-7 last small"></span>
<table class="record">

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
</table>
	<span class="span-23 last prepend-1">如有疑问，请你回传给我们！
		<span>11111111111</span>&nbsp;或&nbsp;
		<span>11111111111111111111</span>
	</span>

<span class="span-5">制单人：<span>1111111</span></span>
<span class="span-5">发货人：<span>11111111</span></span>
<span class="span-5">审核人：<span>1111111</span></span>
<span class="span-5">进货人：<span>111111</span></span>
<span class="span-4 last">客户签收：<span>11111111</span></span>
<span class="span-5">制单日期：<span>1111111</span></span>
<span class="span-5">发货日期：<span></span></span>
<span class="span-5">审核日期：<span></span></span>
<span class="span-5">进货日期：<span></span></span>
<span class="span-4 last">签收日期：<span></span></span>

</div>

</div>
