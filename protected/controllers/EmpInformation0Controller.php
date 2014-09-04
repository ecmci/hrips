<?php

class EmpInformation0Controller extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $error = "";
	public $errCivil="";
	public $errWork="";
	public $GovtService="";
	public $errOrg="";
	public $errTraining="";
	public $errRef="";
	public $errQueries="";
	public $query_error=1;
	public $EditMode=false;
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/* return array(
			array('allow', 
				'actions'=>array('index','view','update'),
				'users'=>array('@'),
			),
			array('allow', 
				'actions'=>array('admin','delete', 'create','update','index'),
				'roles'=>array('admin','hr','employer'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		); */
	
		if(Yii::app()->user->isGuest){ //redirect to login
			$this->redirect(Yii::app()->baseUrl.'/index.php/site/login');
		}else{
			if(isset(Yii::app()->user->emp_id)){
			$employee=EmpInformation::model()->findByPk(Yii::app()->user->emp_id);
			
				if(!empty($employee)){ //employee has already created his pds
					//special exception for sir jude ONLY
					if (Yii::app()->user->emp_id==1098){
						return array(
							array('allow',
								'actions'=>array('admin','delete', 'create','update','view'),
								'roles'=>array('manager','hr','employer','admin'),
							),
						);
					}else{ //for everybody else
						return array(
							array('allow', //allow higher levels to create pds for others
								'actions'=>array('admin','delete', 'create','update','index','view'),
								'roles'=>array('admin','hr','employer'),
							),
							array('allow',
								'actions'=>array('view','update'),
								'users'=>array('@')
							),
							array('deny', //deny employee 
								'actions'=>array('create','admin'),
								'users'=>array('@')
							),
							
						);
					}
				}else{ //employee has not created his pds
					
					return array(
						array('allow',
							'actions'=>array('create','view'),
							'users'=>array('@')
						),
						array('allow', 
							'actions'=>array('admin','delete','update','view'),
							'roles'=>array('admin','hr','employer'),
						),
						array('deny',
							'actions'=>array('update','admin'),
							'users'=>array('@'),
						),
						array('deny',  // deny all users
							'users'=>array('*'),
						),
					);
				}
			}
		}
		
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		
		$curruser=HrisUsers::model()->findByPk(Yii::app()->user->emp_id);
		$userlvl=$curruser->access_lvl_id;
		
		if($userlvl=='3' || $userlvl=='4' || $userlvl=='5'){ //admin and hr can view anyone's pds
			$this->render('view',array(
			 'model'=>$this->loadModel($id),
			));
		}else{ //employee can only view their OWN pds
			 if (Yii::app()->user->emp_id==$id){
			$this->render('view',array(
			 'model'=>$this->loadModel($id),
			));
			}else{
				$this->render('view',array(
				 'model'=>$this->loadModel(Yii::app()->user->emp_id),
				));
			} 
		}
		/**/
		
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$model=new EmpInformation;
		$modelFam = new EmpFambg;
		$modChild = new EmpChildren;
		$modEduc = new EmpEducbg;
		$modCivil = new EmpCivilservice;
		$modWork = new EmpWorkexp;
		$modOrg = new EmpOrganization;
		$modTrain = new EmpTraining;
		$modOther = new EmpOtherinfo;
		$modQueries = new EmpQueries;
		$modRef = new EmpRef;
		$children=$this->getMychildren();
		$education=$this->getMyeducation();
		$civilServices=$this->getMycivilservice();
		$workExps=$this->getMyworkexps();
		$civicorgs=$this->getMyCivicorgs();
		$trainings=$this->getMyTrainings();
		$refs=$this->getMyReferences();
		
		if(isset($_POST['EmpInformation'])){
			$model->attributes=$_POST['EmpInformation'];
			$modelFam->attributes=$_POST['EmpFambg'];
			$modelFam->EmpID=$_POST['EmpInformation']['EmpID'];
			
			$isValidChildren="";
			$temp = $_POST['EmpChildren'];
			$mysize=(count($_POST['EmpChildren']));
			$sizeCivil=(count($_POST['EmpCivilservice']));
			$sizeWork=(count($_POST['EmpWorkexp']));
			$sizeOrg=(count($_POST['EmpOrganization']));
			$sizeTraining=(count($_POST['EmpTraining']));
			$sizeRef=(count($_POST['EmpRef']));
			
			$allValid = $model->validate();
			$isValidCivilservice="";
			$isValidChildren="";
			$isValidWork="";
			$isValidOrg="";
			$isValidTraining="";
			$isValidRef="";
			$isValidOtherinfo="";
			
			$allValid=$modelFam->validate() && $allValid;
			$isValidRef=$this->isValidRef($refs);
			$allValid=$isValidRef && $allValid;
			
			if(isset($_POST['chkMychild'])){ //validate child if the chkbox is checked
				$isValidChildren = $this->isValidChildren($children);
				$allValid=$isValidChildren && $allValid;
				//echo '<br><br>Children: '.$allValid;
			}
				
			if(isset($_POST['chkCvl'])){
				$isValidCivilservice = $this->isValidCivilservice($civilServices);
				$allValid=$isValidCivilservice && $allValid;
				//echo '<br><br>Civil: '.$allValid;
			}
			
			if(isset($_POST['chkWork'])){
				$isValidWork = $this->isValidWork($workExps);
				$allValid=$isValidWork && $allValid;
			}
			
			if(isset($_POST['chkOrg'])){
				$isValidOrg = $this->isValidOrg($civicorgs);
				$allValid=$isValidOrg && $allValid;
			}
			
			if(isset($_POST['chkTraining'])){
				$isValidTraining = $this->isValidTraining($trainings);
				$allValid=$isValidTraining && $allValid;
			}
			
				$modQueries->attributes=$_POST['EmpQueries'];
				$modQueries->EmpID=$_POST['EmpInformation']['EmpID'];
				$isValidQueries = $modQueries->validate();
				if(!$modQueries->validate()){
					$query_error=0; //error
				}else{
					$query_error=1; //no error
				}
				
				$allValid = $isValidQueries && $allValid;
				
				$modOther->attributes=$_POST['EmpOtherinfo'];
				$isValidOtherinfo=$modOther->validate();
				$allValid=$isValidOtherinfo && $allValid;
			//echo '<br><br>All: '.$allValid;
			 if ($allValid){ //all validations passed
				$model->attributes=$_POST['EmpInformation'];
				$model->ResidentialAddress=$_POST['EmpInformation']['ResidentialAddress'];
				$model->HomeAddress=$_POST['EmpInformation']['HomeAddress'];
				$model->DateAccomplished=date("Y-m-d H:i:s");
				$model->LastModifiedBy=Yii::app()->user->emp_id;
				$strLName=$_POST['EmpInformation']['LastName'];
				$strFName=$_POST['EmpInformation']['FirstName'];
				$strEmpName= $strLName.", ".$strFName;
				$model->EmpName=$strEmpName;
				$model->save(false);
				$modelFam->save(false);
				
				if($isValidChildren){ //validations passed for children tbl; will not save if chkMychild is not checked
					for($i=0 ; $i <$mysize; $i++){
							$modChild = new EmpChildren;
							$modChild->ChildName=$children[$i]['ChildName'];
							$modChild->BirthDate=$children[$i]['BirthDate'];
							$modChild->EmpID=$_POST['EmpInformation']['EmpID'];
							$modChild->save(false);
							
						}
				}
				
				//save educbg
				if(isset($_POST['EmpEducbg'])){
				$myeducs=$_POST['EmpEducbg'];
					for($i=0; $i<5; $i++){
						$idEduclvl=$i+1;
						$modEduc = new EmpEducbg;
						$modEduc->EmpID=$_POST['EmpInformation']['EmpID'];
						$modEduc->EducLevel	=$idEduclvl;
						$modEduc->NameofSchool=$myeducs[$i]['NameofSchool'];
						$modEduc->DegreeCourse=$myeducs[$i]['DegreeCourse'];
						$modEduc->YearGrad=$myeducs[$i]['YearGrad'];
						$modEduc->HighestEarned	=$myeducs[$i]['HighestEarned'];
						$modEduc->FromDate=$myeducs[$i]['FromDate'];
						$modEduc->ToDate=$myeducs[$i]['ToDate'];
						$modEduc->ScholarshipReceived=$myeducs[$i]['ScholarshipReceived'];
						
						$modEduc->save(false);
					} 
				} 
				//civil service
				if($isValidCivilservice){
					for($i=0; $i<$sizeCivil; $i++){
						$modCivil = new EmpCivilservice;
						$modCivil->EmpID=$_POST['EmpInformation']['EmpID'];
						$modCivil->CareerService=$civilServices[$i]['CareerService'];
						$modCivil->Rating=$civilServices[$i]['Rating'];
						$modCivil->DateExam=$civilServices[$i]['DateExam'];
						$modCivil->ExamPlace=$civilServices[$i]['ExamPlace'];
						$modCivil->LicenseNumber=$civilServices[$i]['LicenseNumber'];
						$modCivil->ReleaseDate=$civilServices[$i]['ReleaseDate'];
						$modCivil->save(false);
					}
				}
				//work
				if($isValidWork){
					for($i=0; $i<$sizeWork; $i++){
						$modWork = new EmpWorkexp;
						$modWork->EmpID=$_POST['EmpInformation']['EmpID'];
						$modWork->FromDate=$workExps[$i]['FromDate'];
						$modWork->ToDate=$workExps[$i]['ToDate'];
						$modWork->PositionTitle=$workExps[$i]['PositionTitle'];
						$modWork->Company=$workExps[$i]['Company'];
						$modWork->MonthlySalary=$workExps[$i]['MonthlySalary'];
						$modWork->SalaryGrade=$workExps[$i]['SalaryGrade'];
						$modWork->StatAppointment=$workExps[$i]['StatAppointment'];
						$modWork->GovtService=$workExps[$i]['GovtService'];
						$modWork->save(false);
					}
				}
				
				if($isValidOrg){
					for($i=0; $i<$sizeOrg; $i++){
						$modOrg = new EmpOrganization;
						$modOrg->EmpID=$_POST['EmpInformation']['EmpID'];
						$modOrg->NameAddressOrg=$civicorgs[$i]['NameAddressOrg'];
						$modOrg->FromDate=$civicorgs[$i]['FromDate'];
						$modOrg->ToDate=$civicorgs[$i]['ToDate'];
						$modOrg->NoOfHrs=$civicorgs[$i]['NoOfHrs'];
						$modOrg->PositionNatureOfWork=$civicorgs[$i]['PositionNatureOfWork'];
						$modOrg->save(false);
					}
				}
				
				if($isValidTraining){
					for($i=0; $i<$sizeTraining; $i++){
						$modTrain = new EmpTraining;
						$modTrain->EmpID=$_POST['EmpInformation']['EmpID'];
						$modTrain->SeminarTitle=$trainings[$i]['SeminarTitle'];
						$modTrain->FromDate=$trainings[$i]['FromDate'];
						$modTrain->ToDate=$trainings[$i]['ToDate'];
						$modTrain->NoOfHrs=$trainings[$i]['NoOfHrs'];
						$modTrain->ConductedBy=$trainings[$i]['ConductedBy'];
						$modTrain->save(false);
					}
				}
				
				if($isValidRef){
					for($i=0; $i<$sizeRef; $i++){
						$modRef = new EmpRef;
						$modRef->EmpID=$_POST['EmpInformation']['EmpID'];
						$modRef->RefName=$refs[$i]['RefName'];
						$modRef->RefAdd=$refs[$i]['RefAdd'];
						$modRef->Telno=$refs[$i]['Telno'];
						$modRef->save(false);
					}
				}
				
				//save other info
				if(isset($_POST['EmpOtherinfo'])){
					$modOther = new EmpOtherinfo;
					$modOther->attributes=$_POST['EmpOtherinfo'];
					$modOther->EmpID=$_POST['EmpInformation']['EmpID'];
					$modOther->save(false);
				}
				
				//save queries
				if(isset($_POST['EmpQueries'])){
					$modQueries = new EmpQueries;
					$modQueries->attributes=$_POST['EmpQueries'];
					$modQueries->EmpID=$_POST['EmpInformation']['EmpID'];
					$modQueries->save(false);
				}
				$id=$model->EmpID;
				$updateOthers=$this->getUpdateothers($id);
				$this->redirect(array('view','id'=>$model->EmpID));
			} 
		}
		
		
		$this->EditMode=false;
		
		$this->render('create',array(
			'model'=>$model,
			'modelFam'=>$modelFam,
			'modChild'=>$modChild,
			'modEduc'=>$modEduc,
			'modCivil'=>$modCivil,
			'modWork'=>$modWork,
			'modOrg'=>$modOrg,
			'modTrain'=>$modTrain,
			'modOther'=>$modOther,
			'modQueries'=>$modQueries,
			'modRef'=>$modRef,
			'children_details'=>$children,
			'children_error' => $this->error,
			'cvlservice_details'=>$civilServices,
			'cvlservice_error'=> $this->errCivil,
			'workexp_details'=>$workExps,
			'workexp_error'=>$this->errWork,
			'cvcorg_details'=>$civicorgs,
			'cvcorg_error'=>$this->errOrg,
			'training_details'=>$trainings,
			'training_error'=>$this->errTraining,
			'ref_details'=>$refs,
			'ref_error'=>$this->errRef,
			'query_error'=>$this->query_error,
			'educ_details'=>$education
		));
		
		
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelFam = EmpFambg::model()->findByPk($id);
		$modChild = $model->empChildrens;
		$children=$this->getMychildren();
		$modEduc = $model->empEducbgs();
		$education=$this->getMyeducation();
		$modCivil = $model->empCivilservices;
		$civilServices=$this->getMycivilservice();
		$modWork = $model->empWorkexps;
		$workExps=$this->getMyworkexps();
		$modOrg=$model->empOrganizations;
		$civicorgs=$this->getMyCivicorgs();
		$modTrain = $model->empTrainings;
		$trainings=$this->getMyTrainings();
		$modOther=EmpOtherinfo::model()->findByPk($id);
		$modQueries=EmpQueries::model()->findByPk($id);
		$modRef=$model->empRefs;
		$refs=$this->getMyReferences();
		
		if(isset($_POST['EmpInformation']))
		{
			$model->attributes=$_POST['EmpInformation'];
			$modelFam=new EmpFambg;
			$modelFam->attributes=$_POST['EmpFambg'];
			$modelFam->EmpID=$_POST['EmpInformation']['EmpID'];
			$modelFam->Children=0;
			$modChild=new EmpChildren;
			
			$mysize=(count($_POST['EmpChildren']));
			$sizeCivil=(count($_POST['EmpCivilservice']));
			$sizeWork=(count($_POST['EmpWorkexp']));
			$sizeOrg=(count($_POST['EmpOrganization']));
			$sizeTraining=(count($_POST['EmpTraining']));
			$sizeRef=(count($_POST['EmpRef']));
			
			$isValidCivilservice="";
			$isValidTraining="";
			$isValidWork="";
			$isValidOrg="";
			$isValidChildren="";
			$isValidOtherinfo="";
			
			$allValid=$model->validate();
			$allValid=$modelFam->validate() && $allValid;
			$isValidRef=$this->isValidRef($refs);
			$allValid=$isValidRef && $allValid;
			
			
			if(isset($_POST['chkMychild'])){ //validate child if the chkbox is checked
				$isValidChildren = $this->isValidChildren($children);
				$allValid=$isValidChildren && $allValid;
			}
			
			if(isset($_POST['chkCvl'])){
				$isValidCivilservice = $this->isValidCivilservice($civilServices);
				$allValid=$isValidCivilservice && $allValid;
				//echo '<br><br>Civil: '.$allValid;
			}
			
			if(isset($_POST['chkWork'])){
				$isValidWork = $this->isValidWork($workExps);
				$allValid=$isValidWork && $allValid;
			}
			
			if(isset($_POST['chkOrg'])){
				$isValidOrg = $this->isValidOrg($civicorgs);
				$allValid=$isValidOrg && $allValid;
			}
			
			if(isset($_POST['chkTraining'])){
				$isValidTraining = $this->isValidTraining($trainings);
				$allValid=$isValidTraining && $allValid;
			}
			
			if(isset($_POST['chkTraining'])){
				$isValidTraining = $this->isValidTraining($trainings);
				$allValid=$isValidTraining && $allValid;
			}
			
			$modQueries->attributes=$_POST['EmpQueries'];
			$modQueries->EmpID=$_POST['EmpInformation']['EmpID'];
			$isValidQueries = $modQueries->validate();
			if(!$modQueries->validate()){ $query_error=0; /*error*/ }else{ $query_error=1; /*no error*/}
			$allValid = $isValidQueries && $allValid;
			
			$modOther->attributes=$_POST['EmpOtherinfo'];
			$isValidOtherinfo=$modOther->validate();
			$allValid=$isValidOtherinfo && $allValid;
			
      
      
			if($allValid){
				$model->LastModifiedBy=Yii::app()->user->emp_id;
				$model->ResidentialAddress=$_POST['EmpInformation']['ResidentialAddress'];
				$model->HomeAddress=$_POST['EmpInformation']['HomeAddress'];
				$model->DateModified=date('Y-m-d h:i:s');
				$strLName=$_POST['EmpInformation']['LastName'];
				$strFName=$_POST['EmpInformation']['FirstName'];
				$strEmpName= $strLName.", ".$strFName;
				$model->EmpName=$strEmpName;
        $model->save();
        
				
				//delete existing fam records of user
				$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
				EmpFambg::model()->deleteAll($criteria);
				//save new records 
				$modelFam->save(false);
				
				if($isValidChildren){ //validations passed for children tbl; will not save if chkMychild is not checked
					//delete existing fam records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpChildren::model()->deleteAll($criteria);
					
					for($i=0 ; $i <$mysize; $i++){
						$modChild = new EmpChildren;
						$modChild->ChildName=$children[$i]['ChildName'];
						$modChild->BirthDate=$children[$i]['BirthDate'];
						$modChild->EmpID=$_POST['EmpInformation']['EmpID'];
						$modChild->save(false);
					}
				}
				
				//save educbg
				if(isset($_POST['EmpEducbg'])){
					$myeducs=$_POST['EmpEducbg'];
					//delete existing educ records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpEducbg::model()->deleteAll($criteria);
					for($i=0; $i<5; $i++){
						$idEduclvl=$i+1;
						$modEduc = new EmpEducbg;
						$modEduc->EmpID=$_POST['EmpInformation']['EmpID'];
						$modEduc->EducLevel	=$idEduclvl;
						$modEduc->NameofSchool=$myeducs[$i]['NameofSchool'];
						$modEduc->DegreeCourse=$myeducs[$i]['DegreeCourse'];
						$modEduc->YearGrad=$myeducs[$i]['YearGrad'];
						$modEduc->HighestEarned	=$myeducs[$i]['HighestEarned'];
						$modEduc->FromDate=$myeducs[$i]['FromDate'];
						$modEduc->ToDate=$myeducs[$i]['ToDate'];
						$modEduc->ScholarshipReceived=$myeducs[$i]['ScholarshipReceived'];
						
						$modEduc->save(false);
					} 
				}
				
				//civil service
				if($isValidCivilservice){
					//delete existing civil records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpCivilservice::model()->deleteAll($criteria);
					//save new records 
					for($i=0; $i<$sizeCivil; $i++){
						$modCivil = new EmpCivilservice;
						$modCivil->EmpID=$_POST['EmpInformation']['EmpID'];
						$modCivil->CareerService=$civilServices[$i]['CareerService'];
						$modCivil->Rating=$civilServices[$i]['Rating'];
						$modCivil->DateExam=$civilServices[$i]['DateExam'];
						$modCivil->ExamPlace=$civilServices[$i]['ExamPlace'];
						$modCivil->LicenseNumber=$civilServices[$i]['LicenseNumber'];
						$modCivil->ReleaseDate=$civilServices[$i]['ReleaseDate'];
						$modCivil->save(false);
					}
				}
				
				//work
				if($isValidWork){
					//delete existing work records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpWorkexp::model()->deleteAll($criteria);
					//save new records 
					for($i=0; $i<$sizeWork; $i++){
						$modWork = new EmpWorkexp;
						$modWork->EmpID=$_POST['EmpInformation']['EmpID'];
						$modWork->FromDate=$workExps[$i]['FromDate'];
						$modWork->ToDate=$workExps[$i]['ToDate'];
						$modWork->PositionTitle=$workExps[$i]['PositionTitle'];
						$modWork->Company=$workExps[$i]['Company'];
						$modWork->MonthlySalary=$workExps[$i]['MonthlySalary'];
						$modWork->SalaryGrade=$workExps[$i]['SalaryGrade'];
						$modWork->StatAppointment=$workExps[$i]['StatAppointment'];
						$modWork->GovtService=$workExps[$i]['GovtService'];
						$modWork->save(false);
					}
				}
				
				//civic org
				if($isValidOrg){
					//delete existing work records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpOrganization::model()->deleteAll($criteria);
					//save new records 
					for($i=0; $i<$sizeOrg; $i++){
						$modOrg = new EmpOrganization;
						$modOrg->EmpID=$_POST['EmpInformation']['EmpID'];
						$modOrg->NameAddressOrg=$civicorgs[$i]['NameAddressOrg'];
						$modOrg->FromDate=$civicorgs[$i]['FromDate'];
						$modOrg->ToDate=$civicorgs[$i]['ToDate'];
						$modOrg->NoOfHrs=$civicorgs[$i]['NoOfHrs'];
						$modOrg->PositionNatureOfWork=$civicorgs[$i]['PositionNatureOfWork'];
						$modOrg->save(false);
					}
				}
				
				//training
				if($isValidTraining){
					//delete existing work records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpTraining::model()->deleteAll($criteria);
					//save new records 
					for($i=0; $i<$sizeTraining; $i++){
						$modTrain = new EmpTraining;
						$modTrain->EmpID=$_POST['EmpInformation']['EmpID'];
						$modTrain->SeminarTitle=$trainings[$i]['SeminarTitle'];
						$modTrain->FromDate=$trainings[$i]['FromDate'];
						$modTrain->ToDate=$trainings[$i]['ToDate'];
						$modTrain->NoOfHrs=$trainings[$i]['NoOfHrs'];
						$modTrain->ConductedBy=$trainings[$i]['ConductedBy'];
						$modTrain->save(false);
					}
				}
				
				//other info
				if(isset($_POST['EmpOtherinfo'])){
					//delete existing work records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpOtherinfo::model()->deleteAll($criteria);
					//save new records 
					$modOther = new EmpOtherinfo;
					$modOther->attributes=$_POST['EmpOtherinfo'];
					$modOther->EmpID=$_POST['EmpInformation']['EmpID'];
					$modOther->save(false);
				}
				
				//queries
				if(isset($_POST['EmpQueries'])){
					//delete existing work records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpQueries::model()->deleteAll($criteria);
					//save new records 
					$modQueries = new EmpQueries;
					$modQueries->attributes=$_POST['EmpQueries'];
					$modQueries->EmpID=$_POST['EmpInformation']['EmpID'];
					$modQueries->save(false);
				}
				
				//ref
				if($isValidRef){
					//delete existing work records of user
					$criteria=new CDbCriteria(array('condition'=>'EmpID='.$id));
					EmpRef::model()->deleteAll($criteria);
					//save new records 
					for($i=0; $i<$sizeRef; $i++){
						$modRef = new EmpRef;
						$modRef->EmpID=$_POST['EmpInformation']['EmpID'];
						$modRef->RefName=$refs[$i]['RefName'];
						$modRef->RefAdd=$refs[$i]['RefAdd'];
						$modRef->Telno=$refs[$i]['Telno'];
						$modRef->save(false);
					}
				}
				$updateOthers=$this->getUpdateothers($id);
        
				$this->redirect(array('view','id'=>$model->EmpID));
			}
			
			/*  $model->attributes=$_POST['EmpInformation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->EmpID));  */
				
				
		}
		$this->EditMode=true;
		
		$this->render('update',array(
			'model'=>$model,
			'modelFam'=>$modelFam,
			'modChild'=>$modChild,
			'children_details'=>$children,
			'children_error' => $this->error,
			'modEduc'=>$modEduc,
			'educ_details'=>$education,
			'modCivil'=>$modCivil,
			'cvlservice_details'=>$civilServices,
			'cvlservice_error'=> $this->errCivil,
			'modWork'=>$modWork,
			'workexp_details'=>$workExps,
			'workexp_error'=>$this->errWork,
			'modOrg'=>$modOrg,
			'cvcorg_details'=>$civicorgs,
			'cvcorg_error'=>$this->errOrg,
			'modTrain'=>$modTrain,
			'training_details'=>$trainings,
			'training_error'=>$this->errTraining,
			'modOther'=>$modOther,
			'modQueries'=>$modQueries,
			'modRef'=>$modRef,
			'ref_details'=>$refs
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EmpInformation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmpInformation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmpInformation']))
			$model->attributes=$_GET['EmpInformation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmpInformation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmpInformation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmpInformation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='emp-information-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getChildbday()
	{
		if(!isset($_POST['EmpChildren'])){
		$childbday[] = $_POST['EmpChildren']['bday'];
			echo $childbday;
		}
	}
	
	public function getEducbg($i,$myempid)
	{
		$myempid=$_POST['EmpInformation']['EmpID'];
		$b=0;
		$b=$i+1;
		$educ=$_POST['EmpEducbg'];
		$modEduc = new EmpEducbg;
		$modEduc->attributes=$_POST['EmpEducbg'];
		$modEduc->EmpID=$myempid;//$_POST['EmpInformation']['EmpID'];
		$modEduc->EducLevel=$b;
		$modEduc->NameofSchool=$educ['NameofSchool'][$i];
		$modEduc->DegreeCourse=$educ['DegreeCourse'][$i];
		$modEduc->YearGrad=$educ['YearGrad'][$i];
		$modEduc->HighestEarned=$educ['HighestEarned'][$i];
		$modEduc->FromDate=$educ['FromDate'][$i];
		$modEduc->ToDate=$educ['ToDate'][$i];
		$modEduc->ScholarshipReceived=$educ['ScholarshipReceived'][$i]; 
		$modEduc->save(false);
	}

	public function beforeSave()
    {
        if(parent::beforeSave())
        {
            if(!empty($this->flags) && is_array($this->flags))
                $this->flags = implode(',',$this->flags);
 
            return true;
        }
 
        return false;
    }
	
	public function afterFind()
	{
       $this->flags = empty($this->flags) ? array() : explode(',',$this->flags);
	}
   
   protected function getMyeducation(){
		$education=array();
		//
		$education[0]['EducLevel']="Elementary";
		$education[1]['EducLevel']="High School";
		$education[2]['EducLevel']="Vocational";
		$education[3]['EducLevel']="College";
		$education[4]['EducLevel']="Graduate Studies";
		if(isset($_POST['EmpEducbg'])){
			$educ=$_POST['EmpEducbg'];
			for($i=0; $i<=4; $i++){
				$education[$i]['NameofSchool']=$educ[$i]['NameofSchool'];
				$education[$i]['DegreeCourse']=$educ[$i]['DegreeCourse'];
				$education[$i]['YearGrad']=$educ[$i]['YearGrad'];
				$education[$i]['HighestEarned']=$educ[$i]['HighestEarned'];
				$education[$i]['FromDate']=$educ[$i]['FromDate'];
				$education[$i]['ToDate']=$educ[$i]['ToDate'];
				$education[$i]['ScholarshipReceived']=$educ[$i]['ScholarshipReceived'];
			}
		}else{
			for($i=0; $i<=4; $i++){
				$education[$i]['NameofSchool']="";
				$education[$i]['DegreeCourse']="";
				$education[$i]['YearGrad']="";
				$education[$i]['HighestEarned']="";
				$education[$i]['FromDate']="";  
				$education[$i]['ToDate']="";  
				$education[$i]['ScholarshipReceived']="";  
			}
		}
		return $education;
   }
   protected function getMychildren(){
		$children=array();
		if(isset($_POST['EmpChildren'])){			
			$limit = (count($_POST['EmpChildren']));
			$tmp = $_POST['EmpChildren'];			
			 for($i=0 ; $i<$limit; $i++){
				$children[$i]['ChildName']=$tmp[$i]['ChildName'];
				$children[$i]['BirthDate']=$tmp[$i]['BirthDate'];	
			}	 
		}else{
			$children[0]['ChildName']="";
			$children[0]['BirthDate']="";	
		}
		return $children;
	}
	
	protected function isValidChildren($children){
		$limit = sizeof($children);
		$modChild = new EmpChildren;
		for($i=0 ; $i < $limit ; $i++){			
			$modChild->ChildName = $children[$i]['ChildName'];
			$modChild->EmpID = $_POST['EmpInformation']['EmpID'];
			$modChild->BirthDate = $children[$i]['BirthDate'];
			if(!$modChild->validate()) { 
				$this->error = "<div class='errorSummary'>Please fix the following input errors:<ul>";
				$errors = $modChild->getErrors();
				$j=0;
				foreach($errors as $error){
					$this->error .= "<li>".$error[0]."</li>";
				}
				$this->error .= "<ul></div>";
				return false;
			}
		}
		return true;
	}
   
	protected function getMycivilservice(){
		$civilServices=array();
		if(isset($_POST['EmpCivilservice'])){
			$limit = (count($_POST['EmpCivilservice']));
			$tmp = $_POST['EmpCivilservice'];			
			  for($i=0 ; $i<$limit; $i++){
				$civilServices[$i]['CareerService']=$tmp[$i]['CareerService'];
				$civilServices[$i]['Rating']=$tmp[$i]['Rating'];	
				$civilServices[$i]['DateExam']=$tmp[$i]['DateExam'];	
				$civilServices[$i]['ExamPlace']=$tmp[$i]['ExamPlace'];	
				$civilServices[$i]['LicenseNumber']=$tmp[$i]['LicenseNumber'];	
				$civilServices[$i]['ReleaseDate']=$tmp[$i]['ReleaseDate'];	
			}	 
		}else{
		
			 $civilServices[0]['CareerService']="";
				$civilServices[0]['Rating']="";
				$civilServices[0]['DateExam']="";
				$civilServices[0]['ExamPlace']="";
				$civilServices[0]['LicenseNumber']="";
				$civilServices[0]['ReleaseDate']=""; 
		}
		return $civilServices;
		
	}

	protected function isValidCivilservice($civilServices){
		$limit = sizeof($civilServices);
		$modCivil = new EmpCivilservice;
		for($i=0 ; $i < $limit ; $i++){			
			$modCivil->EmpID = $_POST['EmpInformation']['EmpID'];
			$modCivil->CareerService = $civilServices[$i]['CareerService'];
			$modCivil->Rating = $civilServices[$i]['Rating'];
			$modCivil->DateExam = $civilServices[$i]['DateExam'];
			$modCivil->ExamPlace = $civilServices[$i]['ExamPlace'];
			$modCivil->LicenseNumber = $civilServices[$i]['LicenseNumber'];
			$modCivil->ReleaseDate = $civilServices[$i]['ReleaseDate'];
			//$modCivil->BirthDate = $civilServices[$i]['BirthDate'];
			if(!$modCivil->validate()) { 
				$this->errCivil = "<div class='errorSummary'>Please fix the following input errors:<ul>";
				$errCivil = $modCivil->getErrors();
				$j=0;
				foreach($errCivil as $errorCivil){
					$this->errCivil .= "<li>".$errorCivil[0]."</li>";
				}
				$this->errCivil .= "<ul></div>";
				return false;
			}
		}
		return true;
	}
	
	protected function getMyworkexps(){
		$workExps=array();
		if(isset($_POST['EmpWorkexp'])){
			$limit = (count($_POST['EmpWorkexp']));
			$tmp = $_POST['EmpWorkexp'];			
			  for($i=0 ; $i<$limit; $i++){
				$workExps[$i]['FromDate']=$tmp[$i]['FromDate'];
				$workExps[$i]['ToDate']=$tmp[$i]['ToDate'];	
				$workExps[$i]['PositionTitle']=$tmp[$i]['PositionTitle'];	
				$workExps[$i]['Company']=$tmp[$i]['Company'];	
				$workExps[$i]['MonthlySalary']=$tmp[$i]['MonthlySalary'];	
				$workExps[$i]['SalaryGrade']=$tmp[$i]['SalaryGrade'];	
				$workExps[$i]['StatAppointment']=$tmp[$i]['StatAppointment'];	
				$workExps[$i]['GovtService']=$tmp[$i]['GovtService'];	
			}	 
		}else{
			$workExps[0]['FromDate']="";
			$workExps[0]['ToDate']="";
			$workExps[0]['PositionTitle']="";
			$workExps[0]['Company']="";
			$workExps[0]['MonthlySalary']="";
			$workExps[0]['SalaryGrade']=""; 
			$workExps[0]['StatAppointment']=""; 
			$workExps[0]['GovtService']=""; 
		}
		return $workExps;
	}
	
	protected function isValidWork($workExps){
		$limit = sizeof($workExps);
		$modWork = new EmpWorkexp;
		for($i=0 ; $i < $limit ; $i++){			
			$modWork->EmpID = $_POST['EmpInformation']['EmpID'];
			$modWork->FromDate = $workExps[$i]['FromDate'];
			$modWork->ToDate = $workExps[$i]['ToDate'];
			$modWork->PositionTitle = $workExps[$i]['PositionTitle'];
			$modWork->Company= $workExps[$i]['Company'];
			$modWork->MonthlySalary= $workExps[$i]['MonthlySalary'];
			$modWork->SalaryGrade= $workExps[$i]['SalaryGrade'];
			$modWork->StatAppointment= $workExps[$i]['StatAppointment'];
			$modWork->GovtService = $workExps[$i]['GovtService'];
			if(!$modWork->validate()) { 
				$this->errWork = "<div class='errorSummary'>Please fix the following input errors:<ul>";
				$errWork = $modWork->getErrors();
				$j=0;
				foreach($errWork as $errorWork){
					$this->errWork .= "<li>".$errorWork[0]."</li>";
				}
				$this->errWork .= "<ul></div>";
				return false;
			}
		}
		return true;
	}
	
	protected function getMyCivicorgs(){
		$civicorgs=array();
		if(isset($_POST['EmpOrganization'])){
			$limit = (count($_POST['EmpOrganization']));
			$tmp = $_POST['EmpOrganization'];			
			  for($i=0 ; $i<$limit; $i++){
				$civicorgs[$i]['NameAddressOrg']=$tmp[$i]['NameAddressOrg'];	
				$civicorgs[$i]['FromDate']=$tmp[$i]['FromDate'];
				$civicorgs[$i]['ToDate']=$tmp[$i]['ToDate'];	
				$civicorgs[$i]['NoOfHrs']=$tmp[$i]['NoOfHrs'];	
				$civicorgs[$i]['PositionNatureOfWork']=$tmp[$i]['PositionNatureOfWork'];	
			}	 
		}else{
			$civicorgs[0]['NameAddressOrg']="";
			$civicorgs[0]['FromDate']="";
			$civicorgs[0]['ToDate']="";
			$civicorgs[0]['NoOfHrs']="";
			$civicorgs[0]['PositionNatureOfWork']="";
		}
		return $civicorgs;
	}
	
	protected function isValidOrg($civicorgs){
		$limit = sizeof($civicorgs);
		$modOrg = new EmpOrganization;
		for($i=0 ; $i < $limit ; $i++){			
			$modOrg->EmpID = $_POST['EmpInformation']['EmpID'];
			$modOrg->NameAddressOrg = $civicorgs[$i]['NameAddressOrg'];
			$modOrg->FromDate = $civicorgs[$i]['FromDate'];
			$modOrg->ToDate = $civicorgs[$i]['ToDate'];
			$modOrg->NoOfHrs = $civicorgs[$i]['NoOfHrs'];
			$modOrg->PositionNatureOfWork = $civicorgs[$i]['PositionNatureOfWork'];
			if(!$modOrg->validate()) { 
				$this->errOrg = "<div class='errorSummary'>Please fix the following input errors:<ul>";
				$errOrg = $modOrg->getErrors();
				$j=0;
				foreach($errOrg as $errorOrg){
					$this->errOrg .= "<li>".$errorOrg[0]."</li>";
				}
				$this->errOrg .= "<ul></div>";
				return false;
			}
		}
		return true;
	}
	
	protected function getMyTrainings(){
		$trainings=array();
		$modTrain=new EmpTraining;
		if(isset($_POST['EmpTraining'])){
			$limit = (count($_POST['EmpTraining']));
			$tmp = $_POST['EmpTraining'];			
			  for($i=0 ; $i<$limit; $i++){
				$trainings[$i]['SeminarTitle']=$tmp[$i]['SeminarTitle'];	
				$trainings[$i]['FromDate']=$tmp[$i]['FromDate'];
				$trainings[$i]['ToDate']=$tmp[$i]['ToDate'];	
				$trainings[$i]['NoOfHrs']=$tmp[$i]['NoOfHrs'];	
				$trainings[$i]['ConductedBy']=$tmp[$i]['ConductedBy'];	
			}	 
		}else{
			$trainings[0]['SeminarTitle']="";
			$trainings[0]['FromDate']="";
			$trainings[0]['ToDate']="";
			$trainings[0]['NoOfHrs']="";
			$trainings[0]['ConductedBy']="";
		}
		return $trainings;
	}
	
	protected function isValidTraining($trainings){
		$limit = sizeof($trainings);
		$modTrain = new EmpTraining;
		for($i=0 ; $i < $limit ; $i++){			
			$modTrain->EmpID = $_POST['EmpInformation']['EmpID'];
			$modTrain->SeminarTitle = $trainings[$i]['SeminarTitle'];
			$modTrain->FromDate = $trainings[$i]['FromDate'];
			$modTrain->ToDate = $trainings[$i]['ToDate'];
			$modTrain->NoOfHrs = $trainings[$i]['NoOfHrs'];
			$modTrain->ConductedBy = $trainings[$i]['ConductedBy'];
			if(!$modTrain->validate()) { 
				$this->errTraining = "<div class='errorSummary'>Please fix the following input errors:<ul>";
				$errTraining = $modTrain->getErrors();
				$j=0;
				foreach($errTraining as $errorTraining){
					$this->errTraining .= "<li>".$errorTraining[0]."</li>";
				}
				$this->errTraining .= "<ul></div>";
				return false;
			}
		}
		return true;
	}
	
	protected function getMyReferences(){
		$refs=array();
		if(isset($_POST['EmpRef'])){
			$limit = (count($_POST['EmpRef']));
			$tmp = $_POST['EmpRef'];			
			  for($i=0 ; $i<$limit; $i++){
				$refs[$i]['RefName']=$tmp[$i]['RefName'];	
				$refs[$i]['RefAdd']=$tmp[$i]['RefAdd'];
				$refs[$i]['Telno']=$tmp[$i]['Telno'];	
			}	 
		}else{
			$refs[0]['RefName']="";
			$refs[0]['RefAdd']="";
			$refs[0]['Telno']="";
		}
		return $refs;
	}
	
	protected function isValidRef($refs){
		$limit = sizeof($refs);
		$modRef = new EmpRef;
		for($i=0 ; $i < $limit ; $i++){			
			$modRef->EmpID = $_POST['EmpInformation']['EmpID'];
			$modRef->RefName = $refs[$i]['RefName'];
			$modRef->RefAdd = $refs[$i]['RefAdd'];
			$modRef->Telno = $refs[$i]['Telno'];
			if(!$modRef->validate()) { 
				$this->errRef = "<div class='errorSummary'>Please fix the following input errors:<ul>";
				$errRef = $modRef->getErrors();
				$j=0;
				foreach($errRef as $errorRef){
					$this->errRef .= "<li>".$errorRef[0]."</li>";
				}
				$this->errRef .= "<ul></div>";
				return false;
			}
		}
		return true;
	}
  
  /**
   * This code syncs the EmpInformation table to that of the payroll's Employee table
   */     
	public function getUpdateothers($id){
		$sql="Update emp_information as t1, (select Emp_ID, Department, Position, Date_Hired from employee where emp_id=".$id.") as t2 SET t1.Department=t2.Department, t1.Position=t2.Position, t1.DateHire=t2.Date_Hired where t1.EmpID=".$id;
		$com=Yii::app()->db->createCommand($sql);
		$result=$com->query();
	}
}
