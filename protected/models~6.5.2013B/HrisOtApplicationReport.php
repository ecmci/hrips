<?php

Yii::import('application.models._base.BaseHrisOtApplicationReport');

class HrisOtApplicationReport extends BaseHrisOtApplicationReport
{
	
	public $hours;
	public $minutes;
  public $from,$to;
	/**
  	*	Gets the current form status
  	*	@return string Status
  	*/
  	public function getCurrentStatus(){
  		return $this->nextLvl->status;
  	}
	
	public function beforeSave(){
		$this->approved_hours = "$this->hours hours $this->minutes minutes";
		return parent::beforeSave();
    }
	
	public static function label($n = 1) {
		return Yii::t('app', 'Overtime Application|Overtime Applications', $n);
	}
	
	public static function representingColumn() {
		return 'id';
	}
	
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('dept_id', $this->dept_id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('sub_code_id', $this->sub_code_id, true);
		$criteria->compare('in_datetime', $this->in_datetime, true);
		$criteria->compare('out_datetime', $this->out_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		$criteria->compare('approved_hours', $this->approved_hours);
		$criteria->compare('sup_id', $this->sup_id);
		$criteria->compare('sup_approve', $this->sup_approve);
		$criteria->compare('sup_approve_datetime', $this->sup_approve_datetime, true);
		$criteria->compare('sup_disapprove_reason', $this->sup_disapprove_reason, true);
		$criteria->compare('mgr_id', $this->mgr_id);
		$criteria->compare('mgr_approve', $this->mgr_approve);
		$criteria->compare('mgr_approve_datetime', $this->mgr_approve_datetime, true);
		$criteria->compare('mgr_disapprove_reason', $this->mgr_disapprove_reason, true);
		$criteria->compare('hr_id', $this->hr_id);
		$criteria->compare('hr_approve', $this->hr_approve);
		$criteria->compare('hr_approve_datetime', $this->hr_approve_datetime, true);
		$criteria->compare('hr_disapprove_reason', $this->hr_disapprove_reason, true);
		$criteria->compare('employer_id', $this->employer_id);
		$criteria->compare('employer_approve', $this->employer_approve);
		$criteria->compare('employer_approve_datetime', $this->employer_approve_datetime, true);
		$criteria->compare('employer_disapprove_reason', $this->employer_disapprove_reason, true);
		$criteria->compare('replicated_to_emp_hrs', $this->replicated_to_emp_hrs);
		$criteria->compare('timestamp', $this->timestamp, true);
    
    if(empty($this->is_entered)){
      $criteria->compare('is_entered', '0', 'OR');
    }else{
       $criteria->compare('is_entered', $this->is_entered);
    }
    
    if(!empty($this->from) and !empty($this->to)){ // TimeIn >= from AND TimeIn <= to
      $criteria->addBetweenCondition('in_datetime',$this->from, $this->to.' 23:55:00');
    }elseif(!empty($this->from)){ // TimeIn >= from
      $criteria->addCondition("in_datetime >= '$this->from'");
    }elseif(!empty($this->to)){ // TimeIn <= to
      $criteria->addCondition("in_datetime <= '$this->to 23:55:00'");
    }

		$criteria->order = 'emp_id asc, in_datetime asc';
		
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array('pagesize'=>'10'),
		));
	}
  
  public function searchPrint() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('dept_id', $this->dept_id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('sub_code_id', $this->sub_code_id, true);
		$criteria->compare('in_datetime', $this->in_datetime, true);
		$criteria->compare('out_datetime', $this->out_datetime, true);

    
    if(empty($this->is_entered)){
      $criteria->compare('is_entered', '0');
    }else{
       $criteria->compare('is_entered', $this->is_entered);
    }
    
    if(!empty($this->from) and !empty($this->to)){ // TimeIn >= from AND TimeIn <= to
      $criteria->addBetweenCondition('in_datetime',$this->from, $this->to.' 23:55:00');
    }elseif(!empty($this->from)){ // TimeIn >= from
      $criteria->addCondition("in_datetime >= '$this->from'");
    }elseif(!empty($this->to)){ // TimeIn <= to
      $criteria->addCondition("in_datetime <= '$this->to 23:55:00'");
    }

		$criteria->order = 'emp_id asc, in_datetime asc';
		//$criteria->limit = 0;
    
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
      'pagination'=>false,
		));
	}
  
  public function getBriefReason(){
    return substr($this->reason,0,25).'...';
  }
	
	public function getHeaderTitle(){
  		$status = "Unknown";	
  		$employee = $this->emp->Lname.'('.$this->emp_id.')';
  		$loa_type = 'Overtime';
  		switch($this->next_lvl_id){
  			case HrisAccessLvl::$ULTIMATELY_APPROVED:
  				$status = "Approved";
  			break;
  			case HrisAccessLvl::$ULTIMATELY_DENIED:
  				$status = "Denied";
  			break;
  			case HrisAccessLvl::$EMPLOYEE:
  				$status = "Reason Pending"." | $employee | $loa_type";
  			break;
  			default:$status="Waiting on ".$this->nextLvl->status." | $employee | $loa_type";
  		}
  		return $status;
  	}
	
	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'dept_id' => Yii::t('app', 'Department'),
			'emp_id' => Yii::t('app', 'Employee ID'),
			'next_lvl_id' => Yii::t('app', 'Status'),
			'job_code_id' => Yii::t('app', 'OT Sub Code'),
			'sub_code_id' => Yii::t('app', 'OT Type'),
			'in_datetime' => Yii::t('app', 'In Datetime'),
			'out_datetime' => Yii::t('app', 'Out Datetime'),
			'reason' => Yii::t('app', 'Reason'),
			'approved_hours' => Yii::t('app', 'Approved Hours'),
			'sup_id' => Yii::t('app', 'Supervisor'),
			'sup_approve' => Yii::t('app', 'Supervisor Approve'),
			'sup_approve_datetime' => Yii::t('app', 'Supervisor Approve Datetime'),
			'sup_disapprove_reason' => Yii::t('app', 'Supervisor Disapprove Reason'),
			'mgr_id' => Yii::t('app', 'Manager'),
			'mgr_approve' => Yii::t('app', 'Manager Approve'),
			'mgr_approve_datetime' => Yii::t('app', 'Manager Approve Datetime'),
			'mgr_disapprove_reason' => Yii::t('app', 'Manager Disapprove Reason'),
			'hr_id' => Yii::t('app', 'Human Resource Personnel'),
			'hr_approve' => Yii::t('app', 'HR Approve'),
			'hr_approve_datetime' => Yii::t('app', 'HR Approve Datetime'),
			'hr_disapprove_reason' => Yii::t('app', 'HR Disapprove Reason'),
			'employer_id' => Yii::t('app', 'Employer'),
			'employer_approve' => Yii::t('app', 'Employer Approve'),
			'employer_approve_datetime' => Yii::t('app', 'Employer Approve Datetime'),
			'employer_disapprove_reason' => Yii::t('app', 'Employer Disapprove Reason'),
			'replicated_to_emp_hrs' => Yii::t('app', 'Replicated To Emp Hrs'),
			'timestamp' => Yii::t('app', 'Timestamp'),
			'employer' => Yii::t('app', 'Employer'),
			'sup' => Yii::t('app', 'Supervisor'),
			'mgr' => Yii::t('app', 'Manager'),
			'hr' => Yii::t('app', 'HR'),
			'jobCode' => Yii::t('app', 'Job Code'),
			'dept' => Yii::t('app', 'Department'),
			'nextLvl' => Yii::t('app', 'Status'),
			'emp' => Yii::t('app', 'Employee'),
			'hrisOtAttachments' => Yii::t('app', 'Attachments'),
      'is_entered' => Yii::t('app', 'Entered'),
		);
	}
	
	public function rules() {
		return array(
			array('dept_id, emp_id, next_lvl_id, job_code_id, sub_code_id, in_datetime, out_datetime, reason, timestamp', 'required'),
			array('dept_id, emp_id, next_lvl_id, job_code_id, sup_id, sup_approve, mgr_id, mgr_approve, hr_id, hr_approve, employer_id, employer_approve, replicated_to_emp_hrs', 'numerical', 'integerOnly'=>true),
			array('sub_code_id', 'length', 'max'=>10),
			array('approved_hours, hours, minutes, sup_approve_datetime, sup_disapprove_reason, mgr_approve_datetime, mgr_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, employer_approve_datetime, employer_disapprove_reason, is_entered, from, to', 'safe'),
			array('approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason, replicated_to_emp_hrs', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, dept_id, emp_id, next_lvl_id, job_code_id, sub_code_id, in_datetime, out_datetime, reason, approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason, replicated_to_emp_hrs, timestamp', 'safe', 'on'=>'search'),
		);
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}