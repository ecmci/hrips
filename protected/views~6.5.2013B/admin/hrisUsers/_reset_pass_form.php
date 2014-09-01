<?php
$this->pageTitle=Yii::app()->name . ' - Reset Password';
$this->breadcrumbs=array(
	'Recover',
);
?>
<div class="page-header">
	<h1>Reset Password<small></small></h1>  
</div>

<div class="row-fluid">
    <div class="span5 offset4 well">
          <img class="offset3" src="<?php echo Yii::app()->baseUrl; ?>/images/logo-ecmci.png" />
          <div class="form wide">
               <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'reset-password-form',
                    'enableClientValidation'=>true,
                     'clientOptions'=>array(
                         'validateOnSubmit'=>true,
                     ),
                )); ?>
                
                <?php echo $form->errorSummary($model); ?>
                
                <div class="row">
                  <?php echo $form->label($model, 'password'); ?>
                  <?php echo $form->passwordField($model, 'password',array('placeholder'=>'New Password','required'=>'required')); ?>
                  <?php echo $form->error($model,'password'); ?>
                </div>
                
                <div class="row">
                  <?php echo $form->label($model, 'password_confirm'); ?>
                  <?php echo $form->passwordField($model, 'password_confirm',array('placeholder'=>'Retype Password','required'=>'required')); ?>
                  <?php echo $form->error($model,'password_confirm'); ?>
                </div>
                
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Save',array('class'=>'btn btn btn-success')); ?>
                </div>
                
                <?php $this->endWidget(); ?>
          </div>
    </div>    
</div>