<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */
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
		<?php echo $form->label($model,'dept_id'); ?>
		<?php echo $form->textField($model,'dept_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'next_lvl_id'); ?>
		<?php echo $form->textField($model,'next_lvl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_code_id'); ?>
		<?php echo $form->textField($model,'job_code_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sub_code_id'); ?>
		<?php echo $form->textField($model,'sub_code_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'in_datetime'); ?>
		<?php echo $form->textField($model,'in_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'out_datetime'); ?>
		<?php echo $form->textField($model,'out_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reason'); ?>
		<?php echo $form->textArea($model,'reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ifexistid'); ?>
		<?php echo $form->textField($model,'ifexistid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approved_hours'); ?>
		<?php echo $form->textField($model,'approved_hours',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sup_id'); ?>
		<?php echo $form->textField($model,'sup_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sup_approve'); ?>
		<?php echo $form->textField($model,'sup_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sup_approve_datetime'); ?>
		<?php echo $form->textField($model,'sup_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sup_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'sup_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mgr_id'); ?>
		<?php echo $form->textField($model,'mgr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mgr_approve'); ?>
		<?php echo $form->textField($model,'mgr_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mgr_approve_datetime'); ?>
		<?php echo $form->textField($model,'mgr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mgr_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'mgr_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hr_id'); ?>
		<?php echo $form->textField($model,'hr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hr_approve'); ?>
		<?php echo $form->textField($model,'hr_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hr_approve_datetime'); ?>
		<?php echo $form->textField($model,'hr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hr_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'hr_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employer_id'); ?>
		<?php echo $form->textField($model,'employer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employer_approve'); ?>
		<?php echo $form->textField($model,'employer_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employer_approve_datetime'); ?>
		<?php echo $form->textField($model,'employer_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employer_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'employer_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'replicated_to_emp_hrs'); ?>
		<?php echo $form->textField($model,'replicated_to_emp_hrs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_entered'); ?>
		<?php echo $form->textField($model,'is_entered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->