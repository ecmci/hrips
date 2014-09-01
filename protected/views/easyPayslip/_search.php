<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmployeeId'); ?>
		<?php echo $form->textField($model,'EmployeeId',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ClientGroup'); ?>
		<?php echo $form->textField($model,'ClientGroup',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MiddleInitial'); ?>
		<?php echo $form->textField($model,'MiddleInitial',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Department'); ?>
		<?php echo $form->textField($model,'Department',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StdRateSalary'); ?>
		<?php echo $form->textField($model,'StdRateSalary'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GP1'); ?>
		<?php echo $form->textField($model,'GP1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FICAWH'); ?>
		<?php echo $form->textField($model,'FICAWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MedicareWH'); ?>
		<?php echo $form->textField($model,'MedicareWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FederalWH'); ?>
		<?php echo $form->textField($model,'FederalWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StateWH'); ?>
		<?php echo $form->textField($model,'StateWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LocalWH'); ?>
		<?php echo $form->textField($model,'LocalWH'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NetPay'); ?>
		<?php echo $form->textField($model,'NetPay'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HoursWorked'); ?>
		<?php echo $form->textField($model,'HoursWorked'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PayPeriod'); ?>
		<?php echo $form->textField($model,'PayPeriod',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Timestamp'); ?>
		<?php echo $form->textField($model,'Timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Emailed'); ?>
		<?php echo $form->textField($model,'Emailed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastErrorMessage'); ?>
		<?php echo $form->textArea($model,'LastErrorMessage',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->