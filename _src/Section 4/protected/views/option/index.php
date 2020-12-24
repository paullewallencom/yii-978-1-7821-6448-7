<?php
/* @var $this OptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Options',
);

$this->menu=array(
	array('label'=>'Create Option', 'url'=>array('create')),
	array('label'=>'Manage Option', 'url'=>array('admin')),
);
?>

<h1>Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
