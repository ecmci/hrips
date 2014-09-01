<?php
/* @var $this EmpAppraisalsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Appraisals',
);

$this->menu=array(
	array('label'=>'Create EmpAppraisals', 'url'=>array('create')),
	array('label'=>'Manage EmpAppraisals', 'url'=>array('admin')),
);
?>

<h1>Emp Appraisals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
