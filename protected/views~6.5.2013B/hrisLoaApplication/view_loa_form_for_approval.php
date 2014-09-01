<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Back to My') . ' ' . $model->label(2), 'url'=>array('admin')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
	
);
?>

<h1><?php //echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>
<h3><?php echo $model->getHeaderTitle(); ?></h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'nullDisplay'=>'-',	
	'attributes' => array(
'id',
array(
	'name'=>'timestamp',
	'value'=>WebApp::formatDate($model->timestamp),
),
/*array(
			'name' => 'emp',
			'type' => 'raw',
			'value' => $model->emp !== null ? GxHtml::link(GxHtml::encode($model->emp->), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->emp, true))) : null,
			),*/
/*array(
			'name' => 'jobCode',
			//'type' => 'raw',
			//'value' => $model->jobCode !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobCode)), array('jobCode/view', 'id' => GxActiveRecord::extractPkValue($model->jobCode, true))) : null,
			'value'=>$model->jobCode->title,
			),*/
array(
	'name'=>'from_datetime',
	'value'=>WebApp::formatDate($model->from_datetime),
),
array(
	'name'=>'to_datetime',
	'value'=>WebApp::formatDate($model->to_datetime),
),
array(
	'name'=>'hours_requested',
	'value'=>$model->hours_requested,
),
// array(
// 	'name'=>'hours_approved',
// 	'value'=>$model->hours_approved,
// ),
'reason',
'remarks',
array(
			'name' => 'reliever',
			'type' => 'raw',
			'value' => $model->reliever !== null ? GxHtml::link(GxHtml::encode($model->reliever->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->reliever, true))) : null,
			),
'reliever_approve:boolean',
array(
	'name'=>'reliever_approve_datetime',
	'value'=>($model->reliever_approve_datetime !==null)?WebApp::formatDate($model->reliever_approve_datetime):null,
),
array(
			'name' => 'sup',
			'type' => 'raw',
			'value' => $model->sup !== null ? GxHtml::link(GxHtml::encode($model->sup->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->sup, true))) : null,
			),
'sup_approve:boolean',
array(
	'name'=>'sup_approve_datetime',
	'value'=>($model->sup_approve_datetime !==null)?WebApp::formatDate($model->sup_approve_datetime):null,
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
	'value'=>($model->mgr_approve_datetime !==null)?WebApp::formatDate($model->mgr_approve_datetime):null,
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
	'value'=>($model->hr_approve_datetime !==null)?WebApp::formatDate($model->hr_approve_datetime):null,
),
'hr_disapprove_reason',
	),
)); ?>

<h2><?php //echo GxHtml::encode($model->getRelationLabel('hrisLoaAttachments')); ?></h2>
<h2><?php echo "Attachments"; ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->hrisLoaAttachments as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link($relatedModel->real_filename,Yii::app()->baseUrl.'/uploads/'.$relatedModel->storage_filename,array('target'=>'_blank'));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
	//echo "<pre>";var_dump($model->attributes);echo "</pre>";
?>
