<div class="form wide">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'easy-payslip-access-form',
    	'enableAjaxValidation'=>false,
    )); ?>
    
      <div class="row">
        <h3>Hello, <?php echo $record->FirstName.' '.$record->LastName; ?>.</h3> 
        <p>For your security, please input the passkey that you received in the email.</p>
      </div>
      
      <?php echo $form->errorSummary($model); ?>
      
      <div class="row">
    		<?php echo $form->hiddenField($model,'id',array('value'=>$record->id)); ?>
    	</div>
      
      <div class="row">
    		<?php echo $form->labelEx($model,'passkey'); ?>
    		<?php echo $form->textField($model,'passkey',array('required'=>'required')); ?>
    		<?php echo $form->error($model,'passkey'); ?>
    	</div>
    
    	<div class="row buttons">
    		<?php echo CHtml::submitButton('Get Payslip',array('class'=>'btn btn-large')); ?>
    	</div>

    <?php $this->endWidget(); ?>    
</div>