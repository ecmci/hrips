<?php

class ApprovalController extends GxController {

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
  public function actionGet(){
     $loa = new HrisLoaApplication;
  
     $this->render('approval', array(
			 'loa' => $loa,
		));
  }

}
