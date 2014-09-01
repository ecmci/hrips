<?php
/* @var $this EasyPayslipController */
/* @var $data EasyPayslip */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmployeeId')); ?>:</b>
	<?php echo CHtml::encode($data->EmployeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ClientGroup')); ?>:</b>
	<?php echo CHtml::encode($data->ClientGroup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MiddleInitial')); ?>:</b>
	<?php echo CHtml::encode($data->MiddleInitial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Department')); ?>:</b>
	<?php echo CHtml::encode($data->Department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StdRateSalary')); ?>:</b>
	<?php echo CHtml::encode($data->StdRateSalary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GP1')); ?>:</b>
	<?php echo CHtml::encode($data->GP1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FICAWH')); ?>:</b>
	<?php echo CHtml::encode($data->FICAWH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MedicareWH')); ?>:</b>
	<?php echo CHtml::encode($data->MedicareWH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FederalWH')); ?>:</b>
	<?php echo CHtml::encode($data->FederalWH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StateWH')); ?>:</b>
	<?php echo CHtml::encode($data->StateWH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LocalWH')); ?>:</b>
	<?php echo CHtml::encode($data->LocalWH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NetPay')); ?>:</b>
	<?php echo CHtml::encode($data->NetPay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HoursWorked')); ?>:</b>
	<?php echo CHtml::encode($data->HoursWorked); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PayPeriod')); ?>:</b>
	<?php echo CHtml::encode($data->PayPeriod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->Timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Emailed')); ?>:</b>
	<?php echo CHtml::encode($data->Emailed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastErrorMessage')); ?>:</b>
	<?php echo CHtml::encode($data->LastErrorMessage); ?>
	<br />

	*/ ?>

</div>