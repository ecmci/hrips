<?php
class HrisMuApplication1 extends HrisMuApplication0{
  	public function rules() {
  		return array(
        //convert
        array('to_datetime','validateMUDates','on'=>'convert'),
        array('from_datetime','validateStartDate','on'=>'convert'),
        array('clockedin_datetime, clockedout_datetime, reliever_id, from_datetime, to_datetime, reason','required','on'=>'convert'),
        
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
 

}
?>