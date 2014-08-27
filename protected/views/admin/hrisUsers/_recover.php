<div class="page-header">
	<h1>Account Recovery</h1>
</div>
<div class="row-fluid">
	<div class="form">
	<?php $form = $this->beginWidget('GxActiveForm', array(
		'id' => 'hris-users-recover-form',
		'enableAjaxValidation' => false,
	));
	?>
		<?php echo $form->errorSummary($model); ?>
		<div class="row">
		<?php echo CHtml::label('Enter your Employee ID',''); ?>
		<?php echo $form->textField($model, 'username',array('placeholder'=>'Employee ID')); ?>
		<?php echo $form->error($model,'username'); ?>
		</div><!-- row -->

	<?php
	echo GxHtml::submitButton(Yii::t('app', 'Recover'), array('class'=>'btn btn-success'));
	$this->endWidget();
	?>
	</div>
</div>