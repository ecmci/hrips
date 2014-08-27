<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-ot-application-form',
	'enableAjaxValidation' => true,
));
?>
	<?php
    $flashMessages = Yii::app()->user->getFlashes();
    if ($flashMessages) {        
        foreach($flashMessages as $key => $message) {
            echo '<div class="alert alert-warning '.$key.'">';
            echo '<button class="close" data-dismiss="alert" type="button">x</button>';
            echo $message;
            echo '</div>';
        }
        
    }
    ?>
	
	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php //echo $form->labelEx($model,'dept_id'); ?>
		<?php //echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)),array('disabled'=>'disabled')); ?>
		<?php //echo $form->error($model,'dept_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->dropDownList($model, 'emp_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),array('disabled'=>'disabled')); ?>
		<?php //echo $form->error($model,'emp_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'next_lvl_id'); ?>
		<?php ///echo $form->dropDownList($model, 'next_lvl_id', GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)),array('disabled'=>'disabled')); ?>
		<?php //echo $form->error($model,'next_lvl_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'job_code_id'); ?>
		<?php //echo $form->dropDownList($model, 'job_code_id', GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true)),array('disabled'=>'disabled')); ?>
		<?php //echo $form->error($model,'job_code_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sub_code_id'); ?>
		<?php echo $form->dropDownList($model, 'sub_code_id', GxHtml::listDataEx(OtSubCode::model()->findAllAttributes(null, true)),array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'sub_code_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'in_datetime'); ?>
		<?php echo $form->textField($model, 'in_datetime',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'in_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'out_datetime'); ?>
		<?php echo $form->textField($model, 'out_datetime',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'out_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model, 'reason',array('required'=>'required')); ?>
		<?php echo $form->error($model,'reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'approved_hours'); ?>
		<?php echo $form->textField($model, 'approved_hours',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'approved_hours'); ?>
		</div><!-- row -->
		<?php /*
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
		<?php echo $form->dropDownList($model, 'mgr_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
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
		<?php echo $form->textField($model, 'hr_approve'); ?>
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
		<?php echo $form->labelEx($model,'employer_id'); ?>
		<?php echo $form->dropDownList($model, 'employer_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'employer_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'employer_approve'); ?>
		<?php echo $form->textField($model, 'employer_approve'); ?>
		<?php echo $form->error($model,'employer_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'employer_approve_datetime'); ?>
		<?php echo $form->textField($model, 'employer_approve_datetime'); ?>
		<?php echo $form->error($model,'employer_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'employer_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'employer_disapprove_reason'); ?>
		<?php echo $form->error($model,'employer_disapprove_reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model, 'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('hrisOtAttachments')); ?></label>
		<?php echo $form->checkBoxList($model, 'hrisOtAttachments', GxHtml::encodeEx(GxHtml::listDataEx(HrisOtAttachments::model()->findAllAttributes(null, true)), false, true)); ?>
    */ ?>
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->