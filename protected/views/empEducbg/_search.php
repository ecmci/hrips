<?php
/* @var $this EmpEducbgController */
/* @var $model EmpEducbg */
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
		<?php echo $form->label($model,'Level'); ?>
		<?php echo $form->textField($model,'Level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NameofSchool'); ?>
		<?php echo $form->textField($model,'NameofSchool',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DegreeCourse'); ?>
		<?php echo $form->textField($model,'DegreeCourse',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'YearGrad'); ?>
		<?php echo $form->textField($model,'YearGrad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HighestEarned'); ?>
		<?php echo $form->textField($model,'HighestEarned',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FromDate'); ?>
		<?php echo $form->textField($model,'FromDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ToDate'); ?>
		<?php echo $form->textField($model,'ToDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ScholarshipReceived'); ?>
		<?php echo $form->textArea($model,'ScholarshipReceived',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->