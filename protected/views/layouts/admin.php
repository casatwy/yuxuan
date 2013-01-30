
<?php $this->beginContent('//layouts/column1'); ?>

<div id="mainmenu">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'用户信息', 'url'=>array('/admin/users')),
            array('label'=>'客户信息', 'url'=>array('/admin/clients')),
            //array('label'=>'物料类型', 'url'=>array('/admin/types')),
            //array('label'=>'出入库数据', 'url'=>array('/admin/records')),
        ),
    )); ?>
</div>
<!-- mainmenu -->

<div id="content">
	<?php echo $content; ?>
</div>
<!-- content -->
<?php $this->endContent(); ?>
