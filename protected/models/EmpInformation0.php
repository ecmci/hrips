<?php
Yii::import('application.models._base.BaseEmpInformation');
/**
 * This is the model class for table "emp_information".
 *
 * The followings are the available columns in table 'emp_information':
 * @property integer $EmpID
 * @property string $FirstName
 * @property string $LastName
 * @property string $MiddleName
 * @property string $NameExt
 * @property string $EmpName
 * @property string $ResidentialAddress
 * @property string $RAZipCode
 * @property string $RATelno
 * @property string $HomeAddress
 * @property string $HAZipCode
 * @property string $HATelno
 * @property string $ContactNo
 * @property string $BirthDate
 * @property string $BdayPlace
 * @property integer $Gender
 * @property integer $CivilStat
 * @property string $Citizenship
 * @property string $Height
 * @property string $Weight
 * @property string $BloodType
 * @property string $DateHire
 * @property string $DateRehire
 * @property string $DateResignation
 * @property string $DateTermination
 * @property string $DateRetirement
 * @property string $SSS
 * @property string $TIN
 * @property string $PHIC
 * @property string $HDMF
 * @property string $AcctNo
 * @property integer $AgencyEmpNo
 * @property string $Department
 * @property string $Position
 * @property string $ExtensionNo
 * @property string $OfficeSeatLocation
 * @property string $EmailAddress
 * @property integer $Tenant
 * @property integer $BedNo
 * @property string $Allowance
 * @property string $DateAPE
 * @property integer $CertifyTrue
 * @property integer $NewEmp
 * @property integer $TaxCertNo
 * @property string $IssuedAt
 * @property string $IssuedOn
 * @property string $DateAccomplished
 * @property string $DateModified
 * @property integer $LastModifiedBy
 *
 * The followings are the available model relations:
 * @property EmpChildren[] $empChildrens
 * @property EmpCivilservice[] $empCivilservices
 * @property EmpEducbg[] $empEducbgs
 * @property EmpFambg $empFambg
 * @property EmpGender $gender
 * @property EmpCivilstat $civilStat
 * @property EmpOrganization[] $empOrganizations
 * @property EmpOtherinfo[] $empOtherinfos
 * @property EmpQueries $empQueries
 * @property EmpRef[] $empRefs
 * @property EmpTraining[] $empTrainings
 * @property EmpWorkexp[] $empWorkexps
 */
