<?php
/* @var $this EmpQueriesController */
/* @var $model EmpQueries */
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
		<?php echo $form->label($model,'ThirdDegreeRelated'); ?>
		<?php echo $form->textField($model,'ThirdDegreeRelated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TDRdetails'); ?>
		<?php echo $form->textArea($model,'TDRdetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FourthDegreeRelated'); ?>
		<?php echo $form->textField($model,'FourthDegreeRelated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FDRdetails'); ?>
		<?php echo $form->textArea($model,'FDRdetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FormallyCharged'); ?>
		<?php echo $form->textField($model,'FormallyCharged'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ChargedDetails'); ?>
		<?php echo $form->textArea($model,'ChargedDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AdminOffense'); ?>
		<?php echo $form->textField($model,'AdminOffense'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OffenseDetails'); ?>
		<?php echo $form->textArea($model,'OffenseDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CrimeConvicted'); ?>
		<?php echo $form->textField($model,'CrimeConvicted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CrimeDetails'); ?>
		<?php echo $form->textArea($model,'CrimeDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SeparatedService'); ?>
		<?php echo $form->textField($model,'SeparatedService'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SSdetails'); ?>
		<?php echo $form->textArea($model,'SSdetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ElectionCandidate'); ?>
		<?php echo $form->textField($model,'ElectionCandidate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ECdetails'); ?>
		<?php echo $form->textArea($model,'ECdetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Indigenous'); ?>
		<?php echo $form->textField($model,'Indigenous'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IndiDetails'); ?>
		<?php echo $form->textArea($model,'IndiDetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DiffAbled'); ?>
		<?php echo $form->textField($model,'DiffAbled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DAdetails'); ?>
		<?php echo $form->textArea($model,'DAdetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SoloParent'); ?>
		<?php echo $form->textField($model,'SoloParent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SPdetails'); ?>
		<?php echo $form->textArea($model,'SPdetails',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->