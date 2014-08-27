<?php

class HrisEmailQueueForFormsController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('admin','delete','index','view','minicreate', 'create','update'),
				'roles'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisEmailQueueForForms'),
		));
	}

	public function actionCreate() {
		$model = new HrisEmailQueueForForms;


		if (isset($_POST['HrisEmailQueueForForms'])) {
			$model->setAttributes($_POST['HrisEmailQueueForForms']);

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
		$model = $this->loadModel($id, 'HrisEmailQueueForForms');


		if (isset($_POST['HrisEmailQueueForForms'])) {
			$model->setAttributes($_POST['HrisEmailQueueForForms']);

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
			$this->loadModel($id, 'HrisEmailQueueForForms')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('HrisEmailQueueForForms');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new HrisEmailQueueForForms('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisEmailQueueForForms']))
			$model->setAttributes($_GET['HrisEmailQueueForForms']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}