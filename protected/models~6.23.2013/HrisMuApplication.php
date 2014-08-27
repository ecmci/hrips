<?php

Yii::import('application.models._base.BaseHrisMuApplication');

class HrisMuApplication extends BaseHrisMuApplication
{
	
	public $formInstrux = '<h6>Note:</h6>
							<p>Before you proceed, you must have already rendered the hours. "Clocked In" and "Clocked Out" means your exact punch in and punch out (including breaks) segment on the Time Clock access point.</p>
	';
	public $to_mgr = '0';
	public $action = '0';
	public $reason = '';
	
	public function beforeSave(){
		if($this->isNewRecord){
			$this->job_code_id = '2009';
			$this->emp_id = Yii::app()->user->getState('emp_id');
			$this->dept_id = Yii::app()->user->getState('dept_id');
			$this->next_lvl_id = HrisAccessLvl::$RELIEVER;
			$this->timestamp = new CDbExpression('NOW()');
		}
		return parent::beforeSave();
	}
	
	public function isValidMUApplication(){
		// check date range
		if(strtotime($this->clockedin_datetime) >=  strtotime($this->clockedout_datetime))	{
			$this->addError('clockedin_datetime','Invalid Date Range: Clocked In Date must be less than the Clocked Out Date');
			$this->addError('clockedout_datetime','Invalid Date Range: Clocked In Date must be less than the Clocked Out Date');		
			return false;
		}
		
		// must be clocked in / out during that period
		if(!$this->wasClockedInOut()){
			return false;
		}
		
		return true;
	}
	
	private function wasClockedInOut(){
		$valid = true;
		//$start = date('Y-m-d',strtotime($this->clockedin_datetime));
		$start = $this->clockedin_datetime;
		$end = $this->clockedout_datetime;
		$emp_id = Yii::app()->user->getState('emp_id');
		$data = WebApp::getEmployeeClockRecords($start, $end, $emp_id);
		$size = sizeof($data);
		if(!$data or $size < 1) {
			$this->addError('clockedin_datetime','Please check your timesheet and key in the actual hour/min you clocked in/out.');
			$this->addError('clockedout_datetime','Please check your timesheet and key in the actual hour/min you clocked in/out.');
			$this->addError('','No clocked in/out records found. Please check your timesheet.');					
			return false;
		}
		//echo '<pre>'; print_r($data); echo '</pre>'; exit();
		if(strtotime($this->clockedin_datetime) < strtotime($data[0]['TimeIn'])){
			$this->addError('clockedin_datetime','Your clocked in record only shows '.$data[0]['TimeIn'].'.');
			$valid = false;
		}
		if(strtotime($data[$size-1]['TimeOut']) < strtotime($this->clockedout_datetime)){
			$this->addError('clockedout_datetime','Your clocked out record only shows '.$data[$size-1]['TimeOut'].'.');
			$valid = false;
		}
		return $valid;
	}
	
