<?php

Yii::import('application.controllers.EmpInformation0Controller');

class EmpInformationController extends EmpInformation0Controller {
    /**
     * Business Rules 9/5/2014. 
     * 1. CREATE: Only employees can create their PDS.
     * 2. UPDATE: Employees can only update their PDS. HR and Employer can update everyone.
     * 3. VIEW: Employees can only view their PDS. HR and Employer can view everyone.
     * 4. DELETE: No one can delete any PDS.
     * @return type
     */
    public function accessRules() {
        $current_usr_lvl = Yii::app()->user->getState('access_lvl_id');
        return array(
            array('allow',
                'actions' => array('index','view','syncwithemployee'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create','update'),
                'users' => array('@'),
                'roles'=>array('emp','hr','employer'),
            ),
            array('allow',
                'actions' => array('admin'),
                'users' => array('@'),
                'roles'=>array('hr','employer'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        if(Yii::app()->user->getState('access_lvl_id') == HrisAccessLvl::$EMPLOYEE){
            $this->redirect(Yii::app()->createUrl('empInformation/view',array('id'=>Yii::app()->user->getState('emp_id'))));
        }else{
            $this->redirect(Yii::app()->createUrl('empInformation/admin'));
        }        
    }

    public function actionCreate() {
        //can only create once        
        if(EmpInformation::model()->exists("EmpID = ".Yii::app()->user->emp_id))
        {
            $this->redirect('index');
        }

        $model = new EmpInformation;
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
        $children = $this->getMychildren();
        $education = $this->getMyeducation();
        $civilServices = $this->getMycivilservice();
        $workExps = $this->getMyworkexps();
        $civicorgs = $this->getMyCivicorgs();
        $trainings = $this->getMyTrainings();
        $refs = $this->getMyReferences();

        if (isset($_POST['EmpInformation'])) {
            $model->attributes = $_POST['EmpInformation'];
            $modelFam->attributes = $_POST['EmpFambg'];
            $modelFam->EmpID = $_POST['EmpInformation']['EmpID'];

            $isValidChildren = "";
            $temp = $_POST['EmpChildren'];
            $mysize = (count($_POST['EmpChildren']));
            $sizeCivil = (count($_POST['EmpCivilservice']));
            $sizeWork = (count($_POST['EmpWorkexp']));
            $sizeOrg = (count($_POST['EmpOrganization']));
            $sizeTraining = (count($_POST['EmpTraining']));
            $sizeRef = (count($_POST['EmpRef']));

            $allValid = $model->validate();
            $isValidCivilservice = "";
            $isValidChildren = "";
            $isValidWork = "";
            $isValidOrg = "";
            $isValidTraining = "";
            $isValidRef = "";
            $isValidOtherinfo = "";

            $allValid = $modelFam->validate() && $allValid;
            $isValidRef = $this->isValidRef($refs);
            $allValid = $isValidRef && $allValid;

            if (isset($_POST['chkMychild'])) { //validate child if the chkbox is checked
                $isValidChildren = $this->isValidChildren($children);
                $allValid = $isValidChildren && $allValid;
                //echo '<br><br>Children: '.$allValid;
            }

            if (isset($_POST['chkCvl'])) {
                $isValidCivilservice = $this->isValidCivilservice($civilServices);
                $allValid = $isValidCivilservice && $allValid;
                //echo '<br><br>Civil: '.$allValid;
            }

            if (isset($_POST['chkWork'])) {
                $isValidWork = $this->isValidWork($workExps);
                $allValid = $isValidWork && $allValid;
            }

            if (isset($_POST['chkOrg'])) {
                $isValidOrg = $this->isValidOrg($civicorgs);
                $allValid = $isValidOrg && $allValid;
            }

            if (isset($_POST['chkTraining'])) {
                $isValidTraining = $this->isValidTraining($trainings);
                $allValid = $isValidTraining && $allValid;
            }

            $modQueries->attributes = $_POST['EmpQueries'];
            $modQueries->EmpID = $_POST['EmpInformation']['EmpID'];
            $isValidQueries = $modQueries->validate();
            if (!$modQueries->validate()) {
                $query_error = 0; //error
            } else {
                $query_error = 1; //no error
            }

            $allValid = $isValidQueries && $allValid;

            $modOther->attributes = $_POST['EmpOtherinfo'];
            $isValidOtherinfo = $modOther->validate();
            $allValid = $isValidOtherinfo && $allValid;
            //echo '<br><br>All: '.$allValid;
            if ($allValid) { //all validations passed
                $model->attributes = $_POST['EmpInformation'];
                $model->ResidentialAddress = $_POST['EmpInformation']['ResidentialAddress'];
                $model->HomeAddress = $_POST['EmpInformation']['HomeAddress'];
                $model->DateAccomplished = date("Y-m-d H:i:s");
                $model->LastModifiedBy = Yii::app()->user->emp_id;
                $strLName = $_POST['EmpInformation']['LastName'];
                $strFName = $_POST['EmpInformation']['FirstName'];
                $strEmpName = $strLName . ", " . $strFName;
                $model->EmpName = $strEmpName;
                $model->save(false);
                $modelFam->save(false);

                if ($isValidChildren) { //validations passed for children tbl; will not save if chkMychild is not checked
                    for ($i = 0; $i < $mysize; $i++) {
                        $modChild = new EmpChildren;
                        $modChild->ChildName = $children[$i]['ChildName'];
                        $modChild->BirthDate = $children[$i]['BirthDate'];
                        $modChild->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modChild->save(false);
                    }
                }

                //save educbg
                if (isset($_POST['EmpEducbg'])) {
                    $myeducs = $_POST['EmpEducbg'];
                    for ($i = 0; $i < 5; $i++) {
                        $idEduclvl = $i + 1;
                        $modEduc = new EmpEducbg;
                        $modEduc->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modEduc->EducLevel = $idEduclvl;
                        $modEduc->NameofSchool = $myeducs[$i]['NameofSchool'];
                        $modEduc->DegreeCourse = $myeducs[$i]['DegreeCourse'];
                        $modEduc->YearGrad = $myeducs[$i]['YearGrad'];
                        $modEduc->HighestEarned = $myeducs[$i]['HighestEarned'];
                        $modEduc->FromDate = $myeducs[$i]['FromDate'];
                        $modEduc->ToDate = $myeducs[$i]['ToDate'];
                        $modEduc->ScholarshipReceived = $myeducs[$i]['ScholarshipReceived'];

                        $modEduc->save(false);
                    }
                }
                //civil service
                if ($isValidCivilservice) {
                    for ($i = 0; $i < $sizeCivil; $i++) {
                        $modCivil = new EmpCivilservice;
                        $modCivil->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modCivil->CareerService = $civilServices[$i]['CareerService'];
                        $modCivil->Rating = $civilServices[$i]['Rating'];
                        $modCivil->DateExam = $civilServices[$i]['DateExam'];
                        $modCivil->ExamPlace = $civilServices[$i]['ExamPlace'];
                        $modCivil->LicenseNumber = $civilServices[$i]['LicenseNumber'];
                        $modCivil->ReleaseDate = $civilServices[$i]['ReleaseDate'];
                        $modCivil->save(false);
                    }
                }
                //work
                if ($isValidWork) {
                    for ($i = 0; $i < $sizeWork; $i++) {
                        $modWork = new EmpWorkexp;
                        $modWork->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modWork->FromDate = $workExps[$i]['FromDate'];
                        $modWork->ToDate = $workExps[$i]['ToDate'];
                        $modWork->PositionTitle = $workExps[$i]['PositionTitle'];
                        $modWork->Company = $workExps[$i]['Company'];
                        $modWork->MonthlySalary = $workExps[$i]['MonthlySalary'];
                        $modWork->SalaryGrade = $workExps[$i]['SalaryGrade'];
                        $modWork->StatAppointment = $workExps[$i]['StatAppointment'];
                        $modWork->GovtService = $workExps[$i]['GovtService'];
                        $modWork->save(false);
                    }
                }

                if ($isValidOrg) {
                    for ($i = 0; $i < $sizeOrg; $i++) {
                        $modOrg = new EmpOrganization;
                        $modOrg->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modOrg->NameAddressOrg = $civicorgs[$i]['NameAddressOrg'];
                        $modOrg->FromDate = $civicorgs[$i]['FromDate'];
                        $modOrg->ToDate = $civicorgs[$i]['ToDate'];
                        $modOrg->NoOfHrs = $civicorgs[$i]['NoOfHrs'];
                        $modOrg->PositionNatureOfWork = $civicorgs[$i]['PositionNatureOfWork'];
                        $modOrg->save(false);
                    }
                }

                if ($isValidTraining) {
                    for ($i = 0; $i < $sizeTraining; $i++) {
                        $modTrain = new EmpTraining;
                        $modTrain->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modTrain->SeminarTitle = $trainings[$i]['SeminarTitle'];
                        $modTrain->FromDate = $trainings[$i]['FromDate'];
                        $modTrain->ToDate = $trainings[$i]['ToDate'];
                        $modTrain->NoOfHrs = $trainings[$i]['NoOfHrs'];
                        $modTrain->ConductedBy = $trainings[$i]['ConductedBy'];
                        $modTrain->save(false);
                    }
                }

                if ($isValidRef) {
                    for ($i = 0; $i < $sizeRef; $i++) {
                        $modRef = new EmpRef;
                        $modRef->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modRef->RefName = $refs[$i]['RefName'];
                        $modRef->RefAdd = $refs[$i]['RefAdd'];
                        $modRef->Telno = $refs[$i]['Telno'];
                        $modRef->save(false);
                    }
                }

                //save other info
                if (isset($_POST['EmpOtherinfo'])) {
                    $modOther = new EmpOtherinfo;
                    $modOther->attributes = $_POST['EmpOtherinfo'];
                    $modOther->EmpID = $_POST['EmpInformation']['EmpID'];
                    $modOther->save(false);
                }

                //save queries
                if (isset($_POST['EmpQueries'])) {
                    $modQueries = new EmpQueries;
                    $modQueries->attributes = $_POST['EmpQueries'];
                    $modQueries->EmpID = $_POST['EmpInformation']['EmpID'];
                    $modQueries->save(false);
                }
                $id = $model->EmpID;
                $this->redirect(array('view', 'id' => $model->EmpID));
            }
        } else {
            $model->populateFromEmployee(Yii::app()->user->emp_id);
        }


        $this->EditMode = false;

        $this->render('create', array(
            'model' => $model,
            'modelFam' => $modelFam,
            'modChild' => $modChild,
            'modEduc' => $modEduc,
            'modCivil' => $modCivil,
            'modWork' => $modWork,
            'modOrg' => $modOrg,
            'modTrain' => $modTrain,
            'modOther' => $modOther,
            'modQueries' => $modQueries,
            'modRef' => $modRef,
            'children_details' => $children,
            'children_error' => $this->error,
            'cvlservice_details' => $civilServices,
            'cvlservice_error' => $this->errCivil,
            'workexp_details' => $workExps,
            'workexp_error' => $this->errWork,
            'cvcorg_details' => $civicorgs,
            'cvcorg_error' => $this->errOrg,
            'training_details' => $trainings,
            'training_error' => $this->errTraining,
            'ref_details' => $refs,
            'ref_error' => $this->errRef,
            'query_error' => $this->query_error,
            'educ_details' => $education
        ));
    }

    public function actionUpdate($id) {
        $emp_id = '';
        //HR can edit all
        if(in_array(Yii::app()->user->getState('access_lvl_id'), array(HrisAccessLvl::$HR,HrisAccessLvl::$EMPLOYER)))
        {
            $emp_id = $id;
        }
        else // limit only to current user
        {
            $emp_id = Yii::app()->user->getState('emp_id');
        }
        
        $model = $this->loadModel($emp_id);
        $modelFam = EmpFambg::model()->findByPk($emp_id);
        $modChild = $model->empChildrens;
        $children = $this->getMychildren();
        $modEduc = $model->empEducbgs();
        $education = $this->getMyeducation();
        $modCivil = $model->empCivilservices;
        $civilServices = $this->getMycivilservice();
        $modWork = $model->empWorkexps;
        $workExps = $this->getMyworkexps();
        $modOrg = $model->empOrganizations;
        $civicorgs = $this->getMyCivicorgs();
        $modTrain = $model->empTrainings;
        $trainings = $this->getMyTrainings();
        $modOther = EmpOtherinfo::model()->findByPk($emp_id);
        $modQueries = EmpQueries::model()->findByPk($emp_id);
        $modRef = $model->empRefs;
        $refs = $this->getMyReferences();

        if (isset($_POST['EmpInformation'])) {
            $model->attributes = $_POST['EmpInformation'];
            $modelFam = new EmpFambg;
            $modelFam->attributes = $_POST['EmpFambg'];
            $modelFam->EmpID = $_POST['EmpInformation']['EmpID'];
            $modelFam->Children = 0;
            $modChild = new EmpChildren;

            $mysize = (count($_POST['EmpChildren']));
            $sizeCivil = (count($_POST['EmpCivilservice']));
            $sizeWork = (count($_POST['EmpWorkexp']));
            $sizeOrg = (count($_POST['EmpOrganization']));
            $sizeTraining = (count($_POST['EmpTraining']));
            $sizeRef = (count($_POST['EmpRef']));

            $isValidCivilservice = "";
            $isValidTraining = "";
            $isValidWork = "";
            $isValidOrg = "";
            $isValidChildren = "";
            $isValidOtherinfo = "";

            $allValid = $model->validate();
            $allValid = $modelFam->validate() && $allValid;
            $isValidRef = $this->isValidRef($refs);
            $allValid = $isValidRef && $allValid;


            if (isset($_POST['chkMychild'])) { //validate child if the chkbox is checked
                $isValidChildren = $this->isValidChildren($children);
                $allValid = $isValidChildren && $allValid;
            }

            if (isset($_POST['chkCvl'])) {
                $isValidCivilservice = $this->isValidCivilservice($civilServices);
                $allValid = $isValidCivilservice && $allValid;
                //echo '<br><br>Civil: '.$allValid;
            }

            if (isset($_POST['chkWork'])) {
                $isValidWork = $this->isValidWork($workExps);
                $allValid = $isValidWork && $allValid;
            }

            if (isset($_POST['chkOrg'])) {
                $isValidOrg = $this->isValidOrg($civicorgs);
                $allValid = $isValidOrg && $allValid;
            }

            if (isset($_POST['chkTraining'])) {
                $isValidTraining = $this->isValidTraining($trainings);
                $allValid = $isValidTraining && $allValid;
            }

            if (isset($_POST['chkTraining'])) {
                $isValidTraining = $this->isValidTraining($trainings);
                $allValid = $isValidTraining && $allValid;
            }

            $modQueries->attributes = $_POST['EmpQueries'];
            $modQueries->EmpID = $_POST['EmpInformation']['EmpID'];
            $isValidQueries = $modQueries->validate();
            if (!$modQueries->validate()) {
                $query_error = 0; /* error */
            } else {
                $query_error = 1; /* no error */
            }
            $allValid = $isValidQueries && $allValid;

            $modOther->attributes = $_POST['EmpOtherinfo'];
            $isValidOtherinfo = $modOther->validate();
            $allValid = $isValidOtherinfo && $allValid;

            if ($allValid) {
                $model->LastModifiedBy = Yii::app()->user->emp_id;
                $model->ResidentialAddress = $_POST['EmpInformation']['ResidentialAddress'];
                $model->HomeAddress = $_POST['EmpInformation']['HomeAddress'];
                $model->DateModified = date('Y-m-d h:i:s');
                $strLName = $_POST['EmpInformation']['LastName'];
                $strFName = $_POST['EmpInformation']['FirstName'];
                $strEmpName = $strLName . ", " . $strFName;
                $model->EmpName = $strEmpName;
                $model->save();


                //delete existing fam records of user
                $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                EmpFambg::model()->deleteAll($criteria);
                //save new records 
                $modelFam->save(false);

                if ($isValidChildren) { //validations passed for children tbl; will not save if chkMychild is not checked
                    //delete existing fam records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpChildren::model()->deleteAll($criteria);

                    for ($i = 0; $i < $mysize; $i++) {
                        $modChild = new EmpChildren;
                        $modChild->ChildName = $children[$i]['ChildName'];
                        $modChild->BirthDate = $children[$i]['BirthDate'];
                        $modChild->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modChild->save(false);
                    }
                }

                //save educbg
                if (isset($_POST['EmpEducbg'])) {
                    $myeducs = $_POST['EmpEducbg'];
                    //delete existing educ records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpEducbg::model()->deleteAll($criteria);
                    for ($i = 0; $i < 5; $i++) {
                        $idEduclvl = $i + 1;
                        $modEduc = new EmpEducbg;
                        $modEduc->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modEduc->EducLevel = $idEduclvl;
                        $modEduc->NameofSchool = $myeducs[$i]['NameofSchool'];
                        $modEduc->DegreeCourse = $myeducs[$i]['DegreeCourse'];
                        $modEduc->YearGrad = $myeducs[$i]['YearGrad'];
                        $modEduc->HighestEarned = $myeducs[$i]['HighestEarned'];
                        $modEduc->FromDate = $myeducs[$i]['FromDate'];
                        $modEduc->ToDate = $myeducs[$i]['ToDate'];
                        $modEduc->ScholarshipReceived = $myeducs[$i]['ScholarshipReceived'];

                        $modEduc->save(false);
                    }
                }

                //civil service
                if ($isValidCivilservice) {
                    //delete existing civil records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpCivilservice::model()->deleteAll($criteria);
                    //save new records 
                    for ($i = 0; $i < $sizeCivil; $i++) {
                        $modCivil = new EmpCivilservice;
                        $modCivil->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modCivil->CareerService = $civilServices[$i]['CareerService'];
                        $modCivil->Rating = $civilServices[$i]['Rating'];
                        $modCivil->DateExam = $civilServices[$i]['DateExam'];
                        $modCivil->ExamPlace = $civilServices[$i]['ExamPlace'];
                        $modCivil->LicenseNumber = $civilServices[$i]['LicenseNumber'];
                        $modCivil->ReleaseDate = $civilServices[$i]['ReleaseDate'];
                        $modCivil->save(false);
                    }
                }

                //work
                if ($isValidWork) {
                    //delete existing work records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpWorkexp::model()->deleteAll($criteria);
                    //save new records 
                    for ($i = 0; $i < $sizeWork; $i++) {
                        $modWork = new EmpWorkexp;
                        $modWork->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modWork->FromDate = $workExps[$i]['FromDate'];
                        $modWork->ToDate = $workExps[$i]['ToDate'];
                        $modWork->PositionTitle = $workExps[$i]['PositionTitle'];
                        $modWork->Company = $workExps[$i]['Company'];
                        $modWork->MonthlySalary = $workExps[$i]['MonthlySalary'];
                        $modWork->SalaryGrade = $workExps[$i]['SalaryGrade'];
                        $modWork->StatAppointment = $workExps[$i]['StatAppointment'];
                        $modWork->GovtService = $workExps[$i]['GovtService'];
                        $modWork->save(false);
                    }
                }

                //civic org
                if ($isValidOrg) {
                    //delete existing work records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpOrganization::model()->deleteAll($criteria);
                    //save new records 
                    for ($i = 0; $i < $sizeOrg; $i++) {
                        $modOrg = new EmpOrganization;
                        $modOrg->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modOrg->NameAddressOrg = $civicorgs[$i]['NameAddressOrg'];
                        $modOrg->FromDate = $civicorgs[$i]['FromDate'];
                        $modOrg->ToDate = $civicorgs[$i]['ToDate'];
                        $modOrg->NoOfHrs = $civicorgs[$i]['NoOfHrs'];
                        $modOrg->PositionNatureOfWork = $civicorgs[$i]['PositionNatureOfWork'];
                        $modOrg->save(false);
                    }
                }

                //training
                if ($isValidTraining) {
                    //delete existing work records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpTraining::model()->deleteAll($criteria);
                    //save new records 
                    for ($i = 0; $i < $sizeTraining; $i++) {
                        $modTrain = new EmpTraining;
                        $modTrain->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modTrain->SeminarTitle = $trainings[$i]['SeminarTitle'];
                        $modTrain->FromDate = $trainings[$i]['FromDate'];
                        $modTrain->ToDate = $trainings[$i]['ToDate'];
                        $modTrain->NoOfHrs = $trainings[$i]['NoOfHrs'];
                        $modTrain->ConductedBy = $trainings[$i]['ConductedBy'];
                        $modTrain->save(false);
                    }
                }

                //other info
                if (isset($_POST['EmpOtherinfo'])) {
                    //delete existing work records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpOtherinfo::model()->deleteAll($criteria);
                    //save new records 
                    $modOther = new EmpOtherinfo;
                    $modOther->attributes = $_POST['EmpOtherinfo'];
                    $modOther->EmpID = $_POST['EmpInformation']['EmpID'];
                    $modOther->save(false);
                }

                //queries
                if (isset($_POST['EmpQueries'])) {
                    //delete existing work records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpQueries::model()->deleteAll($criteria);
                    //save new records 
                    $modQueries = new EmpQueries;
                    $modQueries->attributes = $_POST['EmpQueries'];
                    $modQueries->EmpID = $_POST['EmpInformation']['EmpID'];
                    $modQueries->save(false);
                }

                //ref
                if ($isValidRef) {
                    //delete existing work records of user
                    $criteria = new CDbCriteria(array('condition' => 'EmpID=' . $emp_id));
                    EmpRef::model()->deleteAll($criteria);
                    //save new records 
                    for ($i = 0; $i < $sizeRef; $i++) {
                        $modRef = new EmpRef;
                        $modRef->EmpID = $_POST['EmpInformation']['EmpID'];
                        $modRef->RefName = $refs[$i]['RefName'];
                        $modRef->RefAdd = $refs[$i]['RefAdd'];
                        $modRef->Telno = $refs[$i]['Telno'];
                        $modRef->save(false);
                    }
                }
                $this->redirect(array('view', 'id' => $model->EmpID));
            }

        } else {
            $model->populateFromEmployee($emp_id);
        }

        $this->EditMode = true;

        $this->render('update', array(
            'model' => $model,
            'modelFam' => $modelFam,
            'modChild' => $modChild,
            'children_details' => $children,
            'children_error' => $this->error,
            'modEduc' => $modEduc,
            'educ_details' => $education,
            'modCivil' => $modCivil,
            'cvlservice_details' => $civilServices,
            'cvlservice_error' => $this->errCivil,
            'modWork' => $modWork,
            'workexp_details' => $workExps,
            'workexp_error' => $this->errWork,
            'modOrg' => $modOrg,
            'cvcorg_details' => $civicorgs,
            'cvcorg_error' => $this->errOrg,
            'modTrain' => $modTrain,
            'training_details' => $trainings,
            'training_error' => $this->errTraining,
            'modOther' => $modOther,
            'modQueries' => $modQueries,
            'modRef' => $modRef,
            'ref_details' => $refs
        ));
    }

    public function actionView($id) {
        $curruser = HrisUsers::model()->findByPk(Yii::app()->user->emp_id);
        $model = $this->loadModel($id);
        //employees can only view their own PDS
        if (!in_array($curruser->access_lvl_id, array(HrisAccessLvl::$HR, HrisAccessLvl::$EMPLOYER)) and $id != Yii::app()->user->getState('emp_id')) {
            throw new CHttpException(401, "Access denied. Only the HR, Employer and Administrator can view this PDS.");
        } else {
            $model->populateFromEmployee($id);
            $this->render('view', array(
                'model' => $model,
            ));
        }
    }
    
    
    public function actionSyncwithemployee()
    {
        echo '<pre>';
        $emps = EmpInformation::model()->findAll();
        foreach($emps as $emp)
        {
            $emp->save(false);
        }
        echo '</pre>';
    }

}