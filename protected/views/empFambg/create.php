<?php
/* @var $this EmpFambgController */
/* @var $model EmpFambg */

$this->breadcrumbs=array(
	'Emp Fambgs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpFambg', 'url'=>array('index')),
	array('label'=>'Manage EmpFambg', 'url'=>array('admin')),
);
?>

<h1>Create EmpFambg</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>