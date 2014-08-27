<?php
/* @var $this EmpOtherinfoController */
/* @var $model EmpOtherinfo */

$this->breadcrumbs=array(
	'Emp Otherinfos'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmpOtherinfo', 'url'=>array('index')),
	array('label'=>'Create EmpOtherinfo', 'url'=>array('create')),
	array('label'=>'View EmpOtherinfo', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmpOtherinfo', 'url'=>array('admin')),
);
?>

<h1>Update EmpOtherinfo <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>