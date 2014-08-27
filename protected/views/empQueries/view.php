<?php
/* @var $this EmpQueriesController */
/* @var $model EmpQueries */

$this->breadcrumbs=array(
	'Emp Queries'=>array('index'),
	$model->EmpID,
);

$this->menu=array(
	array('label'=>'List EmpQueries', 'url'=>array('index')),
	array('label'=>'Create EmpQueries', 'url'=>array('create')),
	array('label'=>'Update EmpQueries', 'url'=>array('update', 'id'=>$model->EmpID)),
	array('label'=>'Delete EmpQueries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->EmpID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpQueries', 'url'=>array('admin')),
);
?>

<h1>View EmpQueries #<?php echo $model->EmpID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'EmpID',
		'ThirdDegreeRelated',
		'TDRdetails',
		'FourthDegreeRelated',
		'FDRdetails',
		'FormallyCharged',
		'ChargedDetails',
		'AdminOffense',
		'OffenseDetails',
		'CrimeConvicted',
		'CrimeDetails',
		'SeparatedService',
		'SSdetails',
		'ElectionCandidate',
		'ECdetails',
		'Indigenous',
		'IndiDetails',
		'DiffAbled',
		'DAdetails',
		'SoloParent',
		'SPdetails',
	),
)); ?>
