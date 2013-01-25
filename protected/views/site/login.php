<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/* @var $nameList Array  */

$this->pageTitle=Yii::app()->name . ' - 登录';
?>
<div class="prepend-11 log-bg" >
<div id="login">
    <h1><?php echo Yii::app()->name; ?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<span class="pad-50 span-2 "><?php echo $form->labelEx($loginForm,'username'); ?></span>
		<span class="span-4 last"><?php echo $form->dropDownList($loginForm,'username', $nameList); ?></span>
	</div>

	<div class="row">
		<span class="pad-50 span-2 "><?php echo $form->labelEx($loginForm,'password'); ?></span>
		<span class="span-5 last"><?php echo $form->passwordField($loginForm,'password'); ?></span>
	</div>
	<span class="pad-50 span-2 "></span>
	<div class="row buttons span-3 last">
		<?php echo CHtml::submitButton('登录'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
</div>
