<?php
/* @var $this EmpAppraisalsController */
/* @var $data EmpAppraisals */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FromSalary')); ?>:</b>
	<?php echo CHtml::encode($data->FromSalary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ToSalary')); ?>:</b>
	<?php echo CHtml::encode($data->ToSalary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateEffective')); ?>:</b>
	<?php echo CHtml::encode($data->DateEffective); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Notes')); ?>:</b>
	<?php echo CHtml::encode($data->Notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdateToPayroll')); ?>:</b>
	<?php echo CHtml::encode($data->UpdateToPayroll); ?>
	<br />


</div>