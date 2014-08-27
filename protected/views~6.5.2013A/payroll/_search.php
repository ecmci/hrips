<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Emp_ID'); ?>
		<?php echo $form->textField($model, 'Emp_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Emp_Name'); ?>
		<?php echo $form->textField($model, 'Emp_Name', array('maxlength' => 60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Position'); ?>
		<?php echo $form->textField($model, 'Position', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Department'); ?>
		<?php echo $form->textField($model, 'Department', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Schedule'); ?>
		<?php echo $form->textField($model, 'Schedule', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Emp_Status'); ?>
		<?php echo $form->textField($model, 'Emp_Status', array('maxlength' => 60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Monthly_Basic'); ?>
		<?php echo $form->textField($model, 'Monthly_Basic', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Semi_Monthly_Basic'); ?>
		<?php echo $form->textField($model, 'Semi_Monthly_Basic', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Tax_Status'); ?>
		<?php echo $form->textField($model, 'Tax_Status', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Monthly_Night_Diff'); ?>
		<?php echo $form->textField($model, 'Monthly_Night_Diff', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Semi_Monthly'); ?>
		<?php echo $form->textField($model, 'Total_Semi_Monthly', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Days_Work'); ?>
		<?php echo $form->textField($model, 'Days_Work', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Late_Absent'); ?>
		<?php echo $form->textField($model, 'Late_Absent', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Extra_Allowance'); ?>
		<?php echo $form->textField($model, 'Extra_Allowance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'New_Salary_with_ND'); ?>
		<?php echo $form->textField($model, 'New_Salary_with_ND', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Days_Work'); ?>
		<?php echo $form->textField($model, 'Total_Days_Work', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Per_Day'); ?>
		<?php echo $form->textField($model, 'Per_Day', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Per_Hr'); ?>
		<?php echo $form->textField($model, 'Per_Hr', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Regular_Pay'); ?>
		<?php echo $form->textField($model, 'Regular_Pay', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Night_Diff'); ?>
		<?php echo $form->textField($model, 'Total_Night_Diff', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ND_Per_Days'); ?>
		<?php echo $form->textField($model, 'ND_Per_Days', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Days_with_ND'); ?>
		<?php echo $form->textField($model, 'Total_Days_with_ND', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_ND'); ?>
		<?php echo $form->textField($model, 'Total_ND', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Gross_Pay'); ?>
		<?php echo $form->textField($model, 'Total_Gross_Pay', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Basic_Salary'); ?>
		<?php echo $form->textField($model, 'Total_Basic_Salary', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'SSS'); ?>
		<?php echo $form->textField($model, 'SSS', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Emp_Share_SSS'); ?>
		<?php echo $form->textField($model, 'Emp_Share_SSS', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EC'); ?>
		<?php echo $form->textField($model, 'EC', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'PHIC'); ?>
		<?php echo $form->textField($model, 'PHIC', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Emp_Share_PHIC'); ?>
		<?php echo $form->textField($model, 'Emp_Share_PHIC', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'HDMF'); ?>
		<?php echo $form->textField($model, 'HDMF', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Emp_Share_HDMF'); ?>
		<?php echo $form->textField($model, 'Emp_Share_HDMF', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_HDMF'); ?>
		<?php echo $form->textField($model, 'Total_HDMF', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Tax_Income'); ?>
		<?php echo $form->textField($model, 'Total_Tax_Income', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Withholding_Tax'); ?>
		<?php echo $form->textField($model, 'Withholding_Tax', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'SSS_Loan'); ?>
		<?php echo $form->textField($model, 'SSS_Loan', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'HDMF_Loan'); ?>
		<?php echo $form->textField($model, 'HDMF_Loan', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Insurance'); ?>
		<?php echo $form->textField($model, 'Insurance', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Rental_Housing'); ?>
		<?php echo $form->textField($model, 'Rental_Housing', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Deduction'); ?>
		<?php echo $form->textField($model, 'Total_Deduction', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Non_PTO_Hrs'); ?>
		<?php echo $form->textField($model, 'Non_PTO_Hrs', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Non_PTO_Amt'); ?>
		<?php echo $form->textField($model, 'Non_PTO_Amt', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Net_Pay'); ?>
		<?php echo $form->textField($model, 'Net_Pay', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Payroll_Period'); ?>
		<?php echo $form->textField($model, 'Payroll_Period', array('maxlength' => 60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Payroll_Date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'Payroll_Date',
			'value' => $model->Payroll_Date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Payroll_Date_Words'); ?>
		<?php echo $form->textField($model, 'Payroll_Date_Words', array('maxlength' => 60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Earnings'); ?>
		<?php echo $form->textField($model, 'Total_Earnings', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Overtime_hrs'); ?>
		<?php echo $form->textField($model, 'Overtime_hrs', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Overtime'); ?>
		<?php echo $form->textField($model, 'Overtime', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Regular_OT'); ?>
		<?php echo $form->textField($model, 'Regular_OT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'NDOT'); ?>
		<?php echo $form->textField($model, 'NDOT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Spec_Holiday'); ?>
		<?php echo $form->textField($model, 'Spec_Holiday', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Spec_OT'); ?>
		<?php echo $form->textField($model, 'Spec_OT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Spec_NDOT'); ?>
		<?php echo $form->textField($model, 'Spec_NDOT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Reg_Holiday'); ?>
		<?php echo $form->textField($model, 'Reg_Holiday', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'RegHoliday_OT'); ?>
		<?php echo $form->textField($model, 'RegHoliday_OT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'RegHoliday_NDOT'); ?>
		<?php echo $form->textField($model, 'RegHoliday_NDOT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'VL'); ?>
		<?php echo $form->textField($model, 'VL', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'PTO_With_Tax'); ?>
		<?php echo $form->textField($model, 'PTO_With_Tax', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'PTO_Wo_Tax'); ?>
		<?php echo $form->textField($model, 'PTO_Wo_Tax', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Basic_Pay'); ?>
		<?php echo $form->textField($model, 'Basic_Pay', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Cash_Out'); ?>
		<?php echo $form->textField($model, 'Cash_Out', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Starting_Salary'); ?>
		<?php echo $form->textField($model, 'Starting_Salary'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sumEverything'); ?>
		<?php echo $form->textField($model, 'sumEverything', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'initialYrEnder'); ?>
		<?php echo $form->textField($model, 'initialYrEnder', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'YearEnder'); ?>
		<?php echo $form->textField($model, 'YearEnder', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Excess_to_13mo'); ?>
		<?php echo $form->textField($model, 'Excess_to_13mo', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'countLang'); ?>
		<?php echo $form->textField($model, 'countLang', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Adjustment'); ?>
		<?php echo $form->textField($model, 'Adjustment', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Salary_Adjustment'); ?>
		<?php echo $form->textField($model, 'Salary_Adjustment', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_MB'); ?>
		<?php echo $form->textField($model, 'Add_to_MB', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_ND'); ?>
		<?php echo $form->textField($model, 'Add_to_ND', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_OT'); ?>
		<?php echo $form->textField($model, 'Add_to_OT', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_PTO_With_Tax'); ?>
		<?php echo $form->textField($model, 'Add_to_PTO_With_Tax', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_SSS'); ?>
		<?php echo $form->textField($model, 'Add_to_SSS', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_PHIC'); ?>
		<?php echo $form->textField($model, 'Add_to_PHIC', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_HDMF'); ?>
		<?php echo $form->textField($model, 'Add_to_HDMF', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_Taxable_Income'); ?>
		<?php echo $form->textField($model, 'Add_to_Taxable_Income', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_NonTaxableDeduct'); ?>
		<?php echo $form->textField($model, 'Add_to_NonTaxableDeduct', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Add_to_Tax_Due'); ?>
		<?php echo $form->textField($model, 'Add_to_Tax_Due', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Taxable_Adj'); ?>
		<?php echo $form->textField($model, 'Taxable_Adj', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'NonTaxableAdj'); ?>
		<?php echo $form->textField($model, 'NonTaxableAdj', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Act_Status'); ?>
		<?php echo $form->textField($model, 'Act_Status', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Rate_with_ND'); ?>
		<?php echo $form->textField($model, 'Rate_with_ND', array('maxlength' => 20)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
