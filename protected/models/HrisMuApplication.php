<?php
/**
 * Revision dated 8.19.2013
 *
 */  
class HrisMuApplication extends HrisMuApplication0{
    public $from_staggered, $to_staggered, $applied_total, $rows, $mode, $ext_recs_count, $mu_recs_count;
    
    public static $MIN_HOURS = 1;
    
    //Now includes unscheduled clock ins
    public function getExtendedHours(){
      //format variables                   
      $date_format = Yii::app()->params['dateFormat'];
      $sql_date_format = 'Y-m-d';
      $days_ago = '7';
      $now = time();
      
     
      //get clocked hours per range
      $this->from = (empty($this->from)) ? date($sql_date_format,strtotime("-$days_ago days",$now)) : date($sql_date_format,strtotime($this->from));
      $this->to = (empty($this->to)) ? date($sql_date_format,strtotime('-1 days',$now)) : date($sql_date_format,strtotime($this->to));

      $from = $this->from;
      $to = $this->to;
      $emp_id = Yii::app()->user->getState('emp_id');
      $clocked_hrs = Yii::app()->tcdb->createCommand()
                      ->select('TimeIn, TimeOut, BreakFlag, RecordId, JobCode')
                      ->from('EmployeeHours')
                      ->where("TimeIn between '$from' and '$to'")
                      ->andWhere("EmployeeId = '$emp_id'")
                      ->order('TimeIn asc')
                      ->queryAll();
      
      $data = array();
 
      //for each clocked hours, 
      foreach($clocked_hrs as $i=>$hrs){
        //do not include overtime or job code 2001
        if($hrs['JobCode'] == '2001') continue;
        
        //register hours
        $tIn = strtotime($hrs['TimeIn']);
        $tOut = strtotime($hrs['TimeOut']);
        
        //retrieve schedule
        $in = date('Y-m-d',$tIn);
        $out = date('Y-m-d',$tOut);
        $sched = Yii::app()->tcdb->createCommand()
                  ->select('TimeIn, TimeOut')
                  ->from('EmployeeSchedules')
                  ->where("TimeIn between '$in' and '$in 23:55:00'")
                  ->orWhere("TimeOut between '$out' and '$out 23:55:00'")
                  ->andWhere("EmployeeId = '$emp_id'")
                  ->order('TimeIn asc')
                  ->limit(1);
        $sched = $sched->queryRow();
        
        //examine hours
        $is_ext = '0';
        $ext = 0;
        $hours = 0;
        $minutes = 0;
        $sin = '-Unscheduled-';
        $sout = '-Unscheduled-';
        if(empty($sched)){ // 1. If not scheduled
          $is_ext = '1';
          $ext += $tOut - $tIn;
        }else{ // 2. is scheduled
          $sin = $sched['TimeIn'];
          $sout = $sched['TimeOut'];
          
          $sIn = strtotime($sched['TimeIn']);
          $sOut = strtotime($sched['TimeOut']);
          
          if($tIn < $sIn){ //clocked in before sched in?            
            $ext += $sIn - $tIn;
            $is_ext = '1';  
          }
          
          if($tOut > $sOut){ //clocked out after sched out?
            $is_ext = '1';
            $ext += $tOut - $sOut;
          }
        }
        
        //calculate overall extended hours
        $hours = floor($ext / 3600);
        $minutes = (($ext - ($hours * 60 * 60)) / 60);
        
        //set data variables
        if($hours >= self::$min_extension_hours or $minutes >= self::$min_extension_minutes) {
          $data[$i]['ClockedInDate'] = date($date_format, strtotime($hrs['TimeIn']));
          $data[$i]['ClockedOutDate'] = date($date_format, strtotime($hrs['TimeOut']));
          $data[$i]['ClockedIn'] = $tIn;
          $data[$i]['ClockedOut'] = $tOut;
          $data[$i]['SchedIn'] = $sIn;
          $data[$i]['SchedOut'] = $sOut;
          $data[$i]['break'] = $hrs['BreakFlag'];
          $data[$i]['hasBeenApplied'] = $this->hasApprovedOrProcessedRecord($hrs['RecordId']);
          $data[$i]['isExtended'] = $is_ext;

          $data[$i]['extendedHours'] = $hours;
          $data[$i]['extendedMinutes'] = $minutes;
          $hours = $hours < 10 ? '0'.$hours : $hours;
          $minutes = $minutes < 10 ? '0'.$minutes : $minutes;
          $data[$i]['extended'] = "$hours:$minutes:00";
          $data[$i]['SchedInDate'] = ($sin != '-Unscheduled-') ? date($date_format,strtotime($sin)) : $sin;
          $data[$i]['SchedOutDate'] = ($sout != '-Unscheduled-') ? date($date_format,strtotime($sout)) : $sout;
          $data[$i]['recordId'] = $hrs['RecordId'];
          $data[$i]['jobCodeTitle'] = $hrs['JobCode'];
        }
      }//end foreach clocked hour
      
      //return data
      return $data; 
    }
    
    
    public function totalClockedHours(){
      $this->applied_total = 0;
      if(empty($this->rows)) return;
      foreach($this->rows as $i=>$row){
        if($row == '1'){
          $ext = explode(':',$this->hours[$i]['extended']);
          $this->applied_total += ($ext[0] * 3600) + ($ext[1] * 60); 
          $this->ext_recs_count++;         
        }
      }
      //Yii::log('totalClockedHours: '.$this->applied_total,'error','app');
    }
    
