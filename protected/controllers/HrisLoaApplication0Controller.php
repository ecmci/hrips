<?php

class HrisLoaApplication0Controller extends GxController {
	
	//var $layout = 'column1';

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('update','index','view','minicreate', 'create','admin','formyapproval','formyapprovalview','test','print','cancel'),
				'users'=>array('@'),
				),
		
			array('allow', 
				'actions'=>array('update'),
				'roles'=>array('admin','hr','employer'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	
	
	public function actionView($id) {
		$model = $this->loadModel($id, 'HrisLoaApplication');

		//view your own or superuser policy
		if($model->emp_id != Yii::app()->user->getState('emp_id') and Yii::app()->user->getState('access_lvl_id')!='4')
			throw new CHttpException(401,'You are not authorized to view this application form.');
		
		$this->render('view', array(
			'model' => $model,
		));
	}

  public function actionPrint($id){
    $model = $this->loadModel($id,'HrisLoaApplication');
    
    $this->renderPartial('print_loa',array(
    'model'=>$model,
    ));
  }

	public function actionCreate() {
		$model = new HrisLoaApplication;

		$this->performAjaxValidation($model, 'hris-loa-application-form');

		

		if (isset($_POST['HrisLoaApplication'])) {
			$model->setAttributes($_POST['HrisLoaApplication']);
			$validForm = $model->validate();
			//$validLOA = $model->isValidLoaApplication();  
			$validLOA = true; //override kay nag error ug not  	defined ang shift daw
			if ($validForm and $validLOA) {				
				$model->save(false);				
				$model->queueEmail();
				//save attachments
				if(isset($_POST['uploads']))						
					Attachments::saveAttachments($model,'HrisLoaAttachments',$_POST['uploads']);
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}
		
		//form instruction flashes
		Yii::app()->user->setFlash("reminder", $model->formInstrux);
		
		//$model->isValidLoaApplication();

		$this->render('create', array( 'model' => $model));
	}
	
	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'HrisLoaApplication');
		
		//edit policy
		if(!$model->canEdit())
			throw new CHttpException(401,'Action is not allowed because at least one approver has already signed. Please cancel this and make a new one instead.');

		$this->performAjaxValidation($model, 'hris-loa-application-form');
			
		if (isset($_POST['HrisLoaApplication'])) {
			$model->setAttributes($_POST['HrisLoaApplication']);
			
			$validForm = $model->validate();
			$validLOA = $model->isValidLoaApplication();
			
			if ($validForm and $validLOA) {
				$model->save(false);
				
				//save attachments
				if(isset($_POST['uploads']))						
					Attachments::saveAttachments($model,'HrisLoaAttachments',$_POST['uploads']);					
				$this->redirect(array('view', 'id' => $model->id));
			}
		}
		
		//form instruction flashes
		Yii::app()->user->setFlash("reminder", $model->formInstrux);
		
		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisLoaApplication')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		/*$dataProvider = new CActiveDataProvider('HrisLoaApplication');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));*/
		$this->actionAdmin();
	}

	public function actionAdmin() {
		$model = new HrisLoaApplication('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisLoaApplication']))
			$model->setAttributes($_GET['HrisLoaApplication']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
	
	
	public function actionFormyapproval(){
		$this->layout = 'column1';
		$model = new HrisLoaApplication('search');
		$model->unsetAttributes();
		
		if (isset($_GET['HrisLoaApplication']))
			$model->setAttributes($_GET['HrisLoaApplication']);
		
		 if(isset($_POST['id']) and Yii::app()->request->isAjaxRequest) {
			$i = 0;
			$ids = Yii::app()->request->getPost('id');
			$action = Yii::app()->request->getPost('action');
			$denial_reason = Yii::app()->request->getPost('denial_reason');
			$approved_hours = Yii::app()->request->getPost('approved_hours');
			$to_hr = (isset($_POST['to_hr'])) ? Yii::app()->request->getPost('to_hr') : '0';
			foreach($ids as $id){
				$model = $this->loadModel($id, 'HrisLoaApplication');
				//$okloa = $model->approveLOA($action,$denial_reason,$to_hr,$approved_hours);
				//$okmodel = $model->validate();
				//echo "okloa = $okloa AND okmodel = $okmodel";exit();
				if($model->approveLOA($action,$denial_reason,$to_hr,$approved_hours) and $model->save(false))
				//if($model->approveLOA($action,$denial_reason,$to_hr,$approved_hours))
					$i++;
			}
			echo "$i records updated successfully.";
			exit();
		} 
		
		if(Yii::app()->request->isAjaxRequest) {echo '0 records updated.'; Yii::app()->end();}
		
		$this->render('approval', array(
			'model' => $model,
		));
	}
	
	public function actionFormyapprovalview($id) {
		$model = $this->loadModel($id, 'HrisLoaApplication');

		
		
		$this->render('view_loa_form_for_approval', array(
			'model' => $model,
		));
	}
	
	public function actionTest(){
		//throw new CHttpException(404,'');
		$shifts_copy = WebApp::getInOutDatetimes('2013-04-22 22:00:00','1078');
				
		echo '<pre>';
		print_r($shifts_copy);
		echo '</pre>';
	}         

}