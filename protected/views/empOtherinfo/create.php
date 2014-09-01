<?php
/* @var $this EmpOtherinfoController */
/* @var $model EmpOtherinfo */

$this->breadcrumbs=array(
	'Emp Otherinfos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmpOtherinfo', 'url'=>array('index')),
	array('label'=>'Manage EmpOtherinfo', 'url'=>array('admin')),
);
?>

<h1>Create EmpOtherinfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>