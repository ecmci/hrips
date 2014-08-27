<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'For My Approval'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		//array('label'=>Yii::t('app', 'New'),'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search-ot', "
$(document).ready(function(){
	$('.search-form').hide();
});
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hris-ot-application-grid', {
		data: $(this).serialize()
	});
	$('.search-form').slideToggle();
	return false;
});
$('#btn-approve').click(function(){
	if(confirm('Are you sure?')){
		$('#action').val('1');
		/*$('#approved-hours').dialog('open');*/
    submit();
		return false;
	}
	return false;
});
$('#btn-deny').click(function(){
	if(confirm('Are you sure?')){
		$('#action').val('0');
		$('#dialog-denial-reason').dialog('open');
		return false;
	}
	return false;
});

function submit(){
	$.post('".Yii::app()->createUrl('/hrisOtApplication/formyapproval')."',$('#hris-ot-application-form-approval').serialize(),function(response){
		alert(response);
		location.reload();
	});
}
");
?>

<h1><?php echo Yii::t('app', 'For My Approval'); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<div class="form">
<?php 
 	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'hris-ot-application-form-approval',
	));
  
  
 	$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-ot-application-grid',
	'dataProvider' => $model->getOTForApproval(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/formyapprovalview', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'selectableRows'=>'10',	
	'filter' => $model,
	'columns' => array(
		/*array(
			'name'=>'',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>5),
			'value'=>'',
		),*/
		array(
			'class'=>'OTCheckBoxColumn',
		 ),

		'id',
		array(
				'name'=>'job_code_id',
				'value'=>'GxHtml::valueEx($data->jobCode)',
				'filter'=>false,
				),
    
		array(
				'header'=>'Requesting Employee',
				'name'=>'emp_id',
				'value'=>'$data->emp->getEmpIdFullName()',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAll(),'Emp_ID','EmpIdFullName'),
				),
		// array(
				// 'name'=>'emp_id',
				// 'header'=>'Status',
				// 'value'=>'$data->getCurrentStatus()',
				// 'filter'=>false,
		// ),
		
		array(
			'name'=>'in_datetime',
			'value'=>'WebApp::formatDate($data->in_datetime)',
		),
		array(
			'name'=>'out_datetime',
			'value'=>'WebApp::formatDate($data->out_datetime)',
		),
		array(
			'name'=>'approved_hours',
					'value'=>'$data->approved_hours',
					'filter'=>false,
		),
		array(
			'header'=>'Approve Hours',
			'type'=>'raw',
			'name'=>'approved_hours',
					'value'=>'CHtml::textField("ot[$row][approved_hours]","$data->approved_hours",array("style"=>"width:20px;","maxlength"=>"2"))',
					'filter'=>false,
		),
		array(
			'header'=>'Overtime Type',
			'type'=>'raw',
			'name'=>'sub_code_id',
			'value'=>'CHtml::dropDownList("ot[$row][sub_code_id]",$data->sub_code_id,CHtml::listData(OtSubCode::model()->findAll(),"ot_code","title"))',
			'filter'=>false,
		),
		'reason',
		array(
			'name'=>'timestamp',
			'value'=>'WebApp::formatDate($data->timestamp)',
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
//echo CHtml::hiddenField('approved_hours','',array('name'=>'approved_hours','id'=>'approved_hours'));
echo "";
echo GxHtml::submitButton(Yii::t('app', 'Approve'), array('id'=>'btn-approve','class'=>'btn btn-info','value'=>'Approve')).
"&nbsp;&nbsp;&nbsp;&nbsp;"
.GxHtml::submitButton(Yii::t('app', 'Deny'), array('id'=>'btn-deny','class'=>'btn btn-warning','value'=>'Deny'));
echo '</div>';

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dialog-denial-reason',
    'options'=>array(
        'title'=>'Denial Reason',
        'width'=>250,
        'height'=>200,
        'autoOpen'=>false,
        'resizable'=>false,
        'modal'=>true,
        'closeOnEscape' => false,
        'buttons'=>array(
          'Submit'=>"js:function(){
              $('#denial_reason').val($('#denial-reason').val());
        			$('#denial-reason').val('');
        			$( this ).dialog( 'close' );
        			submit();
          }",
          'Cancel'=>"js:function(){
            $(this).dialog('close');
          }",
        ),     
    ),
));
echo CHtml::textArea('denial-reason',''); 
$this->endWidget('denial-reason');

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'approved-hours',
    'options'=>array(
        'title'=>'Approved Hours',
        'width'=>250,
        'height'=>200,
        'autoOpen'=>false,
        'resizable'=>false,
        'modal'=>true,
        'closeOnEscape' => false,
        'buttons'=>array(
          'Submit'=>"js:function(){
              $('#approved_hours').val($('#approved-hours').val());
        			$('#approved-hours').val('');
        			$( this ).dialog( 'close' );
        			submit();
          }",
          'Cancel'=>"js:function(){
            $(this).dialog('close');
          }",
        ),     
    ),
));
echo CHtml::textField('approved-hours',''); 
$this->endWidget('approved-hours');

$this->endWidget('hris-ot-application-form-approval');
?>
</div>

