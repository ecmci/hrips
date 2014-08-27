<?php
/* @var $this EmpTrainingController */
/* @var $model EmpTraining */
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
		<?php echo $form->label($model,'SeminarTitle'); ?>
		<?php echo $form->textField($model,'SeminarTitle',array('size'=>60,'maxlength'=>150)); ?>
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
		<?php echo $form->label($model,'NoOfHrs'); ?>
		<?php echo $form->textField($model,'NoOfHrs',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ConductedBy'); ?>
		<?php echo $form->textField($model,'ConductedBy',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->