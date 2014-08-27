<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hris-document-form',
	//'enableAjaxValidation' => true,
  //'enableClientValidation' => true,
  'htmlOptions'=>array(
    'enctype' => 'multipart/form-data',
  ), 
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>
    
    <?php if(!$model->isNewRecord){ ?>
    <div class="row">    
    <?php echo $form->checkBox($model, 'replace_file'); ?>
    <?php echo $form->labelEx($model,'replace_file',array('style'=>'padding-left:10px;display:inline;')); ?>
    <?php //echo 'filename_real= '.$model->filename_real; ?>
    </div><!-- row -->
    <?php } ?>
    
    <div class="row">    
		<?php echo $form->labelEx($model,'filename_real'); ?>    
    <?php if($model->isNewRecord){ ?>
    <?php echo $form->fileField($model, 'filename_real',array('required'=>'required')); ?>
     <?php }else{
          echo $form->fileField($model, 'filename_real');
          echo $form->hiddenField($model, 'filename_real',array('value'=>$model->filename_real));
     } ?>
		<?php echo $form->error($model,'filename_real'); ?>    
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', GxHtml::listDataEx(HrisDocumentCategory::model()->findAllAttributes(null, true)),array('empty'=>'- select -','required'=>'required')); ?>
		<?php echo CHtml::link('Add New Category',Yii::app()->createUrl('hrisDocumentCategory/create')); ?>
    <?php echo $form->error($model,'category_id'); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php //echo $form->labelEx($model,'author_id'); ?>
		<?php //echo $form->dropDownList($model, 'author_id', GxHtml::listDataEx(Employee::model()->findAllAttributes(null, true))); ?>
		<?php //echo $form->error($model,'author_id'); ?>
    <?php echo $form->hiddenField($model,'author_id',array('value'=>Yii::app()->user->getState('emp_id'))); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
		<?php echo $form->error($model,'description'); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php //echo $form->labelEx($model,'created_timestamp'); ?>
		<?php //echo $form->textField($model, 'created_timestamp'); ?>
		<?php //echo $form->error($model,'created_timestamp'); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php //echo $form->labelEx($model,'updated_timestamp'); ?>
		<?php //echo $form->textField($model, 'updated_timestamp'); ?>
		<?php //echo $form->error($model,'updated_timestamp'); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php //echo $form->labelEx($model,'filename_storage'); ?>
		<?php //echo $form->textField($model, 'filename_storage', array('maxlength' => 100)); ?>
		<?php //echo $form->error($model,'filename_storage'); ?>
		</div><!-- row -->
		
    <div class="row">
		<?php //echo $form->labelEx($model,'active'); ?>
		<?php //echo $form->checkBox($model, 'active'); ?>
		<?php //echo $form->error($model,'active'); ?>
		</div><!-- row -->

    <?php include '_access1.php'; ?>

    <div class="row">
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class'=>'btn btn-success'));
$this->endWidget('GxActiveForm');
?>
    </div><!-- row -->
</div><!-- form -->