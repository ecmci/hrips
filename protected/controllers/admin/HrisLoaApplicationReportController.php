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
      array('allow', 
				'actions'=>array('enter'),
				'roles'=>array('employer'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionForprint() {
		$this->layout = 'print';
    $this->pageTitle = 'MU Report';
    $model = new HrisLoaApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisLoaApplicationReport']))
			$model->setAttributes($_GET['HrisLoaApplicationReport']);

		$this->render('getprinterfriendlyreport', array(
			'model' => $model,
		));
	}
  
  
  public function actionEnter(){
    if (!Yii::app()->getRequest()->getIsAjaxRequest())
					throw new CHttpException(500, Yii::t('app', ''));
   
    if(isset($_POST['row'])){
      $ids =  $_POST['row'];
      $failed_ids = array();
      $ok_ids = array();
      foreach($ids as $id){
        $model = $this->loadModel($id,'HrisLoaApplicationReport');
        if($model and $model->next_lvl_id == HrisAccessLvl::$ULTIMATELY_APPROVED or $model->next_lvl_id == HrisAccessLvl::$ULTIMATELY_DENIED){
          $model->is_entered = '1';
          $model->save(false);
          $ok_ids[] = $id;
        }else{
          $failed_ids[] = $id;
        }  
      }
      $feedback['failed_ids'] = (empty($failed_ids)) ? '' : sizeof($failed_ids).' IDs failed ('.implode(', ',$failed_ids).'). Make sure they are APPROVED/DENIED first.';
      $feedback['ok_ids'] = 'You have entered '.sizeof($ok_ids).' applications successfully. (ID = '.implode(',',$ok_ids).')'; 
      echo json_encode($feedback);
      Yii::app()->end();   
    }
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
	
	

}