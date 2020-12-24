<?php
/* @var $this PhotoController */
/* @var $data Photo */
?>

<div class="view">

    <div class="imgWrap" style="width: <?php echo Yii::app()->params['thumbSize']; ?>px ; height: <?php echo Yii::app()->params['thumbSize']; ?>px">
        <?php
            echo CHtml::link(
                    CHtml::image($data->getThumb(),
                            CHtml::encode($data->alt_text),array()) ,
                    $data->getUrl(),
                    array('rel'=>'colorBox','title'=>CHtml::encode($data->alt_text))
                    );
    ?>
    
    
    </div>
    <div class="caption">
        <?php echo CHtml::encode($data->caption); ?>
    </div>
    <div class="imgIcons">
            <?php 
                echo CHtml::link(($data->commentCount==0)? '+' : $data->commentCount,
			$this->createUrl('/photo/view',array('id'=>$data->id)),
			array('class'=>'textIcon')
			);
            ?>
    </div>

</div>