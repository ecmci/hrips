<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */

$this->breadcrumbs=array(
	'Ot Applications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OtApplication', 'url'=>array('index')),
	array('label'=>'Create OtApplication', 'url'=>array('create')),
	array('label'=>'Update OtApplication', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OtApplication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OtApplication', 'url'=>array('admin')),
);
?>

<h1>View OtApplication #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dept_id',
		'emp_id',
		'next_lvl_id',
		'job_code_id',
		'sub_code_id',
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
	),
)); ?>
