<?php
/* @var $this EmpOrganizationController */
/* @var $model EmpOrganization */

$this->breadcrumbs=array(
	'Emp Organizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpOrganization', 'url'=>array('index')),
	array('label'=>'Manage EmpOrganization', 'url'=>array('admin')),
);
?>

<h1>Create EmpOrganization</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>