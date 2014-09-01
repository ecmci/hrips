<?php

Yii::import('application.models._base.BaseHrisLoaApplication');

class HrisLoaApplication extends BaseHrisLoaApplication
{
	var $formInstrux = "<p><strong>Reminder!</strong> LOA policies are in effect. Please refer to the <a href='http://intranet.ecmci.com/resources/employee-handbook/' target='_blank'>Employee Handbook</a> for your guidance.</p>
				";	
	private $days_requested = 0;
  public $hours, $minutes;
	
        public function renderActionsColumn(){
            $baseUrl = Yii::app()->createUrl('HrisLoaApplication');
            $data = '
              <div class="btn-group">
                <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
                  Action
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="'.$baseUrl.'/view/id/'.$this->id.'"><i class="icon-eye-open"></i> View</a></li>
                  <li><a href="'.$baseUrl.'/update/id/'.$this->id.'"><i class="icon-pencil"></i> Edit</a></li>    
                  <li><a href="#" onclick="cancelLOA('.$this->id.')"><i class="icon-trash"></i> Cancel</a></li>
                </ul>
              </div>
            ';
            echo $data;
        } 

    /**
         * Cancels this LOA application and also removes entries from employee hours tables
         * @return \HrisLoaApplication
         */
        public function cancel(){
            $this->next_lvl_id = HrisAccessLvl::$CANCELLED;
            $this->reason .= " | MANUALLY CANCELLED BY USER LAST ".date('m/d/Y h:i A',time());
            
            //also remove entries from employee_hours table
            $c = new CDbCriteria;
            $c->compare('job_code',$this->job_code_id);
            $c->compare('emp_id',$this->emp_id);
            $c->addCondition("datetime_in >= '".$this->from_datetime."' AND datetime_out <= '".$this->to_datetime."'");
            EmployeeHrs::model()->deleteAll($c);
            return $this;
        }
  
