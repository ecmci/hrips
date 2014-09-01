<?php

Yii::import('application.models._base.BaseHrisLoaApplicationReport');


class HrisLoaApplicationReport extends BaseHrisLoaApplicationReport
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules() {
		return array(
			array('emp_id, job_code_id, from_datetime, to_datetime, reason, reliever_id', 'required'),
			array('emp_id, job_code_id, reliever_id, reliever_approve, sup_id, sup_approve, hr_id, hr_approve', 'numerical', 'integerOnly'=>true),
			array('hours_requested, next_lvl_id, from_datetime,  to_datetime, remarks, reliever_approve_datetime, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason', 'safe'),
			array('remarks, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, emp_id, job_code_id, from_datetime, to_datetime, reason, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'safe', 'on'=>'search'),
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
	
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('from_datetime', $this->from_datetime, true);
		$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		$criteria->compare('remarks', $this->remarks, true);
		$criteria->compare('reliever_id', $this->reliever_id);
		$criteria->compare('reliever_approve', $this->reliever_approve);
		$criteria->compare('reliever_approve_datetime', $this->reliever_approve_datetime, true);
		$criteria->compare('sup_id', $this->sup_id);
		$criteria->compare('sup_approve', $this->sup_approve);
		$criteria->compare('sup_approve_datetime', $this->sup_approve_datetime, true);
		$criteria->compare('sup_disapprove_reason', $this->sup_disapprove_reason, true);
		$criteria->compare('hr_id', $this->hr_id);
		$criteria->compare('hr_approve', $this->hr_approve);
		$criteria->compare('hr_approve_datetime', $this->hr_approve_datetime, true);
		$criteria->compare('hr_disapprove_reason', $this->hr_disapprove_reason, true);

		$criteria->order = 'emp_id asc, timestamp asc';
		
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,			
			'pagination'=>array('pageSize'=>'100'),
		));
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'LOA Application|LOA Applications', $n);
	}
}