<?php
/* @var $this EmpEducbgController */
/* @var $model EmpEducbg */

$this->breadcrumbs=array(
	'Emp Educbgs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpEducbg', 'url'=>array('index')),
	array('label'=>'Manage EmpEducbg', 'url'=>array('admin')),
);
?>

<h1>Create EmpEducbg</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>