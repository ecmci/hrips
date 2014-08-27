<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		array('label'=>Yii::t('app', 'New'),'url'=>array('create'),'visible'=>(Yii::app()->user->getState('access_lvl_id')==HrisAccessLvl::$HR)),
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
	$.fn.yiiGridView.update('hris-ot-application-grid', {
		data: $(this).serialize()
	});
	/*$('.search-form').slideToggle();*/
	return false;
});
$(document).ready(function(){
	$('a.print-friendly').click(function(){
		var data = $('.search-form form').serialize();
		//alert(data);
		window.open('".Yii::app()->baseUrl."/index.php/admin/hrisOtApplicationReport/forprint/?' + data );
		return false;
	});
});

$('#btn-enter').click(function(){
  if(confirm('Are you sure you want to enter these records?')){
    var data = $('#hris-ot-application-research-form').serialize();
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

");
?>

<h1><?php echo Yii::t('app', 'Research') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search2', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php 
 	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'hris-ot-application-research-form',
	)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-ot-application-grid',
	'dataProvider' => $model->search(),
	//'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
  'htmlOptions'=>array('class'=>'table table-hover table-striped table-condensed'),
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
				//'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
    array(
				'name'=>'sub_code_id',
				'value'=>'GxHtml::valueEx($data->subCode)',
				//'filter'=>GxHtml::listDataEx(OtSubCode::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
		array(
				'name'=>'next_lvl_id',
				'value'=>'$data->getCurrentStatus()',
				//'filter'=>GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
    array(
  			'name'=>'in_datetime',
  			'value'=>'WebApp::formatDate($data->in_datetime)',
			'filter'=>false,
  		),
		 array(
  			'name'=>'out_datetime',
  			'value'=>'WebApp::formatDate($data->out_datetime)',
			'filter'=>false,
  		),
//       array(   
//         'name'=>'approved_hours',
// 				'value'=>'$data->approved_hours',
// 				'filter'=>false,
// 				),
     
     array(
				'name'=>'approved_hours',
				'filter'=>false,
				'sortable'=>false,
				),
     array(
  			'name'=>'reason',
        'value'=>'$data->getBriefReason()',
			'filter'=>false,
			'sortable'=>false,
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
$this->endWidget('hris-ot-application-research-form');
?>
