<?php
/* @var $this EmpWorkexpController */
/* @var $model EmpWorkexp */

$this->breadcrumbs=array(
	'Emp Workexps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpWorkexp', 'url'=>array('index')),
	array('label'=>'Manage EmpWorkexp', 'url'=>array('admin')),
);
?>

<h1>Create EmpWorkexp</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>