    public function totalMUHours(){
      $this->requested_total = 0; 
      if(empty($this->from_datetime)) return;
      foreach($this->from_datetime as $i=>$from){
        $start = strtotime($from);
        $end = strtotime($this->to_datetime[$i]);
        $this->requested_total += $end - $start;
        $this->mu_recs_count++;
      }
      //Yii::log('totalMUHours: '.$this->requested_total,'error','app');
    }
    
    public function beforeValidate(){      
      if($this->scenario == 'convert') return true;
      $this->totalClockedHours();
      $this->totalMUHours();
      return parent::beforeValidate();
    }
    
    public function saveMU(){
      $result = '0';
      switch($this->mode){
        case 'one-to-many' : $result = $this->saveAsOneToMany(); break;
        case 'many-to-one' : $result = $this->saveAsManyToOne(); break;
      }
      return $result;  
    }
    
    private function saveAsOneToMany(){
      $sql_datetime = 'Y-m-d H:i:s';
      try{
        $last_start = 0;
        $record_id = '';
        foreach($this->rows as $row=>$selected){ //start clocked hours
          if($selected == '1'){
            $last_start = strtotime($this->hours[$row]['sched_out']);
            $record_id = $this->hours[$row]['recordId'];    
          }  
        }
        foreach($this->from_datetime as $i=>$from_datetime){
          //pre-calc
          $from = strtotime($from_datetime);
          $to = strtotime($this->to_datetime[$i]);          
          $in = $last_start;
          $last_start = $out = strtotime('+ '.($to - $from).' seconds',$in);
          $duration = WebApp::parseSeconds($to-$from);
          $duration = ($duration['hours'] < 10 ? '0'.$duration['hours'] : $duration['hours']).':'.($duration['mins'] < 10 ? '0'.$duration['mins'] : $duration['mins']).':00';
          
          //save MU
          $mu = new self;
          $mu->clockedin_datetime = date($sql_datetime,$in);
          $mu->clockedout_datetime = date($sql_datetime,$out);
          $mu->hours = $mu->hours_approved = $duration;
          $mu->from_datetime = date($sql_datetime,$from);
          $mu->to_datetime = date($sql_datetime,$to);
          $mu->reason = $this->reason;
          $mu->remarks = $this->remarks;
          $mu->reliever_id = $this->reliever_id;
          $mu->record_ids = $record_id;
          
          if(!$mu->save(false)){
            $f = new CActiveForm;
            throw new Exception($f->errorSummary($mu));
          }else{
            Yii::log('MU ID '.$mu->id.' successfully submitted by '.Yii::app()->user->getState('id'),'error','app');
          }
        }
        return '1';  
      }catch(Exception $ex){
        $this->addError('','An error occurred while saving: '.$ex->getMessage().'. Call IT Support for this error.');
      }
    }
    
    private function saveAsManyToOne(){
      $sql_datetime = 'Y-m-d H:i:s';
      try{
        $last_start = 0;
        foreach($this->from_datetime as $key=>$value){ $last_start = strtotime($value); break; }
        foreach($this->rows as $i=>$row){
          if($row == '1'){
            //pre-calc
            $extended = explode(':',$this->hours[$i]['extended']);
            $in = strtotime($this->hours[$i]['clockedin_datetime']);
            $out = strtotime($this->hours[$i]['clockedout_datetime']); 
            $from = $last_start;             
            $to = strtotime('+ '.$extended[0].' hours '.$extended[1].' minutes',$from); 
            
            //track last start
            $last_start = $to; 
            
            $mu = new self;
            $mu->clockedin_datetime = date($sql_datetime,$in);
            $mu->clockedout_datetime = date($sql_datetime,$out);
            $mu->hours = $mu->hours_approved = $this->hours[$i]['extended'];
            $mu->from_datetime = date($sql_datetime,$from);
            $mu->to_datetime = date($sql_datetime,$to);
            $mu->reason = $this->reason;
            $mu->remarks = $this->remarks;
            $mu->reliever_id = $this->reliever_id;
            $mu->record_ids = $this->hours[$i]['recordId'];
            
            if(!$mu->save(false)){
              $f = new CActiveForm;
              throw new Exception($f->errorSummary($mu));
            }else{
              Yii::log('MU ID '.$mu->id.' successfully submitted by '.Yii::app()->user->getState('id'),'error','app');
            }
          } 
        }
        return '1';    
      }catch(Exception $ex){
        $this->addError('','An error occurred while saving: '.$ex->getMessage().'. Call IT Support for this error.');
      }
    }
    
