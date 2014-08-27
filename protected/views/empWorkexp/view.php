<?php
/* @var $this EmpWorkexpController */
/* @var $model EmpWorkexp */

$this->breadcrumbs=array(
	'Emp Workexps'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpWorkexp', 'url'=>array('index')),
	array('label'=>'Create EmpWorkexp', 'url'=>array('create')),
	array('label'=>'Update EmpWorkexp', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpWorkexp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpWorkexp', 'url'=>array('admin')),
);
?>

<h1>View EmpWorkexp #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'FromDate',
		'ToDate',
		'PositionTitle',
		'Company',
		'MonthlySalary',
		'SalaryGrade',
		'StatAppointment',
		'GovtService',
	),
)); ?>
