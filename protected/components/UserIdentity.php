<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate2()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
	
	public function authenticate(){
		$emp_id = $this->username;
		$user=HrisUsers::model()->findByAttributes(array('username'=>$this->username));
		//echo '<pre>';var_dump($user); echo '</pre>';exit();
		if($user===null){
			Yii::log('No such user '.$emp_id.' IP: '.$_SERVER['REMOTE_ADDR'], 'info', 'app');
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}elseif(!$user->validatePassword($this->password)){   
			Yii::log('Login failed for user '.$emp_id.' IP: '.$_SERVER['REMOTE_ADDR'], 'info', 'app');
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}else{
			Yii::log('Login successful for user '.$emp_id.' IP: '.$_SERVER['REMOTE_ADDR'], 'info', 'app');
			$this->username = $user->emp->Fname;
			$this->setState('emp_name', $user->emp->Fname.' '.$user->emp->Lname);     		
			$this->setState('emp_id', $user->emp_id);
			$this->setState('access_lvl_id', $user->access_lvl_id);
			$this->setState('dept_id', $user->dept_id);
			$this->setState('first_login', $user->first_login);
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}
}