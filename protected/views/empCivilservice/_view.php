<?php
/* @var $this EmpCivilserviceController */
/* @var $data EmpCivilservice */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CareerService')); ?>:</b>
	<?php echo CHtml::encode($data->CareerService); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
	<?php echo CHtml::encode($data->Rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateExam')); ?>:</b>
	<?php echo CHtml::encode($data->DateExam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExamPlace')); ?>:</b>
	<?php echo CHtml::encode($data->ExamPlace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LicenseNumber')); ?>:</b>
	<?php echo CHtml::encode($data->LicenseNumber); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ReleaseDate')); ?>:</b>
	<?php echo CHtml::encode($data->ReleaseDate); ?>
	<br />

	*/ ?>

</div>