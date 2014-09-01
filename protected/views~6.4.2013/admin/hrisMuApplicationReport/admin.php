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
	$.fn.yiiGridView.update('hris-mu-application-report-grid', {
		data: $(this).serialize()
	});
	$('.search-form').slideToggle();
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Research') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-mu-application-report-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "/' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		array(
				'name'=>'id',
				'filter'=>false,
				),
		array(
				'name'=>'emp_id',
				'value'=>'GxHtml::valueEx($data->emp)',
				//'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
		array(
				'name'=>'dept_id',
				'value'=>'GxHtml::valueEx($data->dept)',
				//'filter'=>GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
		// array(
				// 'name'=>'job_code_id',
				// 'value'=>'GxHtml::valueEx($data->jobCode)',
				//'filter'=>GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true)),
				// 'filter'=>false,
				// ),
		array(
				'header'=>'Status',
				'name'=>'next_lvl_id',
				'value'=>'GxHtml::valueEx($data->nextLvl)',
				//'filter'=>GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)),
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
				'name'=>'reason',
				'filter'=>false,
				),
		array(
				'name'=>'timestamp',
				'value'=>'(($data->timestamp == null) ? "" : WebApp::formatDate($data->timestamp))',
				'filter'=>false,
				),
		/*
		'clockedout_datetime',
		'hours',
		'from_datetime',
		'to_datetime',
		'reason',
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
		'mgr_id',
		array(
					'name' => 'mgr_approve',
					'value' => '($data->mgr_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'mgr_approve_datetime',
		'mgr_disapprove_reason',
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
		'timestamp',
		array(
					'name' => 'replicated_to_emp_hrs',
					'value' => '($data->replicated_to_emp_hrs === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>