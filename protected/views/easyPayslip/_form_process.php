<?php
/* @var $this EasyPayslipController */
/* @var $model EasyPayslip */

$this->breadcrumbs=array(
	'Easy Payslips'=>array('index'),
	'Process',
);

$this->menu=array(
	//array('label'=>'List EasyPayslip', 'url'=>array('index')),
	//array('label'=>'Manage EasyPayslip', 'url'=>array('admin')),
);
?>

<h1>EasyACCT Payslip Generator and Emailer</h1>

<div class="form">
<?php Yii::app()->clientScript->registerScript('',"
$('#EasyPayslip_file').blur(function(){
  $('#ytEasyPayslip_file').val($('#EasyPayslip_file').val());
});
");?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'easy-payslip-form',
	'enableAjaxValidation'=>true,
  'htmlOptions'=>array(
    'enctype'=>"multipart/form-data",
  ),
)); ?>

  <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
  <div class="row fluid">
      <div class="row">
          <fieldset><legend>Step 1: <small>Upload CSV payroll file exported from EasyACCT.</small></legend>
            <div class="row">
          		<?php echo $form->labelEx($model,'payrollfile'); ?>
          		<?php echo $form->fileField($model,'payrollfile',array('required'=>'required','id'=>'EasyPayslip_file')); ?>
          		<?php echo $form->error($model,'payrollfile'); ?>
          	</div>  
          </fieldset>
          <fieldset><legend>Step 2: <small>Fill up the form below.</small></legend>
          	<div class="row">
          		<?php echo $form->labelEx($model,'ClientGroup'); ?>
          		<?php echo $form->textField($model,'ClientGroup',array('size'=>60,'maxlength'=>512,'required'=>'required')); ?>
          		<?php echo $form->error($model,'ClientGroup'); ?>
          	</div>
            <div class="row">
          		<?php echo $form->labelEx($model,'PayPeriod'); ?>
          		<?php echo $form->textField($model,'PayPeriod',array('size'=>60,'maxlength'=>512,'required'=>'required','placeholder'=>'e.g., Jun 1-15 2013')); ?>
          		<?php echo $form->error($model,'PayPeriod'); ?>
          	</div>
          </fieldset>
          <fieldset><legend>Step 3: <small>Generate And Send Pay Slips.</small></legend>
          <div class="row buttons">
        		<?php echo CHtml::submitButton('Generate And Send',array('class'=>'btn') ); ?>
        	</div>
          </fieldset>
      </div>
  </div>
  
  <?php $this->endWidget(); ?>
  
</div>

