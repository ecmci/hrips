<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-loa-application-report-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'next_lvl_id'); ?>
		<?php echo $form->dropDownList($model, 'next_lvl_id', CHtml::listData(HrisAccessLvl::model()->findAll(),'id','status')); ?>
		<?php echo $form->error($model,'next_lvl_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->dropDownList($model, 'emp_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName')); ?>
		<?php echo $form->error($model,'emp_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dept_id'); ?>
		<?php echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'dept_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_code_id'); ?>
		<?php echo $form->dropDownList($model, 'job_code_id', GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'job_code_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'from_datetime'); ?>
		<?php echo $form->textField($model, 'from_datetime'); ?>
		<?php echo $form->error($model,'from_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'to_datetime'); ?>
		<?php echo $form->textField($model, 'to_datetime'); ?>
		<?php echo $form->error($model,'to_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hours_requested'); ?>
		<?php echo $form->textField($model, 'hours_requested', array('maxlength' => 5)); ?>
		<?php echo $form->error($model,'hours_requested'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hours_approved'); ?>
		<?php echo $form->textField($model, 'hours_approved', array('maxlength' => 5)); ?>
		<?php echo $form->error($model,'hours_approved'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model, 'reason'); ?>
		<?php echo $form->error($model,'reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model, 'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
		</div><!-- row -->
		<?php /*
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_id'); ?>
		<?php echo $form->dropDownList($model, 'reliever_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'reliever_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_approve'); ?>
		<?php echo $form->checkBox($model, 'reliever_approve'); ?>
		<?php echo $form->error($model,'reliever_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_approve_datetime'); ?>
		<?php echo $form->textField($model, 'reliever_approve_datetime'); ?>
		<?php echo $form->error($model,'reliever_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_id'); ?>
		<?php echo $form->dropDownList($model, 'sup_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'sup_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_approve'); ?>
		<?php echo $form->checkBox($model, 'sup_approve'); ?>
		<?php echo $form->error($model,'sup_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_approve_datetime'); ?>
		<?php echo $form->textField($model, 'sup_approve_datetime'); ?>
		<?php echo $form->error($model,'sup_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'sup_disapprove_reason'); ?>
		<?php echo $form->error($model,'sup_disapprove_reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mgr_id'); ?>
		<?php echo $form->textField($model, 'mgr_id'); ?>
		<?php echo $form->error($model,'mgr_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mgr_approve'); ?>
		<?php echo $form->checkBox($model, 'mgr_approve'); ?>
		<?php echo $form->error($model,'mgr_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mgr_approve_datetime'); ?>
		<?php echo $form->textField($model, 'mgr_approve_datetime'); ?>
		<?php echo $form->error($model,'mgr_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mgr_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'mgr_disapprove_reason'); ?>
		<?php echo $form->error($model,'mgr_disapprove_reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_id'); ?>
		<?php echo $form->dropDownList($model, 'hr_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'hr_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_approve'); ?>
		<?php echo $form->checkBox($model, 'hr_approve'); ?>
		<?php echo $form->error($model,'hr_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_approve_datetime'); ?>
		<?php echo $form->textField($model, 'hr_approve_datetime'); ?>
		<?php echo $form->error($model,'hr_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'hr_disapprove_reason'); ?>
		<?php echo $form->error($model,'hr_disapprove_reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'replicated_to_emp_hrs'); ?>
		<?php echo $form->checkBox($model, 'replicated_to_emp_hrs'); ?>
		<?php echo $form->error($model,'replicated_to_emp_hrs'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model, 'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
		</div><!-- row -->
		*/ ?>
		<label><?php //echo GxHtml::encode($model->getRelationLabel('hrisLoaAttachments')); ?></label>
		<?php //echo $form->checkBoxList($model, 'hrisLoaAttachments', GxHtml::encodeEx(GxHtml::listDataEx(HrisLoaAttachments::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->