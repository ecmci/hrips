<?php

Yii::import('application.models._base.BaseHrisUsers');

class HrisUsers extends BaseHrisUsers
{
	public $reset_pass = '0';
  public $password;	
	public $password_confirm;
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function beforeSave(){
		$this->username = $this->emp_id;
		if($this->isNewRecord or $this->reset_pass==='1')
			$this->password_md5 = md5($this->password_md5);
		return parent::beforeSave();	
	}
  
  public function rules() {
		return array(
			array('emp_id, password_md5, access_lvl_id, dept_id', 'required','on'=>'insert'),
			array('emp_id, access_lvl_id, dept_id', 'numerical', 'integerOnly'=>true),
			array('password_md5', 'length', 'max'=>50),
			array('username, reset_pass, password, password_confirm', 'safe'),
			array('password, password_confirm', 'required', 'on'=>'reset'),
			array('password, password_confirm', 'length', 'min'=>4, 'max'=>20),
			array('password', 'compare', 'compareAttribute'=>'password_confirm'),
			array('emp_id, password_md5, access_lvl_id, dept_id, reset_pass', 'safe', 'on'=>'search'),
		);
	}
	
	public static function representingColumn() {
		//return 'password_md5';
		return 'emp_id';
	}
	
	public function getFullName(){
		return $this->emp->Lname.', '.$this->emp->Fname;	
	}
	
	public static function label($n = 1) {
		return Yii::t('app', 'HRIS User|HRIS Users', $n);
	}
	
	public function attributeLabels(){
		 return CMap::mergeArray(parent::attributeLabels(),
            array(
                'password_md5' => 'Password',
                'access_lvl_id' => 'Access Level',
                'dept_id' => 'Department',
                'emp_id'=>'Employee ID',
            	)
         	);
        
	}
	
	public function validatePassword($password)
    {
        //return $this->hashPassword($password,$this->salt)===$this->password;
		return md5($password)===$this->password_md5;
    }
	
	public function recoverAccount(){
		
	}
}