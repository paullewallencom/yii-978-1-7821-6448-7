<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'My Albums'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);
?>

<h1>Create Album</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>