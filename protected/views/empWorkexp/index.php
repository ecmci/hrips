<?php
/* @var $this EmpWorkexpController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Workexps',
);

$this->menu=array(
	array('label'=>'Create EmpWorkexp', 'url'=>array('create')),
	array('label'=>'Manage EmpWorkexp', 'url'=>array('admin')),
);
?>

<h1>Emp Workexps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
