<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'employee-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'Lname'); ?>
		<?php echo $form->textField($model, 'Lname', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Lname'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Fname'); ?>
		<?php echo $form->textField($model, 'Fname', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Fname'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Mname'); ?>
		<?php echo $form->textField($model, 'Mname', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Mname'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Fullname'); ?>
		<?php echo $form->textField($model, 'Fullname', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'Fullname'); ?>
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
		<?php echo $form->labelEx($model,'Tax_Status'); ?>
		<?php echo $form->textField($model, 'Tax_Status', array('maxlength' => 60)); ?>
		<?php echo $form->error($model,'Tax_Status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Birthday'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'Birthday',
			'value' => $model->Birthday,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'Birthday'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Birthplace'); ?>
		<?php echo $form->textField($model, 'Birthplace', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Birthplace'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Gender'); ?>
		<?php echo $form->textField($model, 'Gender', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'Gender'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Contact_No'); ?>
		<?php echo $form->textField($model, 'Contact_No', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'Contact_No'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Height'); ?>
		<?php echo $form->textField($model, 'Height'); ?>
		<?php echo $form->error($model,'Height'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Weight'); ?>
		<?php echo $form->textField($model, 'Weight'); ?>
		<?php echo $form->error($model,'Weight'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Blood_Type'); ?>
		<?php echo $form->textField($model, 'Blood_Type', array('maxlength' => 5)); ?>
		<?php echo $form->error($model,'Blood_Type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Citizenship'); ?>
		<?php echo $form->textField($model, 'Citizenship', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Citizenship'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Civil_Status'); ?>
		<?php echo $form->textField($model, 'Civil_Status', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Civil_Status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Spouse'); ?>
		<?php echo $form->textField($model, 'Spouse', array('maxlength' => 60)); ?>
		<?php echo $form->error($model,'Spouse'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Children'); ?>
		<?php echo $form->textField($model, 'Children'); ?>
		<?php echo $form->error($model,'Children'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Email_Add'); ?>
		<?php echo $form->textField($model, 'Email_Add', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'Email_Add'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Account_Number'); ?>
		<?php echo $form->textField($model, 'Account_Number', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'Account_Number'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'SSS'); ?>
		<?php echo $form->textField($model, 'SSS', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'SSS'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'TIN'); ?>
		<?php echo $form->textField($model, 'TIN', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'TIN'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'PHIL_HEALTH'); ?>
		<?php echo $form->textField($model, 'PHIL_HEALTH', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'PHIL_HEALTH'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'PAG_IBIG'); ?>
		<?php echo $form->textField($model, 'PAG_IBIG', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'PAG_IBIG'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Permanent_Add'); ?>
		<?php echo $form->textArea($model, 'Permanent_Add'); ?>
		<?php echo $form->error($model,'Permanent_Add'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Residential_Add'); ?>
		<?php echo $form->textArea($model, 'Residential_Add'); ?>
		<?php echo $form->error($model,'Residential_Add'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Monthly_Basic'); ?>
		<?php echo $form->textField($model, 'Monthly_Basic', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Monthly_Basic'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Semi_Monthly'); ?>
		<?php echo $form->textField($model, 'Total_Semi_Monthly', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Semi_Monthly'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Starting_Salary'); ?>
		<?php echo $form->textField($model, 'Starting_Salary', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Starting_Salary'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Days_Work'); ?>
		<?php echo $form->textField($model, 'Days_Work', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Days_Work'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Monthly_Night_Diff'); ?>
		<?php echo $form->textField($model, 'Monthly_Night_Diff', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Monthly_Night_Diff'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Date_Hired'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'Date_Hired',
			'value' => $model->Date_Hired,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'Date_Hired'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Date_Regularized'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'Date_Regularized',
			'value' => $model->Date_Regularized,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'Date_Regularized'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Total_Days_Work'); ?>
		<?php echo $form->textField($model, 'Total_Days_Work', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Total_Days_Work'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'NDHrsperWk'); ?>
		<?php echo $form->textField($model, 'NDHrsperWk', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'NDHrsperWk'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'NDHrsCutOff'); ?>
		<?php echo $form->textField($model, 'NDHrsCutOff', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'NDHrsCutOff'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Date_Terminated'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'Date_Terminated',
			'value' => $model->Date_Terminated,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'Date_Terminated'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Act_Status'); ?>
		<?php echo $form->textField($model, 'Act_Status', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'Act_Status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'YearEnder'); ?>
		<?php echo $form->textField($model, 'YearEnder', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'YearEnder'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->