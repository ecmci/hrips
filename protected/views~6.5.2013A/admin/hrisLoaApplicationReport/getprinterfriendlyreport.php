<?php include 'report-style.php';  ?>
<div class="report">
<img class="left logo" src="/images/logo-ecmci.png" />
<h1 class="right">LOA Report</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hris-loa-application-grid',
	'dataProvider' => $model->search(),
	'htmlOptions'=>array('class'=>''),
	'filter' => $model,
	'itemsCssClass'=>'printable-report',
	'summaryText'=>'Found {count} results',
	'columns' => array(		
		array(
			'name'=>'id',
			'filter'=>false,
		),
		array(
				'name'=>'emp_id',
				'value'=>'$data->emp->getEmpIdFullName()',
				'filter'=>false,
				),
		array(
				'name'=>'emp_id',
				'header'=>'Status',
				'value'=>'$data->getCurrentStatus()',
				'filter'=>false,
		),
		array(
				'name'=>'job_code_id',
				'value'=>'GxHtml::valueEx($data->jobCode)',
				'filter'=>false,
				),
		array(
			'name'=>'from_datetime',
			'value'=>'WebApp::formatDate($data->from_datetime)',
			'filter'=>false,
		),
		array(
			'name'=>'to_datetime',
			'value'=>'WebApp::formatDate($data->to_datetime)',
			'filter'=>false,
		),
		array(
			'name'=>'hours_requested',
			'htmlOptions'=>array('class'=>'center'),
			'filter'=>false,
		),
		array(
			'name'=>'reason',			
			'filter'=>false,
		),	
		array(
			'name'=>'timestamp',
			'value'=>'WebApp::formatDate($data->timestamp)',
			'filter'=>false,
		),		
		/*
		'remarks',
		array(
				'name'=>'reliever_id',
				'value'=>'GxHtml::valueEx($data->reliever)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'reliever_approve',
					'value' => '($data->reliever_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'reliever_approve_datetime',
		array(
				'name'=>'sup_id',
				'value'=>'GxHtml::valueEx($data->sup)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'sup_approve',
					'value' => '($data->sup_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'sup_approve_datetime',
		'sup_disapprove_reason',
		array(
				'name'=>'hr_id',
				'value'=>'GxHtml::valueEx($data->hr)',
				'filter'=>GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'hr_approve',
					'value' => '($data->hr_approve === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'hr_approve_datetime',
		'hr_disapprove_reason',
		
		array(
			'class' => 'CButtonColumn',
		),
		*/
	),
));
?>
<p>Generated: <?php echo date('Y-m-d h:i:s',time()); ?> by <?php echo Yii::app()->user->getState('emp_name'); ?></p>
</div>