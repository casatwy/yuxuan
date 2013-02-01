<?php $this->beginContent('//layouts/column1'); ?>

<div id="mainmenu">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'生产计划总览', 'url'=>array('/plan/listall')),
            array('label'=>'日常生产计划', 'url'=>array('/plan/dailylist')),
            array('label'=>'外发生产计划', 'url'=>array('/plan/deliveredList')),
        ),
    )); ?>
</div><!-- mainmenu -->

<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
