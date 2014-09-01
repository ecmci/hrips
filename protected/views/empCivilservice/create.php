<?php
/* @var $this EmpCivilserviceController */
/* @var $model EmpCivilservice */

$this->breadcrumbs=array(
	'Emp Civilservices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpCivilservice', 'url'=>array('index')),
	array('label'=>'Manage EmpCivilservice', 'url'=>array('admin')),
);
?>

<h1>Create EmpCivilservice</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>