<?php
/* @var $this EmpInformationController */
/* @var $data EmpInformation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EmpID), array('view', 'id'=>$data->EmpID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MiddleName')); ?>:</b>
	<?php echo CHtml::encode($data->MiddleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NameExt')); ?>:</b>
	<?php echo CHtml::encode($data->NameExt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmpName')); ?>:</b>
	<?php echo CHtml::encode($data->EmpName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ResidentialAddress')); ?>:</b>
	<?php echo CHtml::encode($data->ResidentialAddress); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('RAZipCode')); ?>:</b>
	<?php echo CHtml::encode($data->RAZipCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RATelno')); ?>:</b>
	<?php echo CHtml::encode($data->RATelno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HomeAddress')); ?>:</b>
	<?php echo CHtml::encode($data->HomeAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HAZipCode')); ?>:</b>
	<?php echo CHtml::encode($data->HAZipCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HATelno')); ?>:</b>
	<?php echo CHtml::encode($data->HATelno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContactNo')); ?>:</b>
	<?php echo CHtml::encode($data->ContactNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BirthDate')); ?>:</b>
	<?php echo CHtml::encode($data->BirthDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BdayPlace')); ?>:</b>
	<?php echo CHtml::encode($data->BdayPlace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Gender')); ?>:</b>
	<?php echo CHtml::encode($data->Gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CivilStat')); ?>:</b>
	<?php echo CHtml::encode($data->CivilStat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Citizenship')); ?>:</b>
	<?php echo CHtml::encode($data->Citizenship); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Height')); ?>:</b>
	<?php echo CHtml::encode($data->Height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Weight')); ?>:</b>
	<?php echo CHtml::encode($data->Weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BloodType')); ?>:</b>
	<?php echo CHtml::encode($data->BloodType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateHire')); ?>:</b>
	<?php echo CHtml::encode($data->DateHire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateRehire')); ?>:</b>
	<?php echo CHtml::encode($data->DateRehire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateResignation')); ?>:</b>
	<?php echo CHtml::encode($data->DateResignation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateTermination')); ?>:</b>
	<?php echo CHtml::encode($data->DateTermination); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateRetirement')); ?>:</b>
	<?php echo CHtml::encode($data->DateRetirement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SSS')); ?>:</b>
	<?php echo CHtml::encode($data->SSS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIN')); ?>:</b>
	<?php echo CHtml::encode($data->TIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PHIC')); ?>:</b>
	<?php echo CHtml::encode($data->PHIC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HDMF')); ?>:</b>
	<?php echo CHtml::encode($data->HDMF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AcctNo')); ?>:</b>
	<?php echo CHtml::encode($data->AcctNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgencyEmpNo')); ?>:</b>
	<?php echo CHtml::encode($data->AgencyEmpNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Department')); ?>:</b>
	<?php echo CHtml::encode($data->Department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Position')); ?>:</b>
	<?php echo CHtml::encode($data->Position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExtensionNo')); ?>:</b>
	<?php echo CHtml::encode($data->ExtensionNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OfficeSeatLocation')); ?>:</b>
	<?php echo CHtml::encode($data->OfficeSeatLocation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailAddress')); ?>:</b>
	<?php echo CHtml::encode($data->EmailAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tenant')); ?>:</b>
	<?php echo CHtml::encode($data->Tenant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BedNo')); ?>:</b>
	<?php echo CHtml::encode($data->BedNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Allowance')); ?>:</b>
	<?php echo CHtml::encode($data->Allowance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAPE')); ?>:</b>
	<?php echo CHtml::encode($data->DateAPE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CertifyTrue')); ?>:</b>
	<?php echo CHtml::encode($data->CertifyTrue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NewEmp')); ?>:</b>
	<?php echo CHtml::encode($data->NewEmp); ?>
	<br />

	*/ ?>

</div>