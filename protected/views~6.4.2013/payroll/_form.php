<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'payroll-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'Emp_ID'); ?>
		<?php echo $form->textField($model, 'Emp_ID'); ?>
		<?php echo $form->error($model,'Emp_ID'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Emp_Name'); ?>
		<?php echo $form->textField($model, 'Emp_Name', array('maxlength' => 60)); ?>
		<?php echo $form->error($model,'Emp_Name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Position'); ?>
		<?php echo $form->textField($model, 'Position', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Position'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Department'); ?>
		<?php echo $form->textField($model, 'Department', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Department'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Schedule'); ?>
		<?php echo $form->textField($model, 'Schedule', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Schedule'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Emp_Status'); ?>
		<?php echo $form->textField($model, 'Emp_Status', array('maxlength' => 60)); ?>
		<?php echo $form->error($model,'Emp_Status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Monthly_Basic'); ?>
		<?php echo $form->textField($model, 'Monthly_Basic', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Monthly_Basic'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Semi_Monthly_Basic'); ?>
		<?php echo $form->textField($model, 'Semi_Monthly_Basic', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Semi_Monthly_Basic'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Tax_Status'); ?>
		<?php echo $form->textField($model, 'Tax_Status', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Tax_Status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Monthly_Night_Diff'); ?>
		<?php echo $form->textField($model, 'Monthly_Night_Diff', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Monthly_Night_Diff'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Semi_Monthly'); ?>
		<?php echo $form->textField($model, 'Total_Semi_Monthly', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Semi_Monthly'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Days_Work'); ?>
		<?php echo $form->textField($model, 'Days_Work', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Days_Work'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Late_Absent'); ?>
		<?php echo $form->textField($model, 'Late_Absent', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Late_Absent'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Extra_Allowance'); ?>
		<?php echo $form->textField($model, 'Extra_Allowance'); ?>
		<?php echo $form->error($model,'Extra_Allowance'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'New_Salary_with_ND'); ?>
		<?php echo $form->textField($model, 'New_Salary_with_ND', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'New_Salary_with_ND'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Days_Work'); ?>
		<?php echo $form->textField($model, 'Total_Days_Work', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Days_Work'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Per_Day'); ?>
		<?php echo $form->textField($model, 'Per_Day', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Per_Day'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Per_Hr'); ?>
		<?php echo $form->textField($model, 'Per_Hr', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Per_Hr'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Regular_Pay'); ?>
		<?php echo $form->textField($model, 'Regular_Pay', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Regular_Pay'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Night_Diff'); ?>
		<?php echo $form->textField($model, 'Total_Night_Diff', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Night_Diff'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ND_Per_Days'); ?>
		<?php echo $form->textField($model, 'ND_Per_Days', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'ND_Per_Days'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Days_with_ND'); ?>
		<?php echo $form->textField($model, 'Total_Days_with_ND', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Days_with_ND'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_ND'); ?>
		<?php echo $form->textField($model, 'Total_ND', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_ND'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Gross_Pay'); ?>
		<?php echo $form->textField($model, 'Total_Gross_Pay', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Gross_Pay'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Basic_Salary'); ?>
		<?php echo $form->textField($model, 'Total_Basic_Salary', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Basic_Salary'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'SSS'); ?>
		<?php echo $form->textField($model, 'SSS', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'SSS'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Emp_Share_SSS'); ?>
		<?php echo $form->textField($model, 'Emp_Share_SSS', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Emp_Share_SSS'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'EC'); ?>
		<?php echo $form->textField($model, 'EC', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'EC'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'PHIC'); ?>
		<?php echo $form->textField($model, 'PHIC', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'PHIC'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Emp_Share_PHIC'); ?>
		<?php echo $form->textField($model, 'Emp_Share_PHIC', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Emp_Share_PHIC'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'HDMF'); ?>
		<?php echo $form->textField($model, 'HDMF', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'HDMF'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Emp_Share_HDMF'); ?>
		<?php echo $form->textField($model, 'Emp_Share_HDMF', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Emp_Share_HDMF'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_HDMF'); ?>
		<?php echo $form->textField($model, 'Total_HDMF', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_HDMF'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Tax_Income'); ?>
		<?php echo $form->textField($model, 'Total_Tax_Income', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Tax_Income'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Withholding_Tax'); ?>
		<?php echo $form->textField($model, 'Withholding_Tax', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Withholding_Tax'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'SSS_Loan'); ?>
		<?php echo $form->textField($model, 'SSS_Loan', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'SSS_Loan'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'HDMF_Loan'); ?>
		<?php echo $form->textField($model, 'HDMF_Loan', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'HDMF_Loan'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Insurance'); ?>
		<?php echo $form->textField($model, 'Insurance', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Insurance'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Rental_Housing'); ?>
		<?php echo $form->textField($model, 'Rental_Housing', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Rental_Housing'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Deduction'); ?>
		<?php echo $form->textField($model, 'Total_Deduction', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Deduction'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Non_PTO_Hrs'); ?>
		<?php echo $form->textField($model, 'Non_PTO_Hrs', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Non_PTO_Hrs'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Non_PTO_Amt'); ?>
		<?php echo $form->textField($model, 'Non_PTO_Amt', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Non_PTO_Amt'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Net_Pay'); ?>
		<?php echo $form->textField($model, 'Net_Pay', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Net_Pay'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Payroll_Period'); ?>
		<?php echo $form->textField($model, 'Payroll_Period', array('maxlength' => 60)); ?>
		<?php echo $form->error($model,'Payroll_Period'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Payroll_Date'); ?>
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
		<?php echo $form->error($model,'Payroll_Date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Payroll_Date_Words'); ?>
		<?php echo $form->textField($model, 'Payroll_Date_Words', array('maxlength' => 60)); ?>
		<?php echo $form->error($model,'Payroll_Date_Words'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Earnings'); ?>
		<?php echo $form->textField($model, 'Total_Earnings', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Earnings'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Overtime_hrs'); ?>
		<?php echo $form->textField($model, 'Overtime_hrs', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Overtime_hrs'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Overtime'); ?>
		<?php echo $form->textField($model, 'Overtime', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Overtime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Regular_OT'); ?>
		<?php echo $form->textField($model, 'Regular_OT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Regular_OT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'NDOT'); ?>
		<?php echo $form->textField($model, 'NDOT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'NDOT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Spec_Holiday'); ?>
		<?php echo $form->textField($model, 'Spec_Holiday', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Spec_Holiday'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Spec_OT'); ?>
		<?php echo $form->textField($model, 'Spec_OT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Spec_OT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Spec_NDOT'); ?>
		<?php echo $form->textField($model, 'Spec_NDOT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Spec_NDOT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Reg_Holiday'); ?>
		<?php echo $form->textField($model, 'Reg_Holiday', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Reg_Holiday'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'RegHoliday_OT'); ?>
		<?php echo $form->textField($model, 'RegHoliday_OT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'RegHoliday_OT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'RegHoliday_NDOT'); ?>
		<?php echo $form->textField($model, 'RegHoliday_NDOT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'RegHoliday_NDOT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'VL'); ?>
		<?php echo $form->textField($model, 'VL', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'VL'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'PTO_With_Tax'); ?>
		<?php echo $form->textField($model, 'PTO_With_Tax', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'PTO_With_Tax'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'PTO_Wo_Tax'); ?>
		<?php echo $form->textField($model, 'PTO_Wo_Tax', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'PTO_Wo_Tax'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Basic_Pay'); ?>
		<?php echo $form->textField($model, 'Basic_Pay', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Basic_Pay'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Cash_Out'); ?>
		<?php echo $form->textField($model, 'Cash_Out', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Cash_Out'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Starting_Salary'); ?>
		<?php echo $form->textField($model, 'Starting_Salary'); ?>
		<?php echo $form->error($model,'Starting_Salary'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sumEverything'); ?>
		<?php echo $form->textField($model, 'sumEverything', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'sumEverything'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'initialYrEnder'); ?>
		<?php echo $form->textField($model, 'initialYrEnder', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'initialYrEnder'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'YearEnder'); ?>
		<?php echo $form->textField($model, 'YearEnder', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'YearEnder'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Excess_to_13mo'); ?>
		<?php echo $form->textField($model, 'Excess_to_13mo', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Excess_to_13mo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'countLang'); ?>
		<?php echo $form->textField($model, 'countLang', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'countLang'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Adjustment'); ?>
		<?php echo $form->textField($model, 'Adjustment', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Adjustment'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Salary_Adjustment'); ?>
		<?php echo $form->textField($model, 'Salary_Adjustment', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Salary_Adjustment'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_MB'); ?>
		<?php echo $form->textField($model, 'Add_to_MB', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_MB'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_ND'); ?>
		<?php echo $form->textField($model, 'Add_to_ND', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_ND'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_OT'); ?>
		<?php echo $form->textField($model, 'Add_to_OT', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_OT'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_PTO_With_Tax'); ?>
		<?php echo $form->textField($model, 'Add_to_PTO_With_Tax', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_PTO_With_Tax'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_SSS'); ?>
		<?php echo $form->textField($model, 'Add_to_SSS', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_SSS'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_PHIC'); ?>
		<?php echo $form->textField($model, 'Add_to_PHIC', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_PHIC'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_HDMF'); ?>
		<?php echo $form->textField($model, 'Add_to_HDMF', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_HDMF'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_Taxable_Income'); ?>
		<?php echo $form->textField($model, 'Add_to_Taxable_Income', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_Taxable_Income'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_NonTaxableDeduct'); ?>
		<?php echo $form->textField($model, 'Add_to_NonTaxableDeduct', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_NonTaxableDeduct'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Add_to_Tax_Due'); ?>
		<?php echo $form->textField($model, 'Add_to_Tax_Due', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Add_to_Tax_Due'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Taxable_Adj'); ?>
		<?php echo $form->textField($model, 'Taxable_Adj', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Taxable_Adj'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'NonTaxableAdj'); ?>
		<?php echo $form->textField($model, 'NonTaxableAdj', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'NonTaxableAdj'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Act_Status'); ?>
		<?php echo $form->textField($model, 'Act_Status', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'Act_Status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Rate_with_ND'); ?>
		<?php echo $form->textField($model, 'Rate_with_ND', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Rate_with_ND'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->