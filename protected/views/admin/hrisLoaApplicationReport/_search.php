<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'next_lvl_id'); ?>
		<?php echo $form->dropDownList($model, 'next_lvl_id', CHtml::listData(HrisAccessLvl::model()->findAll(),'id','status'), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'emp_id'); ?>
		<?php echo $form->dropDownList($model, 'emp_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName'), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dept_id'); ?>
		<?php echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'job_code_id'); ?>
		<?php echo $form->dropDownList($model, 'job_code_id', GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'from_datetime'); ?>
		<?php echo $form->textField($model, 'from_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to_datetime'); ?>
		<?php echo $form->textField($model, 'to_datetime'); ?>
	</div>
	<?php /*
	<div class="row">
		<?php echo $form->label($model, 'hours_requested'); ?>
		<?php echo $form->textField($model, 'hours_requested', array('maxlength' => 5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hours_approved'); ?>
		<?php echo $form->textField($model, 'hours_approved', array('maxlength' => 5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reason'); ?>
		<?php echo $form->textArea($model, 'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'remarks'); ?>
		<?php echo $form->textArea($model, 'remarks'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reliever_id'); ?>
		<?php echo $form->dropDownList($model, 'reliever_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reliever_approve'); ?>
		<?php echo $form->dropDownList($model, 'reliever_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reliever_approve_datetime'); ?>
		<?php echo $form->textField($model, 'reliever_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sup_id'); ?>
		<?php echo $form->dropDownList($model, 'sup_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sup_approve'); ?>
		<?php echo $form->dropDownList($model, 'sup_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sup_approve_datetime'); ?>
		<?php echo $form->textField($model, 'sup_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sup_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'sup_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'mgr_id'); ?>
		<?php echo $form->textField($model, 'mgr_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'mgr_approve'); ?>
		<?php echo $form->dropDownList($model, 'mgr_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'mgr_approve_datetime'); ?>
		<?php echo $form->textField($model, 'mgr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'mgr_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'mgr_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hr_id'); ?>
		<?php echo $form->dropDownList($model, 'hr_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hr_approve'); ?>
		<?php echo $form->dropDownList($model, 'hr_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hr_approve_datetime'); ?>
		<?php echo $form->textField($model, 'hr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hr_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'hr_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'replicated_to_emp_hrs'); ?>
		<?php echo $form->dropDownList($model, 'replicated_to_emp_hrs', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'timestamp'); ?>
		<?php echo $form->textField($model, 'timestamp'); ?>
	</div>
	*/ ?>
	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
