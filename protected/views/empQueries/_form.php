<?php
/* @var $this EmpQueriesController */
/* @var $model EmpQueries */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
function getVal(ThirdDegreeRelated)
{   
	var one_two_ml = $('input:radio[name=EmpQueries[ThirdDegreeRelated]]:checked').val();
   // var x=document.getElementsByName("EmpQueries[ThirdDegreeRelated]")[0].value;
	alert(one_two_ml);
}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-queries-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'EmpID'); ?>
		<?php echo $form->textField($model,'EmpID'); ?>
		<?php echo $form->error($model,'EmpID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ThirdDegreeRelated'); ?>
		<?php //echo $form->textField($model,'ThirdDegreeRelated'); 
			echo $form->radioButtonList($model,'ThirdDegreeRelated',
					array('1'=>'Yes','0'=>'No'),
					array('template'=>'{input}{label}',
						'separator'=>'',
						'labelOptions'=>array(
							'style'=> '
                                  padding-left:2px;
                                  width: 30px;
                                  float: left;
                                 '),
						'style'=>'float:left;',
					)
				);
		?>
		<?php echo $form->error($model,'ThirdDegreeRelated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TDRdetails'); ?>
		<?php echo $form->textArea($model,'TDRdetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'TDRdetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FourthDegreeRelated'); ?>
		<?php echo $form->textField($model,'FourthDegreeRelated'); ?>
		<?php echo $form->error($model,'FourthDegreeRelated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FDRdetails'); ?>
		<?php echo $form->textArea($model,'FDRdetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'FDRdetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FormallyCharged'); ?>
		<?php echo $form->textField($model,'FormallyCharged'); ?>
		<?php echo $form->error($model,'FormallyCharged'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ChargedDetails'); ?>
		<?php echo $form->textArea($model,'ChargedDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ChargedDetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AdminOffense'); ?>
		<?php echo $form->textField($model,'AdminOffense'); ?>
		<?php echo $form->error($model,'AdminOffense'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OffenseDetails'); ?>
		<?php echo $form->textArea($model,'OffenseDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'OffenseDetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CrimeConvicted'); ?>
		<?php echo $form->textField($model,'CrimeConvicted'); ?>
		<?php echo $form->error($model,'CrimeConvicted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CrimeDetails'); ?>
		<?php echo $form->textArea($model,'CrimeDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CrimeDetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SeparatedService'); ?>
		<?php echo $form->textField($model,'SeparatedService'); ?>
		<?php echo $form->error($model,'SeparatedService'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SSdetails'); ?>
		<?php echo $form->textArea($model,'SSdetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'SSdetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ElectionCandidate'); ?>
		<?php echo $form->textField($model,'ElectionCandidate'); ?>
		<?php echo $form->error($model,'ElectionCandidate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ECdetails'); ?>
		<?php echo $form->textArea($model,'ECdetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ECdetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Indigenous'); ?>
		<?php echo $form->textField($model,'Indigenous'); ?>
		<?php echo $form->error($model,'Indigenous'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IndiDetails'); ?>
		<?php echo $form->textArea($model,'IndiDetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'IndiDetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DiffAbled'); ?>
		<?php echo $form->textField($model,'DiffAbled'); ?>
		<?php echo $form->error($model,'DiffAbled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DAdetails'); ?>
		<?php echo $form->textArea($model,'DAdetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DAdetails'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SoloParent'); ?>
		<?php echo $form->textField($model,'SoloParent'); ?>
		<?php echo $form->error($model,'SoloParent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SPdetails'); ?>
		<?php echo $form->textArea($model,'SPdetails',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'SPdetails'); ?>
	</div>

	


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->