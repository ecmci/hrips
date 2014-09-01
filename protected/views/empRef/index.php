<?php
/* @var $this EmpRefController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Refs',
);

$this->menu=array(
	array('label'=>'Create EmpRef', 'url'=>array('create')),
	array('label'=>'Manage EmpRef', 'url'=>array('admin')),
);
?>

<h1>Emp Refs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
