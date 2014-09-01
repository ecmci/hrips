<?php
/* @var $this EmpChildrenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Childrens',
);

$this->menu=array(
	array('label'=>'Create EmpChildren', 'url'=>array('create')),
	array('label'=>'Manage EmpChildren', 'url'=>array('admin')),
);
?>

<h1>Emp Childrens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
