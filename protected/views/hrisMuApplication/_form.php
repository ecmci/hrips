<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-mu-application-form',
	'enableAjaxValidation' => true,
));
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/customization.js');
Yii::app()->clientScript->registerScript('flashy',"
$('.alert').animate({opacity: 1.0}, 30000).fadeOut('slow');
",CClientScript::POS_READY);
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php
    $flashMessages = Yii::app()->user->getFlashes();
    if ($flashMessages) {        
        foreach($flashMessages as $key => $message) {
            echo '<div class="alert alert-warning '.$key.'">';
            echo '<button class="close" data-dismiss="alert" type="button">x</button>';
            echo $message;
            echo '</div>';
        }
        
    }
    ?> 
	
	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo CHtml::label('When did you clock IN?',''); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisMuApplication[clockedin_datetime]',
		    'value'=>$model->clockedin_datetime,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 00:00:00'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> true,            
		    ),
		    'language' => '',	
			//'mode'=>'date',
		));?>
		<?php echo $form->error($model,'clockedin_datetime'); ?>
    <span class="help-block">Input the exact time you clocked IN. Time format is 24-hour.</span>
		</div><!-- row -->
		<div class="row">
		<?php echo CHtml::label('When did you clock OUT?',''); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisMuApplication[clockedout_datetime]',
		    'value'=>$model->clockedout_datetime,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-02-14 00:00:00'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> true,            
		    ),
		    'language' => '',	
			//'mode'=>'date',
		));?>
		<?php echo $form->error($model,'clockedout_datetime'); ?>
    <span class="help-block">Input the exact time you clocked OUT. Time format is 24-hour.</span>    
		</div><!-- row -->
		<div class="row fluid">
		 <?php echo CHtml::label('How many hours and minutes would you like to use from your clock IN-OUT period?',''); ?>
     <div class="input-append">
        <?php echo $form->textField($model, 'hours_in',array('maxlength'=>'2','required'=>'required','style'=>'width:75px;')).''; ?>
        <span class="add-on" style="margin-right:15px;">hours</span>
        &nbsp;
        <?php echo $form->dropDownList($model, 'minutes',array('0'=>'0','15'=>'15','30'=>'30','45'=>'45'),array('required'=>'required','style'=>'width:75px;')).''; ?>
        <span class="add-on">minutes</span>
     </div>

    <?php echo $form->error($model,'hours_in'); ?>
    <?php echo $form->error($model,'minutes'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_id'); ?>
		<?php echo $form->dropDownList($model, 'reliever_id', CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','empIdFullName'),array('required'=>'required','prompt'=>'- select -')); ?>
		<?php echo $form->error($model,'reliever_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model, 'reason',array('required'=>'required')); ?>
		<?php echo $form->error($model,'reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo CHtml::label('Any message you would like to get to your supervisor? Say it here.',''); ?>
		<?php echo $form->textArea($model, 'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
		</div><!-- row --> 	
		
		
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success')).'  '.CHtml::link('Cancel',Yii::app()->createAbsoluteUrl('hrisMuApplication/admin'),array('class'=>'btn'));
$this->endWidget();
?>
</div><!-- form -->