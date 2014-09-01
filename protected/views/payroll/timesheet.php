<?php

$this->breadcrumbs = array(
	'TimeSheet' => array('index'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
	//array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
	//array('label'=>Yii::t('app', 'Back'), 'url' => array('admin')),
);
?>
<h1><?php echo Yii::t('app', 'Email Timesheet'); ?></h1>
<?php
    $flashMessages = Yii::app()->user->getFlashes();
    if ($flashMessages) {        
        foreach($flashMessages as $key => $message) {
            echo '<div class="alert alert-info '.$key.'">';
            echo '<button class="close" data-dismiss="alert" type="button">X</button>';
            echo $message;
            echo '</div>';
        }
        
    }
    ?> 
<div class="form">
<?php
$form = $this->beginWidget('GxActiveForm', array(
	'id' => 'timesheet-form',
	'enableAjaxValidation' => false,
));
?>		<div class="row">
		<?php echo CHtml::label('Employee ID',''); ?>
		<?php echo $form->textField($model, 'Emp_ID',array('maxlength' => '4','required'=>'required')); ?>		
		<?php echo $form->error($model,'Emp_ID'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo CHtml::label('From',''); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
		    'model'=>$model,
			'name'=>'Payroll[from]',
		    'value'=>$model->from,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> false,            
		    ),
		    'language' => '',	
			'mode'=>'date',
		));?>
		<?php echo $form->error($model,'from'); ?>		
		</div><!-- row -->	
		<div class="row">
		<?php echo CHtml::label('To',''); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
		    'model'=>$model,
			'name'=>'Payroll[to]',
		    'value'=>$model->to,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> false,            
		    ),
		    'language' => '',	
			'mode'=>'date',
		));?>
		<?php echo $form->error($model,'to'); ?>		
		</div><!-- row -->
<?php
echo GxHtml::submitButton(Yii::t('app', 'Email'), array('class'=>'btn btn-success'));
$this->endWidget();
//$this->renderPartial('_timesheet',array('data'=>$data));
?>
</div><!-- form -->
