<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/customization.js');

Yii::app()->clientScript->registerScript('ready',"
$('.error-message-div').hide();
",CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('fx',"
$('#hris-mu-application-form').submit(function(){
  $('.preloader-submit').fadeIn();
  $('.error-message-div').fadeOut();
  var params = $('#hris-mu-application-form').serialize();
  var url_submit = '".Yii::app()->createAbsoluteUrl('hrisMuApplication/create')."';
  var url_success_redirect = '".Yii::app()->createAbsoluteUrl('hrisMuApplication/admin')."';
  $.post(url_submit,params,function(data){
    var response = $.parseJSON(data);
    if(response.success == '1'){
      window.location = url_success_redirect;
    }else{
      $('#error-message').html(response.message);      
    }
  });
  $('.preloader-submit').fadeOut();
  $('.error-message-div').fadeIn();
  return false;
});
");
?>

<div class="form">
	<?php $form = $this->beginWidget('GxActiveForm', array(
  	'id' => 'hris-mu-application-form',
  	'enableAjaxValidation' => false,
  ));
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
  
  
  <span id="top"></span>
  <fieldset><legend>Step 1: Your Extended Hours <small>Check one or more extended record(s) that you wish to apply.</small></legend>
  <?php $this->renderPartial('form_extended_hours',array('model'=>$model,'form'=>$form)); ?>      
  </fieldset>
  
  <fieldset><legend>Step 2: Mode <small>How would you like to apply your extended hours above?</small></legend>
  <div class="row">
    <label class="radio">
      <input type="radio" name="HrisMuApplication[mode]" id="many-to-one" value="many-to-one" checked>
      Normal Mode (Many-to-One): <span class="muted">Select this mode if you want to use one or many extended hour record(s) and apply it to one make up date only.</span>
    </label>
    <label class="radio">
      <input type="radio" name="HrisMuApplication[mode]" id="one-to-many" value="one-to-many">
      Staggered Mode (One-to-Many): <span class="muted">Select this mode if you want to use one extended hour record and apply it to several non-contiguous make up dates.</span> 
    </label>
  </div>  
  </fieldset>
  
  <fieldset><legend>Step 3: Make Up Dates <small>Define one or more dates for your make up.</small></legend>
  <?php $this->renderPartial('form_mu_dates',array('model'=>$model)); ?>  
  </fieldset>      
  
  <fieldset><legend>Step 4: Others <small>Provide other information as needed.</small></legend>
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
    
    <div class="row">
      <div class="alert alert-error error-message-div">
        <div id="error-message"></div>
      </div>
    </div><!-- row -->
    
    <div class="row">
      <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class'=>'btn btn-success btn-large')).'  '.CHtml::link('Cancel',Yii::app()->createAbsoluteUrl('hrisMuApplication/admin'),array('class'=>'btn')); ?>&nbsp;<span style="display:none;" class="preloader-submit"><img src="<?php echo Yii::app()->baseUrl; ?>/images/preloader.gif" width="30" style="width:30px; height: 30px;" /> Submitting...Please Wait</span>
    </div><!-- row -->
  </fieldset>
  
  <?php $this->endWidget();?>  
</div>