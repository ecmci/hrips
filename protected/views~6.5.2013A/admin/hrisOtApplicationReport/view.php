<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Back to') . ' ' . $model->label(2), 'url'=>array('admin')),
	array('label'=>Yii::t('app', 'Printer Friendly Page'), 'url'=>array('hrisOtApplication/print/'.$model->id),'linkOptions'=>array('target'=>'_blank')),	
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo $model->getHeaderTitle(); ?></h1>
<h3></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
	'name'=>'timestamp',
	'value'=>($model->timestamp !== null) ?  WebApp::formatDate($model->timestamp) : null,
),
array(
			'name' => 'dept',
			'type' => 'raw',
			'value' => $model->dept !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->dept)), array('hrisDept/view', 'id' => GxActiveRecord::extractPkValue($model->dept, true))) : null,
			),
// array(
// 			'name' => 'emp',
// 			'type' => 'raw',
// 			'value' => $model->emp !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->emp)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->emp, true))) : null,
// 			),
// array(
// 			'name' => 'nextLvl',
// 			'type' => 'raw',
// 			'value' => $model->nextLvl !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->nextLvl)), array('hrisAccessLvl/view', 'id' => GxActiveRecord::extractPkValue($model->nextLvl, true))) : null,
// 			),
// array(
// 			'name' => 'jobCode',
// 			'type' => 'raw',
// 			'value' => $model->jobCode !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobCode)), array('jobCode/view', 'id' => GxActiveRecord::extractPkValue($model->jobCode, true))) : null,
// 			),
'in_datetime',
'out_datetime',
'reason',
'approved_hours',
array(
			'name' => 'sup',
			'type' => 'raw',
			'value' => $model->sup !== null ? GxHtml::link(GxHtml::encode($model->sup->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->sup, true))) : null,
			),
'sup_approve:boolean',

array(
	'name'=>'sup_approve_datetime',
	'value'=>($model->sup_approve_datetime !== null) ? WebApp::formatDate($model->sup_approve_datetime) : null,
),
'sup_disapprove_reason',
array(
			'name' => 'mgr',
			'type' => 'raw',
			'value' => $model->mgr !== null ? GxHtml::link(GxHtml::encode($model->mgr->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->mgr, true))) : null,
			),
'mgr_approve:boolean',

array(
	'name'=>'mgr_approve_datetime',
	'value'=>($model->mgr_approve_datetime !== null) ? WebApp::formatDate($model->mgr_approve_datetime) : null,
),
'mgr_disapprove_reason',
array(
			'name' => 'hr',
			'type' => 'raw',
			'value' => $model->hr !== null ? GxHtml::link(GxHtml::encode($model->hr->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->hr, true))) : null,
			),
'hr_approve:boolean',

array(
	'name'=>'hr_approve_datetime',
	'value'=>($model->hr_approve_datetime !== null) ? WebApp::formatDate($model->hr_approve_datetime) : null,
),
'hr_disapprove_reason',
array(
			'name' => 'employer',
			'type' => 'raw',
			'value' => $model->employer !== null ? GxHtml::link(GxHtml::encode($model->employer->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->employer, true))) : null,
			),
'employer_approve:boolean',

array(
	'name'=>'employer_approve_datetime',
	'value'=>($model->employer_approve_datetime !== null) ? WebApp::formatDate($model->employer_approve_datetime) : null,
),
'employer_disapprove_reason',


	),
)); ?>


<h2><?php //echo GxHtml::encode($model->getRelationLabel('hrisOtAttachments')); ?></h2>
<h2>Attachments</h2>
 <?php	echo GxHtml::openTag('ul');
	foreach($model->hrisOtAttachments as $relatedModel) {
		echo GxHtml::openTag('li');
		//echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), Yii::app()->createAbsoluteUrl('/uploads'));
		echo GxHtml::link($relatedModel->real_filename,Yii::app()->baseUrl.'/uploads/'.$relatedModel->storage_filename,array('target'=>'_blank'));
    echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>