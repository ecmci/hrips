<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<style type="text/css">
.row label{
	font-family: 'Carrois Gothic',sans-serif;
	font-size: 1.2em !important;
	width: 100px !important;
	margin: 10px 0;
}
</style>
	
	<div class="row">
		<div class="span2"></div>
		<div class="span4">
		<?php echo $form->label($model,'from'); ?>
		<?php //echo $form->textField($model,'is_entered'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
									'model'=>$model,		    
									'name'=>'OtApplication[from]', //name!!!
									'id'=>'fromdate',
									'value'=>$model->from,
									'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2014-01-14 00:00:00'),		    		    
									'options'=>array(
									'showAnim'=>'fade',
									'dateFormat'=>'yy-mm-dd',
									'timeFormat'=>'hh:mm:ss',
									'showMinute'=> false,     
									'onClose' => new CJavaScriptExpression('function(selectedDate) { $("#todate").datepicker("option", "minDate", selectedDate); }'),
									),
									'language' => '',	
									//'mode'=>'date',
								));?>
	

		</div><div class="span6">
		<?php echo $form->label($model,'to'); ?>
		<?php //echo $form->textField($model,'timestamp'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
									'model'=>$model,		    
									'name'=>'OtApplication[to]', //name!!!
									'id'=>'todate',
									'value'=>$model->to,
									'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2014-01-14 00:00:00'),		    		    
									'options'=>array(
									'showAnim'=>'fade',
									'dateFormat'=>'yy-mm-dd',
									'timeFormat'=>'hh:mm:ss',
									'showMinute'=> false, 
									'onClose' => new CJavaScriptExpression('function (selectedDate) { $(".OtApplication[from]").datepicker("option", "maxDate", selectedDate); }'),
									),
									'language' => '',
									//'onClose'=>'function(selectedDate){$(".OtApplication[from]").datepicker("option","maxDate",selectedDate);}'
									//'mode'=>'date',
								));?>

	<!--<div class="row buttons">-->
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-success btn-lg')); ?>
	<!--</div>-->
	</div>
</div>

<?php $this->endWidget(); ?>

<!-- search-form -->
</div>