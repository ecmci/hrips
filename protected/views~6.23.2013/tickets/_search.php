<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', $model->getProblemCategoryList(),array('empty'=>'All')); ?> <span class="label">Tip:</span><span class="muted">Type in the keyword to jump directly to the right one.</span>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reported_by_id'); ?>
		<?php echo $form->dropDownList($model, 'reported_by_id', Employee::getEmployeeList(),array('empty'=>'Anyone')); ?><span class="label">Tip:</span><span class="muted">Type in the keyword to jump directly to the right one.</span>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created_by_id'); ?>
		<?php echo $form->dropDownList($model, 'created_by_id', Employee::getEmployeeList(),array('empty'=>'Anyone')); ?><span class="label">Tip:</span><span class="muted">Type in the keyword to jump directly to the right one.</span>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array(''=>'All', 'Open'=>'Open','Closed'=>'Closed'), array('maxlength' => 512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'notes'); ?>
		<?php echo $form->textArea($model, 'notes',array('placeholder'=>'Type a keyword(s) here separated by a space.')); ?>
	</div>

	<div class="row">
    <?php echo $form->label($model, 'from'); ?>
  	<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'Tickets[from]',
		    'value'=>$model->from, 		    	    		    
		    'options'=>array(
  				'showAnim'=>'fade',
  				'dateFormat'=>'yy-mm-dd',
  				'timeFormat'=>'hh:mm:ss',
  				'showMinute'=> false,            
		    ),
		    'language' => '',	
			  'mode'=>'date',
		));?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to'); ?>
  	<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'Tickets[to]',
		    'value'=>$model->to, 		    	    		    
		    'options'=>array(
  				'showAnim'=>'fade',
  				'dateFormat'=>'yy-mm-dd',
  				'timeFormat'=>'hh:mm:ss',
  				'showMinute'=> false,            
		    ),
		    'language' => '',	
			  'mode'=>'date',
		));?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
