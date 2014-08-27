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
		<?php echo $form->label($model, 'template_id'); ?>
		<?php echo $form->dropDownList($model, 'template_id', GxHtml::listDataEx(HrisEmailTemplate::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to_group'); ?>
		<?php echo $form->dropDownList($model, 'to_group', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to_user'); ?>
		<?php echo $form->dropDownList($model, 'to_user', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to'); ?>
		<?php echo $form->textField($model, 'to', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'subject'); ?>
		<?php echo $form->textField($model, 'subject', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'content'); ?>
		<?php echo $form->textArea($model, 'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'model_name'); ?>
		<?php echo $form->textField($model, 'model_name', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'model_id'); ?>
		<?php echo $form->textField($model, 'model_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sent'); ?>
		<?php echo $form->dropDownList($model, 'sent', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sent_timestamp'); ?>
		<?php echo $form->textField($model, 'sent_timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'timestamp'); ?>
		<?php echo $form->textField($model, 'timestamp'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