    public function rules() {
  		return array(
        //convert
        array('to_datetime','validateMUDates','on'=>'convert'),
        array('from_datetime','validateStartDate','on'=>'convert'),
        array('clockedin_datetime, clockedout_datetime, reliever_id, from_datetime, to_datetime, reason','required','on'=>'convert'),
        
  			array('clockedin_datetime, clockedout_datetime, reliever_id, reason, hours_in, minutes','required','on'=>'apply'),
        array('reliever_id, reason, hours', 'required' ,'on'=>'update'),
  			array('from_datetime, to_datetime', 'required' ,'on'=>'approve_sup'),
        
        array('reliever_id, reason', 'required' ,'on'=>'apply_ajax'),
        array('rows','validateExtendedHours','on'=>'apply_ajax'),
        array('from_datetime', 'validateMultipleMUDates' ,'on'=>'apply_ajax'),
        array('to_datetime', 'validateAppliedRequested' ,'on'=>'apply_ajax'),
        array('mode', 'validateMode' ,'on'=>'apply_ajax'),
  			
        array('emp_id, job_code_id, reliever_id, reliever_approve, sup_id, sup_approve, hr_id, hr_approve, hours_in', 'numerical', 'integerOnly'=>true),
  			array('clockedin_datetime, clockedout_datetime, from_datetime, to_datetime, hours,remarks, reliever_approve_datetime, sup_approve_datetime, sup_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, hours_in, minutes, from, to, mu_from, mu_to, record_ids, requested_total, rows, mode', 'safe'),
  			array('job_code_id, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'default', 'setOnEmpty' => true, 'value' => null),
  			array('id, emp_id, hours ,job_code_id, next_lvl_id ,clockedin_datetime, clockedout_datetime, from_datetime, to_datetime, reason, remarks, reliever_id, reliever_approve, reliever_approve_datetime, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason', 'safe', 'on'=>'search'),
  		);
	 }
   
   public function validateAppliedRequested(){
        $applied = WebApp::parseSeconds($this->applied_total);
        $requested = WebApp::parseSeconds($this->requested_total);
      if($this->applied_total != $this->requested_total){
        $applied['hours'] = $applied['hours'] < 10 ? '0'.$applied['hours'] : $applied['hours'];
        $applied['mins'] = $applied['mins'] < 10 ? '0'.$applied['mins'] : $applied['mins'];
        $requested['hours'] = $requested['hours'] < 10 ? '0'.$requested['hours'] : $requested['hours'];
        $requested['mins'] = $requested['mins'] < 10 ? '0'.$requested['mins'] : $requested['mins'];
        $this->addError('','Your requested make up hours does not toal with your extended hours.<br />APPLIED: '.$applied['hours'].':'.$applied['mins'].'<br />REQUESTED: '.$requested['hours'].':'.$requested['mins']);        
      }
      if($requested['hours'] < self::$MIN_HOURS){
        $this->addError('','The minimum required is '.self::$MIN_HOURS.' hour(s).');  
      }                                                                                                                        
   }                                                                                                                            
   
   public function validateExtendedHours(){
    if($this->applied_total == 0){
      $this->addError('rows','You must select at least one record from the extended hours section.');
    } 
   }
   
   //now supports staggered MU dates
   public function validateMultipleMUDates(){
    if($this->requested_total == 0){
      $this->addError('rows','You must define at least one make up date.');
    }                                                                                                                        
   }
   
   public function validateMode(){
    if($this->mode == 'one-to-many' and $this->ext_recs_count > 1){
      $this->addError('from_datetime','Staggered Mode Requirement: Check only one(1) record in the extended hours section.');
    }
    if($this->mode == 'one-to-many' and $this->mu_recs_count < 2){
      $this->addError('from_datetime','Staggered Mode Requirement: Define at least two(2) dates in the make up dates section.');
    }
    if($this->mode == 'many-to-one' and $this->mu_recs_count > 1){
      $this->addError('from_datetime','Normal Mode Requirement: Define only one(1) date in the make up dates section. Otherwise, change the mode to Staggerred.');
    }
   }
   
   public function validateStartDate(){
      if(!$this->hasSchedule()){
        $this->addError('from_datetime','You have no shift schedule for this date.');
      }
   }
                                           
   public function validateMUDates(){
      $from = strtotime($this->from_datetime);
      $to = strtotime($this->to_datetime);
      $in = strtotime($this->clockedin_datetime);
      $out = strtotime($this->clockedout_datetime);
      if($to < $from){
        $this->addError('to_datetime','Invalid date range.');
      }
      
      if(($to-$from) > ($out-$in)){
        $this->addError('to_datetime','Your make up date duration has exceeded your clocked hours.');  
      }
      

   }
   
   public function hasSchedule(){
    return true;
   }
   
    public function renderActionsColumn(){
      $baseUrl = Yii::app()->createUrl('hrisMuApplication');
      $data = '
        <div class="btn-group">
          <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
            Action
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="'.$baseUrl.'/view/id/'.$this->id.'"><i class="icon-eye-open"></i> View</a></li>
            <li><a href="#" onclick="cancelMU('.$this->id.')"><i class="icon-trash"></i> Cancel</a></li>
          </ul>
        </div>
      ';
      echo $data;
    }
 

}
?>