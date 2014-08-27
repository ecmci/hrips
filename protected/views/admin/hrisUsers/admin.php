<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
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
	$.fn.yiiGridView.update('hris-users-grid', {
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
	'id' => 'hris-users-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-striped table-hover table-condensed'),
	'filter' => $model,
	'columns' => array(
		'emp_id',
		array(
				'header'=>'Employee Name',				
				'name'=>'emp_id',
				'type'=>'raw',				
				'value'=>'$data->getFullName()',				
				'filter'=>CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')), 'Emp_ID', 'empIdFullName'),
				),
		//'password_md5',
		array(
				'name'=>'access_lvl_id',
				'value'=>'GxHtml::valueEx($data->accessLvl)',
				'filter'=>GxHtml::listDataEx(HrisAccessLvl::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'dept_id',
				'value'=>'GxHtml::valueEx($data->dept)',
				'filter'=>GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)),
				),
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>