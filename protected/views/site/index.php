<?php
Yii::app()->clientScript->registerCss('index-css',"
.portlet-decoration{
  background-color:#eeeeee;
}
"); 
?>
<div class="row-fluid">
    <div class="span9">
        <div class="row-fluid">
            <div class="span12">
                <?php $this->renderPartial('_quick_facts',array('pending_ot'=>$pending_ot,'pending_loa'=>$pending_loa,)); ?>  
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php $this->renderPartial('_clock'); ?>  
            </div>  
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php $this->renderPartial('_punches'); ?>  
            </div>  
        </div>
    </div>
    <div class="span3">
        <?php $this->renderPartial('_profile',array('user'=>$user,'recent_notification_count'=>$recent_notification_count)); ?>
    </div>   
</div>
