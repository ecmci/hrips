<?php

Yii::import('application.models._base.BaseEmployee');

class Employee extends BaseEmployee
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public static function getEmployeeList(){
    return CHtml::listData(Employee::model()->findAll(array(
      'order'=>'Lname asc',
      'condition'=>"Act_Status = 'Active'",
      )),'Emp_ID','fullName');
  }
  
  public static function getEmployeeListWithBadge(){
    return CHtml::listData(Employee::model()->findAll(array(
      'order'=>'Lname asc',
      'condition'=>"Act_Status = 'Active'",
      )),'Emp_ID','empIdFullName');
  }
	
	public function getEmpIdFullName(){
		return $this->Emp_ID.' - '.$this->Lname.', '.$this->Fname;	
	}
	
	 public function getFullName(){
		return $this->Lname.', '.$this->Fname;	
	}
		
}