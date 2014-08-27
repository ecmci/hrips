<div class="form">
<fieldset><legend></legend>
<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<div class="row fluid">
	<div class="span3">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="span3">
		<?php echo $form->label($model, 'emp_id'); ?>
		<?php echo $form->dropDownList($model, 'emp_id', Employee::getEmployeeListWithBadge(), array('prompt' => Yii::t('app', ''))); ?>
	</div>

	<div class="span3">
		<?php echo $form->label($model, 'dept_id'); ?>
		<?php echo $form->dropDownList($model, 'dept_id', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', ''))); ?>
	</div>

	<div class="span3">
		<?php echo $form->label($model, 'next_lvl_id'); ?>
		<?php echo $form->dropDownList($model, 'next_lvl_id', HrisAccessLvl::getStatusList(), array('prompt' => Yii::t('app', ''))); ?>
	</div>

	<div class="span3">
		<?php echo $form->label($model, 'from'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisMuApplicationReport[from]',
		    'value'=>$model->from,		    	    		    
		    'options'=>array(
				  'showAnim'=>'fade',
          'dateFormat'=>'yy-mm-dd',          
		    ),
		    'language' => '',	
			  'mode'=>'date',
		));?>
	</div>

	<div class="span3">
		<?php echo $form->label($model, 'to'); ?>
		<?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
			 'model'=>$model,		    
		    'name'=>'HrisMuApplicationReport[to]',
		    'value'=>$model->to,		    	    		    
		    'options'=>array(
				  'showAnim'=>'fade',
          'dateFormat'=>'yy-mm-dd',          
		    ),
		    'language' => '',	
			  'mode'=>'date',
		));?>
	</div>

	<div class="span3">
		<?php echo $form->label($model, 'reason'); ?>
		<?php echo $form->textField($model, 'reason'); ?>
	</div>
  
  <div class="span3">		
		<?php echo $form->checkBox($model, 'is_entered'); ?>
    <?php echo CHtml::label('Show Entered Entries','Include Entered',array('style'=>'display:inline;')); ?>
	</div> 
  
  </div><!-- fluid-row -->
  
	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-warning')); ?>
    <?php echo CHtml::link('Enter','#',array('class'=>'btn btn-warning','id'=>'btn-enter')); ?> 
    <?php echo CHtml::link('Print','#',array('class'=>'btn btn-warning print-friendly'));  ?>  
	</div>
 
<?php $this->endWidget(); ?>
 </fieldset>
</div><!-- search-form -->

