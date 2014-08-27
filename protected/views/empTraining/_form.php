<?php
/* @var $this EmpTrainingController */
/* @var $model EmpTraining */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-training-form',
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
		<?php echo $form->labelEx($model,'SeminarTitle'); ?>
		<?php echo $form->textField($model,'SeminarTitle',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'SeminarTitle'); ?>
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
		<?php echo $form->labelEx($model,'NoOfHrs'); ?>
		<?php echo $form->textField($model,'NoOfHrs',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NoOfHrs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ConductedBy'); ?>
		<?php echo $form->textField($model,'ConductedBy',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ConductedBy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->