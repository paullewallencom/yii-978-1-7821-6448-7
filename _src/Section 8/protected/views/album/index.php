<?php
/* @var $this AlbumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Albums',
);


?>

<?php
if (isset($tags))
    echo "<h1>Albums matching tags: ".$tags."</h1>";
else
    echo "<h1>Albums</h1>";
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
