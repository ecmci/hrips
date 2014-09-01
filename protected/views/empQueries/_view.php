<?php
/* @var $this EmpQueriesController */
/* @var $data EmpQueries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EmpID), array('view', 'id'=>$data->EmpID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ThirdDegreeRelated')); ?>:</b>
	<?php echo CHtml::encode($data->ThirdDegreeRelated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TDRdetails')); ?>:</b>
	<?php echo CHtml::encode($data->TDRdetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FourthDegreeRelated')); ?>:</b>
	<?php echo CHtml::encode($data->FourthDegreeRelated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FDRdetails')); ?>:</b>
	<?php echo CHtml::encode($data->FDRdetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FormallyCharged')); ?>:</b>
	<?php echo CHtml::encode($data->FormallyCharged); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ChargedDetails')); ?>:</b>
	<?php echo CHtml::encode($data->ChargedDetails); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('AdminOffense')); ?>:</b>
	<?php echo CHtml::encode($data->AdminOffense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OffenseDetails')); ?>:</b>
	<?php echo CHtml::encode($data->OffenseDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CrimeConvicted')); ?>:</b>
	<?php echo CHtml::encode($data->CrimeConvicted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CrimeDetails')); ?>:</b>
	<?php echo CHtml::encode($data->CrimeDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SeparatedService')); ?>:</b>
	<?php echo CHtml::encode($data->SeparatedService); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SSdetails')); ?>:</b>
	<?php echo CHtml::encode($data->SSdetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ElectionCandidate')); ?>:</b>
	<?php echo CHtml::encode($data->ElectionCandidate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ECdetails')); ?>:</b>
	<?php echo CHtml::encode($data->ECdetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Indigenous')); ?>:</b>
	<?php echo CHtml::encode($data->Indigenous); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IndiDetails')); ?>:</b>
	<?php echo CHtml::encode($data->IndiDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DiffAbled')); ?>:</b>
	<?php echo CHtml::encode($data->DiffAbled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DAdetails')); ?>:</b>
	<?php echo CHtml::encode($data->DAdetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SoloParent')); ?>:</b>
	<?php echo CHtml::encode($data->SoloParent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SPdetails')); ?>:</b>
	<?php echo CHtml::encode($data->SPdetails); ?>
	<br />

	*/ ?>

</div>