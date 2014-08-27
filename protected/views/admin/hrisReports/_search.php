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
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sql_stmt'); ?>
		<?php echo $form->textArea($model, 'sql_stmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created_by_user_id'); ?>
		<?php echo $form->textField($model, 'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created_timestamp'); ?>
		<?php echo $form->textField($model, 'created_timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_updated_timestamp'); ?>
		<?php echo $form->textField($model, 'last_updated_timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
