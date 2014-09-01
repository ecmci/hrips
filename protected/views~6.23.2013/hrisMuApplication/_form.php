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
		<?php echo $form->labelEx($model,'clockedin_datetime'); ?>
		<?php //echo $form->textField($model, 'clockedin_datetime', array('required'=>'required')); ?>
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
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'clockedout_datetime'); ?>
		<?php //echo $form->textField($model, 'clockedout_datetime', array('required'=>'required')); ?>
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
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hours'); ?>
		<?php echo $form->textField($model, 'hours',array('required'=>'required')); ?>
		<?php echo $form->error($model,'hours'); ?>
		</div><!-- row -->
		<?php
			$options = (Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$EMPLOYEE) ? array('disabled'=>'disabled') : array('required'=>'required');
		?>
		<?php if(Yii::app()->user->getState('access_lvl_id') != HrisAccessLvl::$EMPLOYEE){ ?>
		<div class="row">
		<?php echo $form->labelEx($model,'from_datetime'); ?>
		<?php echo $form->textField($model, 'from_datetime',$options); ?>
		<?php echo $form->error($model,'from_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'to_datetime'); ?>
		<?php echo $form->textField($model, 'to_datetime',$options); ?>
		<?php echo $form->error($model,'to_datetime'); ?>
		</div><!-- row -->
		<?php } ?>
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
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model, 'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
		</div><!-- row -->
		
		<?php /*
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_id'); ?>
		<?php echo $form->dropDownList($model, 'reliever_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'reliever_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_approve'); ?>
		<?php echo $form->checkBox($model, 'reliever_approve'); ?>
		<?php echo $form->error($model,'reliever_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reliever_approve_datetime'); ?>
		<?php echo $form->textField($model, 'reliever_approve_datetime'); ?>
		<?php echo $form->error($model,'reliever_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_id'); ?>
		<?php echo $form->dropDownList($model, 'sup_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'sup_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_approve'); ?>
		<?php echo $form->checkBox($model, 'sup_approve'); ?>
		<?php echo $form->error($model,'sup_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_approve_datetime'); ?>
		<?php echo $form->textField($model, 'sup_approve_datetime'); ?>
		<?php echo $form->error($model,'sup_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sup_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'sup_disapprove_reason'); ?>
		<?php echo $form->error($model,'sup_disapprove_reason'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_id'); ?>
		<?php echo $form->dropDownList($model, 'hr_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'hr_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_approve'); ?>
		<?php echo $form->checkBox($model, 'hr_approve'); ?>
		<?php echo $form->error($model,'hr_approve'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_approve_datetime'); ?>
		<?php echo $form->textField($model, 'hr_approve_datetime'); ?>
		<?php echo $form->error($model,'hr_approve_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hr_disapprove_reason'); ?>
		<?php echo $form->textArea($model, 'hr_disapprove_reason'); ?>
		<?php echo $form->error($model,'hr_disapprove_reason'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('hrisMuAttachments')); ?></label>
		<?php echo $form->checkBoxList($model, 'hrisMuAttachments', GxHtml::encodeEx(GxHtml::listDataEx(HrisMuAttachments::model()->findAllAttributes(null, true)), false, true)); ?>

		*/ ?>
		
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success')).' | '.CHtml::link('Cancel',Yii::app()->createAbsoluteUrl('hrisMuApplication/admin'));
$this->endWidget();
?>
</div><!-- form -->