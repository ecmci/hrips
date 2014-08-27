<?php
/* @var $this EmpOrganizationController */
/* @var $data EmpOrganization */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NameAddressOrg')); ?>:</b>
	<?php echo CHtml::encode($data->NameAddressOrg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FromDate')); ?>:</b>
	<?php echo CHtml::encode($data->FromDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ToDate')); ?>:</b>
	<?php echo CHtml::encode($data->ToDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NoOfHrs')); ?>:</b>
	<?php echo CHtml::encode($data->NoOfHrs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PositionNatureOfWork')); ?>:</b>
	<?php echo CHtml::encode($data->PositionNatureOfWork); ?>
	<br />


</div>