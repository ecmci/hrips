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
} 
?>