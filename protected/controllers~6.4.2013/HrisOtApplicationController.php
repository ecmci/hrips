<?php

class HrisOtApplicationController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index','view','update','admin','delete','formyapprovalview','print'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('update','formyapproval'),
				'roles'=>array('hr','employer','sup','mgr'),
				),
			array('allow', 
				'actions'=>array('create','delete'),
				'roles'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
     
     public function actionPrint($id){
        $model = $this->loadModel($id,'HrisOtApplication');
        
        $this->renderPartial('print_ot',array(
          'model'=>$model,
        ));
     
     }
     
     public function actionFormyapprovalview($id) {
    		$this->actionView($id);
    	}
      
	public function actionFormyapproval(){
		$this->layout = 'column1';
		$model = new HrisOtApplication('getOTForApproval');
  		$model->unsetAttributes();
  
		if(isset($_POST['row']) and Yii::app()->request->isAjaxRequest) {
			$i = 0;
			$rows = Yii::app()->request->getPost('row');
			$ots = Yii::app()->request->getPost('ot');
			$action = Yii::app()->request->getPost('action');
			//echo '<pre>';print_r($action);echo '</pre>';exit();
			$denial_reason = Yii::app()->request->getPost('denial_reason');			
			$to_hr = (isset($_POST['to_hr'])) ? Yii::app()->request->getPost('to_hr') : '0';
			foreach($rows as $row){
				$app = HrisOtApplication::model()->findByPk($ots[$row]['id']);
				$app->hours = $ots[$row]['hours'];
				$app->minutes = $ots[$row]['minutes'];
				$app->sub_code_id = $ots[$row]['sub_code_id'];
				$app->approved_hours = "$app->hours hours $app->minutes minutes";				
				if($app->approveOT($action,$denial_reason,$to_hr) and $app->save(false)){
					$i++;
					//echo '<pre>';print_r($app->attributes);echo '</pre>';
				}
			}
			echo "$i records updated successfully.";			
			Yii::app()->end();
		}	
  
  		$this->render('approval', array(
  			'model' => $model,
  		));  
  }
    
	public function actionView($id) {
		$model = $this->loadModel($id, 'HrisOtApplication');
    
		if($model->next_lvl_id == HrisAccessLvl::$EMPLOYEE) 
			$this->actionUpdate($id);
		else
			$this->render('view', array(
				'model' => $model,
			));
	}

	public function actionCreate() {
		$model = new HrisOtApplication;

		$this->performAjaxValidation($model, 'hris-ot-application-form');

		if (isset($_POST['HrisOtApplication'])) {
			$model->setAttributes($_POST['HrisOtApplication']);
			$model->sup_approve_datetime = new CDbExpression('NOW()');
			//echo '<pre>';print_r($model->attributes);echo '</pre>';exit();
			$model->timestamp = new CDbExpression('NOW()');
			$model->sub_code_id = '2001-13';
			//$model->next_lvl_id = '3';
			
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
	
	public function actionManualimport(){
		//WebApp::pullOutOTWeb();
		$db = Yii::app()->db->createCommand()
			->select('id,emp_id,in_datetime as in,out_datetime as out')
			->from('hris_ot_application')			
			->order('emp_id asc')->queryAll();
		
		foreach($db as $d){
			$diff = WebApp::diffBetweenDateTimeRange($d['in'],$d['out']);
			$hours = $diff['hours'];
			$mins = 0;
			$mins = ($diff['mins'] >= 15) ? 15 : $mins;
			$mins = ($diff['mins'] >= 30) ? 30 : $mins;
			$mins = ($diff['mins'] >= 45) ? 45 : $mins;
			//echo $d['emp_id'].' '.$d['in'].' '.$d['out'].' '.$hours.' hours '.$mins.' minutes<br>';
			echo "update hris_ot_application set approved_hours = '$hours hours $mins minutes' where id = '".$d['id']."';<br>";
		}
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'HrisOtApplication');

		if(!$model->canEdit())
				throw new CHttpException(401, Yii::t('app', 'You can no longer modify this application. Please contact IT.'));

		$this->performAjaxValidation($model, 'hris-ot-application-form');

		if (isset($_POST['HrisOtApplication'])) {
			$model->setAttributes($_POST['HrisOtApplication']);
			$valid = $model->validate();
			
			if ($valid) {
				$model->approveOT('1','','0');
				$model->save(false);
				if(isset($_POST['uploads'])){
					Attachments::saveAttachments($model, 'HrisOtAttachments', $_POST['uploads']);
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		}
		
		Yii::app()->user->setFlash("notabene", $model->note);
		
		
			$this->render('update', array(
					'model' => $model,
					));

	}
	
	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisOtApplication')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
// 		$dataProvider = new CActiveDataProvider('HrisOtApplication');
// 		$this->render('index', array(
// 			'dataProvider' => $dataProvider,
// 		));
      $this->actionAdmin();
	}

	public function actionAdmin() {
		$this->layout = 'column1';
    $model = new HrisOtApplication('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisOtApplication']))
			$model->setAttributes($_GET['HrisOtApplication']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}