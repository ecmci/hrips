<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-ot-application-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'dept_id'); ?>
		<?php echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'dept_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->dropDownList($model, 'emp_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName')); ?>
		<?php echo $form->error($model,'emp_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'next_lvl_id'); ?>
		<?php echo $form->dropDownList($model, 'next_lvl_id', GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)), array('empty'=>'')); ?>
		<?php //echo $form->hiddenField($model, 'next_lvl_id',array('value'=>'1')); ?>
		<?php echo $form->error($model,'next_lvl_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'job_code_id'); ?>
		<?php //echo $form->dropDownList($model, 'job_code_id', GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true))); ?>
		<?php //echo $form->error($model,'job_code_id'); ?>
		<?php echo $form->hiddenField($model, 'job_code_id',array('value'=>'2001')); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'in_datetime'); ?>
		<?php echo $form->textField($model, 'in_datetime'); ?>
		<?php echo $form->error($model,'in_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'out_datetime'); ?>
		<?php echo $form->textField($model, 'out_datetime'); ?>
		<?php echo $form->error($model,'out_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model, 'reason'); ?>
		<?php echo $form->error($model,'reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'approved_hours'); ?>
		<?php echo $form->textField($model, 'approved_hours'); ?>
		<?php echo $form->error($model,'approved_hours'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_id'); ?>
		<?php echo $form->dropDownList($model, 'sup_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'sup_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_approve'); ?>
		<?php echo $form->textField($model, 'sup_approve'); ?>
		<?php echo $form->error($model,'sup_approve'); ?>
		</div><!-- row -->

		

    <?php include Yii::getPathOfAlias('webroot').'/js/uploadify/uploadifyWidget.php'; ?>
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->