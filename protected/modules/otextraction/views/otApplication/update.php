<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */

$this->breadcrumbs=array(
	'Ot Applications'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OtApplication', 'url'=>array('index')),
	array('label'=>'Create OtApplication', 'url'=>array('create')),
	array('label'=>'View OtApplication', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OtApplication', 'url'=>array('admin')),
);
?>

<h1>Update OtApplication <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>