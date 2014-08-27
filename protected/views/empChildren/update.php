<?php
/* @var $this EmpChildrenController */
/* @var $model EmpChildren */

$this->breadcrumbs=array(
	'Emp Childrens'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpChildren', 'url'=>array('index')),
	array('label'=>'Create EmpChildren', 'url'=>array('create')),
	array('label'=>'View EmpChildren', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpChildren', 'url'=>array('admin')),
);
?>

<h1>Update EmpChildren <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>