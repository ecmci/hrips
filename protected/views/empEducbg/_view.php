<?php
/* @var $this EmpEducbgController */
/* @var $data EmpEducbg */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Level')); ?>:</b>
	<?php echo CHtml::encode($data->Level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NameofSchool')); ?>:</b>
	<?php echo CHtml::encode($data->NameofSchool); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DegreeCourse')); ?>:</b>
	<?php echo CHtml::encode($data->DegreeCourse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YearGrad')); ?>:</b>
	<?php echo CHtml::encode($data->YearGrad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HighestEarned')); ?>:</b>
	<?php echo CHtml::encode($data->HighestEarned); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FromDate')); ?>:</b>
	<?php echo CHtml::encode($data->FromDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ToDate')); ?>:</b>
	<?php echo CHtml::encode($data->ToDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ScholarshipReceived')); ?>:</b>
	<?php echo CHtml::encode($data->ScholarshipReceived); ?>
	<br />

	*/ ?>

</div>