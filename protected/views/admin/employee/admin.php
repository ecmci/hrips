<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		array('label'=>Yii::t('app', 'New'),'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
	$('.search-form').hide();
});
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-grid', {
		data: $(this).serialize()
	});
	$('.search-form').slideToggle();
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		'Emp_ID',
		'Lname',
		'Fname',
		'Mname',
		'Fullname',
		'Position',
		/*
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
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>