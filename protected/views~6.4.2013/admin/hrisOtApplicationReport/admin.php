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
$(document).ready(function(){
	$('a.print-friendly').click(function(){
		var data = $('.search-form form').serialize();
		//alert(data);
		window.open('".Yii::app()->baseUrl."/index.php/admin/hrisOtApplicationReport/forprint/?' + data );
		return false;
	});
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
	'id' => 'hris-ot-application-grid',
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
				'name'=>'sub_code_id',
				'value'=>'GxHtml::valueEx($data->subCode)',
				//'filter'=>GxHtml::listDataEx(OtSubCode::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
		array(
				'name'=>'emp_id',
				'value'=>'$data->emp->getEmpIdFullName()',
				//'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
		array(
				'name'=>'next_lvl_id',
				'value'=>'$data->getCurrentStatus()',
				//'filter'=>GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)),
				'filter'=>false,
				),
// 		array(
// 				'name'=>'job_code_id',
// 				'value'=>'GxHtml::valueEx($data->jobCode)',
// 				'filter'=>GxHtml::listDataEx(JobCode::model()->findAllAttributes(null, true)),
// 				),
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
				'value'=>'$data->approved_hours',
				'filter'=>false,
				),
     
     array(
				'name'=>'approved_hours',
				'filter'=>false,
				'sortable'=>false,
				),
     array(
  			'name'=>'reason',
			'filter'=>false,
			'sortable'=>false,
  		),
     
		/*
		
		
		
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
				'name'=>'mgr_id',
				'value'=>'GxHtml::valueEx($data->mgr)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'mgr_approve',
					'value' => '($data->mgr_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'mgr_approve_datetime',
		'mgr_disapprove_reason',
		array(
				'name'=>'hr_id',
				'value'=>'GxHtml::valueEx($data->hr)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		'hr_approve',
		'hr_approve_datetime',
		'hr_disapprove_reason',
		array(
				'name'=>'employer_id',
				'value'=>'GxHtml::valueEx($data->employer)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		'employer_approve',
		'employer_approve_datetime',
		'employer_disapprove_reason',
		
		
		array(
			'class' => 'CButtonColumn',
		),
		*/
		
	),
)); 
//echo CHtml::link('Get Printer Friendly View','#',array('class'=>'print-friendly')); 
?>
