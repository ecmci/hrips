<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_ID')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->Emp_ID), array('view', 'id' => $data->Emp_ID)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('Lname')); ?>:
	<?php echo GxHtml::encode($data->Lname); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Fname')); ?>:
	<?php echo GxHtml::encode($data->Fname); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Mname')); ?>:
	<?php echo GxHtml::encode($data->Mname); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Fullname')); ?>:
	<?php echo GxHtml::encode($data->Fullname); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Position')); ?>:
	<?php echo GxHtml::encode($data->Position); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Department')); ?>:
	<?php echo GxHtml::encode($data->Department); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('Schedule')); ?>:
	<?php echo GxHtml::encode($data->Schedule); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_Status')); ?>:
	<?php echo GxHtml::encode($data->Emp_Status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Tax_Status')); ?>:
	<?php echo GxHtml::encode($data->Tax_Status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Birthday')); ?>:
	<?php echo GxHtml::encode($data->Birthday); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Birthplace')); ?>:
	<?php echo GxHtml::encode($data->Birthplace); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Gender')); ?>:
	<?php echo GxHtml::encode($data->Gender); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Contact_No')); ?>:
	<?php echo GxHtml::encode($data->Contact_No); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Height')); ?>:
	<?php echo GxHtml::encode($data->Height); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Weight')); ?>:
	<?php echo GxHtml::encode($data->Weight); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Blood_Type')); ?>:
	<?php echo GxHtml::encode($data->Blood_Type); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Citizenship')); ?>:
	<?php echo GxHtml::encode($data->Citizenship); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Civil_Status')); ?>:
	<?php echo GxHtml::encode($data->Civil_Status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Spouse')); ?>:
	<?php echo GxHtml::encode($data->Spouse); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Children')); ?>:
	<?php echo GxHtml::encode($data->Children); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Email_Add')); ?>:
	<?php echo GxHtml::encode($data->Email_Add); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Account_Number')); ?>:
	<?php echo GxHtml::encode($data->Account_Number); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('SSS')); ?>:
	<?php echo GxHtml::encode($data->SSS); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('TIN')); ?>:
	<?php echo GxHtml::encode($data->TIN); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('PHIL_HEALTH')); ?>:
	<?php echo GxHtml::encode($data->PHIL_HEALTH); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('PAG_IBIG')); ?>:
	<?php echo GxHtml::encode($data->PAG_IBIG); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Permanent_Add')); ?>:
	<?php echo GxHtml::encode($data->Permanent_Add); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Residential_Add')); ?>:
	<?php echo GxHtml::encode($data->Residential_Add); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Monthly_Basic')); ?>:
	<?php echo GxHtml::encode($data->Monthly_Basic); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Semi_Monthly')); ?>:
	<?php echo GxHtml::encode($data->Total_Semi_Monthly); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Starting_Salary')); ?>:
	<?php echo GxHtml::encode($data->Starting_Salary); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Days_Work')); ?>:
	<?php echo GxHtml::encode($data->Days_Work); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Monthly_Night_Diff')); ?>:
	<?php echo GxHtml::encode($data->Monthly_Night_Diff); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Date_Hired')); ?>:
	<?php echo GxHtml::encode($data->Date_Hired); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Date_Regularized')); ?>:
	<?php echo GxHtml::encode($data->Date_Regularized); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Days_Work')); ?>:
	<?php echo GxHtml::encode($data->Total_Days_Work); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('NDHrsperWk')); ?>:
	<?php echo GxHtml::encode($data->NDHrsperWk); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('NDHrsCutOff')); ?>:
	<?php echo GxHtml::encode($data->NDHrsCutOff); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Date_Terminated')); ?>:
	<?php echo GxHtml::encode($data->Date_Terminated); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Act_Status')); ?>:
	<?php echo GxHtml::encode($data->Act_Status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('YearEnder')); ?>:
	<?php echo GxHtml::encode($data->YearEnder); ?>
	<br />
	*/ ?>

</div>