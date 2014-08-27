<?php

class HrisDocumentAccessController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index', 'view'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create', 'update', 'admin', 'delete'),
				'roles'=>array('hr'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisDocumentAccess'),
		));
	}

	public function actionCreate() {
		$model = new HrisDocumentAccess;

		$this->performAjaxValidation($model, 'hris-document-access-form');

		if (isset($_POST['HrisDocumentAccess'])) {
			$model->setAttributes($_POST['HrisDocumentAccess']);

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
		$model = $this->loadModel($id, 'HrisDocumentAccess');

		$this->performAjaxValidation($model, 'hris-document-access-form');

		if (isset($_POST['HrisDocumentAccess'])) {
			$model->setAttributes($_POST['HrisDocumentAccess']);

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
			$this->loadModel($id, 'HrisDocumentAccess')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('HrisDocumentAccess');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new HrisDocumentAccess('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisDocumentAccess']))
			$model->setAttributes($_GET['HrisDocumentAccess']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}