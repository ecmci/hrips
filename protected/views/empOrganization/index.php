<?php
/* @var $this EmpOrganizationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Organizations',
);

$this->menu=array(
	array('label'=>'Create EmpOrganization', 'url'=>array('create')),
	array('label'=>'Manage EmpOrganization', 'url'=>array('admin')),
);
?>

<h1>Emp Organizations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
