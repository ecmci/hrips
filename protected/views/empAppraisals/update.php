<?php
/* @var $this EmpAppraisalsController */
/* @var $model EmpAppraisals */

$this->breadcrumbs=array(
	'Emp Appraisals'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	//array('label'=>'List EmpAppraisals', 'url'=>array('index')),
	array('label'=>'Create', 'url'=>array('create')),
	//array('label'=>'View EmpAppraisals', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'View All', 'url'=>array('admin')),
);
?>

<h1>Update <?php //echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>