<?php
/* @var $this EmpCivilserviceController */
/* @var $model EmpCivilservice */

$this->breadcrumbs=array(
	'Emp Civilservices'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpCivilservice', 'url'=>array('index')),
	array('label'=>'Create EmpCivilservice', 'url'=>array('create')),
	array('label'=>'Update EmpCivilservice', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpCivilservice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpCivilservice', 'url'=>array('admin')),
);
?>

<h1>View EmpCivilservice #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'CareerService',
		'Rating',
		'DateExam',
		'ExamPlace',
		'LicenseNumber',
		'ReleaseDate',
	),
)); ?>
