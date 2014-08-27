<?php
/* @var $this EmpEducbgController */
/* @var $model EmpEducbg */

$this->breadcrumbs=array(
	'Emp Educbgs'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpEducbg', 'url'=>array('index')),
	array('label'=>'Create EmpEducbg', 'url'=>array('create')),
	array('label'=>'View EmpEducbg', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpEducbg', 'url'=>array('admin')),
);
?>

<h1>Update EmpEducbg <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>