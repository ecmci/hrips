<?php
/* @var $this EmpInformationController */
/* @var $model EmpInformation */

/* $this->breadcrumbs=array(
	'Emp Informations'=>array('index'),
	$model->EmpID=>array('view','id'=>$model->EmpID),
	'Update',
); */

$this->menu=array(
	//array('label'=>'View Information', 'url'=>array('view', 'id'=>$model->EmpID)),
	//array('label'=>'View my PDS', 'url'=>array('view', 'id'=>Yii::app()->user->emp_id)),
	//array('label'=>'Create PDS', 'url'=>array('create')),
	array('label'=>'View my PDS ('.Yii::app()->user->emp_id .')', 'url'=>array('view', 'id'=>Yii::app()->user->emp_id)),
	array('label'=>'View all PDS', 'url'=>array('admin')),
	array('label'=>'Generate Reports', 'url'=>array('ReportViewer/index'))
	/* array('label'=>'List EmpInformation', 'url'=>array('index')),
	array('label'=>'Create EmpInformation', 'url'=>array('create')),
	array('label'=>'Manage EmpInformation', 'url'=>array('admin')),
	*/
	
);
?>

<h1>Update PDS of Employee  #<?php echo $model->EmpID; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model, 'modelFam'=>$modelFam, 'modChild'=>$modChild, 'children_details'=>$children_details,'children_error'=>$children_error,'modEduc'=>$modEduc,'educ_details'=>$educ_details,'modCivil'=>$modCivil,'cvlservice_details'=>$cvlservice_details,'cvlservice_error'=>$cvlservice_error,'modWork'=>$modWork,'workexp_details'=>$workexp_details,'workexp_error'=>$workexp_error,'modOrg'=>$modOrg,'cvcorg_details'=>$cvcorg_details,'cvcorg_error'=>$cvcorg_error,'modTrain'=>$modTrain,'training_details'=>$training_details,'training_error'=>$training_error,'modOther'=>$modOther,'modQueries'=>$modQueries,'modRef'=>$modRef,'ref_details'=>$ref_details)); ?>