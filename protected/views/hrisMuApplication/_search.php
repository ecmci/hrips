<div class="form">

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
    		<?php echo $form->label($model, 'from_datetime'); ?>
    		<?php echo $form->textField($model, 'from_datetime',array('placeholder'=>'yyyy-mm-dd h:m:s')); ?><span class="help-inline">Tip: You can use the >, < , >=, <= operators to define ranges. Example: >= 2013-06-23 23:30:00</span>
    	</div>    
    	<div class="span3">
    		<?php echo $form->label($model, 'to_datetime'); ?>
    		<?php echo $form->textField($model, 'to_datetime',array('placeholder'=>'yyyy-mm-dd h:m:s')); ?><span class="help-inline">Tip: You can use the >, < , >=, <= operators to define ranges.  Example: >= 2013-06-23 23:30:00</span>
    	</div>
      <div class="span3">
  		<?php echo $form->label($model, 'reliever_id'); ?>
  		<?php echo $form->dropDownList($model, 'reliever_id', Employee::getEmployeeListWithBadge(), array('prompt' => Yii::t('app', 'All'))); ?>
  	  </div>
      <div class="span3">
      <?php echo $form->label($model, 'next_lvl_id'); ?>
      <?php echo $form->dropDownList($model, 'next_lvl_id', HrisAccessLvl::getStatusList(), array('prompt' => Yii::t('app', ''))); ?>
      </div>
  </div>
  <div class="row fluid">
    
  </div>
  	



























	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search'), array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
