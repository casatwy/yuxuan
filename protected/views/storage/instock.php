<h3>入库记录</h3>
货号:<input type="text" id="J_goodsNumber"></input>
入库单号:<input type="text" id="J_recordId"></input>
客户：<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
<br />
日期范围<br />
开始：<input type="text" class="J_selectTime" id="J_startTime"></input>
结束：<input type="text" class="J_selectTime" id="J_endTime"></input>

<button id="J_searchButton" data-type="<?php echo $type; ?>">搜索</button>
<a href="<?php echo $this->baseUrl.'/storage/createInStock' ?>" >创建记录</a>

<br />===<br/>
<div id="J_fetchedRecords">
    <?php foreach($recordList as $record): ?>

    <J_HEADER data-record-id="<?php echo $record->id; ?>">
        客户名:<?php echo $record->provider->name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        时间:<?php echo date("Y-m-d H:m:s", $record->record_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        单号:RC<?php echo $record->id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        制单人:<?php echo $record->record_maker; ?>
    </J_HEADER>
    <div><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>

    <?php endforeach; ?>

    <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages
        ));
    ?>
</div>
