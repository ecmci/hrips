<?php

Yii::import('application.models._base.BaseHrisMuApplication');

class HrisMuApplication0 extends BaseHrisMuApplication
{
	
	public static $min_extension_minutes = 15;
  public static $min_extension_hours = 1;
  
  public $formInstrux = '<h6>Note:</h6>
							<p>1. Before you proceed, you must have already rendered the hours. "Clocked In" and "Clocked Out" means your exact punch in and punch out (including breaks) segment on the biometric timekeeping device.</p>
              <p>2. Your immediate supervisor will be the one to schedule your make up hours.</p>
              <p>3. Any excess minutes in your clock out punch is rounded down to a 15-minute block.</p>
	';
  
  public $formInstrux2 = '<h6>Note:</h6>
              <ol>
                  <li>Minimum qualifying hours: 1</li>
                  <li>Minimum qualifying minutes: 15</li>
              </ol>
  ';
  
	public $to_mgr = '0';
	public $action = '0';
	public $reason = '';
  public $hours_in, $minutes;
  public $from, $to, $mu_from, $mu_to;
  public $row_error;
  public $requested_total;
  
	
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
  
  public function encodeHoursRequested(){
    $this->hours = "$this->hours_in hours $this->minutes minutes";
  }
  
  // returns 1 = Success, Message = Error
  public function saveMuApplications($rows=array(), $hours=array()){
    if(empty($rows)) return 'Nothing to save since there were no checked clocked records.';
    $last_start = $this->from_datetime;
    $last_end = '';
    $sql_date_format = 'Y-m-d H:i:s';
    
    foreach($rows as $i=>$row){
      //$hours_in = (!empty($hours[$row]['hours_in'])) ? $hours[$row]['hours_in'] : '0';
      //$mins = (!empty($hours[$row]['minutes'])) ? $hours[$row]['minutes'] : '0';
      //$hours_in =  "$hours_in hours $mins minutes";
      $hours_in_short = isset($hours[$row]['extended']) ? $hours[$row]['extended'] : "00:00:00";
      $hours_in = explode(':',$hours_in_short);
      $hours_in = $hours_in[0].' hours '.$hours_in[1].' minutes';
      
      $app = new HrisMuApplication;
      $app->clockedin_datetime = date($sql_date_format,strtotime($hours[$row]['clockedin_datetime']));
      $app->clockedout_datetime = date($sql_date_format,strtotime($hours[$row]['clockedout_datetime']));
      $app->hours = $hours_in_short;
      $last_start = ($i == 0) ? $this->from_datetime :  $last_end;
      $last_end = date($sql_date_format, strtotime($hours_in, strtotime($last_start)));
      $app->from_datetime = $last_start;
      $app->to_datetime = $last_end;
      $app->reliever_id = $this->reliever_id;
      $app->reason = $this->reason;
      $app->remarks = $this->remarks;
      $app->record_ids = $hours[$row]['recordId'];
      if($app->save(false)){
        
      }
    }
        
    
    return '1';
  }
  
