<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Back to') . ' ' . $model->label(2), 'url'=>array('admin')),	
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->Emp_ID)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->Emp_ID), 'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>
<h3></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'Emp_ID',
'Lname',
'Fname',
'Mname',
'Fullname',
'Position',
'Department',
'Schedule',
'Emp_Status',
'Tax_Status',
'Birthday',
'Birthplace',
'Gender',
'Contact_No',
'Height',
'Weight',
'Blood_Type',
'Citizenship',
'Civil_Status',
'Spouse',
'Children',
'Email_Add',
'Account_Number',
'SSS',
'TIN',
'PHIL_HEALTH',
'PAG_IBIG',
'Permanent_Add',
'Residential_Add',
'Monthly_Basic',
'Total_Semi_Monthly',
'Starting_Salary',
'Days_Work',
'Monthly_Night_Diff',
'Date_Hired',
'Date_Regularized',
'Total_Days_Work',
'NDHrsperWk',
'NDHrsCutOff',
'Date_Terminated',
'Act_Status',
'YearEnder',
	),
)); ?>

