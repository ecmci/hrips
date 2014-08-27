<?php

class EasyPayslipController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view','update','admin','delete','process'),
				'users'=>array('@'),
			),
       array('allow',
				'actions'=>array('viewpayslip','test'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
  
  public function actionTest(){
    EasyPayslip::emailPaySlips();
  }
  
  public function actionProcess(){
    $model=new EasyPayslip('process');
    $this->performAjaxValidation($model);

    if(isset($_POST['EasyPayslip'])){
      $model->attributes = $_POST['EasyPayslip'];
      //1. save the csv file
      $model->payrollfile = CUploadedFile::getInstance($model,'payrollfile');  
             
      $validForm = $model->validate();
      $validPayrollFile = false;
      
      if($validForm){
        $fileName = EasyPayslip::encodeFilename($model->payrollfile);
        $folder = $model->getPayrollFolder();
        $model->payrollfile->saveAs($folder.'/'.$fileName);
        $validPayrollFile = $model->processPayrollFile($folder,$fileName); 
      }
      
      $this->redirect(array('admin'));
      
    }
    
    $this->render('_form_process',array(
			'model'=>$model,
		)); 
  }
  
  public function actionViewpayslip($id){
    $this->layout = 'column1';
    $model = new EasyPayslip('access');
    $record = $this->loadModel($id);
    
    if(isset($_POST['EasyPayslip'])){
      $model->attributes = $_POST['EasyPayslip'];
      if($model->validate() AND $model->authenticate()){
        $this->render('payslip',array(
    			'model'=>$record,
    		));
        Yii::app()->end(); 
      }
    }
    
    $this->render('_form_payslip_access',array('model'=>$model,'record'=>$record));  
  }
  
  public function actionView($id){
    $this->layout = 'print';
    $model = $this->loadModel($id);
    
    
    $this->render('payslip',array(
			'model'=>$model,
		));  
  }
  
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewO($id)
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
		$model=new EasyPayslip;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EasyPayslip']))
		{
			$model->attributes=$_POST['EasyPayslip'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

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

		if(isset($_POST['EasyPayslip']))
		{
			$model->attributes=$_POST['EasyPayslip'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

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
// 		$dataProvider=new CActiveDataProvider('EasyPayslip');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));
      $this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = 'column1';
    $model=new EasyPayslip('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EasyPayslip']))
			$model->attributes=$_GET['EasyPayslip'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EasyPayslip the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EasyPayslip::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EasyPayslip $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='easy-payslip-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
