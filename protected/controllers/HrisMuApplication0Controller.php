<?php

class HrisMuApplication0Controller extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
		return array(
			array('allow', 
				'actions'=>array('index','view','minicreate', 'create','admin','update','delete','formyapproval','formyapprovalview','cancel','print','test'),
				'users'=>array('@'),
				),
		  array('allow', 
				'actions'=>array('index','view','minicreate', 'create','admin','update','delete','formyapproval','formyapprovalview','cancel','print','test'),
				'roles'=>array('admin','employer','hr','sup'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionTest(){
  
  }
  
  public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'HrisMuApplication'),
		));
	}
  
  public function actionCancel($id){
    $model = $this->loadModel($id, 'HrisMuApplication');
    $model->scenario = 'cancel';
    if(!$model->canStillCancel())
       throw new CHttpException(403,'You can no longer cancel this application.');
    
    $model->next_lvl_id = HrisAccessLvl::$CANCELLED;
    if($model->save(false))
      Yii::log("Make Up ID $model->id Cancelled By ".Yii::app()->user->getState('emp_id'),'info','app');
    
    
    
    $this->redirect(array('admin'));     
  }
  
  public function actionFormyapproval() {
      $this->layout = 'column1';
		  $model = new HrisMuApplication('search');
      $model->unsetAttributes();
      
      if(isset($_GET['HrisMuApplication']))
        $model->setAttributes($_GET['HrisMuApplication']);
      
      if(isset($_POST['row']) and Yii::app()->request->isAjaxRequest) {
        $rows = Yii::app()->request->getPost('row');
  			$mus = Yii::app()->request->getPost('mu');
  			$action = Yii::app()->request->getPost('action');
  			$denial_reason = Yii::app()->request->getPost('denial_reason'); //echo $denial_reason;
  			$approved_hours = 'no data';
  			$to_hr = (isset($_POST['to_hr'])) ? Yii::app()->request->getPost('to_hr') : '0';
        //$user_is_supervisor = (Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR ) ? true : false;
        $user_is_supervisor = false; //// DEACTIVATED: ASSUME AL USERS CANNOT SET OTHERS' MU DATES
        $ok_ids = array();
        $failed_ids = array();
        $errors = array();
        $frm = new CActiveForm;
        $has_errors = '0';
        foreach($rows as $row){
          
          $app = $this->loadModel($mus[$row]['id'], 'HrisMuApplication');
          if($user_is_supervisor){ // supervisors must schedule the make up date
            
            $app->scenario = ($user_is_supervisor) ? 'approve_sup': '';
            $app->from_datetime = $mus[$row]['from'];
            $app->to_datetime = $mus[$row]['to'];
            $app->encodeApprovedHours();
            $valid = $app->validate();
            $valid_sched = $app->isValidScheduledMakeUp();
            if($valid and $valid_sched){
              $errors[$row]['row'] = $row;
              $errors[$row]['error'] = '';
              $app->encodeApprovedHours();
              if($app->approveMU($action,$denial_reason,$to_hr) and $app->save(false) )
                $ok_ids[]=$app->id;
              else
                Yii::log('Error saving approved MU ID '.$app->id,'info','app');
            }else{ 
              $has_errors = '1';
              $errors[$row]['row'] = $row;
              $errors[$row]['error'] = $frm->errorSummary($app);
              $failed_ids[]=$app->id;            
            }
          }else{ // other users will simply approve / deny
             $approved = $app->approveMU($action,$denial_reason,$to_hr);
             $saved = $app->save(false);
             if($approved and  $saved){
               
               $errors[$row]['row'] = $row;
               $errors[$row]['error'] = '<div class="successSummary">OK</div>'; 
               $ok_ids[]=$app->id;   
             }else{
                
               $has_errors = '1';
               $errors[$row]['row'] = $row;
               $errors[$row]['error'] = $frm->errorSummary($app); 
               $failed_ids[]=$app->id;
             }
          }
        }
        $result['errors'] = $errors;
        $result['ok_ids'] = implode(',',$ok_ids);
        $result['failed_ids'] = implode(',',$failed_ids);
        $result['has_errors'] = $has_errors;
        echo json_encode($result);
        Yii::app()->end();
      }
      
      $this->render('approval2', array(
  			'model' => $model,
  		 ));
  }
	
	public function actionFormyapprovalOLD() {
		
		//throw new CHttpException('404','Abangan...');
		$this->layout = 'column1';
		$model = new HrisMuApplication('approve');
		$model->scenario = 'approve';
    $model->unsetAttributes();
		

		if(isset($_POST['row']) and Yii::app()->request->isAjaxRequest) {
			$i = 0;
			$rows = Yii::app()->request->getPost('row');
			$mus = Yii::app()->request->getPost('mu');
			$action = Yii::app()->request->getPost('action');
			$denial_reason = Yii::app()->request->getPost('denial_reason'); echo $denial_reason;
			$approved_hours = 'no data';
			$to_hr = (isset($_POST['to_hr'])) ? Yii::app()->request->getPost('to_hr') : '0';
			
      foreach($rows as $row){
				$app = $this->loadModel($mus[$row]['id'], 'HrisMuApplication');
				if($app->from_datetime == null and empty($mus[$row]['from']) and Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR){
					echo "Make Up From is required for application ID ".$mus[$row]['id'];
					Yii::app()->end();
				}
				if($app->to_datetime == null and empty($mus[$row]['to']) and Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR){
					echo "Make Up To is required for application ID ".$mus[$row]['id'];
					Yii::app()->end();
				}
				$app->from_datetime = (isset($mus[$row]['from'])) ? $mus[$row]['from'] : $app->from_datetime;
				$app->to_datetime = (isset($mus[$row]['to'])) ? $mus[$row]['to'] : $app->to_datetime;
        if( Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$SUPERVISOR and $action == '1' and !empty ($app->from_datetime) and !empty($app->to_datetime) ) 
          $app->encodeApprovedHours();
				//if($app->approveMU($action,$denial_reason,$to_hr) and $app->save(false))
        if($app->approveMU($action,$denial_reason,$to_hr))
				//if($app->approveMU($action,$denial_reason,$to_hr))
					$i++;
			}
			echo "$i records updated successfully.";
			Yii::app()->end();
		}

		if (Yii::app()->getRequest()->getIsAjaxRequest())
			Yii::app()->end();	

		$this->render('approval', array(
			'model' => $model,
		));
	}

	public function actionFormyapprovalview($id) {
		$model = $this->loadModel($id, 'HrisMuApplication');
		
    $this->render('view', array(
			'model' => $model,
		));
	}
  
  
  public function actionCreate(){
    $model = new HrisMuApplication('apply_ajax');
    //$this->performAjaxValidation($model, 'hris-mu-application-form');
		
    // ajax handler for responding to extended hours request form
    if(isset($_POST['rtr-hrs']) and Yii::app()->request->isAjaxRequest){
      $hrs = new HrisMuApplication;
      $hrs->from = $_POST['from'];
      $hrs->to = $_POST['to'];
      $tcdata = $hrs->getExtendedHours();
      echo $this->renderPartial('_form_extended_hours',array('tcdata'=>$tcdata,'model'=>$hrs),true);
      Yii::app()->end();  
    }
    
    // ajax handler for submission request
    if(isset($_POST['HrisMuApplication']) and Yii::app()->request->isAjaxRequest){
      $response['message'] = '';
      $response['success'] = '0';
      $response['redirectUrl'] = Yii::app()->createAbsoluteUrl('hrisMuApplication/admin');
      $validAll = true;

       //get post data
      $rows = isset($_POST['row']) ? $_POST['row'] : array(); // checked rows
      $hours = $_POST['hours']; // clock hours info in those rows
      $model->setAttributes($_POST['HrisMuApplication']); // form
      
      //no selected hours
      $hasRows =  (!empty($rows)) ? true : false;
      if(!$hasRows){
        $response['message'] .= '<div class="errorSummary">Please select at least one extended clocked hours.</div>';
        $validAll = false;  
      }
      
      //pre calculate values
      $model->addClockedHours($rows, $hours);

      // validate the form
      $validForm = $model->validate();      
      if(!$validForm){
        $frm = new GxActiveForm;
        $response['message'] .= $frm->errorSummary($model);
        $validAll = false;  
      }
      
      //validate the makeup      
      $validMu = $model->isValidMUApplication();
      //$validMu = true;      
      if($validMu != '1'){
        $response['message'] .= '<div class="errorSummary">'.$validMu.'</div>'; 
        $validAll = false; 
      }
      
      //save each clock record as individual MU Application      
      if($validAll){
        try{
          
          $result = $model->saveMuApplications($rows, $hours);           
          if($result != '1') throw new Exception($result);
          $response['success'] = "1";
          $response['message'] .= "success"; 
        }catch(Exception $e){
          $response['message'] .= '<div class="errorSummary">Sorry. An error occured while saving: '.$e->getMessage().'</div>';
        }

      } 
      echo json_encode($response);
      Yii::app()->end();
    }
    
		Yii::app()->user->setFlash('instrux',$model->formInstrux2);
    $this->render('create2', array( 'model' => $model));
  }
  
	
	public function actionCreate0() {
		$model = new HrisMuApplication('apply');

		$this->performAjaxValidation($model, 'hris-mu-application-form');

		if (isset($_POST['HrisMuApplication'])) {
			$model->setAttributes($_POST['HrisMuApplication']);

			$valid = $model->validate();
			$validMu = $model->isValidMUApplication();
			//$validMu = true;
			
			if ($valid and $validMu) {
				$model->encodeHoursRequested(); // encodes it to x hours y minutes, for PHP usage sake
        $model->save(false);
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else{
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}
		Yii::app()->user->setFlash('instrux',$model->formInstrux);
		
		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'HrisMuApplication');

    if(!$model->canStillUpdate())
      throw new CHttpException(403,'You can no longer update this application.');
      
    $model->parseHours();

		$this->performAjaxValidation($model, 'hris-mu-application-form');

		if (isset($_POST['HrisMuApplication'])) {
			$model->setAttributes($_POST['HrisMuApplication']);
			$valid = $model->validate();
			$validMU = $model->isValidMUApplication();
			if ($valid and $validMU) {
        $model->save(false);
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDeleteO($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisMuApplication')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
  
  // Cancels instead: no delete please
  public function actionDelete(){
    
  }

	public function actionIndex() {
		// $dataProvider = new CActiveDataProvider('HrisMuApplication');
		// $this->render('index', array(
			// 'dataProvider' => $dataProvider,
		// ));
		$this->actionAdmin();
	}

	public function actionAdmin() {
		//$this->layout = 'column1';
		//throw new CHttpException('404','Abangan...');
		$model = new HrisMuApplication('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisMuApplication']))
			$model->setAttributes($_GET['HrisMuApplication']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}