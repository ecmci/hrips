<?php
 Yii::import('application.models.HrisOtApplication0');
 
 class HrisOtApplication extends HrisOtApplication0{
    public function convertibleToMakeUp(){
      switch($this->next_lvl_id){
        case HrisAccessLvl::$EMPLOYEE : 
        case HrisAccessLvl::$SUPERVISOR : 
        case HrisAccessLvl::$MANAGER :
        case HrisAccessLvl::$HR :
        case HrisAccessLvl::$EMPLOYER :
        case HrisAccessLvl::$CANCELLED :
        case HrisAccessLvl::$ULTIMATELY_DENIED :
          return true;
        break;
        default: $this->addError('next_lvl_id','Aborted: This OT is either approved or discarded. Call IT for special cases.'); return false;
      }
    }
    
    public function renderActionsColumn(){
      $baseUrl = Yii::app()->createUrl('HrisOtApplication');
      $data = '
        <div class="btn-group">
          <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
            Action
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="'.$baseUrl.'/view/id/'.$this->id.'"><i class="icon-eye-open"></i> View</a></li>
            <li><a href="'.$baseUrl.'/sign/id/'.$this->id.'"><i class="icon-pencil"></i> Sign</a></li>
            <li><a href="'.$baseUrl.'/convertasmu/id/'.$this->id.'"><i class="icon-retweet"></i> Convert to Make Up</a></li>
            <li><a href="#" onclick="cancelOT('.$this->id.')"><i class="icon-trash"></i> Cancel</a></li>
          </ul>
        </div>
      ';
      echo $data;
    }
    
    public function printErrors(){
      $message = '';
      $errors = $this->getErrors();
      foreach($errors as $attrib=>$error){
        $message .= implode(', ',$error);
      }
      echo $message; 
    }
    
    public function rules() {
  		return array(
  			//cancel
        array('next_lvl_id','validateCancellation','cancel'=>'cancel'),
        
        array('reason','required','on'=>'update'),
        
        array('dept_id, emp_id, next_lvl_id, job_code_id, in_datetime, out_datetime, timestamp', 'required','on'=>'create'),
  			array('dept_id, emp_id, next_lvl_id, job_code_id, sup_id, sup_approve, mgr_id, mgr_approve, hr_id, hr_approve, employer_id, employer_approve', 'numerical', 'integerOnly'=>true),
  			array('reason, hours, minutes, sup_approve_datetime, sup_disapprove_reason, mgr_approve_datetime, mgr_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, employer_approve_datetime, employer_disapprove_reason, sub_code_id', 'safe'),
  			array('approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
  			array('id, dept_id, emp_id, next_lvl_id, job_code_id, in_datetime, out_datetime, reason, approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason, timestamp', 'safe', 'on'=>'search'),
  		);
  	}
    
    public function validateCancellation(){
      switch($this->next_lvl_id){
        case HrisAccessLvl::$EMPLOYEE : 
        case HrisAccessLvl::$SUPERVISOR : 
        case HrisAccessLvl::$MANAGER :
        case HrisAccessLvl::$HR :
        case HrisAccessLvl::$EMPLOYER :
          return true;
        break;
        default: $this->addError('next_lvl_id','Aborted: This OT is already either approved or discarded. Call IT for special cases.'); return false;
      }
    }
 }
?>