	public function approveMU($action='0',$denial_reason='',$to_hr='0'){
		// check scheduled date validity first
		// TO FOLLOW...
		
		$success = false;
		$emp_id = Yii::app()->user->getState('emp_id');
		$now = new CDbExpression('NOW()');
		$access_lvl = Yii::app()->user->getState('access_lvl_id');
		
		// catch all if current user is also the reliever
		if($this->userIsReliever()){
			$this->reliever_id = $emp_id;
			$this->reliever_approve = $action;
			$this->reliever_approve_datetime = $now;
		}
		
		switch($access_lvl){
			case HrisAccessLvl::$EMPLOYEE :
				$this->next_lvl_id = ($action == '0') ? HrisAccessLvl::$ULTIMATELY_DENIED : HrisAccessLvl::$SUPERVISOR;
				/******
				* !!! The case of sup/mgr/hr having an employee as a reliever !!!
				*******/
				try{
					$applicant = HrisUsers::model()->findByPk($this->emp_id);				
					switch($applicant->access_lvl_id){
						case HrisAccessLvl::$SUPERVISOR : 
							$this->next_lvl_id = HrisAccessLvl::$MANAGER;
						break;
						case HrisAccessLvl::$MANAGER : 
							$this->next_lvl_id = HrisAccessLvl::$HR;
						break;
						case HrisAccessLvl::$HR : 
							$this->next_lvl_id = HrisAccessLvl::$ULTIMATELY_APPROVED;
						break;
					}
				}catch(Exception $failyou){
					Yii::log('BUG! The case of sup/mgr/hr having an employee as a reliever FAILED for LOA ID '.$this->id.' | '.$failyou->getMessage(),'info','app');
				}
				$success = true;
			break;
			case HrisAccessLvl::$SUPERVISOR :
				$this->sup_id = $emp_id;
				$this->sup_approve = $action;
				$this->sup_approve_datetime = $now;
				$this->sup_disapprove_reason = ($action == '0') ? $denial_reason : NULL;
				$this->next_lvl_id = ($to_hr=='1') ? HrisAccessLvl::$HR : HrisAccessLvl::$MANAGER;
				$this->next_lvl_id = ($action == '0') ? HrisAccessLvl::$ULTIMATELY_DENIED : $this->next_lvl_id;
				$success = true;
			break;
			case HrisAccessLvl::$MANAGER :
				$this->mgr_id = $emp_id;
				$this->mgr_approve = $action;
				$this->mgr_approve_datetime = $now;
				$this->mgr_disapprove_reason = ($action == '0') ? $denial_reason : NULL;
				$this->next_lvl_id = ($action == '0') ? HrisAccessLvl::$ULTIMATELY_DENIED : HrisAccessLvl::$HR;
				$success = true;
			break;
			case HrisAccessLvl::$HR :
				$this->hr_id = $emp_id;
				$this->hr_approve = $action;
				$this->hr_approve_datetime = $now;
				$this->hr_disapprove_reason = ($action == '0') ? $denial_reason : NULL;
				$this->next_lvl_id = ($action == '0') ? HrisAccessLvl::$ULTIMATELY_DENIED : HrisAccessLvl::$ULTIMATELY_APPROVED;
				if($action=='0') $success = true;				
				if($action=='1'){
					if($this->job_code_id == '2010' or $this->job_code_id == '2011'){ // LOAs without Pay
						//do nothing
						$success = true;
					}elseif($this->logHours()){
						$success = true;
					}else{
						Yii::log("Error: Can't decide with this MU ID ".$this->id,'info','app');
						$success = false;
					}
				}				
			break;
			case HrisAccessLvl::$PAYROLL_MASTER :
				$this->next_lvl_id = ($this->next_lvl_id == HrisAccessLvl::$ULTIMATELY_APPROVED) ? HrisAccessLvl::$COPY_FURNISHED : $this->next_lvl_id;
				$success = true;
			break;
		}

		if($success)
			$this->queueEmail();  
		return $success;
	}
	
	
	
