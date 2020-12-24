<div class="photo">

    <div class="imgWrap">
	<?php echo CHtml::image($data->getUrl(), CHtml::encode($data->alt_text)); ?>
    </div>
    <div class="caption show">
	<?php echo CHtml::encode($data->caption); ?>
    </div>

</div>