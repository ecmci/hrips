<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu=array(
	//array('label'=>'List EmpInformation', 'url'=>array('index')),
	array('label'=>'Create PDS', 'url'=>array('create')),
	array('label'=>'View my PDS', 'url'=>array('view', 'id'=>Yii::app()->user->emp_id)),
	array('label'=>'Salary History', 'url'=>array('EmpAppraisals/admin')),
	//array('label'=>'Salary Appraisal', 'url'=>array('EmpAppraisals/admin')),
	array('label'=>'Generate Reports', 'url'=>array('ReportViewer/index'))
	
);

Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
	/*$('.search-form').hide();*/
});
$('.search-button').click(function(){
	$('.search-form').slideToggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('emp-information-grid', {
		data: $(this).serialize()
	});
	/*$('.search-form').slideToggle();*/
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
	'id' => 'emp-information-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	//'filter' => $model,
	'columns' => array(
		'EmpID',
		'EmpName',
		'Department',
		'Position',
		'EmailAddress',
		'DateHire',
		/*
		'ResidentialAddress',
		'RAZipCode',
		'RATelno',
		'HomeAddress',
		'HAZipCode',
		'HATelno',
		'ContactNo',
		'BirthDate',
		'BdayPlace',
		array(
				'name'=>'Gender',
				'value'=>'GxHtml::valueEx($data->gender)',
				'filter'=>GxHtml::listDataEx(EmpGender::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'CivilStat',
				'value'=>'GxHtml::valueEx($data->civilStat)',
				'filter'=>GxHtml::listDataEx(EmpCivilstat::model()->findAllAttributes(null, true)),
				),
		'Citizenship',
		'Height',
		'Weight',
		'BloodType',
		'DateHire',
		'DateRehire',
		'DateResignation',
		'DateTermination',
		'DateRetirement',
		'SSS',
		'TIN',
		'PHIC',
		'HDMF',
		'AcctNo',
		'AgencyEmpNo',
		'Department',
		'Position',
		'ExtensionNo',
		'OfficeSeatLocation',
		'EmailAddress',
		array(
					'name' => 'Tenant',
					'value' => '($data->Tenant === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'BedNo',
		'Allowance',
		'DateAPE',
		array(
					'name' => 'CertifyTrue',
					'value' => '($data->CertifyTrue === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'NewEmp',
					'value' => '($data->NewEmp === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'TaxCertNo',
		'IssuedAt',
		'IssuedOn',
		'DateAccomplished',
		'DateModified',
		'LastModifiedBy',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>