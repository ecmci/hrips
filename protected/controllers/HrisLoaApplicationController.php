<?php
Yii::import("application.controllers.HrisLoaApplication0Controller");
class HrisLoaApplicationController extends HrisLoaApplication0Controller{
  public function actionFormyapproval(){
    $this->layout = 'column1';
    $model = new HrisLoaApplication('search');
    $model->unsetAttributes();
    
    $this->render('approval2', array(
            'model' => $model,
    ));
  }
  
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
          throw new CHttpException(403);
      }
  }
  
} 
?>