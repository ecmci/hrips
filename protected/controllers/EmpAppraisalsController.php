<?php

class EmpAppraisalsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $EditMode=false;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('update'),
				'roles'=>array('admin'),
			),
			array('allow', 
				'actions'=>array('admin','delete', 'create','view','update','forprint'),
				'roles'=>array('admin','hr','employer'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	 public function actionForprint() {
	$this->layout = 'print';
    $this->pageTitle = 'Appraisal';
    $model = new EmpAppraisals('search');
		$model->unsetAttributes();

		if (isset($_GET['EmpAppraisals']))
			$model->setAttributes($_GET['EmpAppraisals']);

		$this->render('printme', array(
			'model' => $model,
		));
	}
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EmpAppraisals;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmpAppraisals']))
		{
			$model->attributes=$_POST['EmpAppraisals'];
			$NewSalary=$_POST['EmpAppraisals']['curMove']; //ToSalary
			$modelID=$_POST['EmpAppraisals']['empId']; //EmpID
			//$modelName=$_POST['EmpAppraisals']['empName'];
			$modelDate=$_POST['EmpAppraisals']['effectdate']; //DateEffective
			$model->UpdateToPayroll = (isset($_POST['chkUpdateToPayroll'])) ? "1" : "0";
			$model->ShowNotif  = (isset($_POST['chkUpdateToPayroll'])) ? "1" : "0";
			$model->PayrollSync  = (isset($_POST['chkUpdateToPayroll'])) ? "0" : "1";
			//$model->empName = $this->empName;
			$model->createddate = date('Y-m-d H:i:s'); //DateAdded
			$model->createdby = Yii::app()->user->emp_id; //AddedBy
			/*if to notify payroll master = 1, payroll sync =0, if you dont want to notify payroll master, payroll sync = 1, meaning this salary change
			has already been implemented*/
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id)); //ID
				/* $dateToday=date('Y-m-d');
				if (isset($_POST['chkUpdateToPayroll']) && ($dateToday>=$modelDate)) {
					$sqlUpdate = "UPDATE employee SET Monthly_Basic='$NewSalary' WHERE emp_id='$modelID'";
					$com = Yii::app()->db->createCommand($sqlUpdate);
					$result = $com->query();
				} */
			}
		}
		$this->EditMode=false;
		$this->render('create',array(
			'model'=>$model,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmpAppraisals']))
		{
			$model->attributes=$_POST['EmpAppraisals'];
			$NewSalary=$_POST['EmpAppraisals']['ToSalary'];
			$modelID=$_POST['EmpAppraisals']['EmpID'];
			$modelDate=$_POST['EmpAppraisals']['DateEffective'];
			$model->UpdateToPayroll = (isset($_POST['chkUpdateToPayroll'])) ? "1" : "0";
			$model->ShowNotif  = (isset($_POST['chkUpdateToPayroll'])) ? "1" : "0";
			$model->PayrollSync  = (isset($_POST['chkUpdateToPayroll'])) ? "0" : "1";
			if($model->save()){
				/* $dateToday=date('Y-m-d');
				if (isset($_POST['chkUpdateToPayroll']) && ($dateToday>=$modelDate)) {
					$sqlUpdate = "UPDATE employee SET Monthly_Basic='$NewSalary' WHERE emp_id='$modelID'";
					$com = Yii::app()->db->createCommand($sqlUpdate);
					$result = $com->query();
					
				} */
				$this->redirect(array('view','id'=>$model->ID));
			}
		}
		$this->EditMode=true;
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EmpAppraisals');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmpAppraisals('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmpAppraisals']))
			$model->attributes=$_GET['EmpAppraisals'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmpAppraisals the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmpAppraisals::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmpAppraisals $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='emp-appraisals-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAutoloadsalary()
	{
		$empid = $_POST['EmpAppraisals']['EmpID'];
	//	$data=Payroll::model()->findByPk($empid);
		/* 
		 */
		//$_POST['EmpAppraisals']['EmpID']=$data['Monthly_Basic'];
	}
}
