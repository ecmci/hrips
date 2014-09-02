<?php
Yii::import("application.controllers.HrisLoaApplication0Controller");
class HrisLoaApplicationController extends HrisLoaApplication0Controller{
  public function accessRules(){
      return array_merge(
            array(
                array('allow', 
                    'actions'=>array('saveapprovals','approve','deny'),
                    'users'=>array('@'),
                ),            
            ),
            parent::accessRules()
      );      
  }
  
  /**
   * Denies the LOA saves changes and sends it off.
   * @throws CHttpException
   */
  public function actionDeny()
  {
      if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['loa']))
            foreach($_POST['loa'] as $loa){
                if($loa['edit'] == '1'){
                    $m = HrisLoaApplication::model()->findByPk($loa['id']);
                    $m->job_code_id = $loa['job_code_id'];
                    $action = '0';
                    $approved_hours = $m->hours_requested;
                    $to_hr = '0';
                    $denial_reason = $_POST['r'];
                    if($m->approveLOA($action,$denial_reason,$to_hr,$approved_hours) and $m->save(false))
                       $count++;     
                }          
            }
          echo $count." record(s) denied.";
      }else{
          throw new CHttpException(400,'This action only accepts ajax requests.');
      }
  }
  
  /**
   * Approves batch LOA, saves changes and sends it off.
   * @throws CHttpException
   */
  public function actionApprove()
  {
      if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['loa']))
            foreach($_POST['loa'] as $loa){
                if($loa['edit'] == '1'){
                    $m = HrisLoaApplication::model()->findByPk($loa['id']);
                    $m->job_code_id = $loa['job_code_id'];
                    $action = '1';
                    $approved_hours = $m->hours_requested;
                    $to_hr = '1';
                    $denial_reason = '';
                    if($m->approveLOA($action,$denial_reason,$to_hr,$approved_hours) and $m->save(false))
                       $count++;     
                }          
            }
          echo $count." record(s) approved.";
      }else{
          throw new CHttpException(400,'This action only accepts ajax requests.');
      }
  }


  /**
   * Processes batch LOA and saves changes without signing it off.
   * @throws CHttpException
   */
  public function actionSaveapprovals(){
      if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['loa']))
            foreach($_POST['loa'] as $loa){
                if($loa['edit'] == '1'){
                    $m = HrisLoaApplication::model()->findByPk($loa['id']);
                    $m->job_code_id = $loa['job_code_id'];
                    Yii::log("LOA ".$loa['id']." Edited by ".Yii::app()->user->getState("emp_name"),'info','app');
                    $m->save(false);
                    $count++;
                }              
            }
          echo $count." record(s) saved.";
      }else{
          throw new CHttpException(400,'This action only accepts ajax requests.');
      }
  }  
  
  /*
   * Renders all LOA for approval in gridview
   */
  public function actionFormyapproval(){
    $this->layout = 'column1';
    $model = new HrisLoaApplication('search');
    $model->unsetAttributes();
    
    $this->render('approval2', array(
            'model' => $model,
    ));
  }
  
  /**
   * Cancels the LOA and makes sure only the requestor can do it.
   * @param type $id of the LOA
   * @throws CHttpException
   */
  public function actionCancel($id)
  {
      $model = $this->loadModel($id, "HrisLoaApplication");
      
      //check if user is owner. only allow cancellation by owner
      if($model->emp_id != Yii::app()->user->getState("emp_id"))  
          throw new CHttpException(401,"Unauthorized. Only the requestor can cancel this LOA.");
      elseif(Yii::app()->getRequest()->getIsAjaxRequest()){
          if($model->cancel()->save(false))
              echo 1;
          else
              echo 0;
      }else{
          throw new CHttpException(400);
      }
  }
  
} 
?>