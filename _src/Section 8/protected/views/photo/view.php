<?php
/* @var $this PhotoController */
/* @var $model Photo */

$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->album->name.' Album'=>array('/album/view','id'=>$model->album->id),
	($model->caption!='')? $model->caption : 'Photo',
);

?>

<?php $this->renderPartial('_photo', array(
	'data'=>$model,
)); ?>

<div id="comments">
	<?php if($model->commentCount>0): ?>
		<h3>
			<?php echo ($model->commentCount>1) ? $model->commentCount . ' comments' : 'One comment'; ?>
		</h3>
		
                <?php 
                    foreach ($model->comments as $data) {
                        $this->renderPartial('/comment/_view', 
                                array (
                                    'data'=>$data
                                ));
                    }
                ?>
    
	<?php endif; ?>

	<h3>Leave a Comment</h3>

	<?php
	    if (!Yii::app()->user->isGuest) 
		$this->renderPartial('/comment/_form',array(
			'model'=>$comment,
		)); 
	    else 
		echo '<span class="loggedIn">You must be logged in to leave a comment</span>';
	?>

</div><!-- comments -->

