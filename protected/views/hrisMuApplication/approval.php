<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		//array('label'=>Yii::t('app', 'New'),'url'=>array('create')),
	);
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/CJuiDateTimePicker/assets/jquery-ui-timepicker-addon.css',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/CJuiDateTimePicker/assets/jquery-ui-timepicker-addon.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
	$('.search-form').hide();
	$('.datepicker').datetimepicker({
		showAnim : 'fade',
		dateFormat : 'yy-mm-dd',
		timeFormat :'hh:mm:ss',
        showMinute : false,
	});	
});
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hris-loa-application-grid', {
		data: $(this).serialize()
	});
	$('.search-form').slideToggle();
	return false;
});
$('#btn-approve').click(function(){
	if(confirm('Are you sure?')){
		$('#action').val('1');
		submit();
		return false;
	}
	return false;
});
$('#btn-deny').click(function(){
	if(confirm('Are you sure?')){
		$('#action').val('0');
		$('#reason-denied-dialog').dialog('open');		
		return false;
	}
	return false;
});

$('#dialog-submit').click(function(){
	$('#denial_reason').val($('#denial-reason').val());
	$('#denial-reason').val('');	
	submit();
	$('#reason-denied-dialog').dialog('close');	
	return false;
});

$('#dialog-cancel').click(function(){
	$('#reason-denied-dialog').dialog('close');	
	return false;
});

$('#dialog-alert-btn-ok').click(function(){
	$('#dialog-alert').dialog('close');  
  if($('#has_errors').val() == '0'){
    location.reload();
  }	
	return false;
});

function submit2(){
	$.post('".Yii::app()->createUrl('hrisMuApplication/formyapproval/')."',$('#hris-mu-application-form-approval').serialize(),function(response){
		var data = $.parseJSON(response);
    if(data){
      $('#has_errors').val(data.has_errors);
      var errors = data.errors;
      var ok_ids = '<p>IDs Passed: ['+data.ok_ids+']</p>';
      var failed_ids = '<p>IDs Failed: ['+data.failed_ids+']</p>';
      $('div.dialog-alert-message').html('').append(ok_ids+failed_ids+errors);
      $('#dialog-alert').dialog('open');
    }else{
      alert('JSON parse error!');
    }
		
	});
}

function submit(){
	$.post('".Yii::app()->createUrl('hrisMuApplication/formyapproval/')."',$('#hris-mu-application-form-approval').serialize(),function(response){
		var data = $.parseJSON(response);
    if(data){
      $('#has_errors').val(data.has_errors);
      $.each(data.errors, function(index, itemData) {
        var row = 'record-'+itemData.row;
        $('#'+row).html(itemData.error);
      });
      if(data.has_errors == '0'){
        /* window.location = '".Yii::app()->createUrl('hrisMuApplication/formyapproval')."'; */
        $.fn.yiiGridView.update('hris-loa-application-grid');
      }
    }else{
      alert('JSON parse error!');
    }
		
	});
}

");
?>

<h1><?php echo Yii::t('app', 'For My Approval'); ?></h1>