  // set whatever needs to be manually set before saving
  public function preSave(){
    // encode hours requested
    $requested = WebApp::parseSeconds($this->requested_total);
    $this->hours = $requested['hours']." hours ".$requested['mins']." minutes";
  }
  
 
  // returns total seconds
  public function addClockedHours($rows=array(),$hours=array()){
    $total = 0;
    $record_ids = array();   
    $hours_in = "00:00:00";
    foreach($rows as $row){
      $hours_in = isset($hours[$row]['extended']) ? $hours[$row]['extended'] : "00:00:00"; 
      $ext = explode(':',$hours_in);
      
      $total += $ext[0] * 60 * 60; // convert hours to seconds
      $total += $ext[1] * 60; // convert minutes to seconds
      $record_ids[] = $hours[$row]['recordId'];
    }
    // also register the time clock records                        
    if($record_ids) $this->record_ids = implode(',',$record_ids);
    $this->requested_total = $total;
        
    return $total;
  }
  
 
  
  
  public function isValidScheduledMakeUpOLD(){
    if(empty($this->from_datetime) or empty($this->to_datetime) ) return false;
    $valid = true;
    $requested = explode(' ',$this->hours);   // from string 'x hours y minutes'
    $seconds_requested = $requested[0] * 60 * 60; // convert hours to seconds
    $seconds_requested += $requested[2] * 60; // convert minutes to seconds
    
    $approved = explode(' ',$this->hours_approved);// from string 'x hours y minutes'
    $seconds_approved = $approved[0] * 60 * 60; // convert hours to seconds
    $seconds_approved += $approved[2] * 60; // convert minutes to seconds
    
    Yii::log('r='.$seconds_requested,'error','app');
    Yii::log('a='.$seconds_approved,'error','app');
    //Yii::log('s='.$this->scenario,'error','app');
    
    if ( $seconds_approved == 0 ){
      $valid = false;
      $this->addError('hours_approved','No hours approved.'); 
    }
    
    if ( $seconds_approved > $seconds_requested ){
      $valid = false;
      $this->addError('hours_approved','Hours approved exceeds hours clocked in/out. Hours Requested ='.$this->hours.' | Hours Approved = '.$this->hours_approved); 
    }
    
    return $valid;
  }
  
  public function isValidScheduledMakeUp(){
    if(empty($this->from_datetime) or empty($this->to_datetime) ) return false;
    $valid = true;
   
    $sApprovedFrom = strtotime($this->from_datetime);
    $sApprovedTo = strtotime($this->to_datetime);
    $sApprovedDiff = abs($sApprovedTo - $sApprovedFrom);
    
    if($sApprovedFrom >= $sApprovedTo){
       $valid = false;
       $this->addError('hours_approved','Invalid approved date range.');
    }
    
    
    
    $sRequestedFrom = strtotime($this->clockedin_datetime);
    $sRequestedTo = strtotime($this->clockedout_datetime);
    $sRequestedDiff = abs($sRequestedTo - $sRequestedFrom);
    
    Yii::log('r='.$sRequestedDiff,'error','app');
    Yii::log('a='.$sApprovedDiff,'error','app');
    
    
    if ( $sApprovedDiff > $sRequestedDiff ){
      $valid = false;
      $this->addError('hours_approved','Hours approved exceeds hours clocked in/out.'); 
    }
    
    return $valid;
  }
  
  public function encodeApprovedHours(){
    $diff = WebApp::diffBetweenDateTimeRange($this->from_datetime, $this->to_datetime);   
    $this->hours_approved = $diff['hours']." hours ".$diff['mins']." minutes";
    //Yii::log('ewrerewre='.$this->hours_approved, 'error','app');
  }
  
  // 1 = Valid, ErrorMessage = Invalid
  public function isValidMUApplication(){
    //return true;
	
	//check date range
    $start = strtotime($this->from_datetime);
    $end = strtotime($this->to_datetime);
    if($start >=  $end)	{			
      return "Invalid Date Range: Make Up Date Start must be less than Make Up Date End";
		}
    
    //check clocked and requested hours
    if(abs($start - $end) != $this->requested_total){
      $clocked = WebApp::parseSeconds($this->requested_total);
      $requested = WebApp::parseSeconds(abs($start - $end));
      return "Invalid request! The selected CLOCKED HOURS must total to your MAKE UP HOURS.<br><br>Clocked: ".$clocked['hours']." hours ".$clocked['mins']." minutes.<br>Requested: ".$requested['hours']." hours and ".$requested['mins']." minutes.";  
    }
    
    return '1';
  }
	
