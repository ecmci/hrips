<?php
/* @var $this EmpRefController */
/* @var $model EmpRef */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-ref-form',
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
		<?php echo $form->labelEx($model,'RefName'); ?>
		<?php echo $form->textField($model,'RefName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'RefName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RefAdd'); ?>
		<?php echo $form->textField($model,'RefAdd',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'RefAdd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Telno'); ?>
		<?php echo $form->textField($model,'Telno',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'Telno'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->