<?php

/**
 * This is the model class for table "emp_children".
 *
 * The followings are the available columns in table 'emp_children':
 * @property integer $ID
 * @property integer $EmpID
 * @property string $ChildName
 * @property string $BirthDate
 * @property string $added
 * @property string $modif
 * @property string $temp
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpChildren extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpChildren the static model class
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
		return 'emp_children';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ChildName, BirthDate', 'required'),
			//array('EmpID', 'numerical', 'integerOnly'=>true),
			//array('ChildName', 'length', 'max'=>100),
			//array('BirthDate', 'length', 'max'=>50),
			array('BirthDate', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),
			array('temp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, EmpID, ChildName, BirthDate, added, modif, temp', 'safe', 'on'=>'search'),
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
			'ChildName' => 'Name of Child (Write full name and list all)',
			'BirthDate' => 'Date of Birth',
			'added' => 'Added',
			'modif' => 'Modif',
			'temp' => 'Temp',
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
		$criteria->compare('ChildName',$this->ChildName,true);
		$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('modif',$this->modif,true);
		$criteria->compare('temp',$this->temp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}