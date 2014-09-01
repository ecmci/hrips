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
		<?php echo $form->label($model, 'dept_id'); ?>
		<?php echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'emp_id'); ?>
		<?php //echo $form->dropDownList($model, 'emp_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
		<?php echo $form->dropDownList($model, 'emp_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName'), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'next_lvl_id'); ?>
		<?php //echo $form->dropDownList($model, 'next_lvl_id', GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
		<?php echo $form->dropDownList($model, 'next_lvl_id', CHtml::listData(HrisAccessLvl::model()->findAll(),'id','status'), array('prompt' => Yii::t('app', ''))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sub_code_id'); ?>
		<?php echo $form->dropDownList($model, 'sub_code_id', GxHtml::listDataEx(OtSubCode::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'in_datetime'); ?>
		<?php echo $form->textField($model, 'in_datetime'); ?>
	</div>	
	<div class="row">
		<?php echo $form->label($model, 'out_datetime'); ?>
		<?php echo $form->textField($model, 'out_datetime'); ?>
	</div>
  <div class="row">
		<?php echo $form->label($model, 'is_entered'); ?>
		<?php echo $form->checkBox($model, 'is_entered'); ?>
	</div>





	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
