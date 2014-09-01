<?php

/**
 * This is the model class for table "emp_workexp".
 *
 * The followings are the available columns in table 'emp_workexp':
 * @property integer $ID
 * @property integer $EmpID
 * @property string $FromDate
 * @property string $ToDate
 * @property string $PositionTitle
 * @property string $Company
 * @property string $MonthlySalary
 * @property string $SalaryGrade
 * @property string $StatAppointment
 * @property integer $GovtService
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpWorkexp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpWorkexp the static model class
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
		return 'emp_workexp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FromDate, PositionTitle,  Company ', 'required'),
			array('EmpID', 'numerical', 'integerOnly'=>true),
			array('PositionTitle, Company', 'length', 'max'=>100),
			array('MonthlySalary, StatAppointment', 'length', 'max'=>20),
			array('MonthlySalary', 'type', 'type'=>'float', 'message' => 'Incorrect value for {attribute}'),
			array('SalaryGrade', 'length', 'max'=>15),
			array('FromDate, ToDate', 'safe'),
			array('GovtService','boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, EmpID, FromDate, ToDate, PositionTitle, Company, MonthlySalary, SalaryGrade, StatAppointment, GovtService', 'safe', 'on'=>'search'),
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
			'emp' => array(self::BELONGS_TO, 'EmpInformation', 'EmpID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'EmpID' => 'Emp',
			'FromDate' => 'From',
			'ToDate' => 'To',
			'PositionTitle' => 'Position Title (Write in full)',
			'Company' => 'Department/ Agency/ Office/ Company',
			'MonthlySalary' => 'Monthly Salary',
			'SalaryGrade' => 'Salary Grade & Step Increment (Format "00-0")',
			'StatAppointment' => 'Status of Appointment',
			'GovtService' => 'Gov\'t Service',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('EmpID',$this->EmpID);
		$criteria->compare('FromDate',$this->FromDate,true);
		$criteria->compare('ToDate',$this->ToDate,true);
		$criteria->compare('PositionTitle',$this->PositionTitle,true);
		$criteria->compare('Company',$this->Company,true);
		$criteria->compare('MonthlySalary',$this->MonthlySalary,true);
		$criteria->compare('SalaryGrade',$this->SalaryGrade,true);
		$criteria->compare('StatAppointment',$this->StatAppointment,true);
		$criteria->compare('GovtService',$this->GovtService);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}