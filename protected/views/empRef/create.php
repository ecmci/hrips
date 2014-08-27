<?php
/* @var $this EmpRefController */
/* @var $model EmpRef */

$this->breadcrumbs=array(
	'Emp Refs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpRef', 'url'=>array('index')),
	array('label'=>'Manage EmpRef', 'url'=>array('admin')),
);
?>

<h1>Create EmpRef</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>