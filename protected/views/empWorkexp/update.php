<?php
/* @var $this EmpWorkexpController */
/* @var $model EmpWorkexp */

$this->breadcrumbs=array(
	'Emp Workexps'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpWorkexp', 'url'=>array('index')),
	array('label'=>'Create EmpWorkexp', 'url'=>array('create')),
	array('label'=>'View EmpWorkexp', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpWorkexp', 'url'=>array('admin')),
);
?>

<h1>Update EmpWorkexp <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>