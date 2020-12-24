<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Album', 'url'=>array('create')),
	array('label'=>'View Album', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);
?>

<h1>Update Album <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php 
    echo $this->renderPartial('_photos', array('photos'=>$photos));
?>

<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photos-form',
	'enableAjaxValidation'=>true,
)); ?>

<?php 
        $this->widget('xupload.XUpload', array(
            'url' => Yii::app()->createUrl("album/upload",array('id'=>$model->id)),
            'model' => $uploads, // change from $model
            'attribute' => 'file',
            'multiple' => true,
            'htmlOptions' => array('id'=>'photos-form'),
            ));
?>

<?php $this->endWidget(); ?>

<?php
	Yii::app()->clientScript->registerScript('File-Upload-Done', "
	   $('#photos-form').bind('fileuploadadd', function (e, data) {
	   console.log('File Added to Queue');
	   });

	   $('#photos-form').bind('fileuploaddone', function (e, data) {
		console.log('FileUploadDone fireed');
		$('#photo-grid').yiiGridView('update', {
			data: $('.filters').serialize()
		});
	   })

	   ", CClientScript::POS_READY);
?>