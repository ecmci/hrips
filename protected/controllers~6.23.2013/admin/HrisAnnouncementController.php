<?php

class HrisAnnouncementController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view','minicreate', 'create','update','admin','delete'),
				'roles'=>array('hr','admin'),
				), 
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisAnnouncement'),
		));
	}

	public function actionCreate() {
		$model = new HrisAnnouncement;

		$this->performAjaxValidation($model, 'hris-announcement-form');

		if (isset($_POST['HrisAnnouncement'])) {
			$model->setAttributes($_POST['HrisAnnouncement']);

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
		$model = $this->loadModel($id, 'HrisAnnouncement');

		$this->performAjaxValidation($model, 'hris-announcement-form');

		if (isset($_POST['HrisAnnouncement'])) {
			$model->setAttributes($_POST['HrisAnnouncement']);

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
			$this->loadModel($id, 'HrisAnnouncement')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('HrisAnnouncement');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new HrisAnnouncement('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisAnnouncement']))
			$model->setAttributes($_GET['HrisAnnouncement']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}