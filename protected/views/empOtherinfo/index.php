<?php
/* @var $this EmpOtherinfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Otherinfos',
);

$this->menu=array(
	array('label'=>'Create EmpOtherinfo', 'url'=>array('create')),
	array('label'=>'Manage EmpOtherinfo', 'url'=>array('admin')),
);
?>

<h1>Emp Otherinfos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
