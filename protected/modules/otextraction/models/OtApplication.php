<?php

/**
 * This is the model class for table "hris_ot_application".
 *
 * The followings are the available columns in table 'hris_ot_application':
 * @property integer $id
 * @property integer $dept_id
 * @property integer $emp_id
 * @property integer $next_lvl_id
 * @property integer $job_code_id
 * @property string $sub_code_id
 * @property string $in_datetime
 * @property string $out_datetime
 * @property string $reason
 * @property string $approved_hours
 * @property integer $sup_id
 * @property integer $sup_approve
 * @property string $sup_approve_datetime
 * @property string $sup_disapprove_reason
 * @property integer $mgr_id
 * @property integer $mgr_approve
 * @property string $mgr_approve_datetime
 * @property string $mgr_disapprove_reason
 * @property integer $hr_id
 * @property integer $hr_approve
 * @property string $hr_approve_datetime
 * @property string $hr_disapprove_reason
 * @property integer $employer_id
 * @property integer $employer_approve
 * @property string $employer_approve_datetime
 * @property string $employer_disapprove_reason
 * @property integer $replicated_to_emp_hrs
 * @property integer $is_entered
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Employee $sup
 * @property Employee $mgr
 * @property Employee $hr
 * @property Employee $employer
 * @property JobCode $jobCode
 * @property HrisDept $dept
 * @property HrisAccessLvl $nextLvl
 * @property Employee $emp
 * @property HrisOtAttachments[] $hrisOtAttachments
 */
class OtApplication extends CActiveRecord
{
	public $from, $to;
  
  /**
   *    Queries and Retrieves OT records from the Time Clock 
   *    @return array OT records
   */        
  public function getOvertimes(){
    $tcsvr = Yii::app()->tcdb;
    //queries the server and returns an array of records
    $records = $tcsvr->createCommand()
              ->select('EmployeeId,TimeIn,TimeOut') 
              ->from('EmployeeHours')
              ->where("JobCode ='2001'") 
              ->andWhere("TimeIn >= '".$this->from."'")
              ->andWhere("TimeIn <= '".$this->to."'")
              ->andWhere("EmployeeId = '".Yii::app()->user->getState("emp_id")."'")
              ->order("EmployeeId asc, TimeIn asc")
              ->queryAll();
      return  $records;
  }
  
