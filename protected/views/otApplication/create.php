<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */

$this->breadcrumbs=array(
	'Ot Applications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OtApplication', 'url'=>array('index')),
	array('label'=>'Manage OtApplication', 'url'=>array('admin')),
);
?>

<h1>Create OtApplication</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>