<?php
/* @var $this EmpOrganizationController */
/* @var $model EmpOrganization */

$this->breadcrumbs=array(
	'Emp Organizations'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpOrganization', 'url'=>array('index')),
	array('label'=>'Create EmpOrganization', 'url'=>array('create')),
	array('label'=>'View EmpOrganization', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpOrganization', 'url'=>array('admin')),
);
?>

<h1>Update EmpOrganization <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>