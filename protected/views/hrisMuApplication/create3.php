<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
  array('label'=>Yii::t('app', 'Back'), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'New') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form3', array(
		'model' => $model,
		'buttons' => 'create'));
?>