<?php
/* @var $this EmpWorkexpController */
/* @var $model EmpWorkexp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-workexp-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'EmpID'); ?>
		<?php echo $form->textField($model,'EmpID'); ?>
		<?php echo $form->error($model,'EmpID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FromDate'); ?>
		<?php echo $form->textField($model,'FromDate'); ?>
		<?php echo $form->error($model,'FromDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ToDate'); ?>
		<?php echo $form->textField($model,'ToDate'); ?>
		<?php echo $form->error($model,'ToDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PositionTitle'); ?>
		<?php echo $form->textField($model,'PositionTitle',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'PositionTitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Company'); ?>
		<?php echo $form->textField($model,'Company',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MonthlySalary'); ?>
		<?php echo $form->textField($model,'MonthlySalary',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'MonthlySalary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SalaryGrade'); ?>
		<?php echo $form->textField($model,'SalaryGrade',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'SalaryGrade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StatAppointment'); ?>
		<?php echo $form->textField($model,'StatAppointment',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'StatAppointment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GovtService'); ?>
		<?php echo $form->textField($model,'GovtService'); ?>
		<?php echo $form->error($model,'GovtService'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->