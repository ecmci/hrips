<?php
/**
 * Revision 8.25.2014
 *
 */  
Yii::import('application.controllers.HrisOtApplication1Controller');
class HrisOtApplicationController extends HrisOtApplication1Controller{  
  public function accessRules() {
      return array_merge(array(
          array('allow',
              'actions'=>array('save','approve','deny'),
              'users'=>array('@'),
          ),
      ),  parent::accessRules());
  }
  
  public function actionDeny()
  {
     if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['ot']))
              foreach($_POST['ot'] as $ot){
                if($ot['edit'] == '1'){
                    $m = HrisOtApplication::model()->findByPk($ot['id']);
                    $m->hours = $ot['hours'];
                    $m->minutes = $ot['minutes'];
                    $m->sub_code_id = $ot['sub_code_id'];
                    $action = '0';
                    $denial_reason = $_POST['r'];
                    $to_hr = '0';
                    if($m->approveOT($action,$denial_reason,$to_hr) and $m->save(false)){
                        Yii::log('OT ID '.$ot['id'].' denied by '.Yii::app()->user->getState('emp_name').' data['.json_encode($ot).']','info','app');
                        $count++;					
                    }                   
                }
              }
          echo $count.' record(s) approved.';
      }else{
          throw new CHttpException(400,'This action only accepts ajax request.');
      }
  }

  /**
   * Approves the OTs state from the approval gridview
   * @throws CHttpException
   */
  public function actionApprove()
  {
      if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['ot']))
              foreach($_POST['ot'] as $ot){
                if($ot['edit'] == '1'){
                    $m = HrisOtApplication::model()->findByPk($ot['id']);
                    $m->hours = $ot['hours'];
                    $m->minutes = $ot['minutes'];
                    $m->sub_code_id = $ot['sub_code_id'];
                    $action = '1';
                    $denial_reason = '';
                    $to_hr = '1';
                    if($m->approveOT($action,$denial_reason,$to_hr) and $m->save(false)){
                        $count++;					
                    }                    
                    Yii::log('OT ID '.$ot['id'].' approved by '.Yii::app()->user->getState('emp_name').' data['.json_encode($ot).']','info','app');
                }
              }
          echo $count.' record(s) approved.';
      }else{
          throw new CHttpException(400,'This action only accepts ajax request.');
      }
  }
  
  /**
   * Saves the OTs state from the approval gridview
   * @throws CHttpException
   */
  public function actionSave()
  {
      if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['ot']))
              foreach($_POST['ot'] as $ot){
                if($ot['edit'] == '1'){
                    $m = HrisOtApplication::model()->findByPk($ot['id']);
                    $m->hours = $ot['hours'];
                    $m->minutes = $ot['minutes'];
                    $m->sub_code_id = $ot['sub_code_id'];
                    $m->save(false);
                    $count++;
                    Yii::log('OT ID '.$ot['id'].' edited by '.Yii::app()->user->getState('emp_name').' data['.json_encode($ot).']','info','app');
                }
              }
          echo $count.' record(s) saved.';
      }else{
          throw new CHttpException(400,'This action only accepts ajax request.');
      }          
  }
  /**
   * Renders the OT approval gridview form.
   */  
  public function actionFormyapproval()
  {
        $this->layout = 'column1';
        $model = new HrisOtApplication('getOTForApproval');
        $model->unsetAttributes();
      
        $this->render('approval2', array(
            'model' => $model,
        ));
  }
}
?>