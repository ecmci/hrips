<?php

class PayrollController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index','admin','viewpayslip'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('timesheet'),
				'users'=>array('*'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionTimesheet(){
		$model = new Payroll('timesheet');
                $data = null;
		
		if(isset($_POST['Payroll'])){
			$model->attributes = $_POST['Payroll'];
			try{
				$sql = "SELECT CONVERT(varchar, eh.[TimeIn], 100) as [ClockedIn],CONVERT(varchar, eh.[TimeOut], 100) as [ClockedOut], mjl.[Description] as [JobCode], DATEDIFF(hh,eh.[TimeIn], eh.[TimeOut]) as [Hours], eh.BreakFlag as BreakAfter
						FROM EmployeeHours eh
						JOIN MasterJobCodeList mjl on mjl.[JobCode] = eh.[JobCode]
						WHERE [EmployeeId] = '".$model->Emp_ID."'
						AND eh.[TimeIn] >= '".$model->from."'
						AND eh.[TimeIn] <= '".$model->to." 23:55:00'
						ORDER BY eh.[TimeIn] DESC";
				$data = new CSqlDataProvider($sql,array(
					//'totalItemCount'=>$count,
					'pagination'=>false,
					'db'=>Yii::app()->tcdb,
				));
				
				//mail it
				$to_user_id = $model->Emp_ID;
				$subject = "TimeSheet | $model->Emp_ID | $model->from to $model->to";
				$content = $this->renderPartial('_timesheet',array('data'=>$data),true);
				$dummy = new HrisLoaApplication;				
				WebApp::queueEmail($dummy, $model_name='', $to_user_id, $subject, $content, '', '');
				Yii::app()->user->setFlash("success", "The timesheet has been sent. Please check in about 5-10 minutes for the email to arrive.");				
			}catch(Exception $e){
				throw new CHttpException(500,$e->getMessage());
			}
		}
		
		$this->render('timesheet',array('model' => $model,'data'=>$data));
	}
	
	public function actionViewPayslip($paydate) {	
    $date = date('Y-m-d',strtotime($paydate));
   // if($date == '2013-12-10')  throw new CHttpException(403,'Your payslip is still being processed.'); /*future payslip*/
		
    $model = Payroll::model()->find("Payroll_Date = '$date' AND Emp_ID = '".Yii::app()->user->emp_id."'");
		if(!$model->canAccess())
		  throw new CHttpException('403','Access Denied.');
		
		Yii::log('Payslip viewed by employee '.Yii::app()->user->emp_id.' from IP '.$_SERVER['REMOTE_ADDR'], 'info', 'app');
		
		$this->renderPartial('_payslip-show-all', array(
			'model' => $model,
		));
	}
  
  public function actionView($id) {

    
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Payroll'),
		));
	}
  
  

	public function actionCreate() {
		$model = new Payroll;


		if (isset($_POST['Payroll'])) {
			$model->setAttributes($_POST['Payroll']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Payroll');


		if (isset($_POST['Payroll'])) {
			$model->setAttributes($_POST['Payroll']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Payroll')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
// 		$dataProvider = new CActiveDataProvider('Payroll');
// 		$this->render('index', array(
// 			'dataProvider' => $dataProvider,
// 		));
      $this->actionAdmin();
      //throw new CHttpException(404,"Temporarily Unavailable. Please contact Admin / HR to view your payslip(s).");
	}

	public function actionAdmin() {
		//$this->layout = 'column1';
		$model = new Payroll('search');
		$model->unsetAttributes();
		
		//$model->Payroll_Period!='Sep. 16-30, 2013';
		if (isset($_GET['Payroll']))
			$model->setAttributes($_GET['Payroll']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
