<?php
/* @var $this EmpRefController */
/* @var $data EmpRef */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RefName')); ?>:</b>
	<?php echo CHtml::encode($data->RefName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RefAdd')); ?>:</b>
	<?php echo CHtml::encode($data->RefAdd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Telno')); ?>:</b>
	<?php echo CHtml::encode($data->Telno); ?>
	<br />


</div>