<?php 
Yii::import('application.controllers.HrisOtApplication0Controller');

class HrisOtApplicationController extends HrisOtApplication0Controller{
  public function accessRules(){
    return array(
			array('allow', 
				'actions'=>array('index','view','update','admin','delete','formyapprovalview','print','sign','cancel','convertasmu'),
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
  
  public function actionConvertasmu($id){
    $ot = $this->loadModel($id,'HrisOtApplication');
    $ot->scenario = 'convert';
    $mu = new HrisMuApplication('convert');
    $mu->scenario = 'convert';
    
    //trap
    if(!$ot->convertibleToMakeUp())throw new CHttpException(400,'This OT is no longer convertible to make up. For special cases, call I.T.');
    
    $this->performAjaxValidation($mu,'hris-ot-to-mu-form');
    
    if(isset($_POST['HrisMuApplication'])){
      //get post data
      $mu->setAttributes ($_POST['HrisMuApplication']);

      //validate
      if($mu->validate()){
        //save new mu
        $mu->save(false);
        
        //cancel the ot
        $ot->next_lvl_id = HrisAccessLvl::$CANCELLED;
        $ot->reason = 'CONVERTED TO MAKE UP ID '.$mu->id.' | '.$ot->reason;
        $ot->save(false);
        
        //redirect
        $this->redirect(array('admin'));
      }
    }else{
      //xfer clock in dates
      $mu->clockedin_datetime = $ot->in_datetime;
      $mu->clockedout_datetime = $ot->out_datetime;
      $diff = WebApp::diffBetweenDateTimeRange($ot->in_datetime,$ot->out_datetime);
      $hours = $diff['hours'] < 10 ? '0'.$diff['hours'] : $diff['hours'];
      $mins = $diff['mins'] < 10 ? '0'.$diff['mins'] : $diff['mins'];
      $mu->hours = "$hours:$mins:00";
    }
    
    $this->render('convert_as_mu',array('ot'=>$ot, 'mu'=>$mu));
    
  }
  
  public function actionSign($id){
    parent::actionUpdate($id);
  }
  
  public function actionCancel($id){
    if(!Yii::app()->request->isAjaxRequest) throw new CHttpException(400,'Invalid Request');
    $model = $this->loadModel($id,'HrisOtApplication');
    $model->scenario = 'cancel';
    
    if($model->validate()){
      $model->next_lvl_id = HrisAccessLvl::$CANCELLED;
      $model->save(false);
      echo '1';
    }else{
      $model->printErrors();      
    }
    Yii::app()->end();
  }
} 
?>