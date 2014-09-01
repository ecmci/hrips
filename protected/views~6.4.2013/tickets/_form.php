<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'tickets-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', $model->getProblemCategoryList(),array('empty'=>'-select-','required'=>'required')); ?> <span class="label">Tip:</span><span class="muted">Type in the keyword to jump directly to the right one.</span>
		<?php echo $form->error($model,'category_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reported_by_id'); ?>
		<?php echo $form->dropDownList($model, 'reported_by_id', Employee::getEmployeeList(),array('empty'=>'-select-','required'=>'required')); ?><span class="label">Tip:</span><span class="muted">Type in the keyword to jump directly to the right one.</span>
		<?php echo $form->error($model,'reported_by_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('Open'=>'Open','Closed'=>'Closed'), array('maxlength' => 512)); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model, 'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>
		</div><!-- row --> 


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->