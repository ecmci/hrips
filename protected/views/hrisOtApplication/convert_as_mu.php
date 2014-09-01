<?php

$this->breadcrumbs = array(
  'Overtime'=>array('admin'),
  'Convert',
	$ot->id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Back to') . ' ' . $ot->label(2), 'url'=>array('admin')),
);

?>

<h1 class="pageHeader">Convert Overtime to Make Up</h1>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'hris-ot-to-mu-form',
	'enableAjaxValidation' => true,
  'enableClientValidation' => true,
  'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="form row-fluid">
  	
    <?php
     echo $form->errorSummary($mu);
    ?>
    
    <div class="row">
  		<?php echo $form->labelEx($mu,'clockedin_datetime'); ?>
  		<?php echo $form->textField($mu,'clockedin_datetime'); ?>
  		<?php echo $form->error($mu,'clockedin_datetime'); ?>
		</div><!-- row -->

    <div class="row">
  		<?php echo $form->labelEx($mu,'clockedout_datetime'); ?>
  		<?php echo $form->textField($mu,'clockedout_datetime'); ?>
  		<?php echo $form->error($mu,'clockedout_datetime'); ?>
		</div><!-- row -->

		<?php			
			$diff = WebApp::diffBetweenDateTimeRange($ot->in_datetime,$ot->out_datetime);
			$hours = array();
			$minutes = array();
			for($i = 0 ; $i <= $diff['hours']; $i++)$hours[$i] = $i;
      for($j = 0 ; $j <= $diff['mins'] ; $j++){ $mincount = $j < 10 ? '0'.$j : $j; $minutes[$mincount] = $mincount; }	
		?>                                           
		<div class="row">
  		<?php echo $form->labelEx($mu,'hours'); ?>
      <?php echo $form->textField($mu,'hours'); ?>
		</div><!-- row -->
    
    <div class="row">
  		<?php echo $form->labelEx($mu,'from_datetime'); ?>
  		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
  			 'model'=>$mu,		    
  		    'name'=>'HrisMuApplication[from_datetime]',
  		    'value'=>$mu->from_datetime,
  		    'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 00:00:00'),		    		    
  		    'options'=>array(
  		        'showAnim'=>'fade',
  		        'dateFormat'=>'yy-mm-dd',
  		        'timeFormat'=>'hh:mm:ss',
              'showMinute'=> true,            
  		    ),
  		    'language' => '',	
  		));?>
  		<?php echo $form->error($mu,'from_datetime'); ?>
		</div><!-- row -->
    
    <div class="row">
  		<?php echo $form->labelEx($mu,'to_datetime'); ?>
  		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
  			 'model'=>$mu,		    
  		    'name'=>'HrisMuApplication[to_datetime]',
  		    'value'=>$mu->to_datetime,
  		    'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 00:00:00'),		    		    
  		    'options'=>array(
  		        'showAnim'=>'fade',
  		        'dateFormat'=>'yy-mm-dd',
  		        'timeFormat'=>'hh:mm:ss',
              'showMinute'=> true,            
  		    ),
  		    'language' => '',	
  		));?>
  		<?php echo $form->error($mu,'to_datetime'); ?>
		</div><!-- row -->
    
    <div class="row">
  		<?php echo $form->labelEx($mu,'reliever_id'); ?>
  		<?php echo $form->dropDownList($mu, 'reliever_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName'),array('required'=>'required','prompt'=>'- select -')); ?>
  		<?php echo $form->error($mu,'reliever_id'); ?>
		</div><!-- row -->
    
		<div class="row">
  		<?php echo $form->labelEx($mu,'reason'); ?>
  		<?php echo $form->textArea($mu, 'reason',array('required'=>'required')); ?>
  		<?php echo $form->error($mu,'reason'); ?>
		</div><!-- row -->
    
		<div class="row">
  		<?php echo CHtml::label('Any message you would like to get to your supervisor? Say it here.',''); ?>
  		<?php echo $form->textArea($mu, 'remarks'); ?>
  		<?php echo $form->error($mu,'remarks'); ?>
		</div><!-- row --> 	

    <div class="row">
    <?php echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success btn-large')); ?>
    <?php echo ' '.GxHtml::link(Yii::t('app', 'Cancel'),array('admin') ,array('class'=>'btn')); ?>
    </div><!-- row --> 

</div>

<?php $this->endWidget(); ?>
