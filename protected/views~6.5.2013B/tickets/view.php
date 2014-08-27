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
			'name' => 'category',
			'type' => 'raw',
			'value' => $model->category !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->category)), array('itTicketsCategory/view', 'id' => GxActiveRecord::extractPkValue($model->category, true))) : null,
			),
array(
			'name' => 'reportedBy',
			'type' => 'raw',
			'value' => $model->reportedBy !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->reportedBy)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->reportedBy, true))) : null,
			),
array(
			'name' => 'createdBy',
			'type' => 'raw',
			'value' => $model->createdBy !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->createdBy)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->createdBy, true))) : null,
			),
'status',
'notes',
'created_timestamp',
'closed_timestamp',
	),
)); ?>

