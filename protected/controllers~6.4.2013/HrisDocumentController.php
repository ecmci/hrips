<?php

class HrisDocumentController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
// 			array('allow', 
// 				'actions'=>array('index', 'view','admin'),
// 				'users'=>array('@'),
// 				),
			array('allow', 
				'actions'=>array('create', 'update', 'admin', 'delete','index', 'view','download'),
				'users'=>array('@'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
  public function actionTest(){
    
  }

	public function actionView($id) {
    if(!HrisDocumentAccess::canAccess($id, Yii::app()->user->dept_id,Yii::app()->user->emp_id, "t.read='1'")){
      Yii::log("Access Denied for User ID ".Yii::app()->user->emp_id.", DocID $id",'info','app');
      throw new CHttpException(401, Yii::t('app', 'Access Denied.'));
    }
       
    $model = $this->loadModel($id, 'HrisDocument');
    $this->logAction($id,'Viewed');
		$this->render('view', array(
			'model' =>$model,
		));
	}

	public function actionCreate() {
		$model = new HrisDocument;
    $model->scenario = 'create';
    $access = $this->getAccessItems();

		//$this->performAjaxValidation($model, 'hris-document-form');

		if (isset($_POST['HrisDocument'])) {
			$model->setAttributes($_POST['HrisDocument']);
      $model->filename_real=CUploadedFile::getInstance($model,'filename_real');
      if($model->validate()){
        //save attachment
        
        $model->filename_storage = Attachments::generateStorageFilename($model->filename_real);
        $model->filename_real->saveAs(Yii::getPathOfAlias('webroot').'/uploads/documents/'.$model->filename_storage);
        $model->save(false);

        //save access rules
        $this->saveAccessRules($model->id,$access);
      
        //log action                                           
        $this->logAction($model->id,"Created");
      
        if (Yii::app()->getRequest()->getIsAjaxRequest())
 					Yii::app()->end();
 				else
 					$this->redirect(array('view', 'id' => $model->id));
      }
		}

		$this->render('create', array( 
      'model' => $model,
      'access'=>$access,
    ));
	}
  
  private function logAction($doc_id,$action){
      $log = new HrisDocumentLog;
      $log->doc_id = $doc_id;
      $log->user_id = Yii::app()->user->getState('emp_id');
      $log->action = $action;
      $log->save(false);
      Yii::log($action,'info','app');
  }
  
  
  private function saveAccessRules($doc_id, $rules){

     foreach($rules as $i=>$rule){
        $rule->doc_id = $doc_id;
        //echo '<pre>'; print_r($rule->attributes); echo '</pre>';
        $rule->save(false);
     }
     //exit();
  }

  private function getAccessItems(){
    if(!isset($_POST['HrisDocumentAccess'])){
      $a[] = new HrisDocumentAccess;
      //grant all access to current user by default
      $a[0]->setDefaultAccess();
      return $a; 
    }else{
      $items = $_POST['HrisDocumentAccess'];
      //echo '<pre>'; print_r($items); echo '</pre>'; exit();
      //echo '<pre>'; print_r($_POST['HrisDocumentAccess']); echo '</pre>'; exit();
      foreach($items as $i=>$item){
        $a[$i] = new HrisDocumentAccess;
        $a[$i]->attributes = $_POST['HrisDocumentAccess'][$i]; 
        //echo '<pre>'; print_r($a[$i]->attributes); echo '</pre>';
      }
      //echo 'count rules='.sizeof($a);
      //exit();
      return $a;
    }
  }

	public function actionUpdate($id) {
    if(!HrisDocumentAccess::canAccess($id, Yii::app()->user->dept_id,Yii::app()->user->emp_id, "t.update='1'")){
      Yii::log("Access Denied for User ID ".Yii::app()->user->emp_id.", DocID $id",'info','app');
      throw new CHttpException(401, Yii::t('app', 'Access Denied.'));
    }
  
		$model = HrisDocument::model()->findByPk($id);
    $model->scenario = 'update';    
    $access = (isset($_POST['HrisDocumentAccess'])) ? $this->getAccessItems() : HrisDocumentAccess::model()->findAll(array('condition'=>"doc_id = '$id'"));

		//$this->performAjaxValidation($model, 'hris-document-form');

		if (isset($_POST['HrisDocument'])) {
			$model->attributes=$_POST['HrisDocument']; //echo '<pre>'; print_r($model->attributes); echo "replace?$model->replace_file"; echo '</pre>';
      if ($model->replace_file == '1') {
        $model->filename_real = CUploadedFile::getInstance($model,'filename_real');
      }
      $valid = $model->validate();
      if($model->replace_file == '1' and ($model->filename_real == '' or $model->filename_real == null)){
        $model->addError('filename_real','The new file is required.');
        $valid = false;
      }
      if($valid){
        //save attachment
        if($model->replace_file == '1'){
          $model->filename_storage = Attachments::generateStorageFilename($model->filename_real);
          $model->filename_real->saveAs(Yii::getPathOfAlias('webroot').'/uploads/documents/'.$model->filename_storage);
        }
        $model->save(false);

        //delete old and save new access rules
        HrisDocumentAccess::model()->deleteAll("doc_id = '$model->id'");
        //echo "doc_id = '$model->id'<br/>";
        //echo '<pre>'; foreach($access as $a) print_r($a->attributes); echo '</pre>';  exit();
        $this->saveAccessRules($model->id,$access);
      
        //log action                                           
        $this->logAction($model->id,"Updated");
      
        if (Yii::app()->getRequest()->getIsAjaxRequest())
 					Yii::app()->end();
 				else
 					$this->redirect(array('view', 'id' => $model->id));
      }
		}


		$this->render('update', array(
				'model' => $model,
        'access'=>$access,
				));
	}

	public function actionDelete($id) {
    if(!HrisDocumentAccess::canAccess($id, Yii::app()->user->dept_id,Yii::app()->user->emp_id, "t.delete='1'")){
      Yii::log("Access Denied for User ID ".Yii::app()->user->emp_id.", DocID $id",'info','app');
      throw new CHttpException(401, Yii::t('app', 'Access Denied.'));
    }
  
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'HrisDocument')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
// 		$dataProvider = new CActiveDataProvider('HrisDocument');
// 		$this->render('index', array(
// 			'dataProvider' => $dataProvider,
// 		));
      $this->actionAdmin();
	}

	public function actionAdmin() {
		$model = new HrisDocument('search');
		$model->unsetAttributes();

		if (isset($_GET['HrisDocument']))
			$model->setAttributes($_GET['HrisDocument']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
  
  public function actionDownload($id){
    if(!HrisDocumentAccess::canAccess($id, Yii::app()->user->dept_id,Yii::app()->user->emp_id, "t.read='1'")){
      Yii::log("Access Denied for User ID ".Yii::app()->user->emp_id.", DocID $id",'info','app');
      throw new CHttpException(401, Yii::t('app', 'Access Denied.'));
    }
    
    
        
  }

}