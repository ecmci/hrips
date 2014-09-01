<?php
/* @var $this EmpRefController */
/* @var $model EmpRef */
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
		<?php echo $form->label($model,'RefName'); ?>
		<?php echo $form->textField($model,'RefName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RefAdd'); ?>
		<?php echo $form->textField($model,'RefAdd',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Telno'); ?>
		<?php echo $form->textField($model,'Telno',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->