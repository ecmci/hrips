<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
		//array('label'=>Yii::t('app', 'New'),'url'=>array('create')),
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
	$.fn.yiiGridView.update('payroll-grid', {
		data: $(this).serialize()
	});
	$('.search-form').slideToggle();
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'My') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php //$this->renderPartial('_search', array(
	//'model' => $model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'payroll-grid',
	'dataProvider' => $model->search(),
	//'htmlOptions'=>array('class'=>'table table-hover table-condensed','style'=>'cursor:pointer;'),
	'htmlOptions'=>array('class'=>'table table-hover table-condensed'),
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/viewpayslip', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
	//'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/viewpayslip', array('paydate'=>$model->Payroll_Date)) . "';}",
	'filter' => $model,
	'columns' => array(
		//'id',
    
    
		array(
      'name'=>'Payroll_Date',
      'value'=>'date("M. d, Y",strtotime($data->Payroll_Date))',
      'filter'=>false,
    ),
    array(
      'name'=>'Payroll_Period',
      'value'=>'$data->Payroll_Period',
      'filter'=>false,
    ),
		//'Emp_ID',
		//'Emp_Name',
		//'Position',
		//'Department',
		//'Schedule',
		/*
		'Emp_Status',
		'Monthly_Basic',
		'Semi_Monthly_Basic',
		'Tax_Status',
		'Monthly_Night_Diff',
		'Total_Semi_Monthly',
		'Days_Work',
		'Late_Absent',
		'Extra_Allowance',
		'New_Salary_with_ND',
		'Total_Days_Work',
		'Per_Day',
		'Per_Hr',
		'Regular_Pay',
		'Total_Night_Diff',
		'ND_Per_Days',
		'Total_Days_with_ND',
		'Total_ND',
		'Total_Gross_Pay',
		'Total_Basic_Salary',
		'SSS',
		'Emp_Share_SSS',
		'EC',
		'PHIC',
		'Emp_Share_PHIC',
		'HDMF',
		'Emp_Share_HDMF',
		'Total_HDMF',
		'Total_Tax_Income',
		'Withholding_Tax',
		'SSS_Loan',
		'HDMF_Loan',
		'Insurance',
		'Rental_Housing',
		'Total_Deduction',
		'Non_PTO_Hrs',
		'Non_PTO_Amt',
		'Net_Pay',
		'Payroll_Period',
		'Payroll_Date',
		'Payroll_Date_Words',
		'Total_Earnings',
		'Overtime_hrs',
		'Overtime',
		'Regular_OT',
		'NDOT',
		'Spec_Holiday',
		'Spec_OT',
		'Spec_NDOT',
		'Reg_Holiday',
		'RegHoliday_OT',
		'RegHoliday_NDOT',
		'VL',
		'PTO_With_Tax',
		'PTO_Wo_Tax',
		'Basic_Pay',
		'Cash_Out',
		'Starting_Salary',
		'sumEverything',
		'initialYrEnder',
		'YearEnder',
		'Excess_to_13mo',
		'countLang',
		'Adjustment',
		'Salary_Adjustment',
		'Add_to_MB',
		'Add_to_ND',
		'Add_to_OT',
		'Add_to_PTO_With_Tax',
		'Add_to_SSS',
		'Add_to_PHIC',
		'Add_to_HDMF',
		'Add_to_Taxable_Income',
		'Add_to_NonTaxableDeduct',
		'Add_to_Tax_Due',
		'Taxable_Adj',
		'NonTaxableAdj',
		'Act_Status',
		'Rate_with_ND',
		*/
		array(
			'class' => 'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array(
				'view'=>array(
					'label'=>'View',					
					'url'=>'Yii::app()->controller->createUrl("/'.Yii::app()->controller->id.'/viewpayslip", array("paydate"=>$data->Payroll_Date))',
					'options'=>array('target'=>'_blank'),
				),
			),
		),
    
	),
)); ?>