<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->name,
);

?>

<h1><?php echo CHtml::encode($model->name); ?></h1>
<p class="By">created by: <?php echo CHtml::encode($model->owner->fullName()); ?> on <span class="Date"><?php echo $model->created_dt; ?></span></p>
<p class=""><?php echo CHtml::encode($model->description); ?></p> 

<?php
    $this->renderPartial('/photo/index',array('dataProvider'=>$photos));
?>