<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */

$this->breadcrumbs=array(
	'Easy Payslips'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EasyPayslip', 'url'=>array('index')),
	array('label'=>'Create EasyPayslip', 'url'=>array('create')),
	array('label'=>'View EasyPayslip', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EasyPayslip', 'url'=>array('admin')),
);
?>

<h1>Update EasyPayslip <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>