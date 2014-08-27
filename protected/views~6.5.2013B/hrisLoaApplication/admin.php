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
	$('.search-form').hide();
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

");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php 
 	
 	$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-loa-application-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'selectableRows'=>'10',	
	'filter' => $model,
	'columns' => array(
		/*array(
			'name'=>'',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>5),
			'value'=>'',
		),*/
		/* array(
      	'class'=>'CCheckBoxColumn',   
      	'checkBoxHtmlOptions'=>array('name'=>'id[]'),   	
      ),*/

		'id',
		/*array(
				'name'=>'emp_id',
				'value'=>'$data->emp->getEmpIdFullName()',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAll(),'Emp_ID','EmpIdFullName'),
				),*/
		array(
				'name'=>'emp_id',
				'header'=>'Status',
				'value'=>'$data->getCurrentStatus()',
				'filter'=>false,
		),
		array(
				'name'=>'job_code_id',
				'value'=>'GxHtml::valueEx($data->jobCode)',
				'filter'=>GxHtml::listDataEx(JobCode::model()->findAll(array('condition'=>"title like '%LOA%'"))),
				),
		array(
			'name'=>'from_datetime',
			'value'=>'WebApp::formatDate($data->from_datetime)',
		),
		array(
			'name'=>'to_datetime',
			'value'=>'WebApp::formatDate($data->to_datetime)',
		),
    array(
			'name'=>'hours_requested',
			'value'=>'$data->hours_requested',
      'filter'=>false,
		),
//     array(
// 			'name'=>'hours_approved',
// 			'value'=>'$data->hours_approved',
//       'filter'=>false,
// 		),
		'reason',
		array(
			'name'=>'timestamp',
			'value'=>'WebApp::formatDate($data->timestamp)',
		),		
		/*
		'remarks',
		array(
				'name'=>'reliever_id',
				'value'=>'GxHtml::valueEx($data->reliever)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'reliever_approve',
					'value' => '($data->reliever_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'reliever_approve_datetime',
		array(
				'name'=>'sup_id',
				'value'=>'GxHtml::valueEx($data->sup)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'sup_approve',
					'value' => '($data->sup_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'sup_approve_datetime',
		'sup_disapprove_reason',
		array(
				'name'=>'hr_id',
				'value'=>'GxHtml::valueEx($data->hr)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'hr_approve',
					'value' => '($data->hr_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'hr_approve_datetime',
		'hr_disapprove_reason',
		*/
		array(
			'class' => 'CButtonColumn',
		),
		
	),
)); 

?>