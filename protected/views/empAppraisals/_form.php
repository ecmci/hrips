<?php
/* @var $this EmpAppraisalsController */
/* @var $model EmpAppraisals */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
var BS = 0;
var ND = 0;
var EA = 0;
var NewTotal = 0;

function sumUp()
{
	//BS = document.getElementById('basicsalary').value;
	//ND = document.getElementById('ndiff').value;
	//EA = document.getElementById('allowance').value;
	//NewTotal = parseFloat(BS) + parseFloat(ND) + parseFloat(EA);
	//document.getElementById('sumtotal').value=NewTotal;
}
function selectRaiseVal()
{
$('#poslist').hide();
$('#deptlist').hide();
//switch(document.getElementById('raise').value) {
	//case '3':
          // needs position list
		// $('#poslist').show();
		 //alert('Promotion');
      //  break;
	//case '4':
        //alert('Lateral Transfer'); //needs department list
	//	$('#deptlist').show();
     //   break;
  //  default:
        //alert(document.getElementById('raise').value);
	//	$('#poslist').hide();
		//$('#deptlist').hide();
//}
}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-appraisals-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'empId'); ?>
		<?php echo $form->dropDownList($model, 'empId', CHtml::listData(EmpInformation::model()->findAll(array('order'=>'EmpName asc')),'EmpID','EmpName'),array('prompt'=>'- select -', 'id'=>'myname')); //echo $form->dropDownList($model, 'EmpID', CHtml::listData(EmpInformation::model()->findAll(array('order'=>'EmpName asc')),'EmpID','EmpName'),array('prompt'=>'- select -'));?>
		<?php echo $form->error($model,'empId'); ?>
		<?php //echo $form->hiddenField($model, 'empId', CHtml::listData(EmpInformation::model()->find(),'EmpID','EmpName')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'RaiseType'); ?>
		<?php echo $form->dropDownList($model, 'RaiseType', CHtml::listData(EmpRaisetype::model()->findAll(array('order'=>'recordid asc')),'recordid','RaiseTypeCol'),array('prompt'=>'- select -', 'onchange'=>'selectRaiseVal()', 'id'=>'raise')); ?>
		<?php echo $form->error($model,'RaiseType'); ?>
	</div>
	
	<div class="row" id="poslist" style="display:none;">
		<?php echo '<label>Position</label>'; ?>
		<?php echo $form->dropDownList($model, 'movType', CHtml::listData(EmployeePosition::model()->findAll(array('order'=>'Position asc')),'Position','Position'),array('prompt'=>'- select -', 'id'=>'cbopos')); ?>
		<?php echo $form->error($model,'curMove'); ?>
	</div>
	
	<div class="row" id="deptlist" style="display:none;">
		<?php echo '<label>Department</label>'; ?>
		<?php echo $form->dropDownList($model, 'movType', CHtml::listData(EmployeeDepartment::model()->findAll(array('order'=>'Department asc')),'Department','Department'),array('prompt'=>'- select -', 'id'=>'cbodept')); ?>
		<?php echo $form->error($model,'curMove'); ?>
	</div>
	
	<div id="wagelist">
	<div class="row">
		<?php echo '<label>Salary</label>';//$form->labelEx($model,'curMove'); ?> <!--ToSalary-->
		<?php echo $form->textField($model,'curMove',array('size'=>20,'maxlength'=>20, 'id'=>'basicsalary'));//echo $form->textField($model,'ToSalary',array('size'=>20,'maxlength'=>20, 'id'=>'basicsalary','onkeyup'=>'sumUp()')); ?>
		<?php echo $form->error($model,'curMove'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'NightDiff'); ?>
		<?php echo $form->textField($model,'NightDiff',array('size'=>20,'maxlength'=>20,'id'=>'ndiff','onkeyup'=>'sumUp()')); ?>
		<?php echo $form->error($model,'NightDiff'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ExtraAllowance'); ?>
		<?php echo $form->textField($model,'ExtraAllowance',array('size'=>20,'maxlength'=>20, 'id'=>'allowance','onkeyup'=>'sumUp()')); ?>
		<?php echo $form->error($model,'ExtraAllowance'); ?>
	</div>
	
	<div class="row" style="display:none;">
		<?php echo $form->labelEx($model,'IncreaseTotal'); ?>
		<?php echo $form->textField($model, 'IncreaseTotal', array('size'=>20,'maxlength'=>20, 'id'=>'sumtotal','readonly'=>'true')); ?>
	</div>
	
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'effectdate'); ?> <!--DateEffective-->
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'name'=>'EmpAppraisals[effectdate]', //<!--DateEffective-->
				'value'=>$model->effectdate, //<!--DateEffective-->
				'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-03-11'),		    		    
				'options'=>array(
					'showAnim'=>'fade',
					'dateFormat'=>'yy-mm-dd',
					'changeMonth' => true,
					'changeYear' => true,
					//'maxDate' => '0',
					),
				'language' => '',	
				//'mode'=>'date',
				));?>
		<?php echo $form->error($model,'effectdate'); ?> <!--DateEffective-->
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Notes'); ?>
		<?php echo $form->textArea($model,'Notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Notes'); ?>
	</div>
	<?php if($this->EditMode){?>
		<div class="row">
		<input type="checkbox" id="chkUpdateToPayroll" name="chkUpdateToPayroll" <?php if($model->UpdateToPayroll==1) echo "checked='checked'"; ?> /> <b>SYNC TO PAYROLL AND NOTIFY PAYROLL MASTER</b></input>
		<?php echo $form->error($model,'UpdateToPayroll'); ?>
		</div>
	<?php }else{ ?>
		<div class="row">
		<input type="checkbox" id="chkUpdateToPayroll" name="chkUpdateToPayroll" <?php if(isset($_POST['chkUpdateToPayroll'])) echo "checked='checked'"; ?> /> <b>SYNC TO PAYROLL AND NOTIFY PAYROLL MASTER</b></input>
		<?php echo $form->error($model,'UpdateToPayroll'); ?>
		</div>
	<?php } ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update',array('class'=>'classname')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->