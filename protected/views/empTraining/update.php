<?php
/* @var $this EmpTrainingController */
/* @var $model EmpTraining */

$this->breadcrumbs=array(
	'Emp Trainings'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpTraining', 'url'=>array('index')),
	array('label'=>'Create EmpTraining', 'url'=>array('create')),
	array('label'=>'View EmpTraining', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpTraining', 'url'=>array('admin')),
);
?>

<h1>Update EmpTraining <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>