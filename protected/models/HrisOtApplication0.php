<?php

Yii::import('application.models._base.BaseHrisOtApplication');

class HrisOtApplication0 extends BaseHrisOtApplication
{
		
    	public $note = "<strong>Note: </strong><p>The correct type of Overtime will be determined by the next high ranking approver.</p>
						<p>Excess minutes is <b>rounded down</b> in a 15-minute block (e.g. 10:14 AM is rounded down to 10:00 AM, not 10:15 AM).</p>
						";
		public $hours;
		public $minutes;
		
		/**
    	*	Logs the LOA to Employee Hours. Functionality is strongly dependendent on prior form data entry validation.
    	*	@param 
    	*	@return boolean Logged_Sucess
    	*/
    	private function logHours(){
    		try{
				//throw new Exception('STOP. EmployeeHours table has been modified.');
				$start = $this->in_datetime;
				$emp_id = $this->emp_id;
		
				$this->out_datetime = date('Y-m-d H:i:s',strtotime("+$this->approved_hours",strtotime($start)));
				$employeeko = Employee::model()->findByPk($this->emp_id);
				$hrs = new EmployeeHrs;
				$hrs->emp_id = $this->emp_id;     
				$hrs->job_code = $this->job_code_id;
				$hrs->schedule = $employeeko->Schedule;
				$hrs->OT_code = $this->sub_code_id;;
				//$hrs->form_model_id = $this->id;
				$hrs->breakflag = '0';
				$hrs->datetime_in = $this->in_datetime;
				$hrs->datetime_out = $this->out_datetime;
				
				//convert mins
				$mins = '00';
				$mins = ($this->minutes >= 15) ? '25' : $mins;
				$mins = ($this->minutes >= 30) ? '50' : $mins;
				$mins = ($this->minutes >= 45) ? '75' : $mins;
				
				$hrs->hrs_patch = $this->hours.'.'.$mins;
				
				$hrs->save(false);
								
				Yii::log("OT ID ".$this->id." has been entered into Employee Hours by ".Yii::app()->user->getState('emp_id'),'info','app');
				$this->replicated_to_emp_hrs = '1';
				return true;
    		}catch(Exception $ex){
    				Yii::log($ex->getMessage()."OT ID ".$this->id." failed entry into Employee Hours.",'info','app');
    				return false;
    		}
    	}
      
      /**
    	*	HELPER: Get Pending OTs for Approval
    	* @param string 
    	* @return integer count
    	*/
      public static function getPendingOTApprovals(){
          $model = new HrisOtApplication;
          $data = $model->getOTForApproval();
          return $data->totalItemCount;
      }
      
      /**
    	*	Approves the application and determines the next approver
    	*	@params string string Action(1=Approve, 0=Deny), string Reason for Denial
    	*	@return boolean Approval_Success
    	*/
    	public function approveOT($action='0',$denial_reason='',$to_hr='0'){
    		//echo "Act=$action,Denial=$denial_reason,hr=$to_hr";exit();
			$success = false;
			$emp_id = Yii::app()->user->getState('emp_id');
    		$now = new CDbExpression('NOW()');
    		switch(Yii::app()->user->getState('access_lvl_id')){
    			case HrisAccessLvl::$EMPLOYEE : 
					$this->next_lvl_id = HrisAccessLvl::$SUPERVISOR;
					$success = true;
    			break;
    			case HrisAccessLvl::$SUPERVISOR : 			
					$this->sup_id = $emp_id;
					$this->sup_approve = $action;
					$this->sup_approve_datetime = $now;
					$this->sup_disapprove_reason = ($action == '0') ? $denial_reason : '';					
					$this->next_lvl_id = ($action == '1') ? HrisAccessLvl::$HR : HrisAccessLvl::$ULTIMATELY_DENIED;
					$this->next_lvl_id = ($action == '1' and $to_hr == '1') ? HrisAccessLvl::$HR : $this->next_lvl_id;
					$success = true;
    			break;
    			case HrisAccessLvl::$MANAGER : 
					$this->mgr_id = $emp_id;
					$this->mgr_approve = $action;
					$this->mgr_approve_datetime = $now;
					$this->mgr_disapprove_reason = ($action == '0') ? $denial_reason : '';					
					$this->next_lvl_id = ($action == '1') ? HrisAccessLvl::$HR : HrisAccessLvl::$ULTIMATELY_DENIED;					
					$success = true;
    			break;
    			case HrisAccessLvl::$HR : 
					$this->hr_id = $emp_id;
					$this->hr_approve = $action;
					$this->hr_approve_datetime = $now;
					$this->hr_disapprove_reason = ($action == '0') ? $denial_reason : '';					
					$this->next_lvl_id = ($action == '1') ? HrisAccessLvl::$EMPLOYER : HrisAccessLvl::$ULTIMATELY_DENIED;						
					$success = true;
    			break;
				case HrisAccessLvl::$PAYROLL_MASTER : 
				case HrisAccessLvl::$EMPLOYER : 
					$this->employer_id = $emp_id;
					$this->employer_approve = $action;
					$this->employer_approve_datetime = $now;
					$this->employer_disapprove_reason = ($action == '0') ? $denial_reason : '';					
					$this->next_lvl_id = ($action == '1') ? HrisAccessLvl::$ULTIMATELY_APPROVED : HrisAccessLvl::$ULTIMATELY_DENIED;
					$success =($this->next_lvl_id ==  HrisAccessLvl::$ULTIMATELY_APPROVED and $this->logHours()) ? true : false;
					$this->replicated_to_emp_hrs = ($success) ? '1' : '0';
    			break;
    			default:
					$success = false;
					throw new CHttpException(401,'You are not authorized to sign this application form.');
    		}
			if($success) 
				$this->queueEmail();

			//return false;  
    		return $success;
    	}
      
