<?php

class TicketsController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('minicreate', 'create', 'update', 'admin','index','view','test'),
				'users'=>array('@'),
				),
      array('allow', 
				'actions'=>array('delete','report'),
				'users'=>array('steven','vince','jude','rowena'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	
  public function actionTest(){
    $m = new Tickets;
    echo $m->getIncidentsPieData('2013-05-01', '2013-06-30');
  }                                              
  
  
  public function actionReport(){
    $this->layout = 'print';
    $model = new Tickets('search');
    
    if (isset($_GET['Tickets']))
			$model->setAttributes($_GET['Tickets']);
      
    $this->render('print', array( 'model' => $model));
  }
  
  public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Tickets'),
		));
	}

	public function actionCreate() {
		$model = new Tickets;


		if (isset($_POST['Tickets'])) {
			$model->setAttributes($_POST['Tickets']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('create'));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Tickets');


		if (isset($_POST['Tickets'])) {
			$model->setAttributes($_POST['Tickets']);

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
			$this->loadModel($id, 'Tickets')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		   /*
    $dataProvider = new CActiveDataProvider('Tickets');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
    */
    $this->actionAdmin();
	}

	public function actionAdmin() {
		$model = new Tickets('search');
		$model->unsetAttributes();

		if (isset($_GET['Tickets']))
			$model->setAttributes($_GET['Tickets']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}