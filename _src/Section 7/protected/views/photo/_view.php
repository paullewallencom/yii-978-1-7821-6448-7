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
                echo "<span class='textIcon'>{$data->commentCount}</span>";
            ?>
    </div>

</div>