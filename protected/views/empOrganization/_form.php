<?php
/* @var $this EmpOrganizationController */
/* @var $model EmpOrganization */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-organization-form',
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
		<?php echo $form->labelEx($model,'NameAddressOrg'); ?>
		<?php echo $form->textField($model,'NameAddressOrg',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'NameAddressOrg'); ?>
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
		<?php echo $form->labelEx($model,'PositionNatureOfWork'); ?>
		<?php echo $form->textField($model,'PositionNatureOfWork',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'PositionNatureOfWork'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->