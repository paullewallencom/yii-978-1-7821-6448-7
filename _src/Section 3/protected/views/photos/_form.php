<div class="form" >
    <div id="success">
    </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'enableAjaxValidation'=>true,
            'id'=>'formPhoto',
        'htmlOptions'=>array('enctype'=>'multipart/form-data',
            ),
    )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	
	<div class="row" >
                <?php echo $model->getThumbnail(); ?>
            <br>
		<?php echo $form->labelEx($model,'filename'); ?>
                <?php echo $form->hiddenField($model, 'id'); ?>
        	<?php echo CHtml::activeFileField($model, 'image'); ?>
                <?php echo CHtml::image("/files/".$model->filename,$model->alt_text); ?>
	
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'caption'); ?>
		<?php echo $form->textArea($model,'caption',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alt_text'); ?>
		<?php echo $form->textArea($model,'alt_text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order'); ?>
	</div>

	<div class="row buttons" id="dvPhotoSubmit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                <?php echo CHtml::button('Cancel',array('onclick'=>"window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');")); ?>
 	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->