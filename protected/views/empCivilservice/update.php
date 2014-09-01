<?php
/* @var $this EmpCivilserviceController */
/* @var $model EmpCivilservice */

$this->breadcrumbs=array(
	'Emp Civilservices'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpCivilservice', 'url'=>array('index')),
	array('label'=>'Create EmpCivilservice', 'url'=>array('create')),
	array('label'=>'View EmpCivilservice', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpCivilservice', 'url'=>array('admin')),
);
?>

<h1>Update EmpCivilservice <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>