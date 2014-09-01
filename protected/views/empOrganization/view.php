<?php
/* @var $this EmpOrganizationController */
/* @var $model EmpOrganization */

$this->breadcrumbs=array(
	'Emp Organizations'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmpOrganization', 'url'=>array('index')),
	array('label'=>'Create EmpOrganization', 'url'=>array('create')),
	array('label'=>'Update EmpOrganization', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmpOrganization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmpOrganization', 'url'=>array('admin')),
);
?>

<h1>View EmpOrganization #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EmpID',
		'NameAddressOrg',
		'FromDate',
		'ToDate',
		'NoOfHrs',
		'PositionNatureOfWork',
	),
)); ?>
