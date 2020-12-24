<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->breadcrumbs=array(
	'Albums'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Album', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('album-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Albums</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'album-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'tags',
		array(
		    'name'=>'shareable',
		    'value'=>'($data->shareable)? \'Yes\' : \'No\''
		    ),
		array(
		    'name'=>'created_dt',
		    'value'=> 'Yii::app()->dateFormatter->format("dd/MM/yyyy",strtotime($data->created_dt))',
		    ),
		array(
		    'class'=>'CButtonColumn',
		    'template'=>'{update} {delete}',
                    'buttons'=>array(
                        'update'=>array(
                            'label'     =>'Update',
                            'imageUrl'  =>Yii::app()->theme->getBaseUrl().'/images/notes.png',
                            'url'=>'$this->grid->controller->createUrl("update", array("id"=>$data->id,"asDialog"=>1))',
                            //'click'=>'function(){alert("Update Click");  return false;}', // NOTE Javascript thus over-rides the url click
			    'options'=>array('class'=>'btn-mini'),
			    'visible'=>'!Yii::app()->user->isGuest'
                        ),
			'delete'=>array(
                            'imageUrl'  =>Yii::app()->theme->getBaseUrl().'/images/delete.png',
                        ),
                    )
		),
	),
)); ?>
