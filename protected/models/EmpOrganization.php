<?php

/**
 * This is the model class for table "emp_organization".
 *
 * The followings are the available columns in table 'emp_organization':
 * @property integer $ID
 * @property integer $EmpID
 * @property string $NameAddressOrg
 * @property string $FromDate
 * @property string $ToDate
 * @property string $NoOfHrs
 * @property string $PositionNatureOfWork
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpOrganization extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpOrganization the static model class
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
		return 'emp_organization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NameAddressOrg, PositionNatureOfWork, FromDate', 'required'),
			array('EmpID', 'numerical', 'integerOnly'=>true),
			array('NameAddressOrg', 'length', 'max'=>300),
			array('NoOfHrs', 'length', 'max'=>20),
			array('PositionNatureOfWork', 'length', 'max'=>100),
			array('FromDate, ToDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, EmpID, NameAddressOrg, FromDate, ToDate, NoOfHrs, PositionNatureOfWork', 'safe', 'on'=>'search'),
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
			'NameAddressOrg' => 'Name & Address of Organization (Write in full)',
			'FromDate' => 'From',
			'ToDate' => 'To',
			'NoOfHrs' => 'No. Of Hours',
			'PositionNatureOfWork' => 'Position/Nature Of Work',
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
		$criteria->compare('NameAddressOrg',$this->NameAddressOrg,true);
		$criteria->compare('FromDate',$this->FromDate,true);
		$criteria->compare('ToDate',$this->ToDate,true);
		$criteria->compare('NoOfHrs',$this->NoOfHrs,true);
		$criteria->compare('PositionNatureOfWork',$this->PositionNatureOfWork,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}