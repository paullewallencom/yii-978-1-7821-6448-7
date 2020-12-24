<?php
/* @var $this AlbumController */
/* @var $data Album */
?>

<div class="view">

    <h2><?php echo CHtml::encode($data->name);?></h2>
    <?php 
    if ($data->photos)  
        echo CHtml::link(
                    CHtml::image($data->photos[0]->getThumb(),CHtml::encode($data->photos[0]->alt_text),array()),
                    $this->createUrl('view',array('id'=>$data->id))
                    );
    ?> 
    <div class="nav">
        <?php echo implode(' ', $data->tagLinks); ?>
    </div>	                    
</div>