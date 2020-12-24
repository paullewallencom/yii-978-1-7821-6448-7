<?php
/* @var $this AlbumController */
/* @var $model Album */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'album-form',
	'enableAjaxValidation'=>true,
)); ?>
        <?php 
            foreach (Yii::app()->user->getFlashes() as $type=>$flash) {
                echo "<div class='{$type}'>{$flash}</div>";
            }
        ?>

	<?php echo $form->errorSummary($model); ?>

        <div class="block">
            <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'name'); ?>
            </div>

            <div class="row">
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

            <div class="row">
                    <?php echo $form->labelEx($model,'shareable'); ?>
                    <?php echo $form->checkBox($model,'shareable'); ?>
                    <?php echo $form->error($model,'shareable'); ?>
            </div>
	
	    <div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'category_id', 
			CHtml::listData(
				Option::model()->findAll('option_name=:opname',array(':opname'=>'CATEGORY')),
				'id',
				'option_value'),
			array('empty' => '(Select)')
			);
		?>
	    </div>
	</div>
    
        <div class="block">
            <div class="row">
                    <?php echo $form->labelEx($model,'description'); ?>
                    <?php echo $form->textArea($model,'description',array('cols'=>'60','rows'=>'12')); ?>
                    <?php echo $form->error($model,'description'); ?>
            </div>
        </div>
    
        
        <br class="clear">
    
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->