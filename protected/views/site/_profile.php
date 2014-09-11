<div class="well"> 
  <div class="row-fluid">
    <div class="span12">
      <h2 class="page-header"><a href="<?php echo Yii::app()->createUrl('empInformation'); ?>" title="View PDS"><?php echo Yii::app()->user->emp_name; ?></a></h2>
      <img class="img-polaroid img-rounded profile-image" src="<?php echo Yii::app()->baseUrl; ?>/images/profilepics/<?php echo $user->hrisUsers->image; ?>">
    </div>
  </div>
  <div class="row-fluid">
     <div class="span12">
        <p><a id="change-profile-pic" href="#" onclick="$('#prof-pic-up-form').toggle();">Change Profile Picture</a></p>
        <div id="prof-pic-up-form" style="display:none;">
          <?php
          $form = $this->beginWidget('GxActiveForm', array(
            'action' => Yii::app()->createAbsoluteUrl('/admin/hrisUsers/updateprofilepic'),
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'method' => 'post',
          ));
          ?>                
          <?php echo $form->hiddenField(new HrisUsers, 'emp_id', array('value' => Yii::app()->user->getState('emp_id'))); ?>
          <?php echo $form->fileField(new HrisUsers, 'image'); ?>
          <?php echo CHtml::submitButton('Upload', array('class' => 'btn')); ?>             
          <?php $this->endWidget(); ?>
        </div>
     </div> 
  </div>
  <br/>
  <div class="row-fluid">
    <div class="span12">
      <?php if ($recent_notification_count == 1) { ?>                        
      <p class="alert alert-info">
        <i class="icon-warning-sign"></i> 
        <strong class="text-error">
          <?php echo $recent_notification_count; ?> action needs your attention.</strong>
      </p>                    
      <?php } elseif ($recent_notification_count > 1) { ?>                        
      <p class="alert alert-info">
        <i class="icon-warning-sign"></i> 
        <strong class="text-error">
          <?php echo $recent_notification_count; ?> actions need your attention.</strong>
      </p>
      <?php } ?> 
    </div>
  </div>
  <div class="row-fluid">
    <fieldset>
        <legend>About You
        </legend>                        
        <p class="parlabel"><strong>Employee ID:</strong> 
          <?php echo $user->Emp_ID; ?>
        </p>                        
        <p class="parlabel"><strong>Department:</strong> 
          <?php echo $user->Department; ?>
        </p>                        
        <p class="parlabel"><strong>Position:</strong>
          <?php echo $user->Position; ?> (Contact HR if this is incorrect.)
        </p>                        
        <p class="parlabel"><strong>Today's Shift:</strong> 
          <?php echo WebApp::getMyDaysShiftSchedule($user->Emp_ID); ?>
        </p>                    
      </fieldset>
  </div>
</div>