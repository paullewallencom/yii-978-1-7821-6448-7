<?php
/* @var $this PhotoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Photos',
);

$this->menu=array(
	array('label'=>'Create Photo', 'url'=>array('create')),
	array('label'=>'Manage Photo', 'url'=>array('admin')),
);
?>

<h1>Photos</h1>

<?php
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php $colorbox->addInstance("a[rel=\'colorBox\']", array('maxHeight'=>'90%', 'maxWidth'=>'90%')); ?>

<?php
Yii::app()->clientScript->registerScript('caption', "
   jQuery('.imgWrap').hover(
        function(){
            if ($(this).next().html().trim()!='')
            $(this).next().slideDown();
        },
        function(){
            $(this).next().hide();
        }
    );
", CClientScript::POS_READY);
?>