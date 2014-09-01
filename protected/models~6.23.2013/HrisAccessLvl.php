<?php

Yii::import('application.models._base.BaseHrisAccessLvl');

class HrisAccessLvl extends BaseHrisAccessLvl
{
	/**
	*	Static Values from hris_access_lvl table
	**/
	public static $EMPLOYEE = '1';
	public static $RELIEVER = '1';
	public static $SUPERVISOR = '2';
	public static $MANAGER = '6';
	public static $HR = '3';
	public static $ADMINISTRATOR = '4';
	public static $EMPLOYER = '5';
	public static $PAYROLL_MASTER = '5';
	public static $STOP = '7';
	public static $ULTIMATELY_APPROVED = '8';
	public static $ULTIMATELY_DENIED = '9';
	public static $COPY_FURNISHED = '10';
	
	
   public static function getStatusList(){
    return CHtml::listData(HrisAccessLvl::model()->findAll(array(
      //'order'=>'Lname asc',
      //'condition'=>"Act_Status = 'Active'",
      )),'id','status');
  } 
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}