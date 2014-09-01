<?php
/* @var $this EmpWorkexpController */
/* @var $data EmpWorkexp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FromDate')); ?>:</b>
	<?php echo CHtml::encode($data->FromDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ToDate')); ?>:</b>
	<?php echo CHtml::encode($data->ToDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PositionTitle')); ?>:</b>
	<?php echo CHtml::encode($data->PositionTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Company')); ?>:</b>
	<?php echo CHtml::encode($data->Company); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MonthlySalary')); ?>:</b>
	<?php echo CHtml::encode($data->MonthlySalary); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SalaryGrade')); ?>:</b>
	<?php echo CHtml::encode($data->SalaryGrade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StatAppointment')); ?>:</b>
	<?php echo CHtml::encode($data->StatAppointment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GovtService')); ?>:</b>
	<?php echo CHtml::encode($data->GovtService); ?>
	<br />

	*/ ?>

</div>