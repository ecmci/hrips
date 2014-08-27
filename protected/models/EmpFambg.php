<?php

/**
 * This is the model class for table "emp_fambg".
 *
 * The followings are the available columns in table 'emp_fambg':
 * @property integer $EmpID
 * @property string $SpouseLname
 * @property string $SpouseFname
 * @property string $SpouseMname
 * @property string $SpouseOccupation
 * @property string $SpouseEmployer
 * @property string $SpouseBusinessAddress
 * @property string $SpouseTelno
 * @property string $FatherLname
 * @property string $FatherFname
 * @property string $FatherMname
 * @property string $MotherMaiden
 * @property string $MotherLname
 * @property string $MotherFname
 * @property string $MotherMname
 * @property integer $Children
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpFambg extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpFambg the static model class
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
		return 'emp_fambg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FatherLname, FatherFname, MotherLname, MotherFname', 'required'),
			array('EmpID, Children', 'numerical', 'integerOnly'=>true),
			array('SpouseLname, SpouseFname, SpouseMname, FatherLname, FatherFname, FatherMname, MotherMaiden, MotherLname, MotherFname, MotherMname', 'length', 'max'=>50),
			array('SpouseOccupation', 'length', 'max'=>100),
			array('SpouseEmployer, SpouseBusinessAddress', 'length', 'max'=>250),
			array('SpouseTelno', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EmpID, SpouseLname, SpouseFname, SpouseMname, SpouseOccupation, SpouseEmployer, SpouseBusinessAddress, SpouseTelno, FatherLname, FatherFname, FatherMname, MotherMaiden, MotherLname, MotherFname, MotherMname, Children', 'safe', 'on'=>'search'),
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
			'SpouseLname' => 'Spouse\'s Surname',
			'SpouseFname' => 'Spouse\'s First Name',
			'SpouseMname' => 'Spouse\'s Middle Name',
			'SpouseOccupation' => 'Occupation',
			'SpouseEmployer' => 'Employer/Bus. Name',
			'SpouseTelno' => 'Telephone No.',
			'FatherLname' => 'Father\'s Surname',
			'FatherFname' => 'Father\'s First Name',
			'FatherMname' => 'Father\'s Middle Name',
			'MotherMaiden' => 'Mother\'s Maiden Name',
			'MotherLname' => 'Mother\'s Surname',
			'MotherFname' => 'Mother\'s First Name',
			'MotherMname' => 'Mother\'s Middle Name',
			'Children' => 'Children',
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

		$criteria->compare('EmpID',$this->EmpID);
		$criteria->compare('SpouseLname',$this->SpouseLname,true);
		$criteria->compare('SpouseFname',$this->SpouseFname,true);
		$criteria->compare('SpouseMname',$this->SpouseMname,true);
		$criteria->compare('SpouseOccupation',$this->SpouseOccupation,true);
		$criteria->compare('SpouseEmployer',$this->SpouseEmployer,true);
		$criteria->compare('SpouseBusinessAddress',$this->SpouseBusinessAddress,true);
		$criteria->compare('SpouseTelno',$this->SpouseTelno,true);
		$criteria->compare('FatherLname',$this->FatherLname,true);
		$criteria->compare('FatherFname',$this->FatherFname,true);
		$criteria->compare('FatherMname',$this->FatherMname,true);
		$criteria->compare('MotherMaiden',$this->MotherMaiden,true);
		$criteria->compare('MotherLname',$this->MotherLname,true);
		$criteria->compare('MotherFname',$this->MotherFname,true);
		$criteria->compare('MotherMname',$this->MotherMname,true);
		$criteria->compare('Children',$this->Children);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}