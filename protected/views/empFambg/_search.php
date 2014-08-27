<?php
/* @var $this EmpFambgController */
/* @var $model EmpFambg */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'EmpID'); ?>
		<?php echo $form->textField($model,'EmpID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseLname'); ?>
		<?php echo $form->textField($model,'SpouseLname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseFname'); ?>
		<?php echo $form->textField($model,'SpouseFname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseMname'); ?>
		<?php echo $form->textField($model,'SpouseMname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseOccupation'); ?>
		<?php echo $form->textField($model,'SpouseOccupation',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseEmployer'); ?>
		<?php echo $form->textField($model,'SpouseEmployer',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseBusinessAddress'); ?>
		<?php echo $form->textField($model,'SpouseBusinessAddress',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SpouseTelno'); ?>
		<?php echo $form->textField($model,'SpouseTelno',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FatherLname'); ?>
		<?php echo $form->textField($model,'FatherLname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FatherFname'); ?>
		<?php echo $form->textField($model,'FatherFname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FatherMname'); ?>
		<?php echo $form->textField($model,'FatherMname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MotherMaiden'); ?>
		<?php echo $form->textField($model,'MotherMaiden',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MotherLname'); ?>
		<?php echo $form->textField($model,'MotherLname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MotherFname'); ?>
		<?php echo $form->textField($model,'MotherFname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MotherMname'); ?>
		<?php echo $form->textField($model,'MotherMname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Children'); ?>
		<?php echo $form->textField($model,'Children'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->