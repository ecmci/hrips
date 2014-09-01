<?php
/* @var $this EmpOtherinfoController */
/* @var $data EmpOtherinfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::encode($data->EmpID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SkillsHobbies')); ?>:</b>
	<?php echo CHtml::encode($data->SkillsHobbies); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NonAcadRecognition')); ?>:</b>
	<?php echo CHtml::encode($data->NonAcadRecognition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MembershipAssocOrg')); ?>:</b>
	<?php echo CHtml::encode($data->MembershipAssocOrg); ?>
	<br />


</div>