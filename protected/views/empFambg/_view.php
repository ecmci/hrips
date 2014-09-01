<?php
/* @var $this EmpFambgController */
/* @var $data EmpFambg */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EmpID), array('view', 'id'=>$data->EmpID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseLname')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseLname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseFname')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseFname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseMname')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseMname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseOccupation')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseOccupation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseEmployer')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseEmployer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseBusinessAddress')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseBusinessAddress); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SpouseTelno')); ?>:</b>
	<?php echo CHtml::encode($data->SpouseTelno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FatherLname')); ?>:</b>
	<?php echo CHtml::encode($data->FatherLname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FatherFname')); ?>:</b>
	<?php echo CHtml::encode($data->FatherFname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FatherMname')); ?>:</b>
	<?php echo CHtml::encode($data->FatherMname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MotherMaiden')); ?>:</b>
	<?php echo CHtml::encode($data->MotherMaiden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MotherLname')); ?>:</b>
	<?php echo CHtml::encode($data->MotherLname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MotherFname')); ?>:</b>
	<?php echo CHtml::encode($data->MotherFname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MotherMname')); ?>:</b>
	<?php echo CHtml::encode($data->MotherMname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Children')); ?>:</b>
	<?php echo CHtml::encode($data->Children); ?>
	<br />

	*/ ?>

</div>