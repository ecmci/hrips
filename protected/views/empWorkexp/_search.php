<?php
/* @var $this EmpWorkexpController */
/* @var $model EmpWorkexp */
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
		<?php echo $form->label($model,'FromDate'); ?>
		<?php echo $form->textField($model,'FromDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ToDate'); ?>
		<?php echo $form->textField($model,'ToDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PositionTitle'); ?>
		<?php echo $form->textField($model,'PositionTitle',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Company'); ?>
		<?php echo $form->textField($model,'Company',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MonthlySalary'); ?>
		<?php echo $form->textField($model,'MonthlySalary',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SalaryGrade'); ?>
		<?php echo $form->textField($model,'SalaryGrade',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StatAppointment'); ?>
		<?php echo $form->textField($model,'StatAppointment',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GovtService'); ?>
		<?php echo $form->textField($model,'GovtService'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->