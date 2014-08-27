<?php

$this->layout = 'column2';

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		array('label'=>Yii::t('app', 'Apply'),'url'=>array('create')),
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
	$.fn.yiiGridView.update('hris-mu-application-grid', {
		data: $(this).serialize()
	});
	/* $('.search-form').slideToggle();*/ 
	return false;
});
");
Yii::app()->clientScript->registerScript('search', "
function cancelMU(id){
  if(confirm('Are you sure you want to CANCEL make up application?')){
    var url = '".Yii::app()->createAbsoluteUrl('hrisMuApplication/cancel?id=')."' + id;
    $.post(url,function(response){
      if(response == '1')
        $.fn.yiiGridView.update('hris-mu-application-grid');
       else
        alert(response);    
    });
  }
}
", CClientScript::POS_BEGIN);
?>

<h1><?php echo Yii::t('app', 'My') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-mu-application-grid',
	'dataProvider' => $model->getMyMU(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed table-striped','style'=>'cursor:pointer;'),
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		array(
				'header'=>'Actions',
        'value'=>'$data->renderActionsColumn()',       
				),
    array(
				'name'=>'id',       
				),
		array(
				'name'=>'next_lvl_id',
				'value'=>'($data->nextLvl == null) ? "Reason Pending" : $data->nextLvl->status',
				'filter'=>GxHtml::listDataEx(HrisAccessLvl::model()->findAll(),'id','status'),
				),
		array(
				'name'=>'clockedin_datetime',
				'filter'=>false,
        'value'=>'WebApp::formatDate($data->clockedin_datetime)'
				),
		
		array(
				'name'=>'clockedout_datetime',
				'filter'=>false,
        'value'=>'WebApp::formatDate($data->clockedout_datetime)'
				),
		array(
				'name'=>'hours',
				'filter'=>false,
				),
		array(
				'name'=>'from_datetime',
				'filter'=>false,
        'value'=>'WebApp::formatDate($data->from_datetime)'
				),
		
		array(
				'name'=>'to_datetime',
				'filter'=>false,
        'value'=>'WebApp::formatDate($data->to_datetime)'
				),
// 		array(
// 			'class' => 'CButtonColumn',
//       'deleteConfirmation'=>'Are you sure you want to cancel this application?',
//       'deleteButtonUrl'=>'Yii::app()->createUrl("hrisMuApplication/cancel",array("id"=>"$data->id"))',
// 		),
	),
)); ?>