<?php
/* @var $this EmpQueriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Queries',
);

$this->menu=array(
	array('label'=>'Create EmpQueries', 'url'=>array('create')),
	array('label'=>'Manage EmpQueries', 'url'=>array('admin')),
);
?>

<h1>Emp Queries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
