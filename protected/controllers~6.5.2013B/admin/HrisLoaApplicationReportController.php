<?php

class HrisLoaApplicationReportController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('admin','index', 'view','forprint'),
				'roles'=>array('admin','mgr','hr','employer','sup'),
				),
			array('allow', 
				'actions'=>array('update','delete'),
				'roles'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisLoaApplicationReport'),
		));
	}

	public function actionCreate() {
		$model = new HrisLoaApplicationReport;


		if (isset($_POST['HrisLoaApplicationReport'])) {
			$model->setAttributes($_POST['HrisLoaApplicationReport']);

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
		$model = $this->loadModel($id, 'HrisLoaApplicationReport');


		if (isset($_POST['HrisLoaApplicationReport'])) {
			$model->setAttributes($_POST['HrisLoaApplicationReport']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisLoaApplicationReport')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		/*
		$dataProvider = new CActiveDataProvider('HrisLoaApplicationReport');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));*/
		$this->actionAdmin();
	}

	public function actionAdmin() {
		$this->layout = 'column1';
		$model = new HrisLoaApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisLoaApplicationReport']))
			$model->setAttributes($_GET['HrisLoaApplicationReport']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
	
	public function actionForprint() {
		$model = new HrisLoaApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisLoaApplicationReport']))
			$model->setAttributes($_GET['HrisLoaApplicationReport']);

		$this->renderPartial('getprinterfriendlyreport', array(
			'model' => $model,
		));
	}

}