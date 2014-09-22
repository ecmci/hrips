<?php
/* @var $this EmpAppraisalsController */
/* @var $model EmpAppraisals */

$this->breadcrumbs=array(
	'Emp Appraisals'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List EmpAppraisals', 'url'=>array('index')),
	array('label'=>'View All', 'url'=>array('admin')),
);
?>

<h1>Employee Appraisals</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>