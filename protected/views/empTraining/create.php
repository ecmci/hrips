<?php
/* @var $this EmpTrainingController */
/* @var $model EmpTraining */

$this->breadcrumbs=array(
	'Emp Trainings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpTraining', 'url'=>array('index')),
	array('label'=>'Manage EmpTraining', 'url'=>array('admin')),
);
?>

<h1>Create EmpTraining</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>