<?php

/**
 * This is the model class for table "emp_educbg".
 *
 * The followings are the available columns in table 'emp_educbg':
 * @property integer $ID
 * @property integer $EmpID
 * @property integer $EducLevel
 * @property string $NameofSchool
 * @property string $DegreeCourse
 * @property integer $YearGrad
 * @property string $HighestEarned
 * @property integer $FromDate
 * @property integer $ToDate
 * @property string $ScholarshipReceived
 *
 * The followings are the available model relations:
 * @property EmpEduclvl $educLevel
 * @property EmpInformation $emp
 */
class EmpEducbg extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpEducbg the static model class
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
		return 'emp_educbg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('EmpID', 'required'),
			array('EmpID, EducLevel, YearGrad, FromDate, ToDate', 'numerical', 'integerOnly'=>true),
			array('NameofSchool', 'length', 'max'=>250),
			array('DegreeCourse, HighestEarned', 'length', 'max'=>100),
			array('ScholarshipReceived, EducLevel', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, EmpID, EducLevel, NameofSchool, DegreeCourse, YearGrad, HighestEarned, FromDate, ToDate, ScholarshipReceived', 'safe', 'on'=>'search'),
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
			'educLevel' => array(self::BELONGS_TO, 'EmpEduclvl', 'EducLevel'),
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
			'EducLevel' => 'Level',
			'NameofSchool' => 'Name of School (Write in full)',
			'DegreeCourse' => 'Degree Course (Write in full)',
			'YearGrad' => 'Year Graduated (if graduated)',
			'HighestEarned' => 'Highest Grade/Level/Units Earned (if not graduated)',
			'FromDate' => 'From ',
			'ToDate' => 'To',
			'ScholarshipReceived' => 'Scholarship/Academic Honors Received',
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
		$criteria->compare('EducLevel',$this->EducLevel);
		$criteria->compare('NameofSchool',$this->NameofSchool,true);
		$criteria->compare('DegreeCourse',$this->DegreeCourse,true);
		$criteria->compare('YearGrad',$this->YearGrad);
		$criteria->compare('HighestEarned',$this->HighestEarned,true);
		$criteria->compare('FromDate',$this->FromDate);
		$criteria->compare('ToDate',$this->ToDate);
		$criteria->compare('ScholarshipReceived',$this->ScholarshipReceived,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}