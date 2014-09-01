<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->emp_id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->emp_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
array(
			'name' => 'emp',
			'type' => 'raw',
			'value' => $model->emp !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->emp)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->emp, true))) : null,
			),
'password_md5',
array(
			'name' => 'accessLvl',
			'type' => 'raw',
			'value' => $model->accessLvl !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->accessLvl)), array('hrisAccessLvl/view', 'id' => GxActiveRecord::extractPkValue($model->accessLvl, true))) : null,
			),
array(
			'name' => 'dept',
			'type' => 'raw',
			'value' => $model->dept !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->dept)), array('hrisDept/view', 'id' => GxActiveRecord::extractPkValue($model->dept, true))) : null,
			),
	),
)); ?>

