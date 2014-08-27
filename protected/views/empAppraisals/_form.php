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
	BS = document.getElementById('basicsalary').value;
	ND = document.getElementById('ndiff').value;
	EA = document.getElementById('allowance').value;
	NewTotal = parseFloat(BS) + parseFloat(ND) + parseFloat(EA);
	document.getElementById('sumtotal').value=NewTotal;
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
		<?php echo $form->labelEx($model,'EmpID'); ?>
		<?php echo $form->dropDownList($model, 'EmpID', CHtml::listData(EmpInformation::model()->findAll(array('order'=>'EmpName asc')),'EmpID','EmpName'),array('prompt'=>'- select -')); ?>
		<?php echo $form->error($model,'EmpID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'RaiseTypeID'); ?>
		<?php echo $form->dropDownList($model, 'RaiseTypeID', CHtml::listData(EmpRaisetype::model()->findAll(array('order'=>'recordid asc')),'recordid','RaiseTypeCol'),array('prompt'=>'- select -')); ?>
		<?php echo $form->error($model,'RaiseTypeID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ToSalary'); ?>
		<?php echo $form->textField($model,'ToSalary',array('size'=>20,'maxlength'=>20, 'id'=>'basicsalary','onkeyup'=>'sumUp()')); ?>
		<?php echo $form->error($model,'ToSalary'); ?>
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
	
	<div class="row">
		<?php echo $form->labelEx($model,'IncreaseTotal'); ?>
		<?php echo $form->textField($model, 'IncreaseTotal', array('size'=>20,'maxlength'=>20, 'id'=>'sumtotal','readonly'=>'true')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'DateEffective'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'name'=>'EmpAppraisals[DateEffective]',
				'value'=>$model->DateEffective,
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
		<?php echo $form->error($model,'DateEffective'); ?>
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