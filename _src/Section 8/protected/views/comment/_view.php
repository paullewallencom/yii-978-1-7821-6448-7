<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="comment"> 
    <div class="commentContent">
    <?php echo CHtml::encode($data->content); ?>
    </div>
    
    <div class="commentFooter">
        <?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:
	<span class="By">
            <?php echo CHtml::encode($data->author->fullName()); ?>
        </span>
        <span class="Date">
	    <?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>
	    <?php echo CHtml::encode($data->create_date); ?>
	</span>
    </div>

</div>