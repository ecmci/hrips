<?php
/* @var $this OtApplicationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ot Applications',
);

$this->menu=array(
	array('label'=>'Create OtApplication', 'url'=>array('create')),
	array('label'=>'Manage OtApplication', 'url'=>array('admin')),
);
?>

<h1>Ot Applications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
