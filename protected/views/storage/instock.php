<span id="J_baseUrl" value="<?php echo $this->baseUrl; ?>"></span>
<?php 
    if($type == StorageController::IN_RECORD){
        echo '<h3>入库记录</h3>';
    }
    if($type == StorageController::OUT_RECORD){
        echo '<h3>出库记录</h3>';
    }
?> 
货号:<input type="text" id="J_goodsNumber"></input>
入库单号:<input type="text" id="J_recordId"></input>
<br />
客户：<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
<br />
<br />
日期范围<br />
开始：<input type="text" class="J_selectTime" id="J_startTime"></input>
结束：<input type="text" class="J_selectTime" id="J_endTime"></input>
<br />
<br />
单日记录<br />
选择日期：<input type="text" class="J_selectTime" id="J_recordTime"></input>
<br />
<br />

<button id="J_searchButton" data-type="<?php echo $type; ?>">搜索</button>
<a href="<?php 
    if($type == StorageController::IN_RECORD){
        echo $this->baseUrl.'/storage/createInStock';
    }
    if($type == StorageController::OUT_RECORD){
        echo $this->baseUrl.'/storage/createOutStock'; 
    }
?>" ><button>创建记录</button></a>

<br />===<br/>
<div id="J_fetchedRecords">
    <?php foreach($recordList as $record): ?>

    <J_HEADER data-record-id="<?php echo $record->id; ?>">
        客户名:<?php echo $record->provider->name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        时间:<?php echo date("Y-m-d H:i:s", $record->record_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        单号:RC<?php echo $record->id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        制单人:<?php echo $record->record_maker; ?>
    </J_HEADER>
    <div><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>

    <?php endforeach; ?>

    <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
        ));
    ?>
</div>
