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
	$.fn.yiiGridView.update('hris-email-queue-for-forms-grid', {
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
	'id' => 'hris-email-queue-for-forms-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	'filter' => $model,
	'columns' => array(
		'id',
// 		array(
// 				'name'=>'template_id',
// 				'value'=>'GxHtml::valueEx($data->template)',
// 				'filter'=>GxHtml::listDataEx(HrisEmailTemplate::model()->findAllAttributes(null, true)),
// 				),
// 		array(
// 					'name' => 'to_group',
// 					'value' => '($data->to_group === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
// 					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
// 					),
// 		array(
// 					'name' => 'to_user',
// 					'value' => '($data->to_user === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
// 					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
// 					),
		'to',
		'subject',
    /*
	array(
					'name' => 'sent',
					'value' => '($data->sent === '0') ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
					*/
		'sent:boolean',
		'sent_timestamp',
		'timestamp',
		/*
		'content',
		'model_name',
		'model_id',
		array(
					'name' => 'sent',
					'value' => '($data->sent === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'sent_timestamp',
		'timestamp',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>