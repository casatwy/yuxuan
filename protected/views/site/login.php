<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/* @var $nameList Array  */

$this->pageTitle=Yii::app()->name . ' - 登录';
?>

<h1>登录</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($loginForm,'username'); ?>
		<?php echo $form->dropDownList($loginForm,'username', $nameList); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($loginForm,'password'); ?>
		<?php echo $form->passwordField($loginForm,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