        public function rules() {
		return array(
			array('emp_id, job_code_id, from_datetime, to_datetime, reason, reliever_id, hours, minutes', 'required'),
			array('emp_id, job_code_id, reliever_id, reliever_approve, sup_id, sup_approve, hr_id, hr_approve', 'numerical', 'integerOnly'=>true),
			array('hours_requested, from_datetime, to_datetime, remarks, reliever_approve_datetime, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, hours, mins', 'safe'),
			array('remarks, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, emp_id, job_code_id, from_datetime, to_datetime, reason, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'safe', 'on'=>'search'),
		);
	}
		    	
	public static function representingColumn() {
		return 'id';
	}
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function attributeLabels(){
		return CMap::mergeArray(parent::attributeLabels(),
			array(
				'id' => Yii::t('app', 'ID'),
				'emp_id' =>Yii::t('app', 'Employee ID'),
				'job_code_id' => Yii::t('app', 'Type'),
				'from_datetime' => Yii::t('app', 'From'),
				'to_datetime' => Yii::t('app', 'To'),
				'reason' => Yii::t('app', 'Reason'),
				'remarks' => Yii::t('app', 'Remarks'),
				'reliever_id' => Yii::t('app', 'Reliever'),
				'reliever_approve' => Yii::t('app', 'Reliever Approves'),
				'reliever_approve_datetime' => Yii::t('app', 'Signed'),
				'sup_id' => Yii::t('app', 'Supervisor'),
				'sup_approve' => Yii::t('app', 'Supervisor Approves'),
				'sup_approve_datetime' => Yii::t('app', 'Signed'),
				'sup_disapprove_reason' => Yii::t('app', 'Reason'),
				'mgr_id' => Yii::t('app', 'Manager'),
				'mgr_approve' => Yii::t('app', 'Manager Approves'),
				'mgr_approve_datetime' => Yii::t('app', 'Signed'),
				'mgr_disapprove_reason' => Yii::t('app', 'Reason'),
				'hr_id' => Yii::t('app', 'HR'),
				'hr_approve' => Yii::t('app', 'HR Approves'),
				'hr_approve_datetime' => Yii::t('app', 'Signed'),
				'hr_disapprove_reason' => Yii::t('app', 'Reason'),
				'emp' => Yii::t('app', 'Employee'),
				'jobCode' => Yii::t('app', 'Type'),
				'reliever' => Yii::t('app', 'Reliever'),
				'sup' => Yii::t('app', 'Supervisor'),
				'hr' => Yii::t('app', 'HR'),
				'mgr' => Yii::t('app', 'Manager'),
				'timestamp' => Yii::t('app', 'Date Submitted'),
				'hrisLoaAttachments' => null,
        'hours' => Yii::t('app', 'Hours'),
        'minutes' => Yii::t('app', 'Minutes'),
			)
		);
	}
	
	public function beforeSave(){
		if($this->isNewRecord){
			$this->next_lvl_id = HrisAccessLvl::$RELIEVER;
			$this->dept_id = Yii::app()->user->getState('dept_id');
      
		}
    $this->hours_requested = $this->hours.':'.$this->minutes;		
		return parent::beforeSave();
	}
  
  public function afterFind(){
    $hrs_req = explode(':',$this->hours_requested);
    $this->hours = isset($hrs_req[0]) ? $hrs_req[0] : '00';
    $this->minutes = isset($hrs_req[1]) ? $hrs_req[1] : '00'; 
    return parent::afterFind();
  }
	
	/**
	*  	Checks the validity of the LOA Application(leave credits left, date range, application date policy, etc...
	*	@param boolean Whether the LOA application is valid
	*/
	public function isValidLoaApplication(){
		//scratch it: let everyone pass this time
		return true;
		
		
		//	trap invalid date range
		if(strtotime($this->from_datetime) >=  strtotime($this->to_datetime))	{
			$this->addError('from_datetime','Invalid Date Range: Start Date must be less than the End Date');
			$this->addError('to_datetime','Invalid Date Range: End Date must be greater than the Start Date');		
			Yii::log('LOA Invalid: Date Range!','error','app');
      return false;
		}
    
		//normalize the start and end datetime based on the scheduled shifts within that date period; validate if there are shifts within as well
		if($this->normalizeLeavePeriod()){   //means there are adjustments to the dates
		  //$this->addError('','normalizeLeavePeriod Error!');
      Yii::log('LOA Invalid: normalizeLeavePeriod!','error','app');
      return false;
		}

		// validate for VL Policy	
		if($this->job_code_id == '2003' and !$this->passVLPolicy($this->days_requested)){
			//$this->addError('','VL-2003 Policy Error!');
      Yii::log('LOA Invalid: VL-2003!','error','app');
      return false;
		}
		//echo 'job_code = '.$this->job_code_id; exit();
		
		//validate for SL Policy
		if($this->job_code_id == '2002' and !$this->passSLPolicy($this->days_requested)){			
			//$this->addError('','VL-2002 Policy Error!');
      Yii::log('LOA Invalid: VL-2002!','error','app');
      return false;
		}
		return true;
	}
  
   /**
   *   Calculates the hours being requested
   *   @params array $shifts_within_period  
   *   @return integer hours  
   */
   private function calculateHours($shifts_within_period){
      $this->hours_requested = WebApp::calculateWorkHours($this->from_datetime,$this->to_datetime,$shifts_within_period);  
   }
   private function calculateHours2($shifts_within_period){
      $start = strtotime($this->from_datetime);
      $end = strtotime($this->to_datetime);
      $hours = sizeof($shifts_within_period) * 8;
      //$this->addError('','Shift Hours: '.$hours);
      $adjust = abs($shifts_within_period[0]['TimeIn'] - $start);
     // $this->addError('','at shift start: '.($adjust/3600));
      if($start >= $shifts_within_period[0]['BreakEnd']) {
         $adjust -= 3600; 
      }
      if($end <= $shifts_within_period[sizeof($shifts_within_period)-1]['BreakStart']){
        $adjust -= 3600;
      }
      //$this->addError('','at break: '.($adjust/3600));
      $adjust += abs($shifts_within_period[sizeof($shifts_within_period)-1]['TimeOut'] - $end);
      //$this->addError('','at shift end: '.($adjust/3600));
      
      
      
      $hours -= floor($adjust/(60*60));
      $this->hours_requested = $hours;  
   } 
  
  /**
   *   Normalize the TimeIn and Out according to shift schedule
   *   @params  
   *   @return boolean Whether there are adjustments or not   
   */ 
  private function normalizeLeavePeriod(){
      $start = strtotime($this->from_datetime);
      $end = strtotime($this->to_datetime);
      $from_date = date('Y-m-d',$start);
      $to_datetime = date('Y-m-d',$end);
      $to_datetime .= ' 23:59:00';
      $shifts_within_period = WebApp::getScheduledShiftsWithin($from_date,$to_datetime,$this->emp_id);
      //check if there are shifts within the period
      if(sizeof($shifts_within_period)==0) {
          $msg = 'There are no scheduled shifts within the period you set.'." If this is incorrect, please contact the <a href='mailto:".Yii::app()->params['adminEmail']."'>HRIS Administrator</a> for this error.";
          $this->addError('',$msg);
          $this->addError('from_datetime','');
          $this->addError('to_datetime','');
          return true; 
      }else{
		$this->days_requested = sizeof($shifts_within_period);
	  }
	  
	  //echo '<pre>'; print_r($shifts_within_period); echo '</pre>';exit();
      
      //convert to time and add breaks
      foreach($shifts_within_period as $i=>$shift){
          $shifts_within_period[$i]['TimeIn']  = strtotime($shifts_within_period[$i]['TimeIn']);
          $shifts_within_period[$i]['TimeOut']  = strtotime($shifts_within_period[$i]['TimeOut']);
          $shifts_within_period[$i]['BreakStart'] = strtotime('+4 hours',$shifts_within_period[$i]['TimeIn']);
          $shifts_within_period[$i]['BreakEnd'] = strtotime('+1 hours',$shifts_within_period[$i]['BreakStart']);       
      }
      
       $hasAdjustments = false;
       //adjust start datetime if it falls within a break       
       if(($start >= $shifts_within_period[0]['BreakStart']) and ($start < $shifts_within_period[0]['BreakEnd'])){
          $this->from_datetime = date('Y-m-d H:i:s',$shifts_within_period[0]['BreakEnd']);
          $this->addError('from_datetime','Please review the adjusted values being highlighted.');
          Yii::app()->user->setFlash('start_datetime_normalized','<strong>Start Datetime Adjusted.</strong> It has been normalized to start after your break since it falls within that shift\'s break period.');
          $hasAdjustments = true;
       }
       
       //adjust end datetime if it is beyond the shift timeout
       if($end > $shifts_within_period[sizeof($shifts_within_period)-1]['TimeOut']){
         $this->to_datetime = date('Y-m-d H:i:s',$shifts_within_period[sizeof($shifts_within_period)-1]['TimeOut']);
         $this->addError('to_datetime','Please review the adjusted values being highlighted.');
         Yii::app()->user->setFlash('end_datetime_normalized','<strong>End Datetime Adjusted.</strong> It has been normalized according to that shift\'s scheduled time off.');
         $hasAdjustments = true;
       }
       //adjust end datetime if falls within a break
       if(($end > $shifts_within_period[sizeof($shifts_within_period)-1]['BreakStart']) and ($end <= $shifts_within_period[sizeof($shifts_within_period)-1]['BreakEnd'])){
          $this->to_datetime =  date('Y-m-d H:i:s',$shifts_within_period[sizeof($shifts_within_period)-1]['BreakStart']);
          $hasAdjustments = true;
          $this->addError('to_datetime','Please review the adjusted values being highlighted.');
          Yii::app()->user->setFlash('end_datetime_normalized','<strong>End Datetime Adjusted.</strong> It has been normalized to end on your break since it falls within that shift\'s break period.');  
       }
      //if(!$hasAdjustments)//calculate hours requested
          //$this->calculateHours($shifts_within_period); 
      return $hasAdjustments;
  }
	
	/**
	*	Checks whether the SL application is valid
	*		Must be employed for six months or more
	*		Max out is 15 days
	*		Enough SL credits
	*		Require attachment when requested is two or more days
	*	@param	string Days_Requested
	*	@return boolean Is_Valid_SL
	*/
	private function passSLPolicy($days_requested){
		//employee must be 6 months from date of hire
		if(!$this->passSixthMonthRule()){
			$this->addError('',"Not eligible for Sick Leave due to the six(6) months policy.");
			return false;
		}
		
		//max SL days is 15 days
		if($days_requested > 15){
			$this->addError('to_date',"Requested number of days($days_requested) is beyond the allowed maximum SL days.");
			return false;
		}
		
		// enough SL credits
		if(!$this->hasEnoughSLCredits($days_requested)){				
			return false;
		}
		
		// require attachment for two or more SL days
		if($days_requested >= 2 and !isset($_REQUEST['uploads'])){
			$this->addError('','Medical Certificate is required for two or more SL days. Days Requested: '.$days_requested);
			return false;
		}
		
		return true;
	}
	
	/**
	*	Checks if there is enough SL credits
	*	@param string Days_Requested
	*	@return boolean Has_Enough_SL_Credits
	*/
	private function hasEnoughSLCredits($days_requested){
		$hours_requested = $days_requested * 8;
		$sl_credits_hrs = self::getSLCredits(Yii::app()->user->getState('emp_id'));
		if($sl_credits_hrs == -1){
			$this->addError('',"There was an error retrieving the SL credits. Please contact the <a href='mailto:".Yii::app()->params['adminEmail']."'>HRIS Administrator</a> for this error.");
			return false;
		}
		if($sl_credits_hrs < $hours_requested){
			$this->addError('to_datetime',"Not enough SL Credits. Current Accrued Hours: $sl_credits_hrs, Requested Hours: $hours_requested");
			return false;
		}
		return true;
	}
	
	/**
	*	Gets the SL credits of an employee
	*	@param string Employee_ID
	*	@return float SL_Credits, -1 for error
	*/
	public static function getSLCredits($emp_id){
		try{
			$con = Yii::app()->db;
			$res = $con->createCommand()
					->select('SickLeave_Credits')
					->from('vacation_leave')
					->where("Emp_ID='$emp_id'")
					->queryRow();
			if($res==NULL) return -1;
			return $res['SickLeave_Credits'];
		}catch(Exception $ex){
			Yii::log('HrisLoaApplication::getSLCredits($emp_id):'.$ex->getMessage(), 'error', 'application');
			return -1;
		}
	}

	/**
	*	VL POLICIES: 	
	*			Must be 6 months or more to avail
	*			Must not be more than 15 days
	*			Must have enough VL credits accrued
	*			Request for Leave of Absence form should be submitted within reasonable time notices as follows:(include non-working days)
	*  				One (1) day or less: two (2) weeks notice in advance, 
	*   			More than one (1) day but less than five (5) days: One (1) month notice in advance.
	* 				Five (5) or more than five (5) days: Two (2) months notice in advance
	*	@param integer Days_Requested		
	*	@return boolean Whether VL is valid		
	*			
	*/	
	private function passVLPolicy($days_requested){
		//scratch it: let all pass
		//return true;
		
		//regular employee must be 6 months from date of hire
		// if(!$this->passSixthMonthRule()){
			// $this->addError('',"Not eligible for Vacation Leave due to the six(6) months policy.");
			// return false;
		// }
		
		//max VL days is 15 days
		if($days_requested > 15){
			$this->addError('to_date',"Requested number of days($days_requested) is beyond the allowed maximum VL days.");
			return false;
		}
		
		// enough VL credits
		if(!$this->hasEnoughVLCredits($days_requested)){
			return false;
		}
		
		//implement VL advance notice policy
		//scratch it: let all pass per special treatment requests
		return true;
		
		$now = date('Y-m-d',time());
		$today = time();
		$submit_date = strtotime($this->from_datetime);
		$diff = WebApp::diffBetweenDateTimeRange($this->from_datetime, $now);
		if($today >= $submit_date){
			$this->addError('from_datetime',"VL Submission Policy Violation! Today is already ".$diff['days']." day(s) past the submission date.");
			return false;
		}

		//14 days count from submission
		if(($days_requested <= 1) and ($diff['days'] < 14)){
			//$this->addError('','policy in effect : <= 1');
			$this->addError('from_datetime',"VL Submission Policy Violation! Today is ".$diff['days']." day(s) from start date. Notice must be 14 or more days.");
			return false;
		}
		
		// 30 days count from submission
		if(($days_requested > 1 and $days_requested < 5) and ($diff['days'] < 30)){
			//$this->addError('','policy in effect : > 1 and < 5');
			$this->addError('from_datetime',"VL Submission Policy Violation! Today is ".$diff['days']." day(s) from start date. Notice must be 30 or more days.");
			return false;
		}
		
		// 60 days count from submission
		if(($days_requested >= 5) and ($diff['days'] < 60)){
			//$this->addError('','policy in effect : >= 5');
			$this->addError('from_datetime',"LOA Submission Policy Violation! Today is ".$diff['days']." day(s) from start date. Notice must be 60 or more days.");
			return false;
		}
		
		

		return true;		
	}
	
	/**
	 * Checks if the employee has reached 6 months and more.
	 * This method will check to see if the employee has reached 6 months and more.
	 * @param integer Days_Requested.
	 * @return boolean whether there is enough VL Credits.
	 */
	 private function passSixthMonthRule(){
		$date_hired = $this->emp->Date_Hired;
		$now = date('Y-m-d',time());
		$diff = WebApp::diffBetweenDateTimeRange($date_hired, $now);
		//$this->addError('','Date Hired: '.$date_hired);
		//$this->addError('','Months Employed: '.$diff['months']);
		return ($diff['months'] >= 6);
	 }
	
	/**
	 * Checks if VL Credits is enough.
	 * This method will check to see if there is enough VL credits to be applied against the VL days requested.
	 * @param integer Days_Requested.
	 * @return boolean whether there is enough VL Credits.
	 */
	 private function hasEnoughVLCredits($days_requested){
		$hours_requested = $days_requested * 8;
		$vl_credits_hrs = self::getVLCredits(Yii::app()->user->getState('emp_id'));
		if($vl_credits_hrs == -1){
			$this->addError('',"There was an error retrieving the VL credits. Please contact the <a href='mailto:".Yii::app()->params['adminEmail']."'>HRIS Administrator</a> for this error.");
			return false;
		}
		if($vl_credits_hrs < $hours_requested){
			$this->addError('to_datetime',"Not enough VL Credits. Current Accrued Hours: $vl_credits_hrs, Requested Hours: $hours_requested");
			return false;
		}
		return true;
	 }
	
   /**
	*	HELPER: Get Pending LOAs for Approval
	* @param 
	* @return integer count
	*/
  public static function getPendingLoaApprovals(){
      $model = new HrisLoaApplication;
      $data = $model->getLOAForApproval();
      return $data->totalItemCount;
  }                 
  
	/**
	*	HELPER: Get VL Credits
	* @param string Employee_ID
	* @return integer VL_Credits_Accrued, -1 for error
	*/
	public static function getVLCredits($emp_id){
		try{
			$con = Yii::app()->db;
			$res = $con->createCommand()
					->select('VacLeave_Credits')
					->from('vacation_leave')
					->where("Emp_ID='$emp_id'")
					->queryRow();
			if($res==NULL) return -1;
			return $res['VacLeave_Credits'];
		}catch(Exception $ex){
			Yii::log('HrisLoaApplication::getVLCredits($emp_id):'.$ex->getMessage(), 'error', 'application');
			return -1;
		}
	}
	
	/**
	* Accesses the TC scheduler and count number of scheduled work days between the dates
	* @param string From_Datetime, To_Datetime
	* @return integer Number_of_Scheduled_Dayss
	*/
	private function getSchedDaysDatePeriod($from, $to){
		try{
			$tcsvr = Yii::app()->tcdb;
			$res = $tcsvr->createCommand()
				->select('count(*) as days')
				->from('EmployeeSchedules')
				->where("EmployeeId='".Yii::app()->user->getState('emp_id')."'")
				->andWhere("(TimeIn >= '$from') and (TimeOut <= '$to')")
				->queryRow();
		
			if($res['days']=="0")
				throw new Exception('There is no shift schedule between the date range you provided. Please widen your search.');
			return $res['days'];
		}catch(Exception $ex){
      Yii::log($ex->getMessage(),'info','app');
			$this->addError('',$ex->getMessage()." If this is incorrect, please contact the <a href='mailto:".Yii::app()->params['adminEmail']."'>HRIS Administrator</a> for this error.");
			return -1;
		}
	}
	
	/*
	* Checks whthere user can edit if the form has not yet been approved by at least one approver. Admins can edit over the fly
	* @return boolean Whether user is allowed to edit
	*/
	public function canEdit(){		
		//if(Yii::app()->user->getState('access_lvl_id')=='4') return true;//superusers have super access
		return ($this->reliever_approve===NULL and  $this->sup_approve===NULL and $this->hr_approve===NULL);//exit();		
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'LOA Application Form|LOA Application Forms', $n);
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
			
			default:$status="".$this->nextLvlId->status." | $employee | $loa_type";
		}
		return $status;
	}
	
	/**
	*	Gets the current form status
	*	@return string Status
	*/
	public function getCurrentStatus(){
		return $this->nextLvlId->status;
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
			
			default:$status="".$this->nextLvlId->status;
		}
		return $status;		
	}
	
	public function getAll(){
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('job_code_id', $this->job_code_id);
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

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
	
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('job_code_id', $this->job_code_id);
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

		//show only current user's applications
		$criteria->compare ('emp_id',Yii::app()->user->getState('emp_id'));
		
		

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
	
	/**
	*	Get LOAs for user approval	
	*	@return CActiveDataProvider LOAs for approval
	*/
	public function getLOAForApproval(){
		$criteria = new CDbCriteria;
		
		$criteria->compare('id', $this->id);
		$criteria->compare('job_code_id', $this->job_code_id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('from_datetime', $this->from_datetime, true);
		$criteria->compare('to_datetime', $this->to_datetime, true);
		$criteria->compare('reason', $this->reason, true);
		
		
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
      'pagination'=>false,
		));
	}
	
	/**
	*	Approves the application and determines the next approver
	*	@params string string Action(1=Approve, 0=Deny), string Reason for Denial
	*	@return boolean Approval_Success
	*/
	public function approveLOAORIG($action='0',$denial_reason='',$to_hr='0'){
		$success = false;
		$emp_id = Yii::app()->user->getState('emp_id');
		$now = new CDbExpression('NOW()');
		switch(Yii::app()->user->getState('access_lvl_id')){
			case HrisAccessLvl::$ADMINISTRATOR : 
				throw new CHttpException(401,'You are not authorized to sign this application form.');
			break;
			case HrisAccessLvl::$EMPLOYEE : 
				$this->reliever_id = $emp_id;
				$this->reliever_approve = $action;
				$this->reliever_approve_datetime = $now;
				$this->next_lvl_id = ($action == '1') ? HrisAccessLvl::$SUPERVISOR : HrisAccessLvl::$ULTIMATELY_DENIED;
				
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
				//sign as reliever if supervisor is reliever as well
				if($this->reliever_id == $emp_id and $this->next_lvl_id == HrisAccessLvl::$RELIEVER){
					$this->reliever_id = $emp_id;
					$this->reliever_approve = $action;
					$this->reliever_approve_datetime = $now;
				}
				
				$this->sup_id = $emp_id;
				$this->sup_approve = $action;
				$this->sup_approve_datetime = $now;
				$this->sup_disapprove_reason = ($action == '0') ? $denial_reason : NULL;
				$this->next_lvl_id = ($to_hr=='1') ? HrisAccessLvl::$HR : HrisAccessLvl::$MANAGER;
				$this->next_lvl_id = ($action == '0') ? HrisAccessLvl::$ULTIMATELY_DENIED : $this->next_lvl_id;
				$success = true;
			break;
			case HrisAccessLvl::$MANAGER : 
				//sign as reliever and supervisor if manager is reliever as well
				if($this->reliever_id == $emp_id and $this->next_lvl_id == HrisAccessLvl::$RELIEVER){
					$this->reliever_id = $this->sup_id = $emp_id;
					$this->reliever_approve = $this->sup_approve = $action;
					$this->reliever_approve_datetime = $this->sup_approve_datetime = $now;
					$this->sup_disapprove_reason = ($action == '0') ? $denial_reason : NULL;
				}
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
				//echo "<pre>";print_r($this->attributes);echo "</pre>";exit();
				if($action=='0')$success = true;
				//if($action=='1' and $this->logHours())
						//$success = true;	
				
				if($action=='1'){
					if($this->job_code == '2010' or $this->job_code == '2011'){ // LOAs without Pay
						//do nothing
						$success = true;
					}elseif($this->logHours()){
						$success = true;
					}else{
						Yii::log("Error: Can't decide with this LOA ID ".$this->id,'info','app');
						$success = false;
					}
				}
			break;
			default:throw new CHttpException(401,'You are not authorized to sign this application form.');
		}
		if($success)
			$this->queueEmail();  
		return $success;
	}
	
	public function approveLOA($action='0',$denial_reason='',$to_hr='0'){
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
						Yii::log("Error: Can't decide with this LOA ID ".$this->id,'info','app');
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
	
	private function userIsReliever(){
		$my_id = Yii::app()->user->getState('access_lvl_id');
		return (($this->reliever_approve == null) and ($my_id = $this->reliever_id));
	}
  
	public function queueEmail(){
      
      $content = "
         <p>Hi,</p>
         <p></p>
         <p>".$this->jobCode->title." has been updated to '".$this->getCurrentStatus()."'.</p>
         <p>".CHtml::link('View',Yii::app()->createAbsoluteUrl('hrisLoaApplication/view',array('id'=>$this->id)))."</p>
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
         <p>".CHtml::link('View',Yii::app()->createAbsoluteUrl('hrisLoaApplication/formyapproval',array('id'=>$this->id)))."</p>
         <p></p>
         <p>At Your Service,</p>
         <p></p>
         <p>HRIS-ECMCI</p>
         <p>(Please don't reply to this email.)</p>
         ";
      //webapp::queueEmail($model, $model_name, $to_user_id, $subject, $content, $email_group_id='', $group_content='')
      WebApp::queueEmail($this, 'HrisLoaApplication', $this->emp_id ,$this->getHeaderTitle(), $content, $this->next_lvl_id, $group_content);  
  }
	
	/**
	*	Logs the LOA to Employee Hours. Functionality is strongly dependendent on prior form data entry validation.
	*	@param 
	*	@return boolean Logged_Sucess
	*/
	private function logHoursORIG(){
		try{
				//throw new Exception('STOP. EmployeeHours table has been modified.');
				$start = $this->from_datetime;
				$end = $this->to_datetime;
				$emp_id = $this->emp_id;
				
				//echo 'start='.$start.' | '.'end='.$end; exit();
				
				//$normalized_start = WebApp::getInOutDatetimes($start,$emp_id);
				$normalized_end = WebApp::getInOutDatetimes($end,$emp_id);
				echo "normalized_start=".$normalized_start['TimeIn'].' | '."normalized_end=".$normalized_end['TimeOut']; exit();
				$shifts = WebApp::getScheduledShiftsWithin($normalized_start['TimeIn'],$normalized_end['TimeOut'],$emp_id);
				
				// clean our nulls
				echo '<pre>';
				print_r($shifts); exit();
				echo '</pre>';
				
				$shifts_copy = $shifts;

				//add breaks
				foreach($shifts as $i=>$shift){						
					$shifts_copy[$i]['BreakFlag'] = '1';
					$shifts_copy[$i]['BreakStart'] = date('Y-m-d H:i:s',strtotime("+4 hours",strtotime($shift['TimeIn'])));
					$shifts_copy[$i]['BreakEnd'] =  date('Y-m-d H:i:s',strtotime("+1 hours",strtotime($shifts_copy[$i]['BreakStart'])));
				}
        
				//adjust head and tail of the period
				if(strtotime($this->from_datetime) >= strtotime($shifts_copy[0]['BreakStart'])){
						$shifts_copy[0]['BreakFlag'] = '0';              
				}
				$shifts_copy[0]['TimeIn'] = $this->from_datetime;
				if(strtotime($this->to_datetime) <= strtotime($shifts_copy[sizeof($shifts_copy)-1]['BreakStart'])){
					  $shifts_copy[sizeof($shifts_copy)-1]['BreakFlag'] = '0'; 
				}
				$shifts_copy[0]['TimeOut'] = $this->to_datetime;

				
				//log the hours to employee_hrs
				foreach($shifts_copy as $i=>$shift){						
						if($shift['BreakFlag'] == '1'){
								$hrs = new EmployeeHrs;
								$hrs->emp_id = $this->emp_id;
								$hrs->job_code = $this->job_code_id;
								//$hrs->form_model_id = $this->id;
								$hrs->breakflag = '1';
								$hrs->datetime_in = $shift['TimeIn'];
								$hrs->datetime_out = $shift['BreakStart'];
								
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
								
								if(strtotime($shift['TimeOut']) > strtotime($shift['BreakEnd'])){
										$hrs = new EmployeeHrs;
										$hrs->emp_id = $this->emp_id;
										$hrs->job_code = $this->job_code_id;
										//$hrs->form_model_id = $this->id;
										$hrs->breakflag = '0';
										$hrs->datetime_in = $shift['BreakEnd'];
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
						}else{
								$hrs = new EmployeeHrs;
								$hrs->emp_id = $this->emp_id;
								$hrs->job_code = $this->job_code_id;
								//$hrs->form_model_id = $this->id;
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
				Yii::log("LOA ID ".$this->id." has been entered into Employee Hours by ".Yii::app()->user->getState('emp_id'),'info','app');
				$this->replicated_to_emp_hrs = '1';
				return true;
		}catch(Exception $ex){
				Yii::log($ex->getMessage()."LOA ID ".$this->id." failed entry into Employee Hours.",'info','app');
				//return false;
				echo $ex->getMessage();exit();
		}
	}
	
	
	private function logHours2(){
		return true;
	}
	
	//override last: 5.24.2013: unknown error not scheduled daw
	private function logHours(){
		try{
			$start_datetime = $this->from_datetime;
			$end_datetime = $this->to_datetime;
			//$start_datetime = date('Y-m-d', strtotime($this->from_datetime));
			//$end_datetime = $this->to_datetime;
			$emp_id = $this->emp_id;
			Yii::log("start_datetime = $start_datetime | end_datetime = $end_datetime",'info','app');
			$normalized_start = WebApp::getInOutDatetimes($start_datetime,$emp_id);
			$normalized_end = WebApp::getInOutDatetimes($end_datetime,$emp_id);
			$err = false;
			$err_msg = '';
			if(empty($normalized_start)) {
				$err = true;
				$err_msg = "NormalizedStart was null for LOA ID $this->id";				
			}
			if(empty($normalized_end)) {
				$err = true;
				$err_msg = "NormalizedEnd was null for LOA ID $this->id";
			}
			if($err) {
				Yii::log($err_msg,'info','app');
				echo "Can't approve LOA request ID $this->id. Please check if there is a scheduled shift within the period requested.";
				//return false;
			}
			$shifts = WebApp::getScheduledShiftsWithin($normalized_start['TimeIn'], $normalized_end['TimeOut'], $emp_id);
			
			// echo "<pre> BET $start_datetime AND $end_datetime";
			// print_r($shifts); exit();
			// echo '</pre>';
			
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
			Yii::log('LOA Logging Hours failed: '.$e->getMessage(),'info','app');
			return false;
		}
		return true;
	}
	
	public static function testlogHours(){
		try{
				$start = '2013-02-11 22:00:00';
				$end = '2013-02-12 08:00:00';
				$emp_id = '1078';

				$diff = WebApp::diffBetweenDateTimeRange($start, $end);
				
				$normalized_start = WebApp::getInOutDatetimes($start,$emp_id);
				$normalized_end = WebApp::getInOutDatetimes($end,$emp_id);
				$shifts = WebApp::getScheduledShiftsWithin($normalized_start['TimeIn'],$normalized_end['TimeOut'],$emp_id);
				
				if($shifts==NULL or sizeof($shifts)==0)throw new Exception('No schedule set.');
				
				echo '<pre>Sched Shifts w/o breaks.....';
				print_r($shifts);
				echo '</pre>';
				
				//add breaks to normal shifts
				foreach($shifts as $i=>$shift){
						$shifts[$i]['BreakStart'] = date('Y-m-d H:i:s',strtotime('+4 hours',strtotime($shift['TimeIn'])));
						$shifts[$i]['BreakEnd'] = date('Y-m-d H:i:s',strtotime('+1 hours',strtotime($shifts[$i]['BreakStart'])));
						$shifts[$i]['hasBreak'] = '1';
				}
				
				//plot the start and end dates
				if(strtotime($start) < strtotime($shifts[0]['BreakStart'])){
						
				}
				
				echo '<pre>Sched Shifts WITH breaks.....';
				print_r($shifts);
				echo '</pre>';
				
				exit();
				
				//log the hours to employee_hrs
				foreach($shifts_copy as $i=>$shift){						
						if($shift['BreakFlag'] == '1'){
								$hrs = new EmployeeHrs;
								$hrs->emp_id = $this->emp_id;
								$hrs->job_code = $this->job_code_id;
								$hrs->form_model_id = $this->id;
								$hrs->breakflag = '1';
								$hrs->datetime_in = $shift['TimeIn'];
								$hrs->datetime_out = $shift['BreakStart'];
								$hrs->save(false);
								
								if(strtotime($shift['TimeOut']) > strtotime($shift['BreakEnd'])){
										$hrs = new EmployeeHrs;
										$hrs->emp_id = $this->emp_id;
										$hrs->job_code = $this->job_code_id;
										$hrs->form_model_id = $this->id;
										$hrs->breakflag = '0';
										$hrs->datetime_in = $shift['BreakEnd'];
										$hrs->datetime_out = $shift['TimeOut'];
										$hrs->save(false);
								}
						}else{
								$hrs = new EmployeeHrs;
								$hrs->emp_id = $this->emp_id;
								$hrs->job_code = $this->job_code_id;
								$hrs->form_model_id = $this->id;
								$hrs->breakflag = '0';
								$hrs->datetime_in = $shift['TimeIn'];
								$hrs->datetime_out = $shift['TimeOut'];
								$hrs->save(false);
						}
						
				}
				
				Yii::log("LOA ID ".$this->id." has been entered into Employee Hours by ".Yii::app()->user->getState('emp_id'),'info','app');
				return true;
		}catch(Exception $ex){
				Yii::log("LOA ID ".$this->id." has been entered into Employee Hours by ".Yii::app()->user->getState('emp_id'),'info','app');
				return false;
		}
	}
	
	
}