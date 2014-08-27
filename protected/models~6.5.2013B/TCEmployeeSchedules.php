<?php

/**
 * This is the model class for table "EmployeeSchedules".
 *
 * The followings are the available columns in table 'EmployeeSchedules':
 * @property integer $RecordId
 * @property double $EmployeeId
 * @property integer $Company
 * @property string $TimeIn
 * @property string $TimeOut
 * @property double $JobCode
 * @property integer $BreakFlag
 * @property string $Description
 * @property integer $Flags
 * @property string $Rate
 * @property string $UTCDateAdded
 */
class TCEmployeeSchedules extends CActiveRecord
{
	public function getDbConnection(){
		return Yii::app()->tcdb;
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TCEmployeeSchedules the static model class
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
		return 'EmployeeSchedules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EmployeeId, Company, TimeIn, TimeOut, JobCode, BreakFlag, Description, Flags', 'required'),
			array('Company, BreakFlag, Flags', 'numerical', 'integerOnly'=>true),
			array('EmployeeId, JobCode', 'numerical'),
			array('Description', 'length', 'max'=>30),
			array('Rate', 'length', 'max'=>19),
			array('UTCDateAdded', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('RecordId, EmployeeId, Company, TimeIn, TimeOut, JobCode, BreakFlag, Description, Flags, Rate, UTCDateAdded', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RecordId' => 'Record',
			'EmployeeId' => 'Employee',
			'Company' => 'Company',
			'TimeIn' => 'Time In',
			'TimeOut' => 'Time Out',
			'JobCode' => 'Job Code',
			'BreakFlag' => 'Break Flag',
			'Description' => 'Description',
			'Flags' => 'Flags',
			'Rate' => 'Rate',
			'UTCDateAdded' => 'Utcdate Added',
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

		$criteria->compare('RecordId',$this->RecordId);
		$criteria->compare('EmployeeId',$this->EmployeeId);
		$criteria->compare('Company',$this->Company);
		$criteria->compare('TimeIn',$this->TimeIn,true);
		$criteria->compare('TimeOut',$this->TimeOut,true);
		$criteria->compare('JobCode',$this->JobCode);
		$criteria->compare('BreakFlag',$this->BreakFlag);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Flags',$this->Flags);
		$criteria->compare('Rate',$this->Rate,true);
		$criteria->compare('UTCDateAdded',$this->UTCDateAdded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}