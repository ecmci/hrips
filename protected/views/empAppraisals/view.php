<?php
/* @var $this EmpAppraisalsController */
/* @var $model EmpAppraisals */

$this->breadcrumbs=array(
	'Emp Appraisals'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List EmpAppraisals', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
//	array('label'=>'Update', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'View All', 'url'=>array('admin')),
);
?>

<h1>View  <?php //echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'ID',
		//'EmpID',
		array('name'=>'EmpID',
			'value'=>$model->emp->EmpName,
		),
		//'FromSalary',
		//'ToSalary',
		//'DateEffective',
		//'prevMove',
		'curMove',
		'NightDiff',
		'ExtraAllowance',
		//'IncreaseTotal',
		'effectdate',
		'Notes',
		array('name'=>'UpdateToPayroll',
			'value'=>$model->UpdateToPayroll=="1" ? "Yes" : "No",
		),
	),
)); ?>
