<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-document-access-form',
	'enableAjaxValidation' => true,
  'enableClientValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'doc_id'); ?>
		<?php echo $form->dropDownList($model, 'doc_id', GxHtml::listDataEx(HrisDocument::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'doc_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dept_id'); ?>
		<?php echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'dept_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'create'); ?>
		<?php echo $form->checkBox($model, 'create'); ?>
		<?php echo $form->error($model,'create'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'update'); ?>
		<?php echo $form->checkBox($model, 'update'); ?>
		<?php echo $form->error($model,'update'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'delete'); ?>
		<?php echo $form->checkBox($model, 'delete'); ?>
		<?php echo $form->error($model,'delete'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'admin'); ?>
		<?php echo $form->checkBox($model, 'admin'); ?>
		<?php echo $form->error($model,'admin'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->