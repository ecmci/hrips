<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>
<?php
Yii::app()->clientScript->registerScript('browser-upgrade-warning',"
$(document).ready(function(){
	if($.browser.msie){
    $('#browser-warning').append('<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p><strong>Outdated Web Browser</strong></p><p>Please consider using the HTML5 compliant Firefox, Chrome or Opera browsers. Internet Explorer is, well, buggy as always.</p></div>');
    alert(\"It is strongly recommended that you use HTML5 and Ajax compliant browsers such as Firefox or Chrome. There have been reports that Internet Explorer is not functioning properly as expected, as this system leverages on HTML5 and Ajax technology. Call IT if you don't have Firefox or Chrome installed on your computer. We apologize for the inconvenience.\");		
		
	}
});
");
?>
<div class="page-header">
	<h1>Welcome. <small>Login to your account</small></h1>
  
</div>
<div class="row-fluid">
	
    <div style="float: none; margin-left: auto; margin-right: auto;" class="span5 well">
<?php
// 	$this->beginWidget('zii.widgets.CPortlet', array(
// 		'title'=>"Welcome",
// 	));
	
?>


    <img class="offset3" src="/images/logo-ecmci.png" />
    <!-- <p>Please fill out the following form with your login credentials:</p> -->
    
    <div class="form wide">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
        <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
    
        <div class="row">
            <?php echo $form->labelEx($model,'username'); ?>
            <?php echo $form->textField($model,'username',array('placeholder'=>'Employee ID','required'=>'required')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    
        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('placeholder'=>'Password','required'=>'required')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
    
        <div class="row">
             <?php //echo $form->checkBox($model,'rememberMe'); ?>
            <?php //echo $form->label($model,'rememberMe'); ?>                       
            <?php //echo $form->error($model,'rememberMe'); ?>
        </div>
		
		<div class="row">
			<!--<p><a class="offset4" href="<?php //echo Yii::app()->createAbsoluteUrl('admin/hrisUsers/recover'); ?>">Recover Password</a></p>-->			
		</div>
    
        <div class="row buttons">
            <?php echo CHtml::submitButton('Login',array('class'=>'btn btn btn-success btn-large')); ?>
        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->
	
  <div id="browser-warning"></div>
	
  <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p><strong>Access Policy</strong></p>
        <p>Access is strictly for EMCI employees only. All activities are logged for audit and security purposes. If you are not authorized to access this system, please close this window immediately.</p>
    </div>
	
	

<?php //$this->endWidget();?>

    </div>

</div>

