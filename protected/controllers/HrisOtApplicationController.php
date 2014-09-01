<?php
/**
 * Revision 8.25.2014
 *
 */  
Yii::import('application.controllers.HrisOtApplication1Controller');
class HrisOtApplicationController extends HrisOtApplication1Controller{
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