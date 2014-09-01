<?php
/* @var $this EmpRefController */
/* @var $model EmpRef */

$this->breadcrumbs=array(
	'Emp Refs'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpRef', 'url'=>array('index')),
	array('label'=>'Create EmpRef', 'url'=>array('create')),
	array('label'=>'View EmpRef', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpRef', 'url'=>array('admin')),
);
?>

<h1>Update EmpRef <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>