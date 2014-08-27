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
");

Yii::app()->clientScript->registerScript('search', "
function cancelOT(id){
  if(confirm('Are you sure you want to CANCEL overtime application?')){
    var url = '".Yii::app()->createAbsoluteUrl('hrisOtApplication/cancel?id=')."' + id;
    $.post(url,function(response){
      if(response == '1')
        $.fn.yiiGridView.update('hris-ot-application-grid');
       else
        alert(response);    
    });
  }
}
",CClientScript::POS_BEGIN);

Yii::app()->clientScript->registerCss('selects',"
select {
  max-width: 220px;
}
");

?>

<h1><?php echo Yii::t('app', 'My ') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<div class="row-fluid">
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-ot-application-grid',
	'dataProvider' => $model->getMyOT(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed'),
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		array(   
        'header'=>'Actions',
				'value'=>'$data->renderActionsColumn()',
				),
    'id',
		array(
				'name'=>'sub_code_id',
				'value'=>'GxHtml::valueEx($data->subCode)',
				'filter'=>GxHtml::listDataEx(OtSubCode::model()->findAllAttributes(null, true)),
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
      array(   
        'name'=>'approved_hours',
        'header'=>'Rendered Hours',
				'value'=>'WebApp::actualHours($data->in_datetime,$data->out_datetime)',
				'filter'=>false,
				),
      array(
				'name'=>'next_lvl_id',
				'value'=>'$data->getCurrentStatus()',
				'filter'=>GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)),
				),
	),
)); ?>
</div>