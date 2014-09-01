<?php

class HrisUsersController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('recover','enroll'),
				//'users'=>array('*'),
				'roles'=>array('admin'),
			),
			array('allow', 
				'actions'=>array('admin','create','update','delete','index','view'),
				'roles'=>array('admin'),
				),
			array('allow', 
				'actions'=>array('resetpassword'),
				'users'=>array('@'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionTest(){
		echo 'hello world!';
	}
	
	public function actionEnroll(){
		try{
			//$users = Employee::model()->findAll(array('condition'=>"Act_Status = 'Active' and Emp_ID != '1078'"));
			$users = array(
				'1097'
			);
			$i = 0;
			$insertStmt = 'insert into hris_users(`emp_id`,`username`,`password_md5`,`access_lvl_id`,`dept_id`,`first_login`)values';
			$emailStmt = '';
			
			$subject = 'Account Created | ECMCI-HRIPS';
			$queueEmailStmt = 'INSERT INTO `evacare`.`hris_email_queue_for_forms` (`id`, `template_id`, `to_group`, `to_user`, `to`, `subject`, `content`, `model_name`, `model_id`, `sent`, `sent_timestamp`, `timestamp`) VALUES';
			$p = md5('123');
			foreach($users as $user){
				if($i > 0) {$queueEmailStmt .= ',';$insertStmt .= ',';};
				$insertStmt .= '("'.$user.'","'.$user.'","'.$p.'","1","7","1")';
				$i++;
				// $u = new HrisUsers;
				// $u->emp_id = $u->username = $user->Emp_ID;
				// $u->password_md5 = $p;
				// $u->access_lvl_id = '1';
				// $u->dept_id = '7';
				// $u->first_login = '1';
				//$u->save(false);
				$content = '<p>Hi '.$user.',</p>
						<p>Your account has been created:</p>
						<ul>
						<li><b>URL:</b> <a href="http://192.168.1.225:8000/">HRIPS Server</a></li><li><b>Username:</b> '.$user.'</li><li><b>Password:</b> 123</li>
						</ul>
						<p>To help you manage your HR transactions, I.T. is pleased to announce its own Human Resource Information and Payroll System (ECMCI-HRIPS). Not only it allows you to manage your leave applications, VL credits tracking, overtime application, timesheet, payslip and many more, it will also accelerate the payroll process--thanks to its sophisticated payroll module.</p>
						<p>For now, keep track of your timesheet in real-time, as it syncs directly to our timeclock. As for the workflow forms(leave and overtime), kindly wait for further advisory from HR or Administration.</p>
						<p>Should you have suggestions and other concerns, please feel free to contact IT at <a href="mailto:itmanila@evacare.com">itmanila@evacare.com</a>.</p>
						<p>At Your Service,</p>
						<p><b>IT Manila</b></p>';
				//echo $content;
				$queueEmailStmt .= "(NULL, NULL, '0', '1', '".$user->Email_Add."', '".$subject."', '".$content."', NULL, NULL, '0', NULL, CURRENT_TIMESTAMP)";
			}
			//echo $queueEmailStmt;
			//exit();
			//queueEmail($model=null, $model_name='', $to_user_id, $subject, $content, $email_group_id='', $group_content='')
			//echo $queueEmailStmt;
			//echo $insertStmt;
			//echo "q'd?: ".mysql_query($queueEmailStmt);
			//mysql_close($con);
			echo "ADDED: ". Yii::app()->db->createCommand($insertStmt)->execute();
			echo "QUEUED: ". Yii::app()->db->createCommand($queueEmailStmt)->execute();
			//echo $p;
		}catch(Exception $ex){
			echo '<pre>';print_r($ex);echo '</pre>';
		}
	}
	
	public function actionRecover(){
		$model = new HrisUsers;
		
		if(isset($_POST['HrisUsers'])){
			$model->attributes = $_POST['HrisUsers']['username'];
			$user = HrisUsers::model()->findByPk($_POST['HrisUsers']['username']);
			if($user==NULL or $user==null){
				$model->addError('username','This ID is not registered in the system.');
			}else{
				$to = $user->emp->Email_Add;
				$from = Yii::app()->params['noreply'];
				$subject = 'Account Recovery | ECMCI-HRIS';				
				$temp_password = uniqid();
				$body = "Temporary password: $temp_password";
				$user->password_md5 = md5($temp_password);
				$user->first_login = '1';
				$user->save(false);
				WebApp::sendPHPMailer($from,$to,$subject,$body);
				Yii::log('Password recovery initiated for Employee ID '.$user.' and trying to send to '.$to,'info','app');
				$this->render('_recover_success',array('model'=>$user,'p'=>$temp_password));
				Yii::app()->end();
			}
		}
		
		$this->render('_recover',array('model'=>$model));
	}

  public function actionResetpassword($id) {
		$this->layout = 'column1';
    $model = $this->loadModel($id, 'HrisUsers');

		$this->performAjaxValidation($model, 'hris-users-form');

		if (isset($_POST['HrisUsers'])) {
			$model->setAttributes($_POST['HrisUsers']);
      if($model->validate()){
        $user = HrisUsers::model()->findByPk($id);
        $user->password_md5 = md5($model->password_confirm);
        $user->first_login = '0';
        $user->save();
        Yii::log("Password Personalized by ".$user->getFullName().' at IP '.$_SERVER['REMOTE_ADDR'],'info','app');
        $this->redirect(array('site/index'));
      }
			
		}

		$this->render('_reset_pass_form', array(
				'model' => $model,
				));
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisUsers'),
		));
	}

	public function actionCreate() {
		$model = new HrisUsers;

		$this->performAjaxValidation($model, 'hris-users-form');

		if (isset($_POST['HrisUsers'])) {
			$model->setAttributes($_POST['HrisUsers']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->emp_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'HrisUsers');

		$this->performAjaxValidation($model, 'hris-users-form');

		if (isset($_POST['HrisUsers'])) {
			$model->setAttributes($_POST['HrisUsers']);
			if($model->reset_pass==='1'){
				$model->first_login = '1';
				Yii::log("Password Reset for Employee ".$model->getFullName()." by ".Yii::app()->user->getState('emp_name'),'info','app');
			}
			if ($model->save()) {				
				$this->redirect(array('view', 'id' => $model->emp_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisUsers')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		/*$dataProvider = new CActiveDataProvider('HrisUsers');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));*/
		$this->actionAdmin();
	}

	public function actionAdmin() {
		$model = new HrisUsers('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisUsers']))
			$model->setAttributes($_GET['HrisUsers']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}