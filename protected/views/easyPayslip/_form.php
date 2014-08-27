<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'easy-payslip-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'EmployeeId'); ?>
		<?php echo $form->textField($model,'EmployeeId',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'EmployeeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ClientGroup'); ?>
		<?php echo $form->textField($model,'ClientGroup',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'ClientGroup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'LastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'FirstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MiddleInitial'); ?>
		<?php echo $form->textField($model,'MiddleInitial',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'MiddleInitial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Department'); ?>
		<?php echo $form->textField($model,'Department',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'Department'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StdRateSalary'); ?>
		<?php echo $form->textField($model,'StdRateSalary'); ?>
		<?php echo $form->error($model,'StdRateSalary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GP1'); ?>
		<?php echo $form->textField($model,'GP1'); ?>
		<?php echo $form->error($model,'GP1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FICAWH'); ?>
		<?php echo $form->textField($model,'FICAWH'); ?>
		<?php echo $form->error($model,'FICAWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MedicareWH'); ?>
		<?php echo $form->textField($model,'MedicareWH'); ?>
		<?php echo $form->error($model,'MedicareWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FederalWH'); ?>
		<?php echo $form->textField($model,'FederalWH'); ?>
		<?php echo $form->error($model,'FederalWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StateWH'); ?>
		<?php echo $form->textField($model,'StateWH'); ?>
		<?php echo $form->error($model,'StateWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LocalWH'); ?>
		<?php echo $form->textField($model,'LocalWH'); ?>
		<?php echo $form->error($model,'LocalWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NetPay'); ?>
		<?php echo $form->textField($model,'NetPay'); ?>
		<?php echo $form->error($model,'NetPay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HoursWorked'); ?>
		<?php echo $form->textField($model,'HoursWorked'); ?>
		<?php echo $form->error($model,'HoursWorked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PayPeriod'); ?>
		<?php echo $form->textField($model,'PayPeriod',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'PayPeriod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Timestamp'); ?>
		<?php echo $form->textField($model,'Timestamp'); ?>
		<?php echo $form->error($model,'Timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Emailed'); ?>
		<?php echo $form->textField($model,'Emailed'); ?>
		<?php echo $form->error($model,'Emailed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastErrorMessage'); ?>
		<?php echo $form->textArea($model,'LastErrorMessage',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'LastErrorMessage'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->