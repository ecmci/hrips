<?php
/* @var $this EmpQueriesController */
/* @var $model EmpQueries */

$this->breadcrumbs=array(
	'Emp Queries'=>array('index'),
	$model->EmpID=>array('view','id'=>$model->EmpID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpQueries', 'url'=>array('index')),
	array('label'=>'Create EmpQueries', 'url'=>array('create')),
	array('label'=>'View EmpQueries', 'url'=>array('view', 'id'=>$model->EmpID)),
	array('label'=>'Manage EmpQueries', 'url'=>array('admin')),
);
?>

<h1>Update EmpQueries <?php echo $model->EmpID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>