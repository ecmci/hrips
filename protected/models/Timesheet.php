<?php
class Timesheet extends CActiveRecord{
	public $EmployeeId, $TimeIn, $TimeOut, $JobCode, $BreakFlag;

  public static function model($className=__CLASS__) {
  	return parent::model($className);
  }
  
  public function tableName() {
		return 'employee_hrs';
	}
  
  public function tcTableName() {
		return 'EmployeeHours';
	}
  
  public function rules() {
		return array(
			array('EmployeeId', 'required'),
      array('TimeIn, TimeOut, JobCode, BreakFlag', 'safe'),
		);
	}

  public function attributeLabels() {
		return array(
			'empId' => Yii::t('app', 'Employee ID'),
      'from' => Yii::t('app', 'From'),
      'to' => Yii::t('app', 'To'),
		);
	}
  
  public function search() {
    $this->TimeIn = empty($this->TimeIn) ? date('Y-m-d',strtotime('-15 days',time())) : $this->TimeIn;
    $this->TimeOut = empty($this->TimeOut) ? date('Y-m-d',time()) : $this->TimeOut;  
    $rows = Yii::app()->tcdb->createCommand()
      ->select("TimeIn,TimeOut,JobCode,BreakFlag")
      ->from($this->tcTableName())
      ->where("EmployeeId = ".$this->EmployeeId)
      ->andWhere("TimeIn BETWEEN '".date('Y-m-d H:i:s',strtotime($this->TimeIn))."' AND '".date('Y-m-d',strtotime($this->TimeOut))." 23:55:00'")
      ->order("TimeIn desc")
      ->queryAll();
    
		return new CArrayDataProvider($rows, array(
			'keyField' => 'RecordId',
      'pagination'=>false
		));    
	}

} 
?>