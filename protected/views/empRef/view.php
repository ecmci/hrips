<?php
/* @var $this EmpRefController */
/* @var $model EmpRef */

$this->breadcrumbs=array(
	'Emp Refs'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpRef', 'url'=>array('index')),
	array('label'=>'Create EmpRef', 'url'=>array('create')),
	array('label'=>'Update EmpRef', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpRef', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpRef', 'url'=>array('admin')),
);
?>

<h1>View EmpRef #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'RefName',
		'RefAdd',
		'Telno',
	),
)); ?>
