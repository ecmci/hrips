
<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-loa-application-form',
	'enableAjaxValidation' => false,
	'enableClientValidation'=>true,
));
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/customization.js');
Yii::app()->clientScript->registerScript('flashy',"
$('.alert').animate({opacity: 1.0}, 30000).fadeOut('slow');
",CClientScript::POS_READY);
?>

 
  <?php
    $flashMessages = Yii::app()->user->getFlashes();
    if ($flashMessages) {        
        foreach($flashMessages as $key => $message) {
            echo '<div class="alert alert-warning '.$key.'">';
            echo '<button class="close" data-dismiss="alert" type="button">×</button>';
            echo $message;
            echo '</div>';
        }
        
    }
    ?>    

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php //echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->dropDownList($model, 'emp_id', CHtml::listData(Employee::model()->findAll(),'Emp_ID','empIdFullName')); ?>
		<?php echo $form->hiddenField($model,'emp_id',array('value'=>Yii::app()->user->getState('emp_id'))); ?>		
		<?php //echo $form->error($model,'emp_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_code_id'); ?>
		<?php echo $form->dropDownList($model, 'job_code_id', GxHtml::listDataEx(JobCode::model()->findAll(array('condition'=> "title LIKE '%LOA%'",'order'=>'title asc'))), array('empty'=>'- select -','required'=>'required')); ?>
		<?php echo $form->error($model,'job_code_id'); ?>
		</div><!-- row -->
		<div class="row">		
		</div><!-- row -->
		<div class="row">
		<p><strong class="text-info">Include Scheduled Shifts Between:</strong></p>
		<?php echo $form->labelEx($model,'from_datetime'); ?>
		<?php //echo $form->textField($model, 'from_datetime'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisLoaApplication[from_datetime]',
		    'value'=>$model->from_datetime,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 00:00:00'),		    		    
		    'options'=>array(
				'showAnim'=>'fade',
				'dateFormat'=>'yy-mm-dd',
				'timeFormat'=>'hh:mm:ss',
				'showMinute'=> false,            
		    ),
		    'language' => '',	
			//'mode'=>'date',
		));?>
		<?php echo "(Today is ".date(Yii::app()->params['dateFormat'],time()).")"; ?>
		<?php echo $form->error($model,'from_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'to_datetime'); ?>
		<?php //echo $form->textField($model, 'to_datetime'); ?>		
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisLoaApplication[to_datetime]',
		    'value'=>$model->to_datetime,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 23:59:00'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',					
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> false,
		    ),
		    'language' => '',	
			//'mode'=>'date',
		));?>
		<?php echo $form->error($model,'to_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hours'); ?>
		<?php //echo $form->textField($model, 'hours_requested',array('readonly'=>'readonly')); ?>
		<?php //echo $form->hiddenField($model, 'hours_requested'); ?>
		<?php //echo $form->numberField($model, 'hours_requested',array('maxlength'=>'2')); ?>
    <?php 
      $hrs = array();
      for($i = 1 ; $i <= 120 ; $i++) { $j = ($i < 10) ? '0'.$i : $i; $hrs[$j] = $j; }
      echo $form->dropDownList($model,'hours',$hrs); 
    ?> 
		<?php echo $form->error($model,'hours'); ?>                                                          
		</div><!-- row -->
    
    <div class="row">
         <?php echo $form->labelEx($model,'minutes'); ?>
         <?php  echo $form->dropDownList($model,'minutes',array(
        '00'=>'00',
        '15'=>'15',
        '30'=>'30',
        '45'=>'45',
        )); ?>
        <?php echo $form->error($model,'minutes'); ?>
    </div>
    
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_id'); ?>
		<?php echo $form->dropDownList($model, 'reliever_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName'),array('empty'=>'- select -','required'=>'required')); ?>
		<?php echo $form->error($model,'reliever_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model, 'reason',array('placeholder'=>'Why?','required'=>'required')); ?>
		<?php echo $form->error($model,'reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model, 'remarks',array('placeholder'=>'Comments?')); ?>
		<?php echo $form->error($model,'remarks'); ?>
		</div><!-- row -->		
		<div class="row">
		<?php //echo $form->labelEx($model,'reliever_approve'); ?>
		<?php //echo $form->checkBox($model, 'reliever_approve'); ?>
		<?php //echo $form->error($model,'reliever_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'reliever_approve_datetime'); ?>
		<?php //echo $form->textField($model, 'reliever_approve_datetime'); ?>
		<?php //echo $form->error($model,'reliever_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'sup_id'); ?>
		<?php //echo $form->dropDownList($model, 'sup_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php //echo $form->error($model,'sup_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'sup_approve'); ?>
		<?php //echo $form->checkBox($model, 'sup_approve'); ?>
		<?php //echo $form->error($model,'sup_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'sup_approve_datetime'); ?>
		<?php //echo $form->textField($model, 'sup_approve_datetime'); ?>
		<?php //echo $form->error($model,'sup_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'sup_disapprove_reason'); ?>
		<?php //echo $form->textArea($model, 'sup_disapprove_reason'); ?>
		<?php //echo $form->error($model,'sup_disapprove_reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'hr_id'); ?>
		<?php //echo $form->dropDownList($model, 'hr_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php //echo $form->error($model,'hr_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'hr_approve'); ?>
		<?php //echo $form->checkBox($model, 'hr_approve'); ?>
		<?php //echo $form->error($model,'hr_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'hr_approve_datetime'); ?>
		<?php //echo $form->textField($model, 'hr_approve_datetime'); ?>
		<?php //echo $form->error($model,'hr_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php //echo $form->labelEx($model,'hr_disapprove_reason'); ?>
		<?php //echo $form->textArea($model, 'hr_disapprove_reason'); ?>
		<?php //echo $form->error($model,'hr_disapprove_reason'); ?>
		</div><!-- row -->

		<?php include Yii::getPathOfAlias('webroot').'/js/uploadify/uploadifyWidget.php'; ?>
		

		<label><?php //echo GxHtml::encode($model->getRelationLabel('hrisLoaAttachments')); ?></label>
		<?php //echo $form->checkBoxList($model, 'hrisLoaAttachments', GxHtml::encodeEx(GxHtml::listDataEx(HrisLoaAttachments::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success')).' | '.CHtml::link('Cancel',Yii::app()->createAbsoluteUrl('hrisLoaApplication/admin'));
$this->endWidget();
?>
</div><!-- form --> 
