<?php 
    if($type == Record::IN_RECORD){
        echo '<img class="span-1" src="'.$this->baseUrl.'/images/instock.png" /><h2 class="span-3">入库记录</h2>';
    }
    if($type == Record::OUT_RECORD){
        echo '<img class="span-1" src="'.$this->baseUrl.'/images/outstock.png" /><h2 class="span-3">出库记录</h2>';
    }
?> 
<a id="plus" class="span-17 last" href="<?php 
    if($type == Record::IN_RECORD){
        echo $this->baseUrl.'/storage/createInStock';
    }
    if($type == Record::OUT_RECORD){
        echo $this->baseUrl.'/storage/createOutStock'; 
    }
?>" > </a>
<hr>

<div class="contant-container prepend">
<span class="span-15 last">客户：<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a></span>
<span class="span-7">货号:<input type="text" id="J_goodsNumber"></input></span>
<span class="span-8 last">入库单号:<input type="text" id="J_recordId"></input></span>

<span class="span-10">日期范围<br />
开始：<input type="text" class="J_selectTime" id="J_startTime"></input>
结束：<input type="text" class="J_selectTime" id="J_endTime"></input></span>

<span class="span-5 last"><br /><button id="J_searchButton" data-type="<?php echo $type; ?>">搜索</button></span>
</div>

<div class="span-21 last" id="J_fetchedRecords">
<?php if(!empty($recordList)): ?>
    <?php foreach($recordList as $record): ?>

    <J_HEADER data-record-id="<?php echo $record->id; ?>" data-record-type="<?php echo $type; ?>">
        客户名:<?php echo $record->getClient(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        时间:<?php echo date("Y-m-d H:i:s", $record->record_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        单号:RC<?php echo $record->id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        制单人:<?php echo $record->getMaker(); ?>
        <a href="javascript:void(0);" class="J_deleteRecord last"
            data-record-id="<?php echo $record->id; ?>" data-record-type="<?php echo $type; ?>">删除</a>
    </J_HEADER>
    <div data-record-id="<?php echo $record->id; ?>"><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>
    <div class="pageTop">
    <?php endforeach; ?>

    <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'htmlOptions' => array("class" => "casacasacasa")
        ));
    ?>
    </div>
<?php else: ?>
        没有记录
<?php endif; ?>
</div>
