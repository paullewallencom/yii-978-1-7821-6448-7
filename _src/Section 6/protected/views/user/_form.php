<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true, 
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="block" style="width: 45%;">
	    <div class="row">
		    <?php echo $form->labelEx($model,'email'); ?>
		    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		    <?php echo $form->error($model,'email'); ?>
	    </div>

	    <div class="row">
		    <?php echo $form->labelEx($model,'url'); ?>
		    <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>256)); ?>
		    <?php echo $form->error($model,'url'); ?>
	    </div>

	    <div class="row">
		    <?php echo $form->labelEx($model,'firstname'); ?>
		    <?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>256)); ?>
		    <?php echo $form->error($model,'firstname'); ?>
	    </div>

	    <div class="row">
		    <?php echo $form->labelEx($model,'lastname'); ?>
		    <?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>256)); ?>
		    <?php echo $form->error($model,'lastname'); ?>
	    </div>

	    <div class="row buttons">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	    </div>

	</div>
	
	<div class="block">

	    <div class="row">
		    <?php echo $form->labelEx($model,'passwordSave'); ?>
		    <?php echo $form->passwordField($model,'passwordSave',array('size'=>60,'maxlength'=>256)); ?>
		    <?php echo $form->error($model,'passwordSave'); ?>
	    </div>
	    <div class="row">
		    <?php echo $form->labelEx($model,'repeatPassword'); ?>
		    <?php echo $form->passwordField($model,'repeatPassword',array('size'=>60,'maxlength'=>256)); ?>
		    <?php echo $form->error($model,'repeatPassword'); ?>
	    </div>

	    <div class="row buttons">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	    </div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->