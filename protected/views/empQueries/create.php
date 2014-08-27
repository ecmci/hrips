<?php
/* @var $this EmpQueriesController */
/* @var $model EmpQueries */

$this->breadcrumbs=array(
	'Emp Queries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpQueries', 'url'=>array('index')),
	array('label'=>'Manage EmpQueries', 'url'=>array('admin')),
);
?>

<h1>Create EmpQueries</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>