<?php
/* @var $this AlbumController */
/* @var $data Album */
/**CB-3.2**/
?>

<div class="view">

    <h2><?php echo CHtml::encode($data->name);?></h2>
    <p><?php /**CB 8.3 if ($data->categories) echo "(".CHtml::encode($data->categories->option_value).")";**/ ?></p>
    <?php 
    if ($data->photos)  
        echo CHtml::link(
                    CHtml::image($data->photos[0]->getThumb(),CHtml::encode($data->photos[0]->alt_text),array()),
                    $this->createUrl('view',array('id'=>$data->id))
                    );
    ?> 
                    
</div>