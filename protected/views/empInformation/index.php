<?php
/* @var $this EmpInformationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Emp Informations',
);

$this->menu=array(
	array('label'=>'Create EmpInformation', 'url'=>array('create')),
	array('label'=>'Manage EmpInformation', 'url'=>array('admin')),
);
?>

<h1>Emp Informations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 

$curruser=HrisUsers::model()->findByPk(Yii::app()->user->emp_id);
$userlvl=$curruser->access_lvl_id;

echo "<br><br><br>".Yii::app()->user->emp_id; 
$employee=EmpInformation::model()->findByPk(Yii::app()->user->emp_id);
if(empty($employee)){ //employee must create PDS first
	echo "<br>Hello! You haven't created your PDS yet!";
	$this->redirect(array('create'));
}else{
	if($userlvl=='3' || $userlvl=='4'){
		//echo "<br>Hello! You have already created your PDS but since you're an admin/hr, you can still create PDS for other people!";
		$this->redirect(array('admin'));
	}else{
		//echo "<br>Hello! Sorry, you can't create anymore PDS!";
		$this->redirect(array('view','id'=>Yii::app()->user->emp_id));
	}
}
?>
