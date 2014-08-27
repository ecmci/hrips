<?php
/* @var $this EmpEducbgController */
/* @var $model EmpEducbg */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-educbg-form',
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
		<?php echo $form->labelEx($model,'Level'); ?>
		<?php echo $form->textField($model,'Level'); ?>
		<?php echo $form->error($model,'Level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NameofSchool'); ?>
		<?php echo $form->textField($model,'NameofSchool',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'NameofSchool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DegreeCourse'); ?>
		<?php echo $form->textField($model,'DegreeCourse',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DegreeCourse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YearGrad'); ?>
		<?php echo $form->textField($model,'YearGrad'); ?>
		<?php echo $form->error($model,'YearGrad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HighestEarned'); ?>
		<?php echo $form->textField($model,'HighestEarned',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'HighestEarned'); ?>
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
		<?php echo $form->labelEx($model,'ScholarshipReceived'); ?>
		<?php echo $form->textArea($model,'ScholarshipReceived',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ScholarshipReceived'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->