<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name.' | Dashboard, '.$user->getEmpIdFullName();
$baseUrl = Yii::app()->theme->baseUrl;
$rootUrl =  Yii::app()->baseUrl;
?>
<?php 
Yii::app()->clientScript->registerCss('dashboard',"
.profile-image{
    width:200px;
}
.feed{
    border-bottom:1px solid #dddddd;
    padding:10px;
}
.feed-image{
    width:70px;
}
.feed-author{
    display:inline;
}
.portlet-decoration{
    background-color: #DFF0D8;
    border-color: #D6E9C6;

}
.portlet-title{
    
}
.hero-unit{
    background-color:#F2F9EC;
    padding: 15px;
}
.hero-unit p{
  font-size:10pt;
} 
.parlabel{
  font-weight:bold;
  border-bottom:1px dotted gray;
} 
#plugin_container{
  height:370px;
}
");
$cs = Yii::app()->getClientScript();
$cs->registerScript('sdfds',"
$('#change-profile-pic').click(function(){
   $('#prof-pic-up-form').slideToggle();   
});
$('#prof-pic-up-form').hide();
",CClientScript::POS_READY);
// $root = Yii::app()->baseUrl;
// $cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($root.'/js/jdigiclock/lib/jquery.jdigiclock.js');
// $cs->registerCssFile($root.'/js/jdigiclock/css/jquery.jdigiclock.css');
// $cs->registerScript('',"
// $(document).ready(function() {
//     $('#digiclock').jdigiclock({
//       'clockImagesPath' : '".$root."/js/jdigiclock/images/clock/',
//       'weatherImagesPath' : '".$root."/js/jdigiclock/images/weather/',
//       'weatherLocationCode' : 'ASI|PH|RP073|MANILA', 
//         
//     });
//     $('#prof-pic-up-form').hide();
// });
// 
// $('#change-profile-pic').click(function(){
//   $('#prof-pic-up-form').slideToggle();
// });
// 
// ");
?>
<div class="row-fluid">  
  <div class="span3">
       <div class="portlet">
              <div class="portlet-decoration">
                  <div class="portlet-title"><i class="icon-signal"></i>Stats</div>
              </div><!--portlet-decoration-->
              <div class="portlet-content"> 
               <div class="summary">
            <ul>
          	<li>
          		<span class="summary-icon">
                	<img width="36" height="36" alt="Monthly Income" src="<?php echo $baseUrl ;?>/img/page_white_edit.png">
                </span>
                <span class="summary-number"><?php echo $pending_ot; ?></span>
                <span class="summary-title">Overtime Forms Waiting For Your Approval</span>
            </li>
            <li>
            	<span class="summary-icon">
                	<img width="36" height="36" alt="Open Invoices" src="<?php echo $baseUrl ;?>/img/page_white_edit.png">
                </span>
                <span class="summary-number"><?php echo $pending_loa; ?></span>
                <span class="summary-title">LOA Forms Waiting For Your Approval</span>
            </li>
             
            <li>
            	<span class="summary-icon">
                	<img width="36" height="36" alt="Open Quotes&lt;" src="<?php echo $baseUrl ;?>/img/folder_page.png">
                </span>
                <span class="summary-number"><?php //echo HrisLoaApplication::getVLCredits($user->Emp_ID); ?></span>
                <span class="summary-title">Temporarily Unavailable. Contact Admin / HR department to get your latest VL credits accrued.</span>
            </li>
            <?php /*
			     <li>
            	<span class="summary-icon">
                	<img width="36" height="36" alt="Active Members" src="<?php echo $baseUrl ;?>/img/folder_page.png">
                </span>
                <span class="summary-number"><?php echo HrisLoaApplication::getSLCredits($user->Emp_ID); ?></span>
                <span class="summary-title">Sick Leave Credits Accrued</span>
            </li>
			      */ ?>
          </ul>
        </div><!--summary-->  
              </div><!--portlet-content-->
        </div><!--portlet-->
    </div><!--span3-->

  <div class="span9">
    <div class="hero-unit">
      <div class="row-fluid">
            <div class="span3">
              <img class="img-polaroid img-rounded profile-image" src="<?php echo $rootUrl ;?>/images/profilepics/<?php echo $user->hrisUsers->image; ?>">
              <p><a id="change-profile-pic" href="#">Change Profile Picture</a></p>
                <div id="prof-pic-up-form">
                <?php $form = $this->beginWidget('GxActiveForm', array(
                	'action' => Yii::app()->createAbsoluteUrl('/admin/hrisUsers/updateprofilepic'),
                  'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                  'method'=>'post',
                ));
                ?>                
                <?php echo $form->hiddenField(new HrisUsers,'emp_id',array('value'=>Yii::app()->user->getState('emp_id'))); ?>
                <?php echo $form->fileField(new HrisUsers,'image'); ?>
                <?php echo CHtml::submitButton('Upload',array('class'=>'btn')); ?>             
                <?php $this->endWidget(); ?>
                </form>
                 </div>
              <h2>Hello, <?php echo Yii::app()->user->name; ?></h2>
              <?php if($recent_notification_count == 1){ ?>
              <p><i class="icon-warning-sign"></i> <strong class="text-error"><?php echo $recent_notification_count;  ?> action needs your attention.</strong></p>
              <?php }elseif($recent_notification_count > 1){ ?>
              <p><i class="icon-warning-sign"></i> <strong class="text-error"><?php echo $recent_notification_count;  ?> actions need your attention.</strong></p>
              <?php } ?>  
            </div>
            <div class="span2">
                <fieldset><legend>About You</legend>
                  <p class="parlabel"><strong>Employee ID:</strong> <?php echo $user->Emp_ID; ?></p>
                  <p class="parlabel"><strong>Department:</strong> <?php echo $user->Department; ?></p>
                  <p class="parlabel"><strong>Position:</strong><?php echo $user->Position; ?> (Contact HR if this is incorrect.)</p>
                  <p class="parlabel"><strong>Today's Shift:</strong> <?php echo WebApp::getMyDaysShiftSchedule($user->Emp_ID); ?></p>
                </fieldset>
            </div>
            <div class="span7" style="text-align:right;">                
                <?php $this->widget('ext.jflipclock.JFlipClock'); ?>
            </div>
      </div>
    </div><!--hero unit-->
  </div><!--span9-->
   
    	
    
		
    


</div><!--row fluid-->

<div class="row-fluid">
    
  <div class="span3">
          <div class="portlet">
              <div class="portlet-decoration">
                  <div class="portlet-title"><i class="icon-bullhorn"></i>Announcements</div>
              </div><!--portlet-decoration-->
              <div class="portlet-content">
                <?php
                  $this->widget('zii.widgets.CListView', array(
                  'dataProvider'=>$announcement->search(),
                  'itemView'=>'_feed',   // refers to the partial view named '_post'
                  // 'enablePagination'=>true   
                   )
                  );
                ?>  
              </div><!--portlet-content-->
          </div><!--portlet-->
      </div><!--span4-->
      
      <div class="span9">
       <div class="portlet">
            <div class="portlet-decoration">
                <div class="portlet-title"><i class="icon-time"></i>Real-TimeSheet <small>(For corrections, please email <strong style="color:red; border-bottom: 2px solid red;">employee_attendance@evacare.com</strong> or contact <strong style="color:red; border-bottom: 2px solid red;">Roberly [ext 104], Eunice [ext 126] or Laarni [ext 103]</strong>.)<br/><span style="color:red;">Please do not email IT for time clock corrections. Thank you.</span></small></div>
            </div><!--portlet-decoration-->
            <div class="portlet-content">
                <table class="table table-hover table-condensed table-striped table-bordered">
				<thead><tr><th>Clocked In</th><th>Clocked Out</th><th>Break</th><th>Job Code</th></tr></thead>
				<tbody>
				<?php
				//echo '<pre>';print_r($recent_punches->data);echo '</pre>';
				foreach($recent_punches->data as $r){
					echo '<tr>';
					echo '<td>'.(($r['ClockedIn']!=null) ? WebApp::formatPunchDatetime($r['ClockedIn']) : '').'</td>';
					echo '<td>'.(($r['ClockedOut']!=null) ? WebApp::formatPunchDatetime($r['ClockedOut']) : '').'</td>';
					echo '<td>'.(($r['BreakAfter']=='1')?'Yes':'No').'</td>';
					echo '<td>'.$r['JobCode'].'</td>';
					echo '</tr>';
				}
				?>
				</tbody>
				</table>				 
            </div><!--portlet-content-->
       </div><!--portlet-->
  </div><!--span9-->
          
</div><!--row fluid-->

