<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
<?php
if (YII_DEBUG) {
?>

<div class="error">

    <h2>Developer Stuff</h2>
   
    <table>
	<tr><td>Code: </td><td><?php echo CHtml::encode($code); ?></td></tr>
	<tr><td>Type: </td><td><?php echo CHtml::encode($type); ?></td></tr>
	<tr><td>Message: </td><td><?php echo CHtml::encode($message); ?></td></tr>
	<tr><td>ScriptName: </td><td><?php echo CHtml::encode($file); ?></td></tr>
	<tr><td>Line No: </td><td><?php echo CHtml::encode($line); ?></td></tr>
	<tr><td>Trace: </td><td><?php echo CHtml::encode($trace); ?></td></tr>
    </table>
</div>

<?php } ?>