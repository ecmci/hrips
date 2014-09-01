<?php

class HrisReportsController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('create', 'update', 'admin', 'delete','index', 'view'),
				'roles'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisReports'),
		));
	}

	public function actionCreate() {
		$model = new HrisReports;

		$this->performAjaxValidation($model, 'hris-reports-form');

		if (isset($_POST['HrisReports'])) {
			$model->setAttributes($_POST['HrisReports']);

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
		$model = $this->loadModel($id, 'HrisReports');

		$this->performAjaxValidation($model, 'hris-reports-form');

		if (isset($_POST['HrisReports'])) {
			$model->setAttributes($_POST['HrisReports']);

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
			$this->loadModel($id, 'HrisReports')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('HrisReports');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new HrisReports('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisReports']))
			$model->setAttributes($_GET['HrisReports']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}