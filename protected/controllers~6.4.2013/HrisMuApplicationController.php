<?php

class HrisMuApplicationController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
		return array(
			array('allow', 
				'actions'=>array('index','view','minicreate', 'create','admin','delete','formyapproval','formyapprovalview','test','print'),
				'users'=>array('@'),
				),
		
			array('allow', 
				'actions'=>array('update'),
				'roles'=>array('admin','sup','mgr','hr','employer'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisMuApplication'),
		));
	}
	
	public function actionFormyapproval() {
		
		//throw new CHttpException('404','Abangan...');
		$this->layout = 'column1';
		$model = new HrisMuApplication('search');
		$model->unsetAttributes();
		

		if(isset($_POST['row']) and Yii::app()->request->isAjaxRequest) {
			$i = 0;
			$rows = Yii::app()->request->getPost('row');
			$mus = Yii::app()->request->getPost('mu');
			$action = Yii::app()->request->getPost('action');
			$denial_reason = Yii::app()->request->getPost('denial_reason'); echo $denial_reason;
			$approved_hours = 'no data';
			$to_hr = (isset($_POST['to_hr'])) ? Yii::app()->request->getPost('to_hr') : '0';
			foreach($rows as $row){
				$app = $this->loadModel($mus[$row]['id'], 'HrisMuApplication');
				if($app->from_datetime == null and empty($mus[$row]['from']) and Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR){
					echo "Make Up From is required for application ID ".$mus[$row]['id'];
					Yii::app()->end();
				}
				if($app->to_datetime == null and empty($mus[$row]['to']) and Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR){
					echo "Make Up To is required for application ID ".$mus[$row]['id'];
					Yii::app()->end();
				}
				$app->from_datetime = ($app->from_datetime == null) ? $mus[$row]['from'] : $app->from_datetime;
				$app->to_datetime = ($app->to_datetime == null) ? $mus[$row]['to'] : $app->to_datetime;
				if($app->approveMU($action,$denial_reason,$to_hr) and $app->save(false))
				//if($app->approveMU($action,$denial_reason,$to_hr))
					$i++;
			}
			echo "$i records updated successfully.";
			Yii::app()->end();
		}

		if (Yii::app()->getRequest()->getIsAjaxRequest())
			Yii::app()->end();	

		$this->render('approval', array(
			'model' => $model,
		));
	}

	public function actionFormyapprovalview($id) {
		$model = $this->loadModel($id, 'HrisMuApplication');

		
		
		$this->render('view', array(
			'model' => $model,
		));
	}
	
	public function actionCreate() {
		$model = new HrisMuApplication('apply');

		$this->performAjaxValidation($model, 'hris-mu-application-form');

		if (isset($_POST['HrisMuApplication'])) {
			$model->setAttributes($_POST['HrisMuApplication']);

			$valid = $model->validate();
			//$validMu = $model->isValidMUApplication();
			$validMu = true;
			
			if ($valid and $validMu) {
				$model->save(false);
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else{
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}
		Yii::app()->user->setFlash('instrux',$model->formInstrux);
		
		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'HrisMuApplication');

		$this->performAjaxValidation($model, 'hris-mu-application-form');

		if (isset($_POST['HrisMuApplication'])) {
			$model->setAttributes($_POST['HrisMuApplication']);
			$valid = $model->validate();
			$validMU = $model->isValidMU();
			if ($valid and $validMU) {
				$model->approveMU();
				$model->save(false);
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisMuApplication')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		// $dataProvider = new CActiveDataProvider('HrisMuApplication');
		// $this->render('index', array(
			// 'dataProvider' => $dataProvider,
		// ));
		$this->actionAdmin();
	}

	public function actionAdmin() {
		//$this->layout = 'column1';
		//throw new CHttpException('404','Abangan...');
		$model = new HrisMuApplication('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisMuApplication']))
			$model->setAttributes($_GET['HrisMuApplication']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}