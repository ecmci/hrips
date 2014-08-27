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
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>
<h3></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'dept',
			'type' => 'raw',
			'value' => $model->dept !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->dept)), array('hrisDept/view', 'id' => GxActiveRecord::extractPkValue($model->dept, true))) : null,
			),
array(
			'name' => 'emp',
			'type' => 'raw',
			'value' => $model->emp !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->emp)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->emp, true))) : null,
			),
array(
			'name' => 'nextLvl',
			'type' => 'raw',
			'value' => $model->nextLvl !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->nextLvl)), array('hrisAccessLvl/view', 'id' => GxActiveRecord::extractPkValue($model->nextLvl, true))) : null,
			),
array(
			'name' => 'jobCode',
			'type' => 'raw',
			'value' => $model->jobCode !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobCode)), array('jobCode/view', 'id' => GxActiveRecord::extractPkValue($model->jobCode, true))) : null,
			),
'sub_code_id',
'in_datetime',
'out_datetime',
'reason',
'approved_hours',
array(
			'name' => 'sup',
			'type' => 'raw',
			'value' => $model->sup !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->sup)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->sup, true))) : null,
			),
'sup_approve:boolean',
'sup_approve_datetime',
'sup_disapprove_reason',
array(
			'name' => 'mgr',
			'type' => 'raw',
			'value' => $model->mgr !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->mgr)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->mgr, true))) : null,
			),
'mgr_approve:boolean',
'mgr_approve_datetime',
'mgr_disapprove_reason',
array(
			'name' => 'hr',
			'type' => 'raw',
			'value' => $model->hr !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->hr)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->hr, true))) : null,
			),
'hr_approve',
'hr_approve_datetime',
'hr_disapprove_reason',
array(
			'name' => 'employer',
			'type' => 'raw',
			'value' => $model->employer !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->employer)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->employer, true))) : null,
			),
'employer_approve',
'employer_approve_datetime',
'employer_disapprove_reason',
'replicated_to_emp_hrs:boolean',
'timestamp',
	),
)); ?>

<h2> echo GxHtml::encode($model->getRelationLabel('hrisOtAttachments')); ?></h2>
<h2>Attachments</h2>
	echo GxHtml::openTag('ul');
	foreach($model->hrisOtAttachments as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('hrisOtAttachments/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>