<?php
/* @var $this PhotoController */
/* @var $model Photo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php 
            foreach (Yii::app()->user->getFlashes() as $type=>$flash) {
                echo "<div class='{$type}'>{$flash}</div>";
            }
        ?>
    
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="block">
			<?php echo $model->getThumbnail(); ?>
		</div>

		<div class="block">
			<?php echo $form->labelEx($model,'caption'); ?>
			<?php echo $form->textArea($model,'caption',array('rows'=>3, 'cols'=>50)); ?>
			<?php echo $form->error($model,'caption'); ?>
		</div>
		<div class="block">
			<?php echo $form->labelEx($model,'alt_text'); ?>
			<?php echo $form->textField($model,'alt_text',array('size'=>60)); ?>
			<?php echo $form->error($model,'alt_text'); ?>
		</div>
		<div class="block">
			<?php echo $form->labelEx($model,'tags'); ?>
			<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		    )); ?>
			<?php echo $form->error($model,'tags'); ?>
		</div>

		<div class="block">
			<?php echo $form->labelEx($model,'sort_order'); ?>
			<?php echo $form->textField($model,'sort_order',array('size'=>6, 'style'=> 'width: 20px')); ?>
			<?php echo $form->error($model,'sort_order'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->