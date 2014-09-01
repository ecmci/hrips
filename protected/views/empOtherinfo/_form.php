<?php
/* @var $this EmpOtherinfoController */
/* @var $model EmpOtherinfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-otherinfo-form',
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
		<?php echo $form->labelEx($model,'SkillsHobbies'); ?>
		<?php echo $form->textArea($model,'SkillsHobbies',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'SkillsHobbies'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NonAcadRecognition'); ?>
		<?php echo $form->textArea($model,'NonAcadRecognition',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'NonAcadRecognition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MembershipAssocOrg'); ?>
		<?php echo $form->textArea($model,'MembershipAssocOrg',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'MembershipAssocOrg'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->