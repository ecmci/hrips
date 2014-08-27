<?php
/* @var $this EmpFambgController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Fambgs',
);

$this->menu=array(
	array('label'=>'Create EmpFambg', 'url'=>array('create')),
	array('label'=>'Manage EmpFambg', 'url'=>array('admin')),
);
?>

<h1>Emp Fambgs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
