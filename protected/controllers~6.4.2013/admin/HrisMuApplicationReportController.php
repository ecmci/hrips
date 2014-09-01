<?php

class HrisMuApplicationReportController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(			
			array('allow', 
				'actions'=>array('update', 'admin','index','view'),
				'roles'=>array('admin','employer','hr','mgr','sup'),
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

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisMuApplicationReport'),
		));
	}

	public function actionCreate() {
		$model = new HrisMuApplicationReport;


		if (isset($_POST['HrisMuApplicationReport'])) {
			$model->setAttributes($_POST['HrisMuApplicationReport']);

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
		$model = $this->loadModel($id, 'HrisMuApplicationReport');


		if (isset($_POST['HrisMuApplicationReport'])) {
			$model->setAttributes($_POST['HrisMuApplicationReport']);

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
			$this->loadModel($id, 'HrisMuApplicationReport')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		// $dataProvider = new CActiveDataProvider('HrisMuApplicationReport');
		// $this->render('index', array(
			// 'dataProvider' => $dataProvider,
		// ));
		$this->actionAdmin();
	}

	public function actionAdmin() {
		$this->layout = 'column1';
		$model = new HrisMuApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisMuApplicationReport']))
			$model->setAttributes($_GET['HrisMuApplicationReport']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}