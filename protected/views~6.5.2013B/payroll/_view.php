<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_ID')); ?>:
	<?php echo GxHtml::encode($data->Emp_ID); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_Name')); ?>:
	<?php echo GxHtml::encode($data->Emp_Name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Position')); ?>:
	<?php echo GxHtml::encode($data->Position); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Department')); ?>:
	<?php echo GxHtml::encode($data->Department); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Schedule')); ?>:
	<?php echo GxHtml::encode($data->Schedule); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_Status')); ?>:
	<?php echo GxHtml::encode($data->Emp_Status); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('Monthly_Basic')); ?>:
	<?php echo GxHtml::encode($data->Monthly_Basic); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Semi_Monthly_Basic')); ?>:
	<?php echo GxHtml::encode($data->Semi_Monthly_Basic); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Tax_Status')); ?>:
	<?php echo GxHtml::encode($data->Tax_Status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Monthly_Night_Diff')); ?>:
	<?php echo GxHtml::encode($data->Monthly_Night_Diff); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Semi_Monthly')); ?>:
	<?php echo GxHtml::encode($data->Total_Semi_Monthly); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Days_Work')); ?>:
	<?php echo GxHtml::encode($data->Days_Work); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Late_Absent')); ?>:
	<?php echo GxHtml::encode($data->Late_Absent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Extra_Allowance')); ?>:
	<?php echo GxHtml::encode($data->Extra_Allowance); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('New_Salary_with_ND')); ?>:
	<?php echo GxHtml::encode($data->New_Salary_with_ND); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Days_Work')); ?>:
	<?php echo GxHtml::encode($data->Total_Days_Work); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Per_Day')); ?>:
	<?php echo GxHtml::encode($data->Per_Day); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Per_Hr')); ?>:
	<?php echo GxHtml::encode($data->Per_Hr); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Regular_Pay')); ?>:
	<?php echo GxHtml::encode($data->Regular_Pay); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Night_Diff')); ?>:
	<?php echo GxHtml::encode($data->Total_Night_Diff); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ND_Per_Days')); ?>:
	<?php echo GxHtml::encode($data->ND_Per_Days); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Days_with_ND')); ?>:
	<?php echo GxHtml::encode($data->Total_Days_with_ND); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_ND')); ?>:
	<?php echo GxHtml::encode($data->Total_ND); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Gross_Pay')); ?>:
	<?php echo GxHtml::encode($data->Total_Gross_Pay); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Basic_Salary')); ?>:
	<?php echo GxHtml::encode($data->Total_Basic_Salary); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('SSS')); ?>:
	<?php echo GxHtml::encode($data->SSS); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_Share_SSS')); ?>:
	<?php echo GxHtml::encode($data->Emp_Share_SSS); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('EC')); ?>:
	<?php echo GxHtml::encode($data->EC); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('PHIC')); ?>:
	<?php echo GxHtml::encode($data->PHIC); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_Share_PHIC')); ?>:
	<?php echo GxHtml::encode($data->Emp_Share_PHIC); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('HDMF')); ?>:
	<?php echo GxHtml::encode($data->HDMF); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Emp_Share_HDMF')); ?>:
	<?php echo GxHtml::encode($data->Emp_Share_HDMF); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_HDMF')); ?>:
	<?php echo GxHtml::encode($data->Total_HDMF); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Tax_Income')); ?>:
	<?php echo GxHtml::encode($data->Total_Tax_Income); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Withholding_Tax')); ?>:
	<?php echo GxHtml::encode($data->Withholding_Tax); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('SSS_Loan')); ?>:
	<?php echo GxHtml::encode($data->SSS_Loan); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('HDMF_Loan')); ?>:
	<?php echo GxHtml::encode($data->HDMF_Loan); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Insurance')); ?>:
	<?php echo GxHtml::encode($data->Insurance); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Rental_Housing')); ?>:
	<?php echo GxHtml::encode($data->Rental_Housing); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Deduction')); ?>:
	<?php echo GxHtml::encode($data->Total_Deduction); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Non_PTO_Hrs')); ?>:
	<?php echo GxHtml::encode($data->Non_PTO_Hrs); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Non_PTO_Amt')); ?>:
	<?php echo GxHtml::encode($data->Non_PTO_Amt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Net_Pay')); ?>:
	<?php echo GxHtml::encode($data->Net_Pay); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Payroll_Period')); ?>:
	<?php echo GxHtml::encode($data->Payroll_Period); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Payroll_Date')); ?>:
	<?php echo GxHtml::encode($data->Payroll_Date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Payroll_Date_Words')); ?>:
	<?php echo GxHtml::encode($data->Payroll_Date_Words); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Total_Earnings')); ?>:
	<?php echo GxHtml::encode($data->Total_Earnings); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Overtime_hrs')); ?>:
	<?php echo GxHtml::encode($data->Overtime_hrs); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Overtime')); ?>:
	<?php echo GxHtml::encode($data->Overtime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Regular_OT')); ?>:
	<?php echo GxHtml::encode($data->Regular_OT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('NDOT')); ?>:
	<?php echo GxHtml::encode($data->NDOT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Spec_Holiday')); ?>:
	<?php echo GxHtml::encode($data->Spec_Holiday); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Spec_OT')); ?>:
	<?php echo GxHtml::encode($data->Spec_OT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Spec_NDOT')); ?>:
	<?php echo GxHtml::encode($data->Spec_NDOT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Reg_Holiday')); ?>:
	<?php echo GxHtml::encode($data->Reg_Holiday); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('RegHoliday_OT')); ?>:
	<?php echo GxHtml::encode($data->RegHoliday_OT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('RegHoliday_NDOT')); ?>:
	<?php echo GxHtml::encode($data->RegHoliday_NDOT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('VL')); ?>:
	<?php echo GxHtml::encode($data->VL); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('PTO_With_Tax')); ?>:
	<?php echo GxHtml::encode($data->PTO_With_Tax); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('PTO_Wo_Tax')); ?>:
	<?php echo GxHtml::encode($data->PTO_Wo_Tax); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Basic_Pay')); ?>:
	<?php echo GxHtml::encode($data->Basic_Pay); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Cash_Out')); ?>:
	<?php echo GxHtml::encode($data->Cash_Out); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Starting_Salary')); ?>:
	<?php echo GxHtml::encode($data->Starting_Salary); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sumEverything')); ?>:
	<?php echo GxHtml::encode($data->sumEverything); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('initialYrEnder')); ?>:
	<?php echo GxHtml::encode($data->initialYrEnder); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('YearEnder')); ?>:
	<?php echo GxHtml::encode($data->YearEnder); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Excess_to_13mo')); ?>:
	<?php echo GxHtml::encode($data->Excess_to_13mo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('countLang')); ?>:
	<?php echo GxHtml::encode($data->countLang); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Adjustment')); ?>:
	<?php echo GxHtml::encode($data->Adjustment); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Salary_Adjustment')); ?>:
	<?php echo GxHtml::encode($data->Salary_Adjustment); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_MB')); ?>:
	<?php echo GxHtml::encode($data->Add_to_MB); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_ND')); ?>:
	<?php echo GxHtml::encode($data->Add_to_ND); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_OT')); ?>:
	<?php echo GxHtml::encode($data->Add_to_OT); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_PTO_With_Tax')); ?>:
	<?php echo GxHtml::encode($data->Add_to_PTO_With_Tax); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_SSS')); ?>:
	<?php echo GxHtml::encode($data->Add_to_SSS); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_PHIC')); ?>:
	<?php echo GxHtml::encode($data->Add_to_PHIC); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_HDMF')); ?>:
	<?php echo GxHtml::encode($data->Add_to_HDMF); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_Taxable_Income')); ?>:
	<?php echo GxHtml::encode($data->Add_to_Taxable_Income); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_NonTaxableDeduct')); ?>:
	<?php echo GxHtml::encode($data->Add_to_NonTaxableDeduct); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Add_to_Tax_Due')); ?>:
	<?php echo GxHtml::encode($data->Add_to_Tax_Due); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Taxable_Adj')); ?>:
	<?php echo GxHtml::encode($data->Taxable_Adj); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('NonTaxableAdj')); ?>:
	<?php echo GxHtml::encode($data->NonTaxableAdj); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Act_Status')); ?>:
	<?php echo GxHtml::encode($data->Act_Status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Rate_with_ND')); ?>:
	<?php echo GxHtml::encode($data->Rate_with_ND); ?>
	<br />
	*/ ?>

</div>