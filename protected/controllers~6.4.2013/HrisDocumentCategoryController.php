<?php

class HrisDocumentCategoryController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index','view','create', 'update', 'admin', 'delete'),
				'roles'=>array('admin','sup','mgr','employer','hr'),
				),
      array('allow', 
				'actions'=>array('index','view','admin'),
				'roles'=>array('emp'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisDocumentCategory'),
		));
	}

	public function actionCreate() {
		$model = new HrisDocumentCategory;

		$this->performAjaxValidation($model, 'hris-document-category-form');

		if (isset($_POST['HrisDocumentCategory'])) {
			$model->setAttributes($_POST['HrisDocumentCategory']);

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
		$model = $this->loadModel($id, 'HrisDocumentCategory');

		$this->performAjaxValidation($model, 'hris-document-category-form');

		if (isset($_POST['HrisDocumentCategory'])) {
			$model->setAttributes($_POST['HrisDocumentCategory']);

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
			$this->loadModel($id, 'HrisDocumentCategory')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
// 		$dataProvider = new CActiveDataProvider('HrisDocumentCategory');
// 		$this->render('index', array(
// 			'dataProvider' => $dataProvider,
// 		));
      $this->actionAdmin();
	}

	public function actionAdmin() {
		$model = new HrisDocumentCategory('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisDocumentCategory']))
			$model->setAttributes($_GET['HrisDocumentCategory']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}