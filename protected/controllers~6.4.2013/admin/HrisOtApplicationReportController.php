<?php

class HrisOtApplicationReportController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('update','admin','index', 'view','forprint'),
				'roles'=>array('admin','employer','mgr','hr','sup'),
				),
			array('allow', 
				'actions'=>array('delete'),
				'roles'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionForprint() {
		$model = new HrisOTApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisOTApplicationReport']))
			$model->setAttributes($_GET['HrisOTApplicationReport']);

		$this->renderPartial('getprinterfriendlyreport', array(
			'model' => $model,
		));
	}
	
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisOtApplicationReport'),
		));
	}

	public function actionCreate() {
		$model = new HrisOtApplicationReport;


		if (isset($_POST['HrisOtApplicationReport'])) {
			$model->setAttributes($_POST['HrisOtApplicationReport']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'HrisOtApplicationReport');


		if (isset($_POST['HrisOtApplicationReport'])) {
			$model->setAttributes($_POST['HrisOtApplicationReport']);
			//echo '<pre>';print_r($model->attributes);echo '</pre>';exit();
			if ($model->save()) {				
				Yii::log('OT Form ID '.$model->id.' modified by '.Yii::app()->user->getState('emp_name'),'info','app');
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$model = $this->loadModel($id, 'HrisOtApplicationReport');
			$model->delete();
			Yii::log('OT Form ID '.$model->id.' deleted by '.Yii::app()->user->getState('emp_name'),'info','app');
			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		// $dataProvider = new CActiveDataProvider('HrisOtApplicationReport');
		// $this->render('index', array(
			// 'dataProvider' => $dataProvider,
		// ));
		$this->actionAdmin();
	}

	public function actionAdmin() {
		$this->layout = 'column1';
	
		$model = new HrisOtApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisOtApplicationReport']))
			$model->setAttributes($_GET['HrisOtApplicationReport']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}