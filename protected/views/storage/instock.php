<h3>入库记录</h3>
<span id="J_recordType" value="<?php echo $type; ?>"></span>
货号:<input type="text" id="J_goodsNumber"></input>
入库单号:<input type="text" id="J_recordId"></input>
客户：<a href="<?php echo $this->baseUrl; ?>/ajaxStorage/selectprovider" id="J_selectProvider" provider="none">点击选择客户</a>
<br />
日期范围<br />
开始：<input type="text" class="J_selectTime" id="J_startTime"></input>
结束：<input type="text" class="J_selectTime" id="J_endTime"></input>

<button id="J_searchButton">搜索</button>
<a href="<?php echo $this->baseUrl.'/storage/createInStock' ?>" >创建记录</a>

<br />===<br/>
<div id="J_fetchedRecords">
    <J_HEADER>1</J_HEADER>
    <div><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>
    <J_HEADER>2</J_HEADER>
    <div>222222<br />22222<br />2222<br />222<br />22<br />2<br /></div>
    <J_HEADER>3</J_HEADER>
    <div>333<br />33<br />3<br /></div>
</div>
