<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */

$this->breadcrumbs=array(
	'Easy Payslips'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EasyPayslip', 'url'=>array('index')),
	array('label'=>'Create EasyPayslip', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#easy-payslip-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Payslips</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'easy-payslip-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
  'htmlOptions'=>array('class'=>'table table-striped table-condensed'), 
	'columns'=>array(
		'id',
    'ClientGroup',
    'PayPeriod',
		'EmployeeId',
		'LastName',
		'FirstName',
		'MiddleInitial',
    'Email',    
    //'isValid:boolean',
    array(
      'name'=>'isValid',
      'value'=>'$data->isValid ? "Yes" : "No"',
      'filter'=>CHtml::activeDropdownList($model,"isValid",array(""=>"All","0"=>"No","1"=>"Yes"),array('style'=>'width:75px;')),
    ),
    array(
      'name'=>'Emailed',
      'value'=>'$data->Emailed ? "Yes" : "No"',
      'filter'=>CHtml::activeDropdownList($model,"Emailed",array(""=>"All","0"=>"No","1"=>"Yes"),array('style'=>'width:75px;')),
    ),
    //'Emailed:boolean',
    'passkey',
    array(
      'name'=>'LastErrorMessage',
      'type'=>'raw',
    ),
		/*
		'Email',
		'Department',
		'StdRateSalary',
		'GP1',
		'FICAWH',
		'MedicareWH',
		'FederalWH',
		'StateWH',
		'LocalWH',
		'NetPay',
		'HoursWorked',
		'PayPeriod',
		'Timestamp',
		'Emailed',
		'LastErrorMessage',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
