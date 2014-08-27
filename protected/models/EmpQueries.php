<?php

/**
 * This is the model class for table "emp_queries".
 *
 * The followings are the available columns in table 'emp_queries':
 * @property integer $EmpID
 * @property integer $ThirdDegreeRelated
 * @property string $TDRdetails
 * @property integer $FourthDegreeRelated
 * @property string $FDRdetails
 * @property integer $FormallyCharged
 * @property string $ChargedDetails
 * @property integer $AdminOffense
 * @property string $OffenseDetails
 * @property integer $CrimeConvicted
 * @property string $CrimeDetails
 * @property integer $SeparatedService
 * @property string $SSdetails
 * @property integer $ElectionCandidate
 * @property string $ECdetails
 * @property integer $Indigenous
 * @property string $IndiDetails
 * @property integer $DiffAbled
 * @property string $DAdetails
 * @property integer $SoloParent
 * @property string $SPdetails
 *
 * The followings are the available model relations:
 * @property EmpInformation $emp
 */
class EmpQueries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpQueries the static model class
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
		return 'emp_queries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$unselected = '{attribute} not selected';
		
		return array(
			 array('ThirdDegreeRelated, FourthDegreeRelated, FormallyCharged, AdminOffense, CrimeConvicted, SeparatedService, ElectionCandidate, Indigenous, DiffAbled, SoloParent', 'required'), 
			array('EmpID, ThirdDegreeRelated, FourthDegreeRelated, FormallyCharged, AdminOffense, CrimeConvicted, SeparatedService, ElectionCandidate, Indigenous, DiffAbled, SoloParent', 'numerical', 'integerOnly'=>true),
			array('TDRdetails, FDRdetails, ChargedDetails, OffenseDetails, CrimeDetails, SSdetails, ECdetails, IndiDetails, DAdetails, SPdetails', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EmpID, ThirdDegreeRelated, TDRdetails, FourthDegreeRelated, FDRdetails, FormallyCharged, ChargedDetails, AdminOffense, OffenseDetails, CrimeConvicted, CrimeDetails, SeparatedService, SSdetails, ElectionCandidate, ECdetails, Indigenous, IndiDetails, DiffAbled, DAdetails, SoloParent, SPdetails', 'safe', 'on'=>'search'),
			/* array('ThirdDegreeRelated', 'required', 'message'=>$unselected),
			array('ThirdDegreeRelated', 'in', 'range'=>array(0, 1)), */
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
			'ThirdDegreeRelated' => 'Third Degree Consanguinity : Y/N',
			'TDRdetails' => 'If YES, give details:',
			'FourthDegreeRelated' => 'Fourth Degree Consanguinity : Y/N',
			'FDRdetails' => 'If YES, give details:',
			'FormallyCharged' => 'Formally Charged : Y/N',
			'ChargedDetails' => 'If YES, give details:',
			'AdminOffense' => 'Admin Offense : Y/N',
			'OffenseDetails' => 'If YES, give details:',
			'CrimeConvicted' => 'Crime Convicted : Y/N',
			'CrimeDetails' => 'If YES, give details:',
			'SeparatedService' => 'Separated Service : Y/N',
			'SSdetails' => 'If YES, give details:',
			'ElectionCandidate' => 'Election Candidate : Y/N',
			'ECdetails' => 'If YES, give details:',
			'Indigenous' => 'Member of Indigenous group : Y/N',
			'IndiDetails' => 'If YES, please specify:',
			'DiffAbled' => 'Differently Abled : Y/N',
			'DAdetails' => 'If YES, please specify:',
			'SoloParent' => 'Solo Parent : Y/N',
			'SPdetails' => 'If YES, please specify:',
		);
	}
	public function getThirdDegree()
	{
		return array('No', 'Yes');
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
		$criteria->compare('ThirdDegreeRelated',$this->ThirdDegreeRelated);
		$criteria->compare('TDRdetails',$this->TDRdetails,true);
		$criteria->compare('FourthDegreeRelated',$this->FourthDegreeRelated);
		$criteria->compare('FDRdetails',$this->FDRdetails,true);
		$criteria->compare('FormallyCharged',$this->FormallyCharged);
		$criteria->compare('ChargedDetails',$this->ChargedDetails,true);
		$criteria->compare('AdminOffense',$this->AdminOffense);
		$criteria->compare('OffenseDetails',$this->OffenseDetails,true);
		$criteria->compare('CrimeConvicted',$this->CrimeConvicted);
		$criteria->compare('CrimeDetails',$this->CrimeDetails,true);
		$criteria->compare('SeparatedService',$this->SeparatedService);
		$criteria->compare('SSdetails',$this->SSdetails,true);
		$criteria->compare('ElectionCandidate',$this->ElectionCandidate);
		$criteria->compare('ECdetails',$this->ECdetails,true);
		$criteria->compare('Indigenous',$this->Indigenous);
		$criteria->compare('IndiDetails',$this->IndiDetails,true);
		$criteria->compare('DiffAbled',$this->DiffAbled);
		$criteria->compare('DAdetails',$this->DAdetails,true);
		$criteria->compare('SoloParent',$this->SoloParent);
		$criteria->compare('SPdetails',$this->SPdetails,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}