<?php
/* @var $this OptionController */
/* @var $model Option */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'option-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'option_name'); ?>
		<?php echo $form->textField($model,'option_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'option_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'option_value'); ?>
		<?php echo $form->textField($model,'option_value',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'option_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order'); ?>
		<?php echo $form->error($model,'sort_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->