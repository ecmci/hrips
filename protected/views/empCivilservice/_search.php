<?php
/* @var $this EmpCivilserviceController */
/* @var $model EmpCivilservice */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmpID'); ?>
		<?php echo $form->textField($model,'EmpID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CareerService'); ?>
		<?php echo $form->textField($model,'CareerService',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Rating'); ?>
		<?php echo $form->textField($model,'Rating',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateExam'); ?>
		<?php echo $form->textField($model,'DateExam'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ExamPlace'); ?>
		<?php echo $form->textField($model,'ExamPlace',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LicenseNumber'); ?>
		<?php echo $form->textField($model,'LicenseNumber',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ReleaseDate'); ?>
		<?php echo $form->textField($model,'ReleaseDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->