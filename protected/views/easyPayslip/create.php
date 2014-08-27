<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */

$this->breadcrumbs=array(
	'Easy Payslips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EasyPayslip', 'url'=>array('index')),
	array('label'=>'Manage EasyPayslip', 'url'=>array('admin')),
);
?>

<h1>Create EasyPayslip</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>