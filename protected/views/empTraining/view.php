<?php
/* @var $this EmpTrainingController */
/* @var $model EmpTraining */

$this->breadcrumbs=array(
	'Emp Trainings'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpTraining', 'url'=>array('index')),
	array('label'=>'Create EmpTraining', 'url'=>array('create')),
	array('label'=>'Update EmpTraining', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpTraining', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpTraining', 'url'=>array('admin')),
);
?>

<h1>View EmpTraining #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'SeminarTitle',
		'FromDate',
		'ToDate',
		'NoOfHrs',
		'ConductedBy',
	),
)); ?>
