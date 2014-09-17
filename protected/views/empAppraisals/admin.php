<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', ''),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		array('label'=>Yii::t('app', 'Create'),'url'=>array('create')),
		//array('label'=>'Print (.pdf format)', 'url'=>array('PdsPrint/printallappraisal'),'linkOptions'=>array('target'=>'_blank')),
		array('label'=>'Back to PDS', 'url'=>array('EmpInformation/admin')),
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
	$.fn.yiiGridView.update('emp-appraisals-grid', {
		data: $(this).serialize()
	});
	/*$('.search-form').slideToggle();*/
	return false;
});
$('a.print-friendly').click(function(){
	var data = $('.search-form form').serialize();
	window.open('".Yii::app()->baseUrl."/index.php/empAppraisals/forprint/?' + data );
	return false;
});

");
?>

<h1><?php echo Yii::t('app', '') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<hr class="thin">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'emp-appraisals-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	//'filter' => $model,
	'columns' => array(
		//'ID',
		// array(
				// 'name'=>'EmpID',
				// 'value'=>'GxHtml::valueEx($data->emp)',
				// 'filter'=>GxHtml::listDataEx(EmpInformation::model()->findAllAttributes(null, true)),
				// ),
		array('name'=>'EmpID',
			'value'=>'$data->emp->EmpName'),
		array('name'=>'RaiseType',
			'value'=>'$data->raiseType->RaiseTypeCol'),
		'ToSalary',
		'NightDiff',
		'ExtraAllowance',
		'DateEffective',
		'Notes',
		/* array('name'=>'UpdateToPayroll',
			'value'=>'$data->UpdateToPayroll=="1" ? "Yes" : "No"'
		), */
		/*
		array(
					'name' => 'UpdateToPayroll',
					'value' => '($data->UpdateToPayroll === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
		/* array(
			'class' => 'CButtonColumn',
			'template'=>'{view}{delete}',
			'buttons'=>array(
				'view'=>array(
					'label'=>'view',					
					'url'=>'Yii::app()->controller->createUrl("/'.Yii::app()->controller->ID.'/view", array("id"=>$data->ID))',
					'options'=>array('target'=>'_blank'),
				),
				'delete'=>array(
					//'deleteConfirmation'=>"js:'Record with ID '+$(this).parent().parent().children(':first-child').text()+' will be deleted! Continue?'",
				),
			),
		), */
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>