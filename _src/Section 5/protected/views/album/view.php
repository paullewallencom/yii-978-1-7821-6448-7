<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Album', 'url'=>array('create')),
	array('label'=>'Update Album', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Album', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->name); ?></h1>
<p class="By">created by: <?php echo CHtml::encode($model->owner->fullName()); ?> on <span class="Date"><?php echo $model->created_dt; ?></span></p>
<p class=""><?php echo CHtml::encode($model->description); ?></p> 

<?php
    $this->renderPartial('/photo/index',array('dataProvider'=>$photos));
?>