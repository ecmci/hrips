<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>
<div class="row fluid">
<fieldset class="myclass">
	<table>
		<tr>
			<td><?php echo $form->label($model, 'ID'); ?>
				<?php echo $form->textField($model, 'ID'); ?> <!--'ID/id'-->
			</td>
			<td><?php echo $form->label($model, 'EmpID'); ?> <!--'EmpID/empId'-->
				<?php echo $form->dropDownList($model, 'EmpID', CHtml::listData(EmpInformation::model()->findAll(array('order'=>'EmpName ASC')),'EmpID','EmpName'),array('prompt'=>'All')); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->label($model, 'RaiseTypeID'); ?> <!--'RaiseTypeID/RaiseType'-->
			<?php echo $form->dropDownList($model, 'RaiseTypeID', CHtml::listData(EmpRaisetype::model()->findAll(array('order'=>'RaiseTypeCol ASC')),'recordid','RaiseTypeCol'),array('prompt'=>'All')); ?>
			</td>
			<td>
				<?php echo $form->label($model, 'DateEffective'); ?>  <!--'DateEffective/effectdate'-->
				<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,
					'attribute' => 'DateEffective', //<!--'DateEffective/effectdate'-->
					'value' => $model->DateEffective, //<!--'DateEffective/effectdate'-->
					'options' => array(
						'showButtonPanel' => true,
						'changeYear' => true,
						'changeMonth' => true,
						'dateFormat' => 'yy-mm-dd',
						),
					));
				 ?>
			</td>
		</tr>
		<tr>
			
			<td>
				<div class="row buttons">
					<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
					<?php echo CHtml::link('Print','#',array('class'=>'btn btn-success print-friendly'));  ?>
				</div>
			</td>
		</tr>
	</table>
</fieldset>	
</div>

	

<?php $this->endWidget(); ?>

</div><!-- search-form -->
