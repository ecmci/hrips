<?php

/**
 * This is the model class for table "emp_ref".
 *
 * The followings are the available columns in table 'emp_ref':
 * @property integer $ID
 * @property integer $EmpID
 * @property string $RefName
 * @property string $RefAdd
 * @property string $Telno
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpRef extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpRef the static model class
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
		return 'emp_ref';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RefName,RefAdd,Telno', 'required'),
			array('EmpID', 'numerical', 'integerOnly'=>true),
			array('RefName', 'length', 'max'=>100),
			array('RefAdd', 'length', 'max'=>150),
			array('Telno', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, EmpID, RefName, RefAdd, Telno', 'safe', 'on'=>'search'),
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
			'RefName' => 'Name',
			'RefAdd' => 'Address',
			'Telno' => 'Tel. No',
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
		$criteria->compare('RefName',$this->RefName,true);
		$criteria->compare('RefAdd',$this->RefAdd,true);
		$criteria->compare('Telno',$this->Telno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}