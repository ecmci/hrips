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
				'actions'=>array('update', 'admin','index','view','forprint','test'),
				'roles'=>array('admin','employer','hr','mgr','sup'),
				),
      array('allow', 
				'actions'=>array('test'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('delete'),
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
    $model = new HrisMuApplicationReport('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisMuApplicationReport']))
			$model->setAttributes($_GET['HrisMuApplicationReport']);

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
        $model = $this->loadModel($id,'HrisMuApplication');
        if($model and $model->next_lvl_id == HrisAccessLvl::$ULTIMATELY_APPROVED or $model->next_lvl_id == HrisAccessLvl::$ULTIMATELY_DENIED or $model->next_lvl_id == HrisAccessLvl::$APPROVED_COPY_FURNISHED){
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