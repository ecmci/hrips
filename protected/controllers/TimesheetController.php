<?php
class TimesheetController extends GxController {
  public function filters() {
  	return array(
  			'accessControl', 
  			);
  }
  
  public function accessRules() {
  	return array(
  			array('allow', 
  				'actions'=>array('get'),
  				'users'=>array('@'),
  				),
  			array('deny', 
  				'users'=>array('*'),
  				),
  			);
  }
  
  public function actionGet($e='')
  { //sleep(3);
    if(Yii::app()->getRequest()->isAjaxRequest){
      $model = new Timesheet;
      $model->EmployeeId = empty($e) ? Yii::app()->user->getState('emp_id') : $e;
      $model->unsetAttributes();
      if(isset($_GET['Timesheet'])){
        $model->attributes = $_GET['Timesheet'];
      }
      echo CJSON::encode($model->search()->getData());
    }else{
      throw new CHttpException(403,'Unauthorized. Ajax request expected.');  
    }
  }

  
}
?>