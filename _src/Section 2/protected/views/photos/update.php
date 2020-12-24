<?php
$this->breadcrumbs=array(
	'Photoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Photos', 'url'=>array('index')),
	array('label'=>'Create Photos', 'url'=>array('create')),
	array('label'=>'View Photos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Photos', 'url'=>array('admin')),
);
?>

<h1>Update Photos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>