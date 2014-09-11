<?php
$baseUrl = Yii::app()->baseUrl;
Yii::app()->clientScript->registerCss('quick-facts-css',"
.summary-icon{
  background: none repeat scroll 0 0 white;
  border: 1px solid #ddd;
  border-radius: 100%;
  box-shadow: 0 0 3px #eee inset;
  float: left;
  height: 36px;
  margin-right: 10px;
  padding: 6px;
  width: 36px;
}
.summary-number{
  display: block;
  font-size: 20px;
  font-weight: bold;
  padding-top: 8px;
}
.summary-title{
  color: #ab4000;
  display: block;
  font-size: 11px;
  text-transform: uppercase;
}
");
?>
<div class="portlet">               
  <div class="portlet-decoration">                     
    <div class="portlet-title">
      <i class="icon-signal"></i>In a Nutshell
    </div>               
  </div>             
  <div class="portlet-content">                      
    <div class="row-fluid">
      <div class="span4">
        <div class="row-fluid">
          <div class="span2">
            <span class="summary-icon"><img src="<?php echo $baseUrl; ?>/themes/abound/img/page_white_edit.png" width="36" height="36" /></span>             
          </div>
          <div class="span10">
            <span class="summary-number"><a title="View OT Forms for Approval" href="<?php echo Yii::app()->createUrl('hrisOtApplication/formyapproval'); ?>"><?php echo $pending_ot; ?></a></span>
            <span class="summary-title">Overtime Forms For Your Approval</span>   
          </div>
        </div>   
      </div>
      <div class="span4">
        <div class="row-fluid">
          <div class="span2">
            <span class="summary-icon"><img src="<?php echo $baseUrl; ?>/themes/abound/img/page_white_edit.png" width="36" height="36" /></span>             
          </div>
          <div class="span10">
            <span class="summary-number"><a title="View LOA Forms for Approval" href="<?php echo Yii::app()->createUrl('hrisLoaApplication/formyapproval'); ?>"><?php echo $pending_loa; ?></a></span>
            <span class="summary-title">LOA Forms For Your Approval</span>   
          </div>
        </div>   
      </div>
      <div class="span4">
        <div class="row-fluid">
          <div class="span2">
            <span class="summary-icon"><img src="<?php echo $baseUrl; ?>/themes/abound/img/folder_page.png" width="36" height="36" /></span>             
          </div>
          <div class="span10">
            <span class="summary-number"><?php //echo HrisLoaApplication::getVLCredits(Yii::app()->user->getState('emp_id'));  ?></span>
            <span class="summary-title">Temporarily Unavailable. Contact Admin / HR department to get your latest VL credits accrued.</span>   
          </div>
        </div> 
      </div>
     </div>                  
  </div>     
</div>