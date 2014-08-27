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
  		<?php echo $form->textField($model, 'clockedin_datetime',array('readonly'=>'readonly')); ?>
  		<?php echo $form->error($model,'clockedin_datetime'); ?>  
    </div>
    <div class="row">
  		<?php echo $form->labelEx($model,'clockedout_datetime'); ?>
  		<?php echo $form->textField($model, 'clockedout_datetime',array('readonly'=>'readonly')); ?>
  		<?php echo $form->error($model,'clockedout_datetime'); ?>  
    </div>
		<div class="row">
  		<?php echo $form->labelEx($model,'hours'); ?>
  		<?php echo $form->textField($model, 'hours',array('readonly'=>'readonly')); ?>
  		<?php echo $form->error($model,'hours'); ?>  
    </div>
    
    <div class="row">
  		<?php echo $form->labelEx($model,'hours_approved'); ?>
  		<?php echo $form->textField($model, 'hours_approved',array('readonly'=>'readonly')); ?>
  		<?php echo $form->error($model,'hours_approved'); ?>  
    </div>

	
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
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success btn-large')).'  '.CHtml::link('Cancel',Yii::app()->createAbsoluteUrl('hrisMuApplication/admin'),array('class'=>'btn'));
$this->endWidget();
?>
</div><!-- form -->