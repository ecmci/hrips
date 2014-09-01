<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */

$this->breadcrumbs=array(
	'Easy Payslips'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EasyPayslip', 'url'=>array('index')),
	array('label'=>'Create EasyPayslip', 'url'=>array('create')),
	array('label'=>'Update EasyPayslip', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EasyPayslip', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EasyPayslip', 'url'=>array('admin')),
);
?>

<h1>View EasyPayslip #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'EmployeeId',
		'ClientGroup',
		'LastName',
		'FirstName',
		'MiddleInitial',
		'Email',
		'Department',
		'StdRateSalary',
		'GP1',
		'FICAWH',
		'MedicareWH',
		'FederalWH',
		'StateWH',
		'LocalWH',
		'NetPay',
		'HoursWorked',
		'PayPeriod',
		'Timestamp',
		'Emailed',
		'LastErrorMessage',
	),
)); ?>
