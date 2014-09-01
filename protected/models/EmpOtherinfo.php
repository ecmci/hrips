<?php

/**
 * This is the model class for table "emp_otherinfo".
 *
 * The followings are the available columns in table 'emp_otherinfo':
 * @property integer $EmpID
 * @property string $SkillsHobbies
 * @property string $NonAcadRecognition
 * @property string $MembershipAssocOrg
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpOtherinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpOtherinfo the static model class
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
		return 'emp_otherinfo';
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
			//array('EmpID', 'required'),
			array('EmpID', 'numerical', 'integerOnly'=>true),
			array('SkillsHobbies, NonAcadRecognition, MembershipAssocOrg', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EmpID, SkillsHobbies, NonAcadRecognition, MembershipAssocOrg', 'safe', 'on'=>'search'),
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
			'EmpID' => 'Emp',
			'SkillsHobbies' => 'Special Skills/Hobbies',
			'NonAcadRecognition' => 'Non-Academic Distinctions/Recognition (Write in full)',
			'MembershipAssocOrg' => 'Membership in Association/Organization (Write in full)',
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
		$criteria->compare('SkillsHobbies',$this->SkillsHobbies,true);
		$criteria->compare('NonAcadRecognition',$this->NonAcadRecognition,true);
		$criteria->compare('MembershipAssocOrg',$this->MembershipAssocOrg,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}