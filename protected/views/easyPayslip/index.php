<?php
/* @var $this EasyPayslipController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Easy Payslips',
);

$this->menu=array(
	array('label'=>'Create EasyPayslip', 'url'=>array('create')),
	array('label'=>'Manage EasyPayslip', 'url'=>array('admin')),
);
?>

<h1>Easy Payslips</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
