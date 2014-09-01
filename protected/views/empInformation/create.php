<?php
/* @var $this EmpInformationController */
/* @var $model EmpInformation */

$this->breadcrumbs=array(
	'Emp Informations'=>array('index'),
	'Create',
);
$curruser=HrisUsers::model()->findByPk(Yii::app()->user->emp_id);
$userlvl=$curruser->access_lvl_id;
if($userlvl=='3' || $userlvl=='4'){ //show this menu to admin and hr only
	$this->menu=array(
	//array('label'=>'List EmpInformation', 'url'=>array('index')),
	array('label'=>'View all PDS', 'url'=>array('admin')),
);
}

?>

<h1>PERSONAL DATA SHEET</h1>
<!--Create EmpInformation -->
<?php echo $this->renderPartial('_form', array('model'=>$model, 'modelFam'=>$modelFam, 'modChild'=>$modChild, 
				'modEduc'=>$modEduc, 'modCivil'=>$modCivil, 'modWork'=>$modWork, 'modOrg'=>$modOrg,
				'modTrain'=>$modTrain, 'modOther'=>$modOther, 'modQueries'=>$modQueries, 'modRef'=>$modRef, 'children_details'=>$children_details, 'children_error'=>$children_error, 'cvlservice_details'=>$cvlservice_details, 'cvlservice_error'=>$cvlservice_error,'workexp_details'=>$workexp_details, 'workexp_error'=>$workexp_error, 'cvcorg_details'=>$cvcorg_details, 'cvcorg_error'=>$cvcorg_error, 'training_details'=>$training_details, 'training_error'=>$training_error, 'ref_details'=>$ref_details, 'ref_error'=>$ref_error, 'query_error'=>$query_error,'educ_details'=>$educ_details)); ?>