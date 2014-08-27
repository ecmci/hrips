<?php
/* @var $this EmpEducbgController */
/* @var $model EmpEducbg */

$this->breadcrumbs=array(
	'Emp Educbgs'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpEducbg', 'url'=>array('index')),
	array('label'=>'Create EmpEducbg', 'url'=>array('create')),
	array('label'=>'Update EmpEducbg', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpEducbg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpEducbg', 'url'=>array('admin')),
);
?>

<h1>View EmpEducbg #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'Level',
		'NameofSchool',
		'DegreeCourse',
		'YearGrad',
		'HighestEarned',
		'FromDate',
		'ToDate',
		'ScholarshipReceived',
	),
)); ?>
