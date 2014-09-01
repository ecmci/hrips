<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-email-queue-for-forms-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'template_id'); ?>
		<?php echo $form->dropDownList($model, 'template_id', GxHtml::listDataEx(HrisEmailTemplate::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'template_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'to_group'); ?>
		<?php echo $form->checkBox($model, 'to_group'); ?>
		<?php echo $form->error($model,'to_group'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'to_user'); ?>
		<?php echo $form->checkBox($model, 'to_user'); ?>
		<?php echo $form->error($model,'to_user'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'to'); ?>
		<?php echo $form->textField($model, 'to', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'to'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model, 'subject', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'subject'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model, 'content'); ?>
		<?php echo $form->error($model,'content'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'model_name'); ?>
		<?php echo $form->textField($model, 'model_name', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'model_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'model_id'); ?>
		<?php echo $form->textField($model, 'model_id'); ?>
		<?php echo $form->error($model,'model_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sent'); ?>
		<?php echo $form->checkBox($model, 'sent'); ?>
		<?php echo $form->error($model,'sent'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sent_timestamp'); ?>
		<?php echo $form->textField($model, 'sent_timestamp'); ?>
		<?php echo $form->error($model,'sent_timestamp'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model, 'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->