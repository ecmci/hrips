<?php

class SiteController extends Controller
{
	
public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index','page'),
				'users'=>array('@'),
				),
      array('allow', 
				'actions'=>array('login','logout','error'),
				'users'=>array('*'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
  /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

    // renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
    $user = Employee::model()->findByPk(Yii::app()->user->getState('emp_id'));
    $announcement = new HrisAnnouncement;
    $recent_punches = WebApp::getRecentPunches();
    
    $pending_loa = HrisLoaApplication::getPendingLoaApprovals();
    $pending_ot = HrisOtApplication::getPendingOTApprovals();
    $recent_notification_count =  $pending_ot + $pending_loa;
    
    
    
    
    //echo $pending_ot;exit(); 
    
		$this->render('index',array(
      'user'=>$user,
      'pending_loa'=>$pending_loa,
      'pending_ot'=>$pending_ot,
      'announcement'=>$announcement,
      'recent_punches'=>$recent_punches,
      'recent_notification_count'=>$recent_notification_count,
      ));
		//$this->redirect('hrisLoa');
	}
  
  public function actionWelcome()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('indexO');
		//$this->redirect('hrisLoa');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		//throw new CHttpException(503,'<h3>Service Unavailable: The server is currently unable to handle the request due to a temporary maintenance.</h3><h1>Be back on 8/14/2013 12:00 NN (PST).</h1>');
    $model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
          if(Yii::app()->user->first_login=='1'){
              $this->redirect(Yii::app()->createAbsoluteUrl('admin/hrisUsers/resetpassword/',array('id'=>Yii::app()->user->emp_id)));
              exit();
          }
          $this->redirect(Yii::app()->user->returnUrl);
          exit();
      }
				
		}
		
		//log all visitors to this site
		Yii::log('Visitor from IP '.$_SERVER['REMOTE_ADDR'], 'info', 'app');
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
  
  
}