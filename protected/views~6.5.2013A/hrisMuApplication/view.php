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

<h3><?php echo $model->getHeaderTitle(); ?></h3>
<h3></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'emp',
			'type' => 'raw',
			'value' => $model->emp !== null ? GxHtml::link(GxHtml::encode($model->emp->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->emp, true))) : null,
			),
array(
			'name' => 'jobCode',
			'type' => 'raw',
			'value' => $model->jobCode !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobCode)), array('jobCode/view', 'id' => GxActiveRecord::extractPkValue($model->jobCode, true))) : null,
			),
'clockedin_datetime',
'clockedout_datetime',
'from_datetime',
'to_datetime',
'reason',
'remarks',
array(
			'name' => 'reliever',
			'type' => 'raw',
			'value' => $model->reliever !== null ? GxHtml::link(GxHtml::encode($model->reliever->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->reliever, true))) : null,
			),
'reliever_approve:boolean',
'reliever_approve_datetime',
array(
			'name' => 'sup',
			'type' => 'raw',
			'value' => $model->sup !== null ? GxHtml::link(GxHtml::encode($model->sup->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->sup, true))) : null,
			),
'sup_approve:boolean',
'sup_approve_datetime',
'sup_disapprove_reason',

array(
			'name' => 'mgr',
			'type' => 'raw',
			'value' => $model->mgr !== null ? GxHtml::link(GxHtml::encode($model->mgr->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->sup, true))) : null,
			),
'mgr_approve:boolean',
'mgr_approve_datetime',
'mgr_disapprove_reason',

array(
			'name' => 'hr',
			'type' => 'raw',
			'value' => $model->hr !== null ? GxHtml::link(GxHtml::encode($model->hr->getEmpIdFullName()), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->hr, true))) : null,
			),
'hr_approve:boolean',
'hr_approve_datetime',
'hr_disapprove_reason',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('hrisMuAttachments')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->hrisMuAttachments as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('hrisMuAttachments/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>