class EmpInformation0 extends GxActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmpInformation the static model class
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
		return 'emp_information';
	}
	public static function label($n = 1) {
		return Yii::t('app', 'PDS|PDS', $n);
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EmpID, FirstName, LastName, EMGName, EMGRelation, EMGAddress, EMGContactNum', 'required'), //, Tenant, DateAccomplished, DateModified
			array('EmpID, Gender, CivilStat, AgencyEmpNo, Tenant, BedNo, CertifyTrue, NewEmp, LastModifiedBy', 'numerical', 'integerOnly'=>true),
			array('FirstName, LastName, MiddleName, EmpName, Position, OfficeSeatLocation, IssuedAt', 'length', 'max'=>50),
			array('NameExt, Height, Weight, ExtensionNo', 'length', 'max'=>10),
			array('BdayPlace', 'length', 'max'=>100),
			array('RAZipCode, HAZipCode', 'length', 'max'=>15),
			array('RATelno, HATelno', 'length', 'max'=>30),
			array('ContactNo, EmailAddress, TaxCertNo', 'length', 'max'=>25),
			array('Citizenship, SSS, TIN, PHIC, HDMF, AcctNo, Allowance', 'length', 'max'=>20),
			array('BloodType', 'length', 'max'=>5),
			array('Position, Department, BirthDate, DateHire, DateRehire, DateResignation, DateTermination, DateRetirement, DateAPE, IssuedOn, ResidentialAddress,HomeAddress', 'safe'),
			array('CertifyTrue', 'compare', 'compareValue' => true, 
              'message' => 'You must declare under oath the authenticity of the information in this Personal Data Sheet by checking the appropriate box below.' ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('EmpID, FirstName, LastName, MiddleName, NameExt, EmpName, ResidentialAddress, RAZipCode, RATelno, HomeAddress, HAZipCode, HATelno, ContactNo, BirthDate, BdayPlace, Gender, CivilStat, Citizenship, Height, Weight, BloodType, DateHire, DateRehire, DateResignation, DateTermination, DateRetirement, SSS, TIN, PHIC, HDMF, AcctNo, AgencyEmpNo, Department, Position, ExtensionNo, OfficeSeatLocation, EmailAddress, Tenant, BedNo, Allowance, DateAPE, CertifyTrue, NewEmp, TaxCertNo, IssuedAt, IssuedOn, DateAccomplished, DateModified, LastModifiedBy', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(								//EmpAppraisals
			'empAppraisals' => array(self::HAS_MANY, 'EmpAppraisals', 'EmpID'), 
			'empChildrens' => array(self::HAS_MANY, 'EmpChildren', 'EmpID'),
			'empCivilservices' => array(self::HAS_MANY, 'EmpCivilservice', 'EmpID'),
			'empEducbgs' => array(self::HAS_MANY, 'EmpEducbg', 'EmpID'),
			'empFambg' => array(self::HAS_ONE, 'EmpFambg', 'EmpID'),
			'gender' => array(self::BELONGS_TO, 'EmpGender', 'Gender'),
			'civilStat' => array(self::BELONGS_TO, 'EmpCivilstat', 'CivilStat'),
			'empOrganizations' => array(self::HAS_MANY, 'EmpOrganization', 'EmpID'),
			'empOtherinfos' => array(self::HAS_MANY, 'EmpOtherinfo', 'EmpID'),
			'empQueries' => array(self::HAS_ONE, 'EmpQueries', 'EmpID'),
			'empRefs' => array(self::HAS_MANY, 'EmpRef', 'EmpID'),
			'empTrainings' => array(self::HAS_MANY, 'EmpTraining', 'EmpID'),
			'empWorkexps' => array(self::HAS_MANY, 'EmpWorkexp', 'EmpID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'EmpID' => 'Badge No.',
			'FirstName' => 'First Name',
			'LastName' => 'Surname',
			'MiddleName' => 'Middle Name',
			'NameExt' => 'Name Extension (e.g. Jr., Sr.)',
			'EmpName' => 'Employee Name',
			'ResidentialAddress' => 'Residential Address',
			'RAZipCode' => 'Zip Code',
			'RATelno' => 'Telephone No',
			'HomeAddress' => 'Permanent Address',
			'HAZipCode' => 'Zip Code',
			'HATelno' => 'Telephone no',
			'ContactNo' => 'Cellphone No',
			'BirthDate' => 'Date of Birth',
			'BdayPlace' => 'Place of Birth',
			'Gender' => 'Gender',
			'CivilStat' => 'Civil Status',
			'Citizenship' => 'Citizenship',
			'Height' => 'Height (m)',
			'Weight' => 'Weight (kg)',
			'BloodType' => 'Blood Type',
			'DateHire' => 'Date Hire',
			'DateRehire' => 'Date Rehire',
			'DateResignation' => 'Date Resignation',
			'DateTermination' => 'Date Termination',
			'DateRetirement' => 'Date Retirement',
			'SSS' => 'SSS No.',
			'TIN' => 'TIN',
			'PHIC' => 'PHIC No.',
			'HDMF' => 'HDMF No.',
			'AcctNo' => 'Acct No',
			'AgencyEmpNo' => 'Agency Employee No.',
			'Department' => 'Department',
			'Position' => 'Position',
			'ExtensionNo' => 'Extension No',
			'OfficeSeatLocation' => 'Office Seat Location',
			'EmailAddress' => 'Email Address',
			'Tenant' => 'Tenant',
			'BedNo' => 'Bed No',
			'Allowance' => 'Allowance',
			'DateAPE' => 'Date Ape',
			'CertifyTrue' => ' true',
			'NewEmp' => 'New Emp',
			'TaxCertNo' => 'Community Tax Certificate No.',
			'IssuedAt' => 'Issued At',
			'IssuedOn' => 'Issued On',
			'DateAccomplished' => 'Date Accomplished',
			'DateModified' => 'Date Modified',
			'LastModifiedBy' => 'Last Modified By',
			'EMGName'=>'Name',
			'EMGContactNum'=>'Contact No',
			'EMGAddress'=>'Address',
			'EMGRelation'=>'Relation',
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
		$criteria->compare('EmpName',$this->EmpName,true);
		
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('MiddleName',$this->MiddleName,true);
		$criteria->compare('NameExt',$this->NameExt,true);
		
		$criteria->compare('ResidentialAddress',$this->ResidentialAddress,true);
		$criteria->compare('RAZipCode',$this->RAZipCode,true);
		$criteria->compare('RATelno',$this->RATelno,true);
		$criteria->compare('HomeAddress',$this->HomeAddress,true);
		$criteria->compare('HAZipCode',$this->HAZipCode,true);
		$criteria->compare('HATelno',$this->HATelno,true);
		$criteria->compare('ContactNo',$this->ContactNo,true);
		$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('BdayPlace',$this->BdayPlace,true);
		$criteria->compare('Gender',$this->Gender);
		$criteria->compare('CivilStat',$this->CivilStat);
		$criteria->compare('Citizenship',$this->Citizenship,true);
		$criteria->compare('Height',$this->Height,true);
		$criteria->compare('Weight',$this->Weight,true);
		$criteria->compare('BloodType',$this->BloodType,true);
		$criteria->compare('DateHire',$this->DateHire,true);
		$criteria->compare('DateRehire',$this->DateRehire,true);
		$criteria->compare('DateResignation',$this->DateResignation,true);
		$criteria->compare('DateTermination',$this->DateTermination,true);
		$criteria->compare('DateRetirement',$this->DateRetirement,true);
		$criteria->compare('SSS',$this->SSS,true);
		$criteria->compare('TIN',$this->TIN,true);
		$criteria->compare('PHIC',$this->PHIC,true);
		$criteria->compare('HDMF',$this->HDMF,true);
		$criteria->compare('AcctNo',$this->AcctNo,true);
		$criteria->compare('AgencyEmpNo',$this->AgencyEmpNo);
		$criteria->compare('Department',$this->Department,true);
		$criteria->compare('Position',$this->Position,true);
		$criteria->compare('ExtensionNo',$this->ExtensionNo,true);
		$criteria->compare('OfficeSeatLocation',$this->OfficeSeatLocation,true);
		$criteria->compare('EmailAddress',$this->EmailAddress,true);
		$criteria->compare('Tenant',$this->Tenant);
		$criteria->compare('BedNo',$this->BedNo);
		$criteria->compare('Allowance',$this->Allowance,true);
		$criteria->compare('DateAPE',$this->DateAPE,true);
		$criteria->compare('CertifyTrue',$this->CertifyTrue);
		$criteria->compare('NewEmp',$this->NewEmp);
		$criteria->compare('TaxCertNo',$this->TaxCertNo);
		$criteria->compare('IssuedAt',$this->IssuedAt,true);
		$criteria->compare('IssuedOn',$this->IssuedOn,true);
		$criteria->compare('DateAccomplished',$this->DateAccomplished,true);
		$criteria->compare('DateModified',$this->DateModified,true);
		$criteria->compare('LastModifiedBy',$this->LastModifiedBy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getLastupdated()
	{
		$lastmod=$model->LastModifiedBy;
		$modifiedby=HrisUsers::model()->findByPk(lastmod);
		
		return $modifiedby;
	}
}