<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php /* $this->renderPartial('_search', array(
	'model' => $model,
)); */ ?>
</div><!-- search-form -->
<div class="form">
<?php 
 	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'hris-mu-application-form-approval',
	));

 	$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-loa-application-grid',
	'dataProvider' => $model->getMUForApproval(),
  //'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/formyapprovalview', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'selectableRows'=>'10',	
	'filter' => $model,
  'afterAjaxUpdate' => "function(id,data){
    $('.datepicker').datetimepicker({
		showAnim : 'fade',
		dateFormat : 'yy-mm-dd',
		timeFormat :'hh:mm:ss',
        showMinute : false,
	});  
  }",
	'columns' => array(
		/*array(
			'name'=>'',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>5),
			'value'=>'',
		),*/
		array(
			'class'=>'CCheckBoxColumn',   
			'checkBoxHtmlOptions'=>array('name'=>'row[]'), 
			'value'=>'$row',
		 ),
		array(
			'name' => 'id',
			'header'=>'',
			'value'=>array($model, 'renderId'),			
			'filter' => false,
		 ),
		array(
			'name' => 'id',
			'filter' => false,
		),
		array(
				'header'=>'Requesting Employee',
				'name'=>'emp_id',
				'value'=>'$data->emp->getEmpIdFullName()',
			//	'filter'=>GxHtml::listDataEx(Employee::model()->findAll(),'Emp_ID','EmpIdFullName'),
        'filter' => false,
				),
		
		array(
			'name'=>'clockedin_datetime',
			'value'=>'WebApp::formatDate($data->clockedin_datetime)',
			'filter' => false,
		),
		array(
			'name'=>'clockedout_datetime',
			'value'=>'WebApp::formatDate($data->clockedout_datetime)',
			'filter' => false,
		),
		array(
			'name'=>'hours',			
			'filter' => false,
		),
    array(
			'name'=>'hours_approved',			
			'filter' => false,
		),
		array(
			'name'=>'from_datetime',
			'type' => 'raw',
			'value'=>array($model,'renderMUDatetimeFrom'),
			'filter' => false,
			'visible' => (Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR),
		),		
		array(
			'name'=>'to_datetime',
			'type' => 'raw',
			'value'=>array($model,'renderMUDatetimeTo'),
			'filter' => false,
			'visible' => (Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR),
		),
		array(
			'name'=>'from_datetime',
			'value'=>'($data->from_datetime) ? WebApp::formatDate($data->from_datetime) : "Pending..."',
			'filter' => false,
			'visible' => (Yii::app()->user->getState('access_lvl_id') != HrisAccessLvl::$SUPERVISOR),
		),
		array(
			'name'=>'to_datetime',
			'value'=>'($data->to_datetime) ? WebApp::formatDate($data->to_datetime) : "Pending..."',
			'filter' => false,
			'visible' => (Yii::app()->user->getState('access_lvl_id') != HrisAccessLvl::$SUPERVISOR),
		),
		array(
			'name' => 'reason',
      'value'=>'$data->getBriefReason()',
			'filter' => false,
		),
		array(
			'name'=>'timestamp',
			'value'=>'WebApp::formatDate($data->timestamp)',
			'filter' => false,
		),
    array(
			'name'=>'row_error',
      'header'=>'-',
      'value'=>array($model, 'renderRowError'),
			'filter' => false,
		),				
		array(
			'class' => 'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array(
				'view'=>array(
					'label'=>'View',					
					'url'=>'Yii::app()->controller->createUrl("/'.Yii::app()->controller->id.'/formyapprovalview", array("id"=>$data->id))',
					'options'=>array('target'=>'_blank'),
				),
			),
		),	
	),
)); 
if(Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR){	
	echo '<div class="row">';
	echo CHtml::checkbox('to_hr',true,array('id'=>'to_hr'));
	echo CHtml::label(' Route Directly to HR (Uncheck if you want to route this to the manager instead.)','to_hr',array('style'=>'display:inline;'));
	echo '</div>';
}
echo '<div class="row">';
echo CHtml::hiddenField('denial_reason','',array('name'=>'denial_reason','id'=>'denial_reason'));
echo CHtml::hiddenField('action','',array('name'=>'action','id'=>'action'));
echo "";
echo GxHtml::submitButton(Yii::t('app', 'Approve'), array('id'=>'btn-approve','class'=>'btn btn-info','value'=>'Approve')).
"&nbsp;&nbsp;&nbsp;&nbsp;"
.GxHtml::submitButton(Yii::t('app', 'Deny'), array('id'=>'btn-deny','class'=>'btn btn-warning','value'=>'Deny'));
echo '</div>';
$this->endWidget();
?>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'reason-denied-dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Reason Denied',
        'autoOpen'=>false,
		'height' => '220',
		'width' => '250',
		'modal' => true,
		'hide' => 'fade',		
    ),
));
?>
    <div id="dialog-denial-reason" title="Authentication">			
	<label for="password">Brief Reason for the Denial</label>
	<textarea id="denial-reason"></textarea>
	<button id="dialog-submit" class="btn btn-info">Submit</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" id="dialog-cancel">Cancel</button>
</div>
<?php
$this->endWidget('reason-denied-dialog');

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialog-alert',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Approval Feedback',
        'autoOpen'=>false,
		'height' => '300',
		'width' => '50%',
		'modal' => true,
		'hide' => 'fade',		
    ),
));
?>
    <div class="dialog-alert-message" title="Approval Feedback"></div>
    <div><button id="dialog-alert-btn-ok" class="btn btn-info pull-right">Okay</button></div>
<?php
$this->endWidget('dialog-alert');

?>
<input id="has_errors" type="hidden" value="">



