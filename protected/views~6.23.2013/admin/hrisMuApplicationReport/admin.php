<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		array('label'=>Yii::t('app', 'New'),'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
	/*$('.search-form').hide();*/
});
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hris-mu-application-report-grid', {
		data: $(this).serialize()
	});
	/*$('.search-form').slideToggle();*/
	return false;
});

$('#btn-enter').click(function(){
  if(confirm('Are you sure you want to enter these records?')){
    var data = $('#hris-mu-application-research-form').serialize();
    var url = '".Yii::app()->createAbsoluteUrl(''.Yii::app()->controller->id.'/enter')."';
    $.post(url,data,function(data){   
        var response = $.parseJSON(data);
        var message = '';
        if(response){          
           message = response.ok_ids + '  ' + response.failed_ids;
        }else{
          message = 'Response cannot be parsed.';
        }  
        alert(message);
        location.reload();      
    });
  }  
});

$('a.print-friendly').click(function(){
	var data = $('.search-form form').serialize();
	window.open('".Yii::app()->baseUrl."/index.php/admin/hrisMuApplicationReport/forprint/?' + data );
	return false;
});

");
?>

<h1><?php echo Yii::t('app', 'Research') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Define Your Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search2', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php 
 	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'hris-mu-application-research-form',
	)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-mu-application-report-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-condensed table-striped'),
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "/' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
  'selectableRows'=>'10',
	'columns' => array(
		array(
			'class'=>'CCheckBoxColumn',
      'header'=>'Enter',     
			'checkBoxHtmlOptions'=>array('name'=>'row[]'), 
			'value'=>'$data->id',
		 ),
    array(
				'name'=>'id',
				'filter'=>false,
				),
		array(
				'name'=>'emp_id',
				'value'=>'$data->emp->getEmpIdFullName()',
				'filter'=>false,
				),
		array(
				'header'=>'Status',
				'name'=>'next_lvl_id',
				'value'=>'$data->nextLvl->status',
				'filter'=>false,
				),
		
		array(
				'name'=>'clockedin_datetime',
				'value'=>'(($data->clockedin_datetime == null) ? "" : WebApp::formatDate($data->clockedin_datetime))',
				'filter'=>false,
				),
		array(
				'name'=>'clockedout_datetime',
				'value'=>'(($data->clockedout_datetime == null) ? "" : WebApp::formatDate($data->clockedout_datetime))',
				'filter'=>false,
				),
		array(
				'name'=>'from_datetime',
				'value'=>'(($data->from_datetime == null) ? "" : WebApp::formatDate($data->from_datetime))',
				'filter'=>false,
				),
		array(
				'name'=>'to_datetime',
				'value'=>'(($data->to_datetime == null) ? "" : WebApp::formatDate($data->to_datetime))',
				'filter'=>false,
				),
    array(
				'name'=>'hours',
        'value'=>'$data->hours',
				'filter'=>false,
				),
		array(
				'name'=>'reason',
        'value'=>'$data->getBriefReason()',
				'filter'=>false,
				), 
		array(
			'class' => 'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array(
				'view'=>array(
					'label'=>'view',					
					'url'=>'Yii::app()->controller->createUrl("/'.Yii::app()->controller->id.'/view", array("id"=>$data->id))',
					'options'=>array('target'=>'_blank'),
				),
			),
		),
	),
)); 
$this->endWidget('hris-mu-application-research-form');
?>