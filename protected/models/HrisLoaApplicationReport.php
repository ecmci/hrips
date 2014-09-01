<?php

Yii::import('application.models._base.BaseHrisLoaApplicationReport');


class HrisLoaApplicationReport extends BaseHrisLoaApplicationReport
{
	public $from, $to;
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules() {
		return array(
			array('emp_id, job_code_id, from_datetime, to_datetime, reason, reliever_id', 'required'),
			array('emp_id, job_code_id, reliever_id, reliever_approve, sup_id, sup_approve, hr_id, hr_approve', 'numerical', 'integerOnly'=>true),
			array('hours_requested, next_lvl_id, from_datetime,  to_datetime, remarks, reliever_approve_datetime, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, from, to, is_entered', 'safe'),
			array('remarks, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, emp_id, job_code_id, from_datetime, to_datetime, reason, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'safe', 'on'=>'search'),
		);
	}
  
  public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'emp_id' => Yii::t('app', 'Employee'),
                        'dept_id' => Yii::t('app', 'Department'),
                        'next_lvl_id' => Yii::t('app', 'Status'),
			'job_code_id' => Yii::t('app', 'Type'),
			'from_datetime' => Yii::t('app', 'From Datetime'),
			'to_datetime' => Yii::t('app', 'To Datetime'),
			'reason' => Yii::t('app', 'Reason'),
			'remarks' => Yii::t('app', 'Remarks'),
			'reliever_id' => Yii::t('app', 'Reliver'),
			'reliever_approve' => Yii::t('app', 'Reliever Approve'),
			'reliever_approve_datetime' => Yii::t('app', 'Reliever Approve Datetime'),
			'sup_id' => Yii::t('app', 'Supervisor'),
			'sup_approve' => Yii::t('app', 'Supervisor Approve'),
			'sup_approve_datetime' => Yii::t('app', 'Supervisor Approve Datetime'),
			'sup_disapprove_reason' => Yii::t('app', 'Supervisor Disapprove Reason'),
			'mgr_id' => Yii::t('app', 'Manager'),
                        'mgr_approve' => Yii::t('app', 'Manager Approve'),
			'mgr_approve_datetime' => Yii::t('app', 'Manager Approve Datetime'),
			'mgr_disapprove_reason' => Yii::t('app', 'Manager Disapprove Reason'),
                        'hr_id' => Yii::t('app', 'HR'),
			'hr_approve' => Yii::t('app', 'Hr Approve'),
			'hr_approve_datetime' => Yii::t('app', 'HR Approve Datetime'),
			'hr_disapprove_reason' => Yii::t('app', 'HR Disapprove Reason'),
			'emp' => Yii::t('app', 'Employee'),
			'jobCode' => Yii::t('app', 'Type'),
			'reliever' => Yii::t('app', 'Reliever'),
			'sup' => Yii::t('app', 'Supervisor'),
			'hr' => Yii::t('app', 'HR'),
			'hrisLoaAttachments' => Yii::t('app', 'Attachments'),
                        'nextLvl' => Yii::t('app', 'Status'),
                        'dept' => Yii::t('app', 'Department'),
                        'timestamp' => Yii::t('app', 'Date Submitted'),
                        'replicated_to_emp_hrs' => Yii::t('app', 'Entered Into Employee Hours'),
		);
	}
	
	/**
	*	Gets the current form status
	*	@return string Status
	*/
	public function getCurrentStatus(){
		/* $status = "Unknown";	
		if($this->reliever_approve === NULL)
			return "Waiting on Reliever";
		if($this->sup_approve === NULL)
			return "Waiting on Supervisor";
		if($this->hr_approve === NULL)
			return "Waiting on HR";
		return $status; */
		switch($this->next_lvl_id){
			case HrisAccessLvl::$ULTIMATELY_APPROVED:
				$status = "Approved";
			break;
			case HrisAccessLvl::$ULTIMATELY_DENIED:
				$status = "Denied";
			break;
			
			default:$status="".$this->nextLvl->status;
		}
		return $status;		
	}
  
  public function getBriefReason(){
    return substr($this->reason,0,25).'...';
  }
	
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('from_datetime', $this->from_datetime, true);
		$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);

    if($this->is_entered == '1'){   //show all
      $criteria->compare('is_entered','');
    }else{   // only show not entered entries
      $criteria->compare('is_entered','0');
    }
    
    if(!empty($this->from) and !empty($this->to)){ // TimeIn >= from AND TimeIn <= to
      $criteria->addBetweenCondition('from_datetime',$this->from, $this->to.' 23:55:00');
    }elseif(!empty($this->from)){ // TimeIn >= from
      $criteria->addCondition("from_datetime >= '$this->from'");
    }elseif(!empty($this->to)){ // TimeIn <= to
      $criteria->addCondition("from_datetime <= '$this->to 23:55:00'");
    }

		$criteria->order = 'emp_id asc, timestamp asc';
		
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,			
			'pagination'=>array('pageSize'=>'10'),
		));
	}
  
  	public function searchPrint() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('from_datetime', $this->from_datetime, true);
		$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);

    if($this->is_entered == '1'){   //show all
      $criteria->compare('is_entered','');
    }else{   // only show not entered entries
      $criteria->compare('is_entered','0');
    }
    
    if(!empty($this->from) and !empty($this->to)){ // TimeIn >= from AND TimeIn <= to
      $criteria->addBetweenCondition('from_datetime',$this->from, $this->to.' 23:55:00');
    }elseif(!empty($this->from)){ // TimeIn >= from
      $criteria->addCondition("from_datetime >= '$this->from'");
    }elseif(!empty($this->to)){ // TimeIn <= to
      $criteria->addCondition("from_datetime <= '$this->to 23:55:00'");
    }

		$criteria->order = 'emp_id asc, timestamp asc';
		
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,			
			'pagination'=>false,
		));
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'LOA Application|LOA Applications', $n);
	}
        
        public function getHeaderTitle(){
		$status = "Unknown";	
		$employee = $this->emp->Lname.'('.$this->emp_id.')';
		$loa_type = $this->jobCode->title;
		/* if($this->reliever_approve === NULL)
			return "Waiting on Reliever | $employee | $loa_type";
		if($this->sup_approve === NULL)
			return "Waiting on Supervisor | $employee | $loa_type";
		if($this->hr_approve === NULL)
			return "Waiting on HR | $employee | $loa_type"; */
		switch($this->next_lvl_id){
			case HrisAccessLvl::$ULTIMATELY_APPROVED:
				$status = "Approved";
			break;
			case HrisAccessLvl::$ULTIMATELY_DENIED:
				$status = "Denied";
			break;
			
			default:$status="".$this->nextLvl->status." | $employee | $loa_type";
		}
		return $status;
	}
}