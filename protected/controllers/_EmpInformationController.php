<?php

class EmpInformationController extends Controller
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
				'actions'=>array('index','view','update'),
				'users'=>array('@'),
			),
			array('allow', 
				'actions'=>array('admin','delete', 'create','update','index'),
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
	public function actionView($id)
	{
		$userid=Yii::app()->user->emp_id;
		
		/* if ($userid==$id){
			$this->render('view',array(
			 'model'=>$this->loadModel($id),
			));
		}else{
			$this->render('view',array(
			 'model'=>$this->loadModel($userid),
			));
		} */
		
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
		$model=new EmpInformation;
		$modelFam = new EmpFambg;
		$modChild = new EmpChildren;
		$modEduc = new EmpEducbg;
		$modCivil = new EmpCivilservice;
		$modWork = new EmpWorkexp;
		$modOrg = new EmpOrganization;
		$modTrain = new EmpTraining;
		$modOther = new EmpOtherinfo;
		$modQueries = new EmpQueries;
		$modRef = new EmpRef;
		//$children=$this->getChildren();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		/* if(isset($_POST['EmpInformation'], $_POST['EmpFambg'], $_POST['EmpChildren'], $_POST['EmpEducbg'], $_POST['EmpCivilservice'], $_POST['EmpWorkexp'],
				$_POST['EmpOrganization'], $_POST['EmpTraining'], $_POST['EmpOtherinfo'], $_POST['EmpRef'])) */
		
		if(isset($_POST['EmpInformation'], $_POST['EmpFambg'], $_POST['EmpChildren']))
		{
			// populate input data to models
			$model->attributes=$_POST['EmpInformation'];
			$modelFam->attributes=$_POST['EmpFambg'];
			$modelFam->EmpID=$_POST['EmpInformation']['EmpID'];
			$modChild->attributes=$_POST['EmpChildren'];
			$modChild->EmpID=$_POST['EmpInformation']['EmpID'];
			/* $modEduc->attributes=$_POST['EmpEducbg'];
			$modCivil->atributes=$_POST['EmpCivilservice'];
			$modWork->attributes=$_POST['EmpWorkexp'];
			$modOrg->attributes=$_POST['EmpOrganization'];
			$modTrain->attributes=$_POST['EmpTraining'];
			$modOther->attributes=$_POST['EmpOtherinfo'];
			$modQueries->attributes=$_POST['EmpQueries'];
			$modRef->attributes=$_POST['EmpRef']; */
			
			 // validate models
			 /*
			$valid=$model->validate();
			$valid=$modelFam->validate() && $valid;
			$valid=$modChild->validate() && $valid;
			 $valid=$modEduc->validate() && $valid;
			$valid=$modCivil->validate() && $valid;
			$valid=$modWork->validate() && $valid;
			$valid=$modOrg->validate() && $valid;
			$valid=$modTrain->validate() && $valid;
			$valid=$modOther->validate() && $valid;
			$valid=$modQueries->validate() && $valid;
			$valid=$modRef->validate() && $valid; */
			
			
			if($model->save()){
				
				//$this->redirect(array('view','id'=>$model->EmpID));
			}
		}
			/*if($valid)
			{
				//if($model->save())
				
				
				/* $model->save(false);
				$modelFam->save(false);
				$modChild->save(false);
				$modEduc->save(false);
				$modCivil->save(false);
				$modWork->save(false);
				$modOrg->save(false);
				$modTrain->save(false);
				$modOther->save(false);
				$modQueries->save(false);
				$modRef->save(false); 
					
			}
			*/
			//$this->redirect(array('view','id'=>$model->EmpID));
		

		$this->render('create',array(
			'model'=>$model,
			'modelFam'=>$modelFam,
			'modChild'=>$modChild,
			'modEduc'=>$modEduc,
			'modCivil'=>$modCivil,
			'modWork'=>$modWork,
			'modOrg'=>$modOrg,
			'modTrain'=>$modTrain,
			'modOther'=>$modOther,
			'modQueries'=>$modQueries,
			'modRef'=>$modRef,
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
		if($model->NewEmp==0){ //employee cannot edit his info anymore, redirect to view page
			$this->redirect(array('view','id'=>$model->EmpID));
		}
		
		if(isset($_POST['EmpInformation']))
		{
			$model->attributes=$_POST['EmpInformation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->EmpID));
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
		$dataProvider=new CActiveDataProvider('EmpInformation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmpInformation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmpInformation']))
			$model->attributes=$_GET['EmpInformation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmpInformation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmpInformation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmpInformation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='emp-information-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	

}
