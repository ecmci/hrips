<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ot-application-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'dept_id'); ?>
		<?php echo $form->textField($model,'dept_id'); ?>
		<?php echo $form->error($model,'dept_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id'); ?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'next_lvl_id'); ?>
		<?php echo $form->textField($model,'next_lvl_id'); ?>
		<?php echo $form->error($model,'next_lvl_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_code_id'); ?>
		<?php echo $form->textField($model,'job_code_id'); ?>
		<?php echo $form->error($model,'job_code_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_code_id'); ?>
		<?php echo $form->textField($model,'sub_code_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'sub_code_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'in_datetime'); ?>
		<?php echo $form->textField($model,'in_datetime'); ?>
		<?php echo $form->error($model,'in_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'out_datetime'); ?>
		<?php echo $form->textField($model,'out_datetime'); ?>
		<?php echo $form->error($model,'out_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model,'reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ifexistid'); ?>
		<?php echo $form->textField($model,'ifexistid'); ?>
		<?php echo $form->error($model,'ifexistid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approved_hours'); ?>
		<?php echo $form->textField($model,'approved_hours',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'approved_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_id'); ?>
		<?php echo $form->textField($model,'sup_id'); ?>
		<?php echo $form->error($model,'sup_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_approve'); ?>
		<?php echo $form->textField($model,'sup_approve'); ?>
		<?php echo $form->error($model,'sup_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_approve_datetime'); ?>
		<?php echo $form->textField($model,'sup_approve_datetime'); ?>
		<?php echo $form->error($model,'sup_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'sup_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sup_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mgr_id'); ?>
		<?php echo $form->textField($model,'mgr_id'); ?>
		<?php echo $form->error($model,'mgr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mgr_approve'); ?>
		<?php echo $form->textField($model,'mgr_approve'); ?>
		<?php echo $form->error($model,'mgr_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mgr_approve_datetime'); ?>
		<?php echo $form->textField($model,'mgr_approve_datetime'); ?>
		<?php echo $form->error($model,'mgr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mgr_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'mgr_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mgr_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hr_id'); ?>
		<?php echo $form->textField($model,'hr_id'); ?>
		<?php echo $form->error($model,'hr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hr_approve'); ?>
		<?php echo $form->textField($model,'hr_approve'); ?>
		<?php echo $form->error($model,'hr_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hr_approve_datetime'); ?>
		<?php echo $form->textField($model,'hr_approve_datetime'); ?>
		<?php echo $form->error($model,'hr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hr_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'hr_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'hr_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employer_id'); ?>
		<?php echo $form->textField($model,'employer_id'); ?>
		<?php echo $form->error($model,'employer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employer_approve'); ?>
		<?php echo $form->textField($model,'employer_approve'); ?>
		<?php echo $form->error($model,'employer_approve'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employer_approve_datetime'); ?>
		<?php echo $form->textField($model,'employer_approve_datetime'); ?>
		<?php echo $form->error($model,'employer_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employer_disapprove_reason'); ?>
		<?php echo $form->textArea($model,'employer_disapprove_reason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'employer_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'replicated_to_emp_hrs'); ?>
		<?php echo $form->textField($model,'replicated_to_emp_hrs'); ?>
		<?php echo $form->error($model,'replicated_to_emp_hrs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_entered'); ?>
		<?php echo $form->textField($model,'is_entered'); ?>
		<?php echo $form->error($model,'is_entered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->