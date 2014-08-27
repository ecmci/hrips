<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		array('label'=>Yii::t('app', 'New'),'url'=>array('create')),
    array('label'=>Yii::t('app', 'Print as Report'), 'url'=>array('#'),'linkOptions'=>array('id' => 'get-report' )),
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
	$.fn.yiiGridView.update('tickets-grid', {
		data: $(this).serialize()
	});
	$('.search-form').slideToggle();
	return false;
});
$('#get-report').click(function(){
  var params =   $('.search-form form').serialize();
  window.location = '".Yii::app()->createAbsoluteUrl('tickets/report')."?'+params;
  return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'tickets-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'category_id',
				'value'=>'GxHtml::valueEx($data->category)',
				'filter'=>GxHtml::listDataEx(TicketsCategory::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'reported_by_id',
				'value'=>'$data->reportedBy->getFullName()',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'created_by_id',
				'value'=>'$data->createdBy->getFullName()',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'status',
				'value'=>'$data->status',
				'filter'=>false,
		),
    array(
				'name'=>'created_timestamp',
				'value'=>'$data->created_timestamp',
				'filter'=>false,
		),
		array(
				'name'=>'closed_timestamp',
				'value'=>'$data->closed_timestamp',
				'filter'=>false,
		),  		
		//'notes',
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>