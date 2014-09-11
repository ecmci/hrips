<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */

$this->breadcrumbs=array(
	'Ot Applications'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OtApplication', 'url'=>array('index')),
	array('label'=>'Create OtApplication', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ot-application-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ot Applications</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ot-application-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dept_id',
		'emp_id',
		'next_lvl_id',
		'job_code_id',
		'sub_code_id',
		/*
		'in_datetime',
		'out_datetime',
		'reason',
		'ifexistid',
		'approved_hours',
		'sup_id',
		'sup_approve',
		'sup_approve_datetime',
		'sup_disapprove_reason',
		'mgr_id',
		'mgr_approve',
		'mgr_approve_datetime',
		'mgr_disapprove_reason',
		'hr_id',
		'hr_approve',
		'hr_approve_datetime',
		'hr_disapprove_reason',
		'employer_id',
		'employer_approve',
		'employer_approve_datetime',
		'employer_disapprove_reason',
		'replicated_to_emp_hrs',
		'is_entered',
		'timestamp',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
