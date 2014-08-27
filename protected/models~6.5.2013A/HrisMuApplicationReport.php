<?php

Yii::import('application.models._base.BaseHrisMuApplicationReport');

class HrisMuApplicationReport extends BaseHrisMuApplicationReport
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'Make Up Application|Make Up Applications', $n);
	}
	
	public static function representingColumn() {
		return 'clockedin_datetime';
	}
	
	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'emp_id' => Yii::t('app', 'Employee'),
			'dept_id' => Yii::t('app', 'Department'),
			'job_code_id' => Yii::t('app', 'Job Code'),
			'next_lvl_id' => Yii::t('app', 'Status'),
			'clockedin_datetime' => Yii::t('app', 'Clockedin Datetime'),
			'clockedout_datetime' => Yii::t('app', 'Clockedout Datetime'),
			'hours' => Yii::t('app', 'Hours'),
			'from_datetime' => Yii::t('app', 'From Datetime'),
			'to_datetime' => Yii::t('app', 'To Datetime'),
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
		$criteria->compare('clockedin_datetime', $this->clockedin_datetime, true);
		$criteria->compare('clockedout_datetime', $this->clockedout_datetime, true);
		$criteria->compare('hours', $this->hours, true);
		$criteria->compare('from_datetime', $this->from_datetime, true);
		$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		$criteria->compare('remarks', $this->remarks, true);
		$criteria->compare('reliever_id', $this->reliever_id);
		$criteria->compare('reliever_approve', $this->reliever_approve);
		$criteria->compare('reliever_approve_datetime', $this->reliever_approve_datetime, true);
		$criteria->compare('sup_id', $this->sup_id);
		$criteria->compare('mgr_id', $this->mgr_id);
		$criteria->compare('mgr_approve', $this->mgr_approve);
		$criteria->compare('mgr_approve_datetime', $this->mgr_approve_datetime, true);
		$criteria->compare('mgr_disapprove_reason', $this->mgr_disapprove_reason, true);
		$criteria->compare('sup_approve', $this->sup_approve);
		$criteria->compare('sup_approve_datetime', $this->sup_approve_datetime, true);
		$criteria->compare('sup_disapprove_reason', $this->sup_disapprove_reason, true);
		$criteria->compare('hr_id', $this->hr_id);
		$criteria->compare('hr_approve', $this->hr_approve);
		$criteria->compare('hr_approve_datetime', $this->hr_approve_datetime, true);
		$criteria->compare('hr_disapprove_reason', $this->hr_disapprove_reason, true);
		$criteria->compare('timestamp', $this->timestamp, true);
		$criteria->compare('replicated_to_emp_hrs', $this->replicated_to_emp_hrs);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array('pageSize'=>'100'),
		));
	}

}