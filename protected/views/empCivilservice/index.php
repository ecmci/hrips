<?php
/* @var $this EmpCivilserviceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Civilservices',
);

$this->menu=array(
	array('label'=>'Create EmpCivilservice', 'url'=>array('create')),
	array('label'=>'Manage EmpCivilservice', 'url'=>array('admin')),
);
?>

<h1>Emp Civilservices</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
