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
		<?php echo $form->label($model, 'emp_id'); ?>
		<?php echo $form->dropDownList($model, 'emp_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'job_code_id'); ?>
		<?php echo $form->dropDownList($model, 'job_code_id', GxHtml::listDataEx(JobCode::model()->findAll(array('condition'=>"title like '%LOA%'"))), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'from_datetime'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisLoaApplication[from_datetime]',
		    'value'=>$model->from_datetime,
		    //'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 23:00:00'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
		        
		    ),
		    'language' => '',	
		    
		));?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to_datetime'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisLoaApplication[to_datetime]',
		    'value'=>$model->to_datetime,
		    //'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 23:00:00'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',					
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',

		    ),
		    'language' => '',	
		    
		));?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reason'); ?>
		<?php echo $form->textArea($model, 'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'remarks'); ?>
		<?php echo $form->textArea($model, 'remarks'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'reliever_id'); ?>
		<?php //echo $form->dropDownList($model, 'reliever_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'reliever_approve'); ?>
		<?php //echo $form->dropDownList($model, 'reliever_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'reliever_approve_datetime'); ?>
		<?php //echo $form->textField($model, 'reliever_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'sup_id'); ?>
		<?php //echo $form->dropDownList($model, 'sup_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'sup_approve'); ?>
		<?php //echo $form->dropDownList($model, 'sup_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'sup_approve_datetime'); ?>
		<?php //echo $form->textField($model, 'sup_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'sup_disapprove_reason'); ?>
		<?php //echo $form->textArea($model, 'sup_disapprove_reason'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'hr_id'); ?>
		<?php //echo $form->dropDownList($model, 'hr_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'hr_approve'); ?>
		<?php //echo $form->dropDownList($model, 'hr_approve', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'hr_approve_datetime'); ?>
		<?php //echo $form->textField($model, 'hr_approve_datetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model, 'hr_disapprove_reason'); ?>
		<?php //echo $form->textArea($model, 'hr_disapprove_reason'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
