<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'employee-hrs-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model, 'emp_id'); ?>
		<?php echo $form->error($model,'emp_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'schedule'); ?>
		<?php echo $form->textField($model, 'schedule', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'schedule'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'datetime_in'); ?>
		<?php echo $form->textField($model, 'datetime_in'); ?>
		<?php echo $form->error($model,'datetime_in'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'datetime_out'); ?>
		<?php echo $form->textField($model, 'datetime_out'); ?>
		<?php echo $form->error($model,'datetime_out'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sched_in'); ?>
		<?php echo $form->textField($model, 'sched_in'); ?>
		<?php echo $form->error($model,'sched_in'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sched_out'); ?>
		<?php echo $form->textField($model, 'sched_out'); ?>
		<?php echo $form->error($model,'sched_out'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_code'); ?>
		<?php echo $form->dropDownList($model, 'job_code', GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'job_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'OT_code'); ?>
		<?php echo $form->textField($model, 'OT_code', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'OT_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'breakflag'); ?>
		<?php echo $form->textField($model, 'breakflag'); ?>
		<?php echo $form->error($model,'breakflag'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'UTC_added'); ?>
		<?php echo $form->textField($model, 'UTC_added'); ?>
		<?php echo $form->error($model,'UTC_added'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'process'); ?>
		<?php echo $form->textField($model, 'process'); ?>
		<?php echo $form->error($model,'process'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'raw_mins_late'); ?>
		<?php echo $form->textField($model, 'raw_mins_late'); ?>
		<?php echo $form->error($model,'raw_mins_late'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mins_late'); ?>
		<?php echo $form->textField($model, 'mins_late'); ?>
		<?php echo $form->error($model,'mins_late'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hrs_late'); ?>
		<?php echo $form->textField($model, 'hrs_late', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'hrs_late'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hrs_patch'); ?>
		<?php echo $form->textField($model, 'hrs_patch', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'hrs_patch'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'updated_to_payroll'); ?>
		<?php echo $form->checkBox($model, 'updated_to_payroll'); ?>
		<?php echo $form->error($model,'updated_to_payroll'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Amt'); ?>
		<?php echo $form->textField($model, 'Amt', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'Amt'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->