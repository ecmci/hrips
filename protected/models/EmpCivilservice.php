<?php

/**
 * This is the model class for table "emp_civilservice".
 *
 * The followings are the available columns in table 'emp_civilservice':
 * @property integer $ID
 * @property integer $EmpID
 * @property string $CareerService
 * @property string $Rating
 * @property string $DateExam
 * @property string $ExamPlace
 * @property string $LicenseNumber
 * @property string $ReleaseDate
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpCivilservice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpCivilservice the static model class
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
		return 'emp_civilservice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CareerService', 'required'),
			array('EmpID', 'numerical', 'integerOnly'=>true),
			array('CareerService', 'length', 'max'=>300),
			array('Rating', 'length', 'max'=>100),
			array('ExamPlace', 'length', 'max'=>200),
			array('LicenseNumber', 'length', 'max'=>30),
			array('DateExam, ReleaseDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, EmpID, CareerService, Rating, DateExam, ExamPlace, LicenseNumber, ReleaseDate', 'safe', 'on'=>'search'),
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
			'CareerService' => 'Career Service',
			'Rating' => 'Rating',
			'DateExam' => 'Date Exam',
			'ExamPlace' => 'Exam Place',
			'LicenseNumber' => 'License Number',
			'ReleaseDate' => 'Release Date',
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
		$criteria->compare('CareerService',$this->CareerService,true);
		$criteria->compare('Rating',$this->Rating,true);
		$criteria->compare('DateExam',$this->DateExam,true);
		$criteria->compare('ExamPlace',$this->ExamPlace,true);
		$criteria->compare('LicenseNumber',$this->LicenseNumber,true);
		$criteria->compare('ReleaseDate',$this->ReleaseDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}