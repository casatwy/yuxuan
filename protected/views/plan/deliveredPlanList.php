
<span id="J_baseUrl" value="<?php echo $this->baseUrl; ?>"></span>
<img class="span-1" src="<?php echo $this->baseUrl; ?>/images/deliveredList.png" /><h2 class="span-3 ">外发计划</h2>

<a id="plus" class="span-17 last" href="<?php echo $this->baseUrl; ?>/plan/createDeliveredPlan" ></a>
<hr>
<div class="contant-container">
<span class="span-15 last">客户：<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a></span>
<span class="span-7">货号:<input type="text" id="J_goodsNumber"></input></span>
<span class="span-8 last">外发单号:<input type="text" id="J_recordId"></input></span>

<span class="span-10">日期范围<br />
开始：<input type="text" class="J_selectTime" id="J_startTime"></input>
结束：<input type="text" class="J_selectTime" id="J_endTime"></input></span>

<span class="span-5 last"><br /><button id="J_searchButton" href="/ajaxPlan/searchDeliveredPlan">搜索</button></span>

</div>

<div class="span-21 last" id="J_fetchedRecords">
    <?php foreach($planList as $plan): ?>

    <J_HEADER data-record-id="<?php echo $plan->id; ?>" data-record-type="<?php echo $type; ?>">
        客户名:<?php echo $plan->getClientName(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        时间:<?php echo date("Y-m-d H:i:s", $plan->record_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        单号:RC<?php echo $plan->id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        制单人:<?php echo $plan->getPlanMakerName(); ?>
    </J_HEADER>
    <div><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>

    <?php endforeach; ?>

    <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
        ));
    ?>
</div>
