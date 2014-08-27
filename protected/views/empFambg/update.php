<?php
/* @var $this EmpFambgController */
/* @var $model EmpFambg */

$this->breadcrumbs=array(
	'Emp Fambgs'=>array('index'),
	$model->EmpID=>array('view','id'=>$model->EmpID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpFambg', 'url'=>array('index')),
	array('label'=>'Create EmpFambg', 'url'=>array('create')),
	array('label'=>'View EmpFambg', 'url'=>array('view', 'id'=>$model->EmpID)),
	array('label'=>'Manage EmpFambg', 'url'=>array('admin')),
);
?>

<h1>Update EmpFambg <?php echo $model->EmpID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>