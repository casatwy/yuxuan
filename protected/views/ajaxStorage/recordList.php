<?php if(!empty($recordList)): ?>
    <?php foreach($recordList as $record): ?>
        <J_HEADER data-record-id="<?php echo $record->id; ?>" data-record-type="<?php echo $type; ?>">
            客户名:<?php echo $record->getClient(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            时间:<?php echo date("Y-m-d H:i:s", $record->record_time); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            单号:RC<?php echo $record->id; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            制单人:<?php echo $record->getMaker(); ?>
        </J_HEADER>
        <div><img src="<?php echo $this->baseUrl; ?>/images/mediumloading.gif"></img></div>
    <?php endforeach; ?>
    
    <?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'htmlOptions' => array(
                'id' => "J_ajaxPageItem"
            ),
        ));
    ?>
<?php else: ?>
没有符合条件的相关记录。
<?php endif; ?>
