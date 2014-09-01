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
'emp_id',
'schedule',
'datetime_in',
'datetime_out',
'sched_in',
'sched_out',
array(
			'name' => 'jobCode',
			'type' => 'raw',
			'value' => $model->jobCode !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobCode)), array('jobCode/view', 'id' => GxActiveRecord::extractPkValue($model->jobCode, true))) : null,
			),
'OT_code',
'breakflag',
'UTC_added',
'process',
'raw_mins_late',
'mins_late',
'hrs_late',
'hrs_patch',
'updated_to_payroll:boolean',
'Amt',
	),
)); ?>

