<?php $this->beginContent('//layouts/column1'); ?>

<div id="mainmenu">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'本厂生产计划', 'url'=>array('/plan/list')),
            array('label'=>'外发生产计划', 'url'=>array('/plan/deliveredList')),
        ),
    )); ?>
</div><!-- mainmenu -->

<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
