<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>
<div class="row fluid">
<fieldset class="myclass">
	<table>
		<tr>
			<td><?php echo $form->label($model, 'id'); ?>
				<?php echo $form->textField($model, 'id'); ?> <!--'ID/id'-->
			</td>
			<td><?php echo '<label>'.'Employee Name'.'</label>';//$form->label($model, 'empId'); ?> <!--'EmpID/empId'-->
				<?php //echo $form->dropDownList($model, 'empId', Yii::app()->Employee->getEmployeeList(),array('prompt'=>'All')); ?><?php echo $form->dropDownList($model, 'empId', CHtml::listData(EmpInformation::model()->findAll(array('order'=>'EmpName ASC')),'EmpID','EmpName'),array('prompt'=>'All')); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->label($model, 'RaiseType'); ?> <!--'RaiseTypeID/RaiseType'-->
			<?php echo $form->dropDownList($model, 'RaiseType', CHtml::listData(EmpRaisetype::model()->findAll(array('order'=>'RaiseTypeCol ASC')),'recordid','RaiseTypeCol'),array('prompt'=>'All')); ?>
			</td>
			<td>
				<?php echo $form->label($model, 'effectdate'); ?>  <!--'DateEffective/effectdate'-->
				<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,
					'attribute' => 'effectdate', //<!--'DateEffective/effectdate'-->
					'value' => $model->effectdate, //<!--'DateEffective/effectdate'-->
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