	public function queueEmail(){
      
      $content = "
         <p>Hi,</p>
         <p></p>
         <p>".$this->jobCode->title." has been updated to '".$this->nextLvl->status."'.</p>
         <p>".CHtml::link('View',Yii::app()->createAbsoluteUrl('hrisMuApplication/view',array('id'=>$this->id)))."</p>
         <p></p>
         <p>At Your Service,</p>
         <p></p>
         <p>HRIS-ECMCI</p>
         <p>(Please don't reply to this email.)</p>
         ";
         
      $group_content = "
         <p>Hi,</p>
         <p></p>
         <p>".$this->jobCode->title." of ".$this->emp->getEmpIdFullName()." needs your approval.</p>
         <p>".CHtml::link('View',Yii::app()->createAbsoluteUrl('hrisMuApplication/formyapproval',array('id'=>$this->id)))."</p>
         <p></p>
         <p>At Your Service,</p>
         <p></p>
         <p>HRIS-ECMCI</p>
         <p>(Please don't reply to this email.)</p>
         ";
      WebApp::queueEmail($this, 'HrisMuApplication', $this->emp_id ,$this->getHeaderTitle(), $content, $this->next_lvl_id, $group_content);  
  }
  
  public function getHeaderTitle(){
		$status = "Unknown";	
		$employee = $this->emp->Lname.'('.$this->emp_id.')';
		$loa_type = $this->jobCode->title;
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

	private function logHours(){
		return true;
	}
	
	private function logHours2(){
		
		try{
			$start_datetime = $this->from_datetime;
			$end_datetime = $this->to_datetime;			
			$emp_id = $this->emp_id;
			
			//Yii::log("start_datetime = $start_datetime | end_datetime = $end_datetime",'info','app');
			
			$normalized_start = WebApp::getInOutDatetimes($start_datetime,$emp_id);
			$normalized_end = WebApp::getInOutDatetimes($end_datetime,$emp_id);

			//if(empty($normalized_start)) return false;
			//if(empty($normalized_end)) return false;
			
			
			$err = false;
			$err_msg = '';
			if(empty($normalized_start)) {
				$err = true;
				$err_msg = "NormalizedStart was null for MU ID $this->id";				
			}
			if(empty($normalized_end)) {
				$err = true;
				$err_msg = "NormalizedEnd was null for MU ID $this->id";
			}
			if($err) {
				Yii::log($err_msg,'info','app');
				echo "Can't approve MU request ID $this->id. Please check if there is a scheduled shift within the period requested.";
				return false;
			}else{
				//Yii::log('good','info','app');
				//return true;
			}
			
			
			$shifts = WebApp::getScheduledShiftsWithin($normalized_start['TimeIn'], $end_datetime, $emp_id);

			//echo '<pre>';	print_r($shifts); echo '</pre>'; exit();
			
			//add breaks
			$shifts_copy = $shifts;
			foreach($shifts as $i=>$shift){						
				$shifts_copy[$i]['BreakFlag'] = '1';
				$shifts_copy[$i]['BreakStart'] = date('Y-m-d H:i:s',strtotime("+4 hours",strtotime($shift['TimeIn'])));
				$shifts_copy[$i]['BreakEnd'] =  date('Y-m-d H:i:s',strtotime("+1 hours",strtotime($shifts_copy[$i]['BreakStart'])));
			}
			
			// echo '<pre> B4 the adj';
			// print_r($shifts_copy); 
			// echo '</pre>';
			
			//adjust head and tail of the period
			if(strtotime($start_datetime) >= strtotime($shifts_copy[0]['BreakStart'])){
					$shifts_copy[0]['BreakFlag'] = '0';              
			}
			$shifts_copy[0]['TimeIn'] = $start_datetime;
			
			if(strtotime($end_datetime) <= strtotime($shifts_copy[sizeof($shifts_copy)-1]['BreakStart'])){
				  $shifts_copy[sizeof($shifts_copy)-1]['BreakFlag'] = '0'; 
			}
			$shifts_copy[0]['TimeOut'] = $end_datetime;
			
			
			//get applicant's schedule
			$employeeko = Employee::model()->findByPk($this->emp_id);
				
			
			//log the hours to employee_hrs
			foreach($shifts_copy as $i=>$shift){						
				if($shift['BreakFlag'] == '1'){
					$hrs = new EmployeeHrs;
					$hrs->emp_id = $this->emp_id;
					$hrs->job_code = $this->job_code_id;
					$hrs->schedule = $employeeko->Schedule;
					$hrs->breakflag = '1';
					$hrs->datetime_in = $shift['TimeIn'];
					$hrs->datetime_out = $shift['BreakStart'];
					
					//dummy data
					$hrs->sched_in = $shift['TimeIn'];
					$hrs->sched_out = $shift['BreakStart'];
					$hrs->process = '0';
					$hrs->raw_mins_late = '00:00:00';
					$hrs->mins_late = '00:00:00';
					$hrs->hrs_late = '0.00';
					$hrs->hrs_patch = '0.00';
					$hrs->updated_to_payroll = '0';
					$hrs->Amt = '0.00';
					
					$hrs->save(false);
						
					if(strtotime($shift['TimeOut']) > strtotime($shift['BreakEnd'])){
						$hrs = new EmployeeHrs;
						$hrs->emp_id = $this->emp_id;
						$hrs->job_code = $this->job_code_id;
						$hrs->schedule = $employeeko->Schedule;
						$hrs->breakflag = '0';
						$hrs->datetime_in = $shift['BreakEnd'];
						$hrs->datetime_out = $shift['TimeOut'];
						
						//dummy data
						$hrs->sched_in = $shift['BreakEnd'];
						$hrs->sched_out = $shift['TimeOut'];
						$hrs->process = '0';
						$hrs->raw_mins_late = '00:00:00';
						$hrs->mins_late = '00:00:00';
						$hrs->hrs_late = '0.00';
						$hrs->hrs_patch = '0.00';
						$hrs->updated_to_payroll = '0';
						$hrs->Amt = '0.00';
						
						$hrs->save(false);
					}
				}else{
					$hrs = new EmployeeHrs;
					$hrs->emp_id = $this->emp_id;
					$hrs->job_code = $this->job_code_id;
					$hrs->schedule = $employeeko->Schedule;
					$hrs->breakflag = '0';
					$hrs->datetime_in = $shift['TimeIn'];
					$hrs->datetime_out = $shift['TimeOut'];
					
					//dummy data
					$hrs->sched_in = $shift['TimeIn'];
					$hrs->sched_out = $shift['TimeOut'];
					$hrs->process = '0';
					$hrs->raw_mins_late = '00:00:00';
					$hrs->mins_late = '00:00:00';
					$hrs->hrs_late = '0.00';
					$hrs->hrs_patch = '0.00';
					$hrs->updated_to_payroll = '0';
					$hrs->Amt = '0.00';
					
					$hrs->save(false);
				}
			} 				
			Yii::log("LOA ID ".$this->id." has been entered into Employee Hours by ".Yii::app()->user->getState('emp_id').' for job code '.$this->job_code_id,'info','app');
			$this->replicated_to_emp_hrs = '1';
		}catch(Exception $e){
			Yii::log('MU Logging Hours failed: '.$e->getMessage(),'info','app');
			return false;
		}
		return true;
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'Make Up Application|Make Up Applications', $n);
	}
	
	public function rules() {
		return array(
			///rray('emp_id, clockedin_datetime, clockedout_datetime, from_datetime, to_datetime, reason', 'required'),
			array('clockedin_datetime, clockedout_datetime, reliever_id, reason','required','on'=>'apply'),
			array('reliever_id, reason, hours', 'required' ,'on'=>'update'),
			array('from_datetime, to_datetime, hours', 'required' ,'on'=>'approve_sup'),
			array('emp_id, job_code_id, reliever_id, reliever_approve, sup_id, sup_approve, hr_id, hr_approve', 'numerical', 'integerOnly'=>true),
			array('hours,remarks, reliever_approve_datetime, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason', 'safe'),
			array('job_code_id, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, emp_id, hours ,job_code_id, next_lvl_id ,clockedin_datetime, clockedout_datetime, from_datetime, to_datetime, reason, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'safe', 'on'=>'search'),
		);
	}
	
	public function relations() {
		return array(
			'hr' => array(self::BELONGS_TO, 'Employee', 'hr_id'),
			'emp' => array(self::BELONGS_TO, 'Employee', 'emp_id'),
			'jobCode' => array(self::BELONGS_TO, 'JobCode', 'job_code_id'),
			'nextLvl' => array(self::BELONGS_TO, 'HrisAccessLvl', 'next_lvl_id'),
			'reliever' => array(self::BELONGS_TO, 'Employee', 'reliever_id'),
			'sup' => array(self::BELONGS_TO, 'Employee', 'sup_id'),
			'mgr' => array(self::BELONGS_TO, 'Employee', 'mgr_id'),
			'hrisMuAttachments' => array(self::HAS_MANY, 'HrisMuAttachments', 'mu_id'),
			'hrisUser' => array(self::BELONGS_TO, 'HrisUsers', 'emp_id'),
		);
	}
	
	public static function representingColumn() {
		return 'id';
	}
	
	public function renderId($data, $row){
		echo CHtml::hiddenField("mu[$row][id]",$data->id);
	}
	
	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'emp_id' => Yii::t('app', 'Employee'),
			'job_code_id' => Yii::t('app', 'Job Code'),
			'next_lvl_id' => Yii::t('app', 'Status'),
			'clockedin_datetime' => Yii::t('app', 'Clocked In'),
			'clockedout_datetime' => Yii::t('app', 'Clocked Out'),
			'hours' => Yii::t('app', 'Hours Requested'),
			'from_datetime' => Yii::t('app', 'Make Up Date From'),
			'to_datetime' => Yii::t('app', 'Make Up Date To'),
			'reason' => Yii::t('app', 'Reason'),
			'remarks' => Yii::t('app', 'Remarks'),
			'reliever_id' => Yii::t('app', 'Reliever'),
			'reliever_approve' => Yii::t('app', 'Reliever Approves'),
			'reliever_approve_datetime' => Yii::t('app', 'Signed'),
			'sup_id' => Yii::t('app', 'Supervisor'),
			'sup_approve' => Yii::t('app', 'Supervisor Approves'),
			'sup_approve_datetime' => Yii::t('app', 'Signed'),
			'sup_disapprove_reason' => Yii::t('app', 'Reason Denied'),
			'mgr_id' => Yii::t('app', 'Manager'),
			'mgr_approve' => Yii::t('app', 'Manager Approves'),
			'mgr_approve_datetime' => Yii::t('app', 'Signed'),
			'mgr_disapprove_reason' => Yii::t('app', 'Reason Denied'),
			'hr_id' => Yii::t('app', 'HR'),
			'hr_approve' => Yii::t('app', 'HR Approves'),
			'hr_approve_datetime' => Yii::t('app', 'Signed'),
			'hr_disapprove_reason' => Yii::t('app', 'Denied Reason'),
			'timestamp' => Yii::t('app', 'Date Submitted'),
			'jobCode' => Yii::t('app', 'Job Code'),
			'emp' => Yii::t('app', 'Employee'),
			'reliever' => Yii::t('app', 'Reliever'),
			'sup' => Yii::t('app', 'Supervisor'),
			'hr' => Yii::t('app', 'HR'),
			'mgr' => Yii::t('app', 'Manager'),
			'hrisMuAttachments' => Yii::t('app', 'Attachments'),
			'nextLvlId' => Yii::t('app', 'Status'),
		);
	}
	
	public function getMUForApproval(){
		$criteria = new CDbCriteria;
		
	
		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		
		$criteria->compare('clockedin_datetime', $this->clockedin_datetime, true);
		$criteria->compare('clockedout_datetime', $this->clockedout_datetime, true);
		$criteria->compare('from_datetime', $this->from_datetime, true);
		$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		$criteria->compare('remarks', $this->remarks, true);
		
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

		/* 
		*	Determine which forms to pull up depending on the access level of the logged in user
		*/
		$emp_id = Yii::app()->user->getState('emp_id');
		$access_lvl_id = Yii::app()->user->getState('access_lvl_id');
		$dept_id = Yii::app()->user->getState('dept_id');
		
		//for employees and everyone, get all reliever approvals
		$criteria->addCondition("reliever_id='$emp_id' AND reliever_approve IS NULL",'OR');
		
		//for employees, 
		if($access_lvl_id == HrisAccessLvl::$EMPLOYEE){			
			
		}
		
		//for supervisors, get forms routed to supervisor level
		if($access_lvl_id == HrisAccessLvl::$SUPERVISOR){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$SUPERVISOR."' AND dept_id = '$dept_id'",'OR');
		}
		
		//for Managers, get forms routed to manager level
		if($access_lvl_id == HrisAccessLvl::$MANAGER){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$MANAGER."'",'OR');
		}
		
		//for HR, get forms routed to HR level
		if($access_lvl_id == HrisAccessLvl::$HR){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$HR."'",'OR');
		}
		
		//for PM, get approved LOAs
		if($access_lvl_id == HrisAccessLvl::$PAYROLL_MASTER){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$ULTIMATELY_APPROVED."'",'OR');
		}
			
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array('pageSize'=>'100'),
		));
	}
	
	private function countMUForApproval(){
		$criteria = new CDbCriteria;
		/* 
		*	Determine which forms to pull up depending on the access level of the logged in user
		*/
		$emp_id = Yii::app()->user->getState('emp_id');
		$access_lvl_id = Yii::app()->user->getState('access_lvl_id');
		$dept_id = Yii::app()->user->getState('dept_id');
		
		//for employees and everyone, get all reliever approvals
		$criteria->addCondition("reliever_id='$emp_id' AND reliever_approve IS NULL",'OR');
		
		//for employees, 
		if($access_lvl_id == HrisAccessLvl::$EMPLOYEE){			
			
		}
		
		//for supervisors, get forms routed to supervisor level
		if($access_lvl_id == HrisAccessLvl::$SUPERVISOR){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$SUPERVISOR."' AND dept_id = '$dept_id'",'OR');
		}
		
		//for Managers, get forms routed to manager level
		if($access_lvl_id == HrisAccessLvl::$MANAGER){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$MANAGER."'",'OR');
		}
		
		//for HR, get forms routed to HR level
		if($access_lvl_id == HrisAccessLvl::$HR){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$HR."'",'OR');
		}
		
		//for PM, get approved LOAs
		if($access_lvl_id == HrisAccessLvl::$PAYROLL_MASTER){			
			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$ULTIMATELY_APPROVED."'",'OR');
		}
			
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,			
		));
	}
	
	public static function getPendingMUApprovals(){
		$model = new HrisMuApplication;
		$data = $model->countMUForApproval();
		return $data->totalItemCount;
	} 
	

	public function getMyMU() {
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('clockedin_datetime', $this->clockedin_datetime, true);
		$criteria->compare('clockedout_datetime', $this->clockedout_datetime, true);
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
		
		$criteria->compare('emp_id', Yii::app()->user->getState('emp_id'));

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
	
	private function userIsReliever(){
		$my_id = Yii::app()->user->getState('access_lvl_id');
		return (($this->reliever_approve == null) and ($my_id = $this->reliever_id));
	}
	
	public function renderMUDatetimeFrom($data, $row){
		echo CHtml::textField("mu[$row][from]",$data->from_datetime,array('required'=>'required','placeholder'=>'Required','class'=>'datepicker',"style"=>"width:125px;"));
	}
	
	public function renderMUDatetimeTo($data, $row){
		echo CHtml::textField("mu[$row][to]",$data->from_datetime,array('required'=>'required','placeholder'=>'Required','class'=>'datepicker',"style"=>"width:125px;"));
	}
	
public function test_encode_hours($hours){
    $diff = WebApp::parseSeconds($hours);
    return $diff['hours'].' hours '.$diff['mins'].' minutes';     
  }
  
  public function test(){
    $criteria = new CDbCriteria;
    
    $criteria->select = "id,clockedin_datetime, clockedout_datetime, timediff(clockedout_datetime, clockedin_datetime) as hours, hours_approved";   
    
    return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>false,
		));  
  }	
	
}