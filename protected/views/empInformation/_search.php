<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>
<div class="row fluid">
<fieldset class="myclass">
	<table>
		<tr>
			<td><?php echo $form->label($model, 'EmpID'); ?>
			<?php echo $form->textField($model, 'EmpID'); ?>
			</td>
			<td><?php echo $form->label($model, 'EmpName'); ?>
			<?php echo $form->dropDownList($model, 'EmpName', CHtml::listData(EmpInformation::model()->findAll(array('order'=>'EmpName ASC')),'EmpName','EmpName'),array('prompt'=>'All')); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->label($model, 'BirthDate'); ?>
			<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'BirthDate',
				'value' => $model->BirthDate,
				'options' => array(
					'showButtonPanel' => true,
					'changeYear' => true,
					'changeMonth' => true,
					'dateFormat' => 'yy-mm-dd',
					),
				));
			?>
			</td>
			<td><?php echo $form->label($model, 'Gender'); ?>
			<?php echo $form->dropDownList($model, 'Gender', CHtml::listData(EmpGender::model()->findAll(array('order'=>'gender ASC')),'ID','gender'),array('prompt'=>'All')); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->label($model, 'CivilStat'); ?>
			<?php echo $form->dropDownList($model, 'CivilStat', CHtml::listData(EmpCivilstat::model()->findAll(array('order'=>'CivilStat ASC')),'ID','CivilStat'),array('prompt'=>'All')); ?>
			</td>
			<td><?php echo $form->label($model, 'Department'); ?>
			<?php echo $form->dropDownList($model, 'Department', CHtml::listData(EmployeeDepartment::model()->findAll(array('order'=>'Department ASC')),'Department','Department'),array('prompt'=>'All')); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->label($model, 'Position'); ?>
			<?php echo $form->dropDownList($model, 'Position', CHtml::listData(EmployeePosition::model()->findAll(array('order'=>'Position ASC')),'Position','Position'),array('prompt'=>'All')); ?>
			</td>
			<td><?php echo $form->label($model, 'DateHire'); ?>
				<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model' => $model,
					'attribute' => 'DateHire',
					'value' => $model->DateHire,
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
			<td colspan="2">
				<div class="row buttons" align="right">
				<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
				</div>
			</td>
		</tr>
	</table>
</fieldset>
</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
