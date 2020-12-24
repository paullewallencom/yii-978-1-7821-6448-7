<?php
$this->breadcrumbs=array(
	'Photos',
);
?>

<h1>Photos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
