<?php $this->beginContent('//layouts/column1'); ?>

<div id="mainmenu">
    <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'仓库（原料）', 'url'=>array('/storage/resource')),
            array('label'=>'仓库（产品）', 'url'=>array('/storage/product')),
            array('label'=>'入库记录', 'url'=>array('/storage/instock')),
            array('label'=>'出库记录', 'url'=>array('/storage/outstock')),
        ),
    )); ?>
</div><!-- mainmenu -->

<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>