  /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OtApplication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hris_ot_application';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dept_id, emp_id, next_lvl_id, job_code_id, sub_code_id, in_datetime, out_datetime, reason, timestamp', 'required'),
			array('dept_id, emp_id, next_lvl_id, job_code_id, sup_id, sup_approve, mgr_id, mgr_approve, hr_id, hr_approve, employer_id, employer_approve, replicated_to_emp_hrs, is_entered', 'numerical', 'integerOnly'=>true),
			array('sub_code_id', 'length', 'max'=>10),
			array('approved_hours', 'length', 'max'=>64),
			array('from,to,sup_approve_datetime, sup_disapprove_reason, mgr_approve_datetime, mgr_disapprove_reason, hr_approve_datetime, hr_disapprove_reason, employer_approve_datetime, employer_disapprove_reason', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dept_id, emp_id, next_lvl_id, job_code_id, sub_code_id, in_datetime, out_datetime, reason, approved_hours, sup_id, sup_approve, sup_approve_datetime, sup_disapprove_reason, mgr_id, mgr_approve, mgr_approve_datetime, mgr_disapprove_reason, hr_id, hr_approve, hr_approve_datetime, hr_disapprove_reason, employer_id, employer_approve, employer_approve_datetime, employer_disapprove_reason, replicated_to_emp_hrs, is_entered, timestamp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sup' => array(self::BELONGS_TO, 'Employee', 'sup_id'),
			'mgr' => array(self::BELONGS_TO, 'Employee', 'mgr_id'),
			'hr' => array(self::BELONGS_TO, 'Employee', 'hr_id'),
			'employer' => array(self::BELONGS_TO, 'Employee', 'employer_id'),
			'jobCode' => array(self::BELONGS_TO, 'JobCode', 'job_code_id'),
			'dept' => array(self::BELONGS_TO, 'HrisDept', 'dept_id'),
			'nextLvl' => array(self::BELONGS_TO, 'HrisAccessLvl', 'next_lvl_id'),
			'emp' => array(self::BELONGS_TO, 'Employee', 'emp_id'),
			'hrisOtAttachments' => array(self::HAS_MANY, 'HrisOtAttachments', 'form_model_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dept_id' => 'Dept',
			'emp_id' => 'Emp',
			'next_lvl_id' => 'Next Lvl',
			'job_code_id' => 'Job Code',
			'sub_code_id' => 'Sub Code',
			'in_datetime' => 'In Datetime',
			'out_datetime' => 'Out Datetime',
			'reason' => 'Reason',
			'approved_hours' => 'Approved Hours',
			'sup_id' => 'Sup',
			'sup_approve' => 'Sup Approve',
			'sup_approve_datetime' => 'Sup Approve Datetime',
			'sup_disapprove_reason' => 'Sup Disapprove Reason',
			'mgr_id' => 'Mgr',
			'mgr_approve' => 'Mgr Approve',
			'mgr_approve_datetime' => 'Mgr Approve Datetime',
			'mgr_disapprove_reason' => 'Mgr Disapprove Reason',
			'hr_id' => 'Hr',
			'hr_approve' => 'Hr Approve',
			'hr_approve_datetime' => 'Hr Approve Datetime',
			'hr_disapprove_reason' => 'Hr Disapprove Reason',
			'employer_id' => 'Employer',
			'employer_approve' => 'Employer Approve',
			'employer_approve_datetime' => 'Employer Approve Datetime',
			'employer_disapprove_reason' => 'Employer Disapprove Reason',
			'replicated_to_emp_hrs' => 'Replicated To Emp Hrs',
			'is_entered' => 'Is Entered',
			'timestamp' => 'Timestamp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('dept_id',$this->dept_id);
		$criteria->compare('emp_id',$this->emp_id);
		$criteria->compare('next_lvl_id',$this->next_lvl_id);
		$criteria->compare('job_code_id',$this->job_code_id);
		$criteria->compare('sub_code_id',$this->sub_code_id,true);
		$criteria->compare('in_datetime',$this->in_datetime,true);
		$criteria->compare('out_datetime',$this->out_datetime,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('approved_hours',$this->approved_hours,true);
		$criteria->compare('sup_id',$this->sup_id);
		$criteria->compare('sup_approve',$this->sup_approve);
		$criteria->compare('sup_approve_datetime',$this->sup_approve_datetime,true);
		$criteria->compare('sup_disapprove_reason',$this->sup_disapprove_reason,true);
		$criteria->compare('mgr_id',$this->mgr_id);
		$criteria->compare('mgr_approve',$this->mgr_approve);
		$criteria->compare('mgr_approve_datetime',$this->mgr_approve_datetime,true);
		$criteria->compare('mgr_disapprove_reason',$this->mgr_disapprove_reason,true);
		$criteria->compare('hr_id',$this->hr_id);
		$criteria->compare('hr_approve',$this->hr_approve);
		$criteria->compare('hr_approve_datetime',$this->hr_approve_datetime,true);
		$criteria->compare('hr_disapprove_reason',$this->hr_disapprove_reason,true);
		$criteria->compare('employer_id',$this->employer_id);
		$criteria->compare('employer_approve',$this->employer_approve);
		$criteria->compare('employer_approve_datetime',$this->employer_approve_datetime,true);
		$criteria->compare('employer_disapprove_reason',$this->employer_disapprove_reason,true);
		$criteria->compare('replicated_to_emp_hrs',$this->replicated_to_emp_hrs);
		$criteria->compare('is_entered',$this->is_entered);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}