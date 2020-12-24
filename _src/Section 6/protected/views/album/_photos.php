<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'photo-grid',
	'dataProvider'=>$photos->search(),
	//'filter'=>$model,
	'columns'=>array(
		array(
		    'name'=>'thumb',
		    'type'=>'raw',
		    'value'=>'$data->getThumbnail()',
		    ),
		'caption',
		'alt_text',
		'tags',
		'sort_order',
		/*
		'created_dt',
		'lastupdate_dt',
		*/
		array(
		    'class'=>'CButtonColumn',
		    'template'=>'{update} {delete}',
                    'buttons'=>array(
                        'update'=>array(
                            'label'     =>'Update',
                            'imageUrl'  =>Yii::app()->theme->getBaseUrl().'/images/notes.png',
                            'url'=>'$this->grid->controller->createUrl("/photo/update", array("id"=>$data->id,"asDialog"=>1))',
                            //'click'=>'function(){alert("Update Click");  return false;}', // NOTE Javascript thus over-rides the url click
			    'options'=>array('class'=>'btn-mini'),
			    'visible'=>'!Yii::app()->user->isGuest'
                        ),
			'delete'=>array(
                            'imageUrl'  =>Yii::app()->theme->getBaseUrl().'/images/delete.png',
                            'url'=>'$this->grid->controller->createUrl("/photo/delete", array("id"=>$data->id,"asDialog"=>1))',
                        ),
                    )
		),
	),
)); ?>
