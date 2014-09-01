<?php
/* @var $this EmpCivilserviceController */
/* @var $model EmpCivilservice */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-civilservice-form',
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
		<?php echo $form->labelEx($model,'CareerService'); ?>
		<?php echo $form->textField($model,'CareerService',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'CareerService'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Rating'); ?>
		<?php echo $form->textField($model,'Rating',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateExam'); ?>
		<?php echo $form->textField($model,'DateExam'); ?>
		<?php echo $form->error($model,'DateExam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ExamPlace'); ?>
		<?php echo $form->textField($model,'ExamPlace',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'ExamPlace'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LicenseNumber'); ?>
		<?php echo $form->textField($model,'LicenseNumber',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'LicenseNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ReleaseDate'); ?>
		<?php echo $form->textField($model,'ReleaseDate'); ?>
		<?php echo $form->error($model,'ReleaseDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->