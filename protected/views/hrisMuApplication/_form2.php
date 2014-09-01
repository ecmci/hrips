<?php
Yii::app()->clientScript->registerScript('',"
$(document).ready(function(){
  $('.error-message-div').hide();
});
$('.retrieve-hours').click(function(){
  var from = $('#rtr-from').val();
  var to = $('#rtr-to').val();
  var params = 'rtr-hrs=1&from='+from+'&to='+to;
  var url ='".Yii::app()->createAbsoluteUrl('hrisMuApplication/create')."';
  $('.preloader').show();
  $('.extended-hours').fadeOut();
  $.post(url,params,function(response){
    $('.preloader').fadeOut();
    $('.extended-hours').html(response).fadeIn();  
  });  
  return false;
});
$('#hris-mu-application-form').submit(function(){
  $('.preloader-submit').fadeIn();
  $('.error-message-div').fadeOut();
  var params = $('#hris-mu-application-form').serialize();
  var url_submit = '".Yii::app()->createAbsoluteUrl('hrisMuApplication/create')."';
  var url_success_redirect = '".Yii::app()->createAbsoluteUrl('hrisMuApplication/admin')."';
  $.post(url_submit,params,function(data){
    var response = $.parseJSON(data);
    if(response.success == '1'){
      /* alert('success'); */
      window.location = response.redirectUrl;
    }else{
      /* alert(response.message); */
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
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/customization.js');
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

  <?php $tcdata = $model->getExtendedHours(); ?>
    
    <div class="row fluid">
      <fieldset><legend>Extended Clocked Hours <small>Check the record(s) that you want to apply.</small></legend>
        <div class="row fluid">
          <table>
                 <tr>
                  <th></th>
                  <th colspan="5">Show extended hours from <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
              			 'model'=>$model,		    
              		    'name'=>'HrisMuApplication[from]',
                      'id'=>'rtr-from',
              		    'value'=>$model->from,
              		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd hh:mm:ss'),		    		    
              		    'options'=>array(
              		        'showAnim'=>'fade',
              		        'dateFormat'=>'yy-mm-dd',
              		        'timeFormat'=>'hh:mm:ss',
                          'showMinute'=> true,            
              		    ),
              		    'language' => '',	
              			  'mode'=>'date',
              		  ));?> to <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
              			 'model'=>$model,		    
              		    'name'=>'HrisMuApplication[to]',
                      'id'=>'rtr-to',
              		    'value'=>$model->to,
              		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd hh:mm:ss'),		    		    
              		    'options'=>array(
              		        'showAnim'=>'fade',
              		        'dateFormat'=>'yy-mm-dd',
              		        'timeFormat'=>'hh:mm:ss',
                          'showMinute'=> true,            
              		    ),
              		    'language' => '',	
              			  'mode'=>'date',
              		  )); echo '&nbsp;'.CHtml::link('Retrieve','#',array('class'=>'btn retrieve-hours')); ?>&nbsp;<span style="display:none;" class="preloader"><img src="<?php echo Yii::app()->baseUrl; ?>/images/preloader.gif" width="30" style="width:30px; height: 30px;" /> Retreiving...Please Wait</span></th>
                </tr>
          </table>
        </div>
        <div class="row">
        <?php include '_form_extended_hours.php';  ?>
        </div><!-- row -->
      </fieldset>
    </div><!-- row -->
    
    <fieldset><legend>Make Up <small>Provide the start and end dates of your make up.</small></legend>
    <div class="row">    
		<?php echo CHtml::label('From',''); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisMuApplication[from_datetime]',
		    'value'=>$model->from_datetime,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd hh:mm:ss'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> true,
            'stepMinute'=> '15',            
		    ),
		    'language' => '',	
			//'mode'=>'date',
		));?>
		<?php echo $form->error($model,'from_datetime'); ?>
		</div><!-- row --> 
    
    <div class="row">
		<?php echo CHtml::label('To',''); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisMuApplication[to_datetime]',
		    'value'=>$model->to_datetime,
		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd hh:mm:ss'),		    		    
		    'options'=>array(
		        'showAnim'=>'fade',
		        'dateFormat'=>'yy-mm-dd',
		        'timeFormat'=>'hh:mm:ss',
            'showMinute'=> true,
            'stepMinute'=> '15',         
		    ),             
		    'language' => '',	
			//'mode'=>'date',
		));?>
		<?php echo $form->error($model,'to_datetime'); ?>		
    </div><!-- row --> 
    </fieldset>
     	
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
    <?php echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success btn-large')).'  '.CHtml::link('Cancel',Yii::app()->createAbsoluteUrl('hrisMuApplication/admin'),array('class'=>'btn')); ?>&nbsp;<span style="display:none;" class="preloader-submit"><img src="<?php echo Yii::app()->baseUrl; ?>/images/preloader.gif" width="30" style="width:30px; height: 30px;" /> Submitting...Please Wait</span>
    </div><!-- row -->
    <div class="row">
      <div class="alert alert-error error-message-div">
        <div id="error-message"></div>
      </div>
    </div><!-- row -->
<?php $this->endWidget();?>
</div><!-- form -->