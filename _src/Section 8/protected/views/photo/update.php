<?php
/* @var $this PhotoController */
/* @var $model Photo */
$this->breadcrumbs=array(
    	'My Albums'=>array('album/admin'),
	$model->album->name.' Album'=>array('album/update','id'=>$model->album_id), 
	'Update',
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>