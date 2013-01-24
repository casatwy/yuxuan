<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/* @var $nameList Array  */

$this->pageTitle=Yii::app()->name . ' - 登录';
?>
<div class="prepend-12 log-bg" >
<div id="login">
<h1>LOG IN</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<span class="prepend-1 span-2"><?php echo $form->labelEx($loginForm,'username'); ?></span>
		<span class="span-3 last"><?php echo $form->dropDownList($loginForm,'username', $nameList); ?></span>
	</div>

	<div class="row">
		<span class="prepend-1 span-2"><?php echo $form->labelEx($loginForm,'password'); ?></span>
		<span class="span-3 last"><?php echo $form->passwordField($loginForm,'password'); ?></span>
	</div>

	<div class="row buttons prepend-3 span-3 last">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
</div>
