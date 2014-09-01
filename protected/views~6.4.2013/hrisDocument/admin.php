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
	$.fn.yiiGridView.update('hris-document-grid', {
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
	'id' => 'hris-document-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'category_id',
				'value'=>'GxHtml::valueEx($data->category)',
				'filter'=>GxHtml::listDataEx(HrisDocumentCategory::model()->findAllAttributes(null, true)),
				),
		'title',
		array(
			'name'=>'description',
			'value'=>'$data->description',
			'filter'=>false,
			),
		array(
				'name'=>'author_id',
				'value'=>'$data->author->getEmpIdFullName()',
				'filter'=>CHtml::listData(Employee::model()->findAll(array('order'=>'Lname asc')),'Emp_ID','EmpIdFullName'),
				),
    array(
			'name'=>'created_timestamp',
			'value'=>'$data->created_timestamp',
			'filter'=>false,
			),
		/*
		'updated_timestamp',
		'filename_storage',
		'filename_real',
		array(
					'name' => 'active',
					'value' => '($data->active === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>