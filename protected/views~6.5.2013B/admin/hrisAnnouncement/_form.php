<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-announcement-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php //echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->dropDownList($model, 'emp_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php //echo $form->error($model,'emp_id'); ?>
    <?php echo $form->hiddenField($model,'emp_id',array('value'=>Yii::app()->user->getState('emp_id')));  ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model, 'message'); ?>
		<?php echo $form->error($model,'message'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'timestamp'); ?>
		<?php //echo $form->textField($model, 'timestamp'); ?>
		<?php //echo $form->error($model,'timestamp'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->