<?php $this->beginContent('//layouts/column1'); ?>

<div id="mainmenu">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'生产计划', 'url'=>array('/plan/list')),
            array('label'=>'历史生产计划', 'url'=>array('/plan/historyList')),
        ),
    )); ?>
</div><!-- mainmenu -->

<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
