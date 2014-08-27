<?php
/* @var $this EmpTrainingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Trainings',
);

$this->menu=array(
	array('label'=>'Create EmpTraining', 'url'=>array('create')),
	array('label'=>'Manage EmpTraining', 'url'=>array('admin')),
);
?>

<h1>Emp Trainings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
