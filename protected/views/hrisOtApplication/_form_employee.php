<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-ot-application-form',
	'enableAjaxValidation' => true,
));
?>
	<?php
    $flashMessages = Yii::app()->user->getFlashes();
    if ($flashMessages) {        
        foreach($flashMessages as $key => $message) {
            echo '<div class="alert alert-warning '.$key.'">';
            echo '<button class="close" data-dismiss="alert" type="button">x</button>';
            echo $message;
            echo '</div>';
        }
        
    }
    ?>
	
	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'in_datetime'); ?>
		<?php echo $form->textField($model, 'in_datetime',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'in_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'out_datetime'); ?>
		<?php echo $form->textField($model, 'out_datetime',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'out_datetime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textArea($model, 'reason',array('required'=>'required')); ?>
		<?php echo $form->error($model,'reason'); ?>
		</div><!-- row -->
		<?php			
			$diff = WebApp::diffBetweenDateTimeRange($model->in_datetime,$model->out_datetime);
			$hours = array();
			$minutes = array();
			for($i = 0 ; $i <= $diff['hours']; $i++)$hours[$i] = $i;
			//for($j = 0 ; $j <= $diff['mins'] ; $j++){ $mincount = $j < 10 ? '0'.$j : $j; $minutes[$mincount] = $mincount; }
			for($j = 0 ; $j < 60 ; $j++){ $mincount = $j < 10 ? '0'.$j : $j; $minutes[$mincount] = $mincount; }
		?>                                           
		<div class="row">
    <?php //echo 'HRS: '.$diff['hours']; ?>	
    <?php //echo 'MIN: '.$diff['mins']; ?>	
		<?php echo CHtml::label('Duration','Hours:Minutes'); ?>
    <?php echo CHtml::dropDownList('HrisOtApplication[hours]',$diff['hours'],$hours,array('style'=>'width:75px;')). ' hour(s) : '. CHtml::dropDownList('HrisOtApplication[minutes]',$diff['mins'],$minutes,array('style'=>'width:75px;')). ' minute(s)'; ?>
		</div><!-- row -->

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget();
?>
</div><!-- form -->