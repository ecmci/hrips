<?php
/* @var $this EmpFambgController */
/* @var $model EmpFambg */

$this->breadcrumbs=array(
	'Emp Fambgs'=>array('index'),
	$model->EmpID,
);

$this->menu=array(
	array('label'=>'List EmpFambg', 'url'=>array('index')),
	array('label'=>'Create EmpFambg', 'url'=>array('create')),
	array('label'=>'Update EmpFambg', 'url'=>array('update', 'id'=>$model->EmpID)),
	array('label'=>'Delete EmpFambg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->EmpID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpFambg', 'url'=>array('admin')),
);
?>

<h1>View EmpFambg #<?php echo $model->EmpID; ?></h1>

<?php
 $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'EmpID',
		'SpouseLname',
		'SpouseFname',
		'SpouseMname',
		'SpouseOccupation',
		'SpouseEmployer',
		'SpouseBusinessAddress',
		'SpouseTelno',
		'FatherLname',
		'FatherFname',
		'FatherMname',
		'MotherMaiden',
		'MotherLname',
		'MotherFname',
		'MotherMname',
		'Children',
	),
)); ?>
