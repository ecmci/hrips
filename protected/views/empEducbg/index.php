<?php
/* @var $this EmpEducbgController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Educbgs',
);

$this->menu=array(
	array('label'=>'Create EmpEducbg', 'url'=>array('create')),
	array('label'=>'Manage EmpEducbg', 'url'=>array('admin')),
);
?>

<h1>Emp Educbgs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