	public function isValidMUApplicationOld(){
		// check date range
		if(strtotime($this->clockedin_datetime) >=  strtotime($this->clockedout_datetime))	{
			$this->addError('clockedin_datetime','Invalid Date Range: Clocked In Date must be less than the Clocked Out Date');
			$this->addError('clockedout_datetime','Invalid Date Range: Clocked In Date must be less than the Clocked Out Date');		
			Yii::log('invalid date range!','error','app');
      return false;
		}
		
		// must be clocked in / out during that period and once in/out has been precisely adjusted, check rendered vs requested hours
		if(!$this->wasClockedInOut()){
      Yii::log('not wasClockedInOut!','error','app');
			return false;
		}elseif(!$this->enoughRenderedHours()){
      Yii::log('not enoughRenderedHours!','error','app');
      return false;
    }

		return true;
	}
  
  
  
  private function enoughRenderedHours(){
    if (empty($this->hours_in)) return false;
    
    $this->hours_in = (empty($this->hours_in)) ? 0 : $this->hours_in;
    $this->minutes = (empty($this->minutes)) ? 0 : $this->minutes;
    
    $valid = true;
    $diff = WebApp::diffBetweenDateTimeRange($this->clockedin_datetime, $this->clockedout_datetime);
    $seconds_rendered = strtotime($this->clockedout_datetime) - strtotime($this->clockedin_datetime);
    $seconds_requested = $this->hours_in * 60 * 60;
    $seconds_requested += $this->minutes * 60;
      
    if( $seconds_rendered < $seconds_requested ){
      $this->addError('hours_in','Not enough rendered hours. You can request a maximum of '.$diff['hours'].' hours and '.$diff['mins'].' minutes.');
      $this->addError('minutes','');
      $valid = false;
    }    
    return $valid;
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
			$this->addError('clockedin_datetime','Your clocked in record shows '.$data[0]['TimeIn'].'. Please correct accordingly.');
			$valid = false;
		}
		if(strtotime($data[$size-1]['TimeOut']) < strtotime($this->clockedout_datetime)){
			$this->addError('clockedout_datetime','Your clocked out record shows '.$data[$size-1]['TimeOut'].'. Please correct accordingly.');
			$valid = false;
		}
		return $valid;
	}
  
  public function canStillUpdate(){
    return $this->emp_id == Yii::app()->user->getState('emp_id') AND $this->next_lvl_id == HrisAccessLvl::$EMPLOYEE;
  }
  
  public function canStillCancel(){
    if ($this->emp_id != Yii::app()->user->getState('emp_id'))return false;
    if ($this->next_lvl_id == HrisAccessLvl::$CANCELLED ) return false;
    if ($this->next_lvl_id == HrisAccessLvl::$ULTIMATELY_APPROVED ) return false;
    if ($this->next_lvl_id == HrisAccessLvl::$APPROVED_COPY_FURNISHED) return false;    
    if ($this->next_lvl_id == HrisAccessLvl::$ULTIMATELY_DENIED) return false;    
    return true;
  }
  
  public function parseHours(){
    $data = explode(':',$this->hours);
    $this->hours_in = $data[0];
    $this->minutes = $data[1];
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
        $this->next_lvl_id = ($this->next_lvl_id == HrisAccessLvl::$ULTIMATELY_APPROVED) ? HrisAccessLvl::$APPROVED_COPY_FURNISHED : $this->next_lvl_id;
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
	  $success = true;	
    try{
      $hrs = new EmployeeHrs;
      $employeeko = Employee::model()->findByPk($this->emp_id);
      $hrs->emp_id = $this->emp_id;
      $hrs->job_code = $this->job_code_id;
      $hrs->schedule = $employeeko->Schedule;
      $hrs->breakflag = '0';
      $hrs->datetime_in = $this->from_datetime;
      $hrs->datetime_out = $this->to_datetime;
      
      //dummy data
      $hrs->sched_in = $this->from_datetime;
      $hrs->sched_out = $this->to_datetime;
      $hrs->process = '0';
      $hrs->raw_mins_late = '00:00:00';
      $hrs->mins_late = '00:00:00';
      $hrs->hrs_late = '0.00';
      $hrs->hrs_patch = '0.00';
      $hrs->updated_to_payroll = '0';
      $hrs->Amt = '0.00';
      
      if(!$hrs->save(false))
        throw new Exception('Failed to log MU ID '.$this->id.' to Employee Hours.');		
      
      $this->	replicated_to_emp_hrs = '1';  
        
    }catch(Exception $e){
      Yii:log($e->getMessage(),'info','app');
      $success = false;
    }   
    return $success;
    //return false;
	}
	
	private function logHours0(){
		
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
			array('clockedin_datetime, clockedout_datetime, reliever_id, reason, hours_in, minutes','required','on'=>'apply'),
      array('reliever_id, reason, hours', 'required' ,'on'=>'update'),
			array('from_datetime, to_datetime', 'required' ,'on'=>'approve_sup'),
      array('record_ids, from_datetime, to_datetime, reliever_id, reason', 'required' ,'on'=>'apply_ajax'),
			array('emp_id, job_code_id, reliever_id, reliever_approve, sup_id, sup_approve, hr_id, hr_approve, hours_in', 'numerical', 'integerOnly'=>true),
			array('from_datetime, to_datetime, hours,remarks, reliever_approve_datetime, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, hours_in, minutes, from, to, mu_from, mu_to, record_ids, requested_total', 'safe'),
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
  
  public function getExtendedHours(){
    $data = array();
    $sql_date_format = 'Y-m-d';
    $global_date_format = Yii::app()->params['dateFormat'];
    $now = time();
    $days_ago = '7'; // default is 1 week
    // 1. Set default period
    $this->from = (empty($this->from)) ? date($sql_date_format,strtotime("-$days_ago days",$now)) : date($sql_date_format,strtotime($this->from));
    $this->to = (empty($this->to)) ? date($sql_date_format,strtotime('-1 days',$now)) : date($sql_date_format,strtotime($this->to));
    // 2. Get scheduled and clocked hours for the period 
   $records = Yii::app()->tcdb->createCommand()
                  ->select('eh.TimeIn as clockedin,es.TimeIn schedin, eh.TimeOut as clockedout, es.TimeOut as schedout, eh.BreakFlag as break, eh.RecordId as recordid, jc.Description as jobcodetitle')
                  ->from('EmployeeHours eh')
                  ->join('EmployeeSchedules es','((es.EmployeeId = eh.EmployeeId) and (eh.TimeIn >= es.TimeIn and eh.TimeIn <= es.TimeOut))')
                  ->join('MasterJobCodeList jc','jc.JobCode = eh.JobCode')
                  ->where("eh.EmployeeId = '".Yii::app()->user->getState('emp_id')."'")
                  ->andWhere("eh.TimeIn >= '$this->from' and eh.TimeIn <= '$this->to'")
                  ->andWhere("es.TimeIn >= '$this->from' and es.TimeIn <= '$this->to'")
                  ->order('eh.TimeIn desc')
                  ->queryAll();

    // 3. Evaluate scheduled vs clocked entries
    foreach($records as $i=>$record){
      $data[$i]['ClockedIn'] = strtotime($record['clockedin']);
      $data[$i]['ClockedOut'] = strtotime($record['clockedout']);
      $data[$i]['SchedIn'] = strtotime($record['schedin']);
      $data[$i]['SchedOut'] = strtotime($record['schedout']);
      
      $data[$i]['ClockedInDate'] = date($global_date_format,$data[$i]['ClockedIn']);
      $data[$i]['ClockedOutDate'] = date($global_date_format,$data[$i]['ClockedOut']);
      $data[$i]['SchedInDate'] = date($global_date_format,$data[$i]['SchedIn']);
      $data[$i]['SchedOutDate'] = date($global_date_format,$data[$i]['SchedOut']);
      
      $data[$i]['break'] = $record['break'];
      // conditions: 1. ClockIn is within SchedIn and SchedOut but extends, 2. ClockIn is before SchedIn, 3. ClockIn is after SchedOut 
      $data[$i]['$withinScheduledInOutExtended'] =  ($data[$i]['ClockedIn'] >= $data[$i]['SchedIn'] AND $data[$i]['ClockedIn'] <= $data[$i]['SchedOut'] AND $data[$i]['ClockedOut'] > $data[$i]['SchedOut']);
      $data[$i]['beforeScheduledIn'] = ($data[$i]['ClockedIn'] < $data[$i]['SchedIn']);
      $data[$i]['afterScheduledOut'] = ($data[$i]['ClockedIn'] > $data[$i]['SchedOut']);
      $data[$i]['isExtended'] = ($data[$i]['$withinScheduledInOutExtended'] OR $data[$i]['beforeScheduledIn'] OR $data[$i]['afterScheduledOut']);
      //$data[$i]['isExtended'] = true;
      $data[$i]['extendedHours'] = 0;
      $data[$i]['extendedMinutes'] = 0;

      $diff = array('hours'=>'','mins'=>'');
      if($data[$i]['$withinScheduledInOutExtended']){        
        $diff = WebApp::diffBetweenDateTimeRange($data[$i]['ClockedOutDate'], $data[$i]['SchedOutDate']);         
      }elseif($data[$i]['beforeScheduledIn']){
        $diff = WebApp::diffBetweenDateTimeRange($data[$i]['SchedInDate'], $data[$i]['ClockedInDate']);
      }elseif($data[$i]['afterScheduledOut']){
        $diff = WebApp::diffBetweenDateTimeRange($data[$i]['ClockedOutDate'], $data[$i]['ClockedInDate']);
      }
      
      $data[$i]['extendedHours'] = ($diff['hours'] < 10) ? '0'.$diff['hours'] : $diff['hours'];
      $data[$i]['extendedMinutes'] = ($diff['mins'] < 10) ? '0'.$diff['mins'] : $diff['mins'];
      $data[$i]['extended'] = $data[$i]['extendedHours'].':'.$data[$i]['extendedMinutes'].':00';
      
      //don't display extended hours < 1
      $data[$i]['extendedHours'] = ($data[$i]['extendedHours'] < 1) ? '0' : $data[$i]['extendedHours'];
      // check if this is approved or in process      
      $data[$i]['hasBeenApplied'] = $this->hasApprovedOrProcessedRecord($record['recordid']);
      
      
      $data[$i]['recordId'] = $record['recordid'];
      $data[$i]['jobCodeTitle'] = $record['jobcodetitle'];      
    }   
//     echo '<pre>';
//     print_r($data);
//     echo '</pre>';
    return $data; 
  }
  
  public function getExtendedHours0(){
    $data = array();        
    // set default cut off period if not set
    $now = time();
    $this->from = (empty($this->from)) ? date('Y-m-d',strtotime("-7 days",$now)) : $this->from;
    $this->to = (empty($this->to)) ? date('Y-m-d',$now).' 23:59:00' : $this->to.' 23:59:00';
    
    // calculate excess hours per day and make data container
    $tcdata = Yii::app()->tcdb->createCommand()
					->select('RecordId,TimeIn,TimeOut')
					->from('EmployeeHours')
					->where("EmployeeId = '".Yii::app()->user->getState('emp_id')."'")
					->andWhere("TimeIn >= '$this->from'")
					->andWhere("TimeOut <= '$this->to'")
          ->andWhere("JobCode = '2000'")
					->order('TimeIn asc')
					->queryAll();
    foreach($tcdata as $i=>$d){
      $in = strtotime($d['TimeIn']);
      $out = strtotime($d['TimeOut']);
      $data[$i]['TimeIn'] = date(Yii::app()->params['dateFormat'],$in);
      $data[$i]['TimeOut'] = date(Yii::app()->params['dateFormat'],$out);
      $diff = WebApp::diffBetweenDateTimeRange($d['TimeIn'], $d['TimeOut']);
      $data[$i]['HoursWorked'] = $diff['hours'];
      $data[$i]['HoursExtended'] = ($diff['hours'] > 4) ? ($diff['hours'] - 4) : '';
      $application = $this->hasRecord($d['RecordId']);
      $data[$i]['Consumed'] = ($application) ? $application->id : false;
      $data[$i]['RecordId'] = $d['RecordId'];
    }
    
    return $data; 
  }
  
  //check if clocked hours is existing and not denied.
  public function hasApprovedOrProcessedRecord($record_id){    
    $statuses[] = HrisAccessLvl::$RELIEVER;
    $statuses[] = HrisAccessLvl::$SUPERVISOR;
    $statuses[] = HrisAccessLvl::$MANAGER;
    $statuses[] = HrisAccessLvl::$HR;
    $statuses[] = HrisAccessLvl::$ULTIMATELY_APPROVED;
    $statuses[] = HrisAccessLvl::$APPROVED_COPY_FURNISHED;
    
    
    $app = HrisMuApplication::model()->exists(array(
      'select'=>'id',
      'condition'=>"emp_id ='".Yii::app()->user->getState('emp_id')."' and record_ids like '%$record_id%' and (next_lvl_id in (".implode(',',$statuses)."))",
      ));
    if($app) {
      Yii::log('REC_ID PRESENT: '.$record_id,'error','app');
    }
    
    return $app;
  }
	
	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'emp_id' => Yii::t('app', 'Employee'),
			'job_code_id' => Yii::t('app', 'Job Code'),
			'next_lvl_id' => Yii::t('app', 'Status'),
			'clockedin_datetime' => Yii::t('app', 'In'),
			'clockedout_datetime' => Yii::t('app', 'Out'),
			'hours' => Yii::t('app', 'Extended Hours'),
      'hours_approved' => Yii::t('app', 'Approved Hours'),
			'from_datetime' => Yii::t('app', 'MU From'),
			'to_datetime' => Yii::t('app', 'MU To'),
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
	
		/* 
		*	Determine which forms to pull up depending on the access level of the logged in user
		*/
		$emp_id = Yii::app()->user->getState('emp_id');
		$access_lvl_id = Yii::app()->user->getState('access_lvl_id');
		$dept_id = Yii::app()->user->getState('dept_id');
		
		//for employees and everyone, get all reliever approvals
		$criteria->addCondition("reliever_id='$emp_id' AND reliever_approve IS NULL",'OR');
		
    //exclude cancelled applications
    $criteria->addCondition( "next_lvl_id != '".HrisAccessLvl::$CANCELLED."'");
    
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
    
    $criteria->order = "emp_id asc, timestamp asc";
			
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array('pageSize'=>'10'),
		));
	}
  
  public function getBriefReason(){
    return substr($this->reason,0,25).'...';
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
    
    //exclude cancelled applications
    $criteria->addCondition( "next_lvl_id != '".HrisAccessLvl::$CANCELLED."'" );
		
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
    $criteria->order = 'timestamp desc';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
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
		$criteria->compare('sup_approve', $this->sup_approve);
		$criteria->compare('sup_approve_datetime', $this->sup_approve_datetime, true);
		$criteria->compare('sup_disapprove_reason', $this->sup_disapprove_reason, true);
		$criteria->compare('hr_id', $this->hr_id);
		$criteria->compare('hr_approve', $this->hr_approve);
		$criteria->compare('hr_approve_datetime', $this->hr_approve_datetime, true);
		$criteria->compare('hr_disapprove_reason', $this->hr_disapprove_reason, true);
		$criteria->compare('timestamp', $this->timestamp, true);

    

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
  
  public function renderRowError($data,$row){
    echo "<span id='record-$row'></span>";
  }
}