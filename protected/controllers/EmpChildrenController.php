<?php

class EmpChildrenController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $error = "";
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new EmpChildren;
		$children=$this->getMychildren();
		
		if(isset($_POST['EmpChildren'])){
			$model->attributes=$_POST['EmpChildren'];
			$temp = $_POST['EmpChildren'];
			$mysize=(count($_POST['EmpChildren']))-1;
			//validate parent
			$isValidParent = $model->validate();
			
			//validate child
			$isValidChildren = $this->isValidChildren($children);
			
			if($isValidParent && $isValidChildren){
				//echo '<br><br>'.$mysize;
				 for($i=0 ; $i <$mysize; $i++){
					$modChild = new EmpChildren;
					$modChild->ChildName=$children[$i]['ChildName'];
					$modChild->BirthDate=$children[$i]['BirthDate'];
					$modChild->EmpID=$_POST['EmpChildren']['EmpID'];
					$modChild->save(false);
							
				} 
			}
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		/* if(isset($_POST['EmpChildren']))
		{
			$model->attributes=$_POST['EmpChildren'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		
		)); */
		$this->render('create',array(
			'model'=>$model,
			'children_details'=>$children,
			'children_error' => $this->error,
			));
	}
	
	private function getMychildren(){
		$children=array();
		if(isset($_POST['EmpChildren'])){			
			$limit = (count($_POST['EmpChildren']))-1;
			$tmp = $_POST['EmpChildren'];			
			 for($i=0 ; $i<$limit; $i++){
				$children[$i]['ChildName']=$tmp[$i]['ChildName'];
				$children[$i]['BirthDate']=$tmp[$i]['BirthDate'];	
			}	 
		}else{
			$children[0]['ChildName']="";
			$children[0]['BirthDate']="";	
		}
		return $children;
	}
	
	private function isValidChildren($children){
		$limit = sizeof($children);
		$modChild = new EmpChildren;
		for($i=0 ; $i < $limit ; $i++){			
			$modChild->ChildName = $children[$i]['ChildName'];
			$modChild->EmpID = $_POST['EmpChildren']['EmpID'];
			$modChild->BirthDate = $children[$i]['BirthDate'];
			if(!$modChild->validate()) { 
				$this->error = "<div class='errorSummary'>Please fix the following input errors in the Purchase Request Details section:<ul>";
				$errors = $modChild->getErrors();
				$j=0;
				foreach($errors as $error){
					$this->error .= "<li>".$error[0]."</li>";
				}
				$this->error .= "<ul></div>";
				return false;
			}
		}
		return true;
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

		if(isset($_POST['EmpChildren']))
		{
			$model->attributes=$_POST['EmpChildren'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
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
		$dataProvider=new CActiveDataProvider('EmpChildren');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmpChildren('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmpChildren']))
			$model->attributes=$_GET['EmpChildren'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmpChildren the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmpChildren::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmpChildren $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='emp-children-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
