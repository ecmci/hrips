<?php
/* @var $this EmpChildrenController */
/* @var $model EmpChildren */

$this->breadcrumbs=array(
	'Emp Childrens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpChildren', 'url'=>array('index')),
	array('label'=>'Manage EmpChildren', 'url'=>array('admin')),
);
?>

<h1>Create EmpChildren</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'children_details'=>$children_details, 'children_error'=>$children_error)); //echo $this->renderPartial('_form', array('model'=>$model)); ?>