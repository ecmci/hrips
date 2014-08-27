<?php
/**
 * Revision dated 8.19.2013
 *
 */  
 Yii::import('application.controllers.HrisMuApplication0Controller');
 class HrisMuApplicationController extends HrisMuApplication0Controller{
  
  //now allows staggered make up dates
  public function actionCreate(){
    $model = new HrisMuApplication('apply_ajax');
    $f = new CActiveForm;
      
    // ajax handler for responding to extended hours request form
    if(isset($_POST['rtr-hrs']) and Yii::app()->request->isAjaxRequest){
      $hrs = new HrisMuApplication;
      $hrs->from = $_POST['from'];
      $hrs->to = $_POST['to'];
      $tcdata = $hrs->getExtendedHours();
      echo $this->renderPartial('_form_extended_hours3',array('tcdata'=>$tcdata,'model'=>$hrs,'form'=>new CActiveForm),true);
      Yii::app()->end();  
    }
    
    //form submission
    // ajax handler for submission request
    if(isset($_POST['HrisMuApplication']) and Yii::app()->request->isAjaxRequest){
      $response['message'] = '';
      $response['success'] = '0';
      $validAll = true;
      
      //get post data
      $model->unsetAttributes();
      $model->setAttributes($_POST['HrisMuApplication']);

      if($model->validate()){
        $response['success'] = $model->saveMU();
        if($response['success'] == '1'){
          //redirect
          $response['message'] = 'ok'; 
        }else{
          $response['message'] .= $f->errorSummary($model);  
        }  
      }else{
        $response['message'] .= $f->errorSummary($model);
      }
      
      // relay message as json
      echo json_encode($response);
      Yii::app()->end(); 
    }
    
    Yii::app()->user->setFlash('instrux',$model->formInstrux2);
    $this->render('create3', array( 'model' => $model));
  }
  
  public function actionCancel($id){
    $model = $this->loadModel($id, 'HrisMuApplication');
    $model->scenario = 'cancel';
    if(!$model->canStillCancel()){
      if(Yii::app()->request->isAjaxRequest){
        echo 'You can no longer cancel this application. Call IT for special cases.';
        Yii::app()->end();
      }else{
        throw new CHttpException(403,'You can no longer cancel this application. Call IT for special cases.');
      }  
    }

    
    $model->next_lvl_id = HrisAccessLvl::$CANCELLED;
    if($model->save(false)) {
      Yii::log("Make Up ID $model->id Cancelled By ".Yii::app()->user->getState('emp_id'),'info','app');
      if(Yii::app()->request->isAjaxRequest){ 
        echo '1';
        Yii::app()->end();
      }
    }

    $this->redirect(array('admin'));     
  } 
 }
?>