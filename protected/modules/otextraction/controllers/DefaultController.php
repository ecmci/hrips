<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{    
    $ot = new OtApplication;
    
    if(isset($_GET['from'])){
      $ot->from = $_GET['from']; 
      $ot->to = $_GET['to'];            
    }
    
    $this->render('extract',array(
      'ot'=>$ot
    ));    
	}
}