      public function queueEmail(){
        $content = "
           <p>Hi,</p>
           <p></p>
           <p>".$this->jobCode->title." has been updated to '".$this->getCurrentStatus()."'.</p>
           <p>".CHtml::link('View',Yii::app()->createAbsoluteUrl('hrisOtApplication/view',array('id'=>$this->id)))."</p>
           <p></p>
           <p>At Your Service,</p>
           <p></p>
           <p>HRIS-ECMCI (donotreply@ecmci.com)</p>
           <p>(Please don't reply to this email.)</p>
           ";
           
        $group_content = "
           <p>Hi,</p>
           <p></p>
           <p>".$this->jobCode->title." of ".$this->emp->getEmpIdFullName()." needs your approval.</p>
           <p>".CHtml::link('View',Yii::app()->createAbsoluteUrl('hrisOtApplication/formyapproval',array('id'=>$this->id)))."</p>
           <p></p>
           <p>At Your Service,</p>
           <p></p>
           <p>HRIS-ECMCI (donotreply@ecmci.com)</p>
           <p>(Please don't reply to this email.)</p>
           ";
        //echo "$this, 'HrisOtApplication', $this->emp_id ,$this->getHeaderTitle(), $content, $this->next_lvl_id, $group_content";
        //exit();
        //webapp::queueEmail($model, $model_name, $to_user_id, $subject, $content, $email_group_id='', $group_content='')
        WebApp::queueEmail($this, 'HrisOtApplication', $this->emp_id ,$this->getHeaderTitle(), $content, $this->next_lvl_id, $group_content);  
    }
      
      
      /**
    	*	Get LOAs for user approval	
    	*	@return CActiveDataProvider LOAs for approval
    	*/
    	public function getOTForApproval(){
    		$criteria = new CDbCriteria;
    		
    		$criteria->compare('id', $this->id);
    		$criteria->compare('job_code_id', $this->job_code_id);
    		$criteria->compare('emp_id', $this->emp_id);
			$criteria->compare('next_lvl_id', $this->next_lvl_id);
    		$criteria->compare('in_datetime', $this->in_datetime, true);
    		$criteria->compare('out_datetime', $this->out_datetime, true);
    		$criteria->compare('reason', $this->reason, true);
    		
    		
    		/* 
    		*	Determine which forms to pull up depending on the access level of the logged in user
    		*/
    		$emp_id = Yii::app()->user->getState('emp_id');
    		$access_lvl_id = Yii::app()->user->getState('access_lvl_id');
    		$dept_id = Yii::app()->user->getState('dept_id');
//     		
//     		
    		//for employees, 
    		if($access_lvl_id == HrisAccessLvl::$EMPLOYEE){			
				$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$EMPLOYEE."'");
				$criteria->addCondition("emp_id = '".$emp_id."'");  	
    		}
			
			//for employees, 
    		if($access_lvl_id == HrisAccessLvl::$ADMINISTRATOR){			
				$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$ADMINISTRATOR."'");				
    		}
//     		
    		//for supervisors, get forms routed to supervisor level for the department only
    		if($access_lvl_id == HrisAccessLvl::$SUPERVISOR){			
    			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$SUPERVISOR."' and dept_id='$dept_id'",'OR');
    		}
    		
    		//for Managers, get forms routed to manager level
    		if($access_lvl_id == HrisAccessLvl::$MANAGER){			
    			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$MANAGER."'",'OR');
    		}
    		
    		//for HR, get forms routed to HR level
    		if($access_lvl_id == HrisAccessLvl::$HR){			
    			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$HR."'",'OR');
    		}
        
			//for HR, get forms routed to HR level
    		if($access_lvl_id == HrisAccessLvl::$EMPLOYER){			
    			$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$EMPLOYER."'",'OR');
    		}
			
			//for PM, get approved LOAs
			if($access_lvl_id == HrisAccessLvl::$PAYROLL_MASTER){			
				//$criteria->addCondition("next_lvl_id = '".HrisAccessLvl::$ULTIMATELY_APPROVED."'",'OR');
			}
      

    	
    		return new CActiveDataProvider($this, array(
    			'criteria' => $criteria,
          'pagination'=>false
    		));
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
  			default:$status="".$this->nextLvl->status." | $employee | $loa_type";
  		}
  		return $status;
  	}
    
    /**
  	*	Gets the current form status
  	*	@return string Status
  	*/
  	public function getCurrentStatus(){
  		switch($this->next_lvl_id){
  			case HrisAccessLvl::$ULTIMATELY_APPROVED:
  				$status = "Approved";
  			break;
  			case HrisAccessLvl::$ULTIMATELY_DENIED:
  				$status = "Denied";
  			break;
  			case HrisAccessLvl::$EMPLOYEE:
  				$status = "Reason Pending";
  			break;
  			default:$status="".$this->nextLvl->status;
  		}
  		return $status;		
  	}
	
	public function relations() {
		return array(
			'emp' => array(self::BELONGS_TO, 'Employee', 'emp_id'),
			'jobCode' => array(self::BELONGS_TO, 'JobCode', 'job_code_id'),
			'sup' => array(self::BELONGS_TO, 'Employee', 'sup_id'),
			'hr' => array(self::BELONGS_TO, 'Employee', 'hr_id'),
			'employer' => array(self::BELONGS_TO, 'Employee', 'employer_id'),
			'mgr' => array(self::BELONGS_TO, 'Employee', 'mgr_id'),
			'dept' => array(self::BELONGS_TO, 'HrisDept', 'dept_id'),
			'nextLvl' => array(self::BELONGS_TO, 'HrisAccessLvl', 'next_lvl_id'),
			'hrisOtAttachments' => array(self::HAS_MANY, 'HrisOtAttachments', 'form_model_id'),
			'subCode' => array(self::BELONGS_TO, 'OtSubCode', 'sub_code_id'),
		);
	}
    
    /*
  	* Checks whthere user can edit if the form has not yet been approved by at least one approver. Admins can edit over the fly
  	* @return boolean Whether user is allowed to edit
  	*/
  	public function canEdit(){
		return ($this->next_lvl_id==HrisAccessLvl::$EMPLOYEE);
  		//if(Yii::app()->user->getState('access_lvl_id')!=HrisAccessLvl::$EMPLOYEE) return true;//superusers have super access
  	}
    
   /** Checks whthere user can view the 
  	* @return boolean Whether user is allowed to view
  	*/
  	public function canView(){
  		if(Yii::app()->user->getState('emp_id')==HrisAccessLvl::$ADMINISTRATOR) return true;//superusers have super access
  		return ($this->emp_id==Yii::app()->user->getState('emp_id'));	
  	}
    
    public function beforeSave(){
		$this->approved_hours = "$this->hours hours $this->minutes minutes";
		return parent::beforeSave();
    }
    
    public function afterFind(){
		
    }
  
  public function rules() {
		return array(
			array('dept_id, emp_id, next_lvl_id, job_code_id, in_datetime, out_datetime, reason, timestamp', 'required'),
			array('dept_id, emp_id, next_lvl_id, job_code_id, sup_id, sup_approve, mgr_id, mgr_approve, hr_id, hr_approve, employer_id, employer_approve', 'numerical', 'integerOnly'=>true),
			array('hours, minutes, sup_approve_datetime, sup_disapprove_reason, mgr_approve_datetime, mgr_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, employer_approve_datetime, employer_disapprove_reason, sub_code_id', 'safe'),
			array('approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, dept_id, emp_id, next_lvl_id, job_code_id, in_datetime, out_datetime, reason, approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason, timestamp', 'safe', 'on'=>'search'),
		);
	}
  
  public function renderId($data, $row){
	echo CHtml::hiddenField("ot[$row][id]",$data->id);
  }
  
  public function renderApprovedHours($data, $row){
	$diff = WebApp::diffBetweenDateTimeRange($data->in_datetime,$data->out_datetime);
	$hours = array();
	$ex = explode(' ',$data->approved_hours);
	//echo '<pre>';print_r($diff);echo '</pre>';exit();
	//$minutes['0'] = '0';
  $minutes = array();
	$d = '0';
	if($ex[2] >= 15) $minutes['15'] = $d = '15';
	if($ex[2] >= 30) $minutes['30'] = $d = '30';
	if($ex[2] >= 45) $minutes['45'] = $d = '45';
	if($diff['hours'] <= 150 ){
    for($i = 0 ; $i <= $diff['hours']; $i++)$hours[$i] = $i;
  }
  for($j = 0 ; $j <= $diff['mins'] ; $j++){ $mincount = $j < 10 ? '0'.$j : $j; $minutes[$mincount] = $mincount; }			
	echo CHtml::dropDownList("ot[$row][hours]",$diff['hours'],$hours,array('style'=>'width:50px;')).' : '.CHtml::dropDownList("ot[$row][minutes]",$diff['mins'],$minutes,array('style'=>'width:50px;'));
  }
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public static function label($n = 1) {
		return Yii::t('app', 'Overtime Application|Overtime Applications', $n);
	}

	public static function representingColumn() {
		return 'id';
	}
  
  public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'dept_id' => Yii::t('app', 'Department'),
			'emp_id' => Yii::t('app', 'Employee'),
			'next_lvl_id' => Yii::t('app', 'Status'),
			'job_code_id' => Yii::t('app', 'Type'),
			'sub_code_id' => Yii::t('app', 'Overtime Type Code'),
			'in_datetime' => Yii::t('app', 'Datetime In'),
			'out_datetime' => Yii::t('app', 'Datetime Out'),
			'reason' => Yii::t('app', 'Reason'),
			'approved_hours' => Yii::t('app', 'Hours'),
			'sup_id' => Yii::t('app', 'Supervisor'),
			'sup_approve' => Yii::t('app', 'Approves'),
			'sup_approve_datetime' => Yii::t('app', 'Signed'),
			'sup_disapprove_reason' => Yii::t('app', 'Reason'),
			'mgr_id' => Yii::t('app', 'Manager'),
			'mgr_approve' => Yii::t('app', 'Approves'),
			'mgr_approve_datetime' => Yii::t('app', 'Signed'),
			'mgr_disapprove_reason' => Yii::t('app', 'Reason'),
			'hr_id' => Yii::t('app', 'HR'),
			'hr_approve' => Yii::t('app', 'Approves'),
			'hr_approve_datetime' => Yii::t('app', 'Signed'),
			'hr_disapprove_reason' => Yii::t('app', 'Reason'),
			'employer_id' => Yii::t('app', 'Employer'),
			'employer_approve' => Yii::t('app', 'Approves'),
			'employer_approve_datetime' => Yii::t('app', 'Signed'),
			'employer_disapprove_reason' => Yii::t('app', 'Reason'),
			'timestamp' => Yii::t('app', 'Date Submitted'),
			'emp' => Yii::t('app', 'Employee'),
			'jobCode' => Yii::t('app', 'Job Code'),
			'subCode' => Yii::t('app', 'Overtime Type Code'),
			'sup' => Yii::t('app', 'Supervisor'),
			'hr' => Yii::t('app', 'HR'),
			'employer' => Yii::t('app', 'Employer'),
			'mgr' => Yii::t('app', 'Manager'),
			'dept' => Yii::t('app', 'Department'),
			'nextLvl' => Yii::t('app', 'Status'),
			'hrisOtAttachments' => Yii::t('app', 'Attachments'),
		);
	}
  
  public function getMyOT() {
		$criteria = new CDbCriteria;
    
		$criteria->compare('id', $this->id);
		$criteria->compare('dept_id', $this->dept_id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('next_lvl_id', $this->next_lvl_id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('sub_code_id', $this->sub_code_id);
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
		$criteria->compare('timestamp', $this->timestamp, true);

		
		$criteria->compare('emp_id', Yii::app()->user->getState('emp_id'));  
		
    $criteria->order = 'timestamp desc';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}