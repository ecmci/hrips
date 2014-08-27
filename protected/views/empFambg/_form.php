<?php
/* @var $this EmpFambgController */
/* @var $model EmpFambg */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-fambg-form',
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
		<?php echo $form->labelEx($model,'SpouseLname'); ?>
		<?php echo $form->textField($model,'SpouseLname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SpouseLname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpouseFname'); ?>
		<?php echo $form->textField($model,'SpouseFname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SpouseFname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpouseMname'); ?>
		<?php echo $form->textField($model,'SpouseMname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'SpouseMname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpouseOccupation'); ?>
		<?php echo $form->textField($model,'SpouseOccupation',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'SpouseOccupation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpouseEmployer'); ?>
		<?php echo $form->textField($model,'SpouseEmployer',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'SpouseEmployer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpouseBusinessAddress'); ?>
		<?php echo $form->textField($model,'SpouseBusinessAddress',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'SpouseBusinessAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SpouseTelno'); ?>
		<?php echo $form->textField($model,'SpouseTelno',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'SpouseTelno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FatherLname'); ?>
		<?php echo $form->textField($model,'FatherLname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'FatherLname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FatherFname'); ?>
		<?php echo $form->textField($model,'FatherFname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'FatherFname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FatherMname'); ?>
		<?php echo $form->textField($model,'FatherMname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'FatherMname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MotherMaiden'); ?>
		<?php echo $form->textField($model,'MotherMaiden',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'MotherMaiden'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MotherLname'); ?>
		<?php echo $form->textField($model,'MotherLname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'MotherLname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MotherFname'); ?>
		<?php echo $form->textField($model,'MotherFname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'MotherFname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MotherMname'); ?>
		<?php echo $form->textField($model,'MotherMname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'MotherMname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Children'); ?>
		<?php echo $form->textField($model,'Children'); ?>
		<?php echo $form->error($model,'Children'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->