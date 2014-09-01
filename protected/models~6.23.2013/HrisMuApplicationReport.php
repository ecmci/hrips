<?php

Yii::import('application.models._base.BaseHrisMuApplicationReport');

class HrisMuApplicationReport extends BaseHrisMuApplicationReport
{
	public $from, $to, $is_entered;
  
  
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'Make Up Application|Make Up Applications', $n);
	}
	
	public static function representingColumn() {
		return 'clockedin_datetime';
	}
  
  public function getBriefReason(){
    return substr($this->reason,0,25).'...';
  }
	
	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'emp_id' => Yii::t('app', 'Employee'),
			'dept_id' => Yii::t('app', 'Department'),
			'job_code_id' => Yii::t('app', 'Job Code'),
			'next_lvl_id' => Yii::t('app', 'Status'),
			'clockedin_datetime' => Yii::t('app', 'Clocked In'),
			'clockedout_datetime' => Yii::t('app', 'Clocked Out'),
			'hours' => Yii::t('app', 'Hours'),
			'from_datetime' => Yii::t('app', 'Makeup From'),
			'to_datetime' => Yii::t('app', 'Make To'),
			'reason' => Yii::t('app', 'Reason'),
			'remarks' => Yii::t('app', 'Remarks'),
			'reliever_id' => Yii::t('app', 'Reliever'),
			'reliever_approve' => Yii::t('app', 'Reliever Approves'),
			'reliever_approve_datetime' => Yii::t('app', 'Reliever Approve Datetime'),
			'sup_id' => Yii::t('app', 'Supervisor'),
			'mgr_id' => Yii::t('app', 'Manager'),
			'mgr_approve' => Yii::t('app', 'Manager Approves'),
			'mgr_approve_datetime' => Yii::t('app', 'Manager Approve Datetime'),
			'mgr_disapprove_reason' => Yii::t('app', 'Reason'),
			'sup_approve' => Yii::t('app', 'Supervisor Approves'),
			'sup_approve_datetime' => Yii::t('app', 'Supervisor Approve Datetime'),
			'sup_disapprove_reason' => Yii::t('app', 'Supervisor Disapprove Reason'),
			'hr_id' => Yii::t('app', 'Human Resource'),
			'hr_approve' => Yii::t('app', 'HR Approve'),
			'hr_approve_datetime' => Yii::t('app', 'HR Approve Datetime'),
			'hr_disapprove_reason' => Yii::t('app', 'HR Disapprove Reason'),
			'timestamp' => Yii::t('app', 'Timestamp'),
			'replicated_to_emp_hrs' => Yii::t('app', 'Replicated'),
			'jobCode' => Yii::t('app', 'Jobe Code'),
			'emp' => Yii::t('app', 'Employee'),
			'reliever' => Yii::t('app', 'Reliever'),
			'sup' => Yii::t('app', 'Supervisor'),
			'hr' => Yii::t('app', 'Human Resource'),
			'nextLvl' => Yii::t('app', 'Status'),
			'dept' => Yii::t('app', 'Department'),
			'hrisMuAttachments' => Yii::t('app', 'Attachments'),
		);
	}
	
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('dept_id', $this->dept_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		//$criteria->compare('from_datetime', $this->from_datetime, true);
		//$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		

		
    if($this->is_entered == '1'){   //show all
      $criteria->compare('is_entered','');
    }else{   // only show not entered entries
      $criteria->compare('is_entered','0');
    }
    
    if(!empty($this->from) and !empty($this->to)){ // MakeFrom >= from AND MakeFrom <= to
      $criteria->addBetweenCondition('from_datetime',$this->from, $this->to.' 23:55:00');
    }elseif(!empty($this->from)){ // MakeFrom >= from
      $criteria->addCondition("from_datetime >= '$this->from'");
    }elseif(!empty($this->to)){ // MakeFrom <= to
      $criteria->addCondition("from_datetime <= '$this->to 23:55:00'");
    }

		$criteria->order = 'emp_id asc, from_datetime asc';
    
    
    return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array('pageSize'=>'10'),
		));
	}
  
  public function searchPrint() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('dept_id', $this->dept_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		//$criteria->compare('from_datetime', $this->from_datetime, true);
		//$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		

		
    if($this->is_entered == '1'){   //show all
      $criteria->compare('is_entered','');
    }else{   // only show not entered entries
      $criteria->compare('is_entered','0');
    }
    
    if(!empty($this->from) and !empty($this->to)){ // MakeFrom >= from AND MakeFrom <= to
      $criteria->addBetweenCondition('from_datetime',$this->from, $this->to.' 23:55:00');
    }elseif(!empty($this->from)){ // MakeFrom >= from
      $criteria->addCondition("from_datetime >= '$this->from'");
    }elseif(!empty($this->to)){ // MakeFrom <= to
      $criteria->addCondition("from_datetime <= '$this->to 23:55:00'");
    }

		$criteria->order = 'emp_id asc, from_datetime asc';
    
    
    return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>false,
		));
	}
  
  public function rules() {
		return array(
			array('emp_id, clockedin_datetime, clockedout_datetime, hours, reason, timestamp', 'required'),
			array('emp_id, dept_id, job_code_id, next_lvl_id, reliever_id, reliever_approve, sup_id, mgr_id, mgr_approve, sup_approve, hr_id, hr_approve, replicated_to_emp_hrs', 'numerical', 'integerOnly'=>true),
			array('hours', 'length', 'max'=>3),
			array('from_datetime, to_datetime, remarks, reliever_approve_datetime, mgr_approve_datetime, mgr_disapprove_reason, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, to, from, is_entered', 'safe'),
			array('dept_id, job_code_id, next_lvl_id, from_datetime, to_datetime, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, replicated_to_emp_hrs', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, emp_id, dept_id, job_code_id, next_lvl_id, clockedin_datetime, clockedout_datetime, hours, from_datetime, to_datetime, reason, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, timestamp, replicated_to_emp_hrs', 'safe', 'on'=>'search'),
		);
	}

}