<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'Emp_ID'); ?>
		<?php echo $form->textField($model, 'Emp_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Lname'); ?>
		<?php echo $form->textField($model, 'Lname', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Fname'); ?>
		<?php echo $form->textField($model, 'Fname', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Mname'); ?>
		<?php echo $form->textField($model, 'Mname', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Fullname'); ?>
		<?php echo $form->textField($model, 'Fullname', array('maxlength' => 100)); ?>
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
		<?php echo $form->label($model, 'Tax_Status'); ?>
		<?php echo $form->textField($model, 'Tax_Status', array('maxlength' => 60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Birthday'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Birthplace'); ?>
		<?php echo $form->textField($model, 'Birthplace', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Gender'); ?>
		<?php echo $form->textField($model, 'Gender', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Contact_No'); ?>
		<?php echo $form->textField($model, 'Contact_No', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Height'); ?>
		<?php echo $form->textField($model, 'Height'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Weight'); ?>
		<?php echo $form->textField($model, 'Weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Blood_Type'); ?>
		<?php echo $form->textField($model, 'Blood_Type', array('maxlength' => 5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Citizenship'); ?>
		<?php echo $form->textField($model, 'Citizenship', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Civil_Status'); ?>
		<?php echo $form->textField($model, 'Civil_Status', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Spouse'); ?>
		<?php echo $form->textField($model, 'Spouse', array('maxlength' => 60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Children'); ?>
		<?php echo $form->textField($model, 'Children'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Email_Add'); ?>
		<?php echo $form->textField($model, 'Email_Add', array('maxlength' => 30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Account_Number'); ?>
		<?php echo $form->textField($model, 'Account_Number', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'SSS'); ?>
		<?php echo $form->textField($model, 'SSS', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'TIN'); ?>
		<?php echo $form->textField($model, 'TIN', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'PHIL_HEALTH'); ?>
		<?php echo $form->textField($model, 'PHIL_HEALTH', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'PAG_IBIG'); ?>
		<?php echo $form->textField($model, 'PAG_IBIG', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Permanent_Add'); ?>
		<?php echo $form->textArea($model, 'Permanent_Add'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Residential_Add'); ?>
		<?php echo $form->textArea($model, 'Residential_Add'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Monthly_Basic'); ?>
		<?php echo $form->textField($model, 'Monthly_Basic', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Semi_Monthly'); ?>
		<?php echo $form->textField($model, 'Total_Semi_Monthly', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Starting_Salary'); ?>
		<?php echo $form->textField($model, 'Starting_Salary', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Days_Work'); ?>
		<?php echo $form->textField($model, 'Days_Work', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Monthly_Night_Diff'); ?>
		<?php echo $form->textField($model, 'Monthly_Night_Diff', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Date_Hired'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Date_Regularized'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Total_Days_Work'); ?>
		<?php echo $form->textField($model, 'Total_Days_Work', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'NDHrsperWk'); ?>
		<?php echo $form->textField($model, 'NDHrsperWk', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'NDHrsCutOff'); ?>
		<?php echo $form->textField($model, 'NDHrsCutOff', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Date_Terminated'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Act_Status'); ?>
		<?php echo $form->textField($model, 'Act_Status', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'YearEnder'); ?>
		<?php echo $form->textField($model, 'YearEnder', array('maxlength' => 20)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
