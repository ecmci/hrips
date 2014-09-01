<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id', array('maxlength' => 64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'emp_id'); ?>
		<?php echo $form->textField($model, 'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'schedule'); ?>
		<?php echo $form->textField($model, 'schedule', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'datetime_in'); ?>
		<?php echo $form->textField($model, 'datetime_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'datetime_out'); ?>
		<?php echo $form->textField($model, 'datetime_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sched_in'); ?>
		<?php echo $form->textField($model, 'sched_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sched_out'); ?>
		<?php echo $form->textField($model, 'sched_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'job_code'); ?>
		<?php echo $form->dropDownList($model, 'job_code', GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'OT_code'); ?>
		<?php echo $form->textField($model, 'OT_code', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'breakflag'); ?>
		<?php echo $form->textField($model, 'breakflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'UTC_added'); ?>
		<?php echo $form->textField($model, 'UTC_added'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'process'); ?>
		<?php echo $form->textField($model, 'process'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'raw_mins_late'); ?>
		<?php echo $form->textField($model, 'raw_mins_late'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'mins_late'); ?>
		<?php echo $form->textField($model, 'mins_late'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hrs_late'); ?>
		<?php echo $form->textField($model, 'hrs_late', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hrs_patch'); ?>
		<?php echo $form->textField($model, 'hrs_patch', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'updated_to_payroll'); ?>
		<?php echo $form->dropDownList($model, 'updated_to_payroll', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'Amt'); ?>
		<?php echo $form->textField($model, 'Amt', array('maxlength' => 20)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
