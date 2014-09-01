<?php
/* @var $this EmpChildrenController */
/* @var $model EmpChildren */

$this->breadcrumbs=array(
	'Emp Childrens'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpChildren', 'url'=>array('index')),
	array('label'=>'Create EmpChildren', 'url'=>array('create')),
	array('label'=>'Update EmpChildren', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpChildren', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpChildren', 'url'=>array('admin')),
);
?>

<h1>View EmpChildren #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'ChildName',
		'BirthDate',
	),
)); ?>
