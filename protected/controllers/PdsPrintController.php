<?php

class PdsPrintController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('printpds', 'printallappraisal', 'printsalaryoptions'),
                'roles' => array('admin', 'hr', 'employer'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        
    }

    public function actionPrintpds($id) {

        // on the beginning of your script save original memory limit
        $original_mem = ini_get('memory_limit');
        $original_max_exec = ini_get('max_execution_time');
        // then set it to the value you think you need (experiment)
        ini_set('memory_limit', '640M');
        ini_set('max_execution_time', 120); // 120 seconds (2 minutes)

        $pdfname = date('YmdHis');

        require_once(Yii::getPathOfAlias('ext.tcpdf') . '/tcpdf.php');
        Yii::import('ext.tcpdf.tcpdf');
        $outputPdf = new TCPDF();
        //
        $creator = !empty($_POST['rptCreator']) ? $_POST['rptCreator'] : "Eva Care Management Consultancy Inc";
        $author = !empty($_POST['rptAuthor']) ? $_POST['rptAuthor'] : "ECMCI";
        $title = "PDS";
        $subj = !empty($_POST['rptSubj']) ? $_POST['rptSubj'] : "ECMCI";
        $outputPdf->setCreator($creator);
        $outputPdf->setAuthor($author);
        $outputPdf->setTitle($title);
        $outputPdf->setSubject($subj);
        $outputPdf->setKeywords('');
        /* $outputPdf->setHeaderData('', 0, $title, '');
          $outputPdf->setHeaderFont(array('helvetica', '', 9)); */
        $outputPdf->setFooterFont(array('helvetica', '', 6));
        $outputPdf->setMargins(5, 10, 5);
        $outputPdf->setHeaderMargin(5);
        $outputPdf->setFooterMargin(5);
        $outputPdf->setAutoPageBreak(true, 0);
        $outputPdf->setFont('helvetica', '', 9);
        //Add a custom size  
        $width = 175;
        $height = 266;
        $orientation = ($height > $width) ? 'P' : 'L';
        //$outputPdf->addFormat("custom", $width, $height);  
        //$outputPdf->reFormat("custom", $orientation);  
        //$outputPdf->setPageOrientation('P');

        $styling = '<style type="text/css">
				table { page-break-inside:auto }
				tr    { page-break-inside:avoid; page-break-after:auto }
				tr.nobreak{
					page-break-inside:avoid; page-break-after:auto; display:table-header-group;
				}
				td { vertical-align:middle;
					font-weight:normal;
					color:#000000;
					}
				td.lbl {
					background-color:#eae9e9;
				}
				td.noborder {
					vertical-align:middle;
					font-weight:normal;
					color:#000000;
					background-color:#eae9e9;
					border-top-color:transparent;
				}
				td.hdr{
					background:-o-linear-gradient(bottom, #5fbf00 5%, #3f7f00 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5fbf00), color-stop(1, #3f7f00) );
					background:-moz-linear-gradient( center top, #5fbf00 5%, #3f7f00 100% );
					filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5fbf00", endColorstr="#3f7f00");	background: -o-linear-gradient(top,#5fbf00,3f7f00);

					background-color:#878686;
					font-weight:bold;
					color:#ffffff;
				}
				thead { page-break-inside:avoid; page-break-after:auto; display:table-header-group }
				tfoot { display:table-footer-group }
				</style>';


        $PDS = EmpInformation::model()->findByPk($id);
        //$PDS->populateFromEmployee($id);
        $FamBg = EmpFambg::model()->findByPk($id);
        $childCriteria = new CDbCriteria;
        $childCriteria->addCondition('EmpID =' . $id);
        $myChildren = EmpChildren::model()->findAll($childCriteria);
        $educCriteria = new CDbCriteria;
        $educCriteria->addCondition('EmpID =' . $id . '', 'AND');
        $educCriteria->addCondition('NameofSchool !=""');
        $EducBg = EmpEducbg::model()->findAll($educCriteria);
        $civilCriteria = new CDbCriteria;
        $civilCriteria->addCondition('EmpID =' . $id . '', 'AND');
        $civilCriteria->addCondition('CareerService !=""');
        $CivilService = EmpCivilservice::model()->findAll($civilCriteria);
        $workCriteria = new CDbCriteria;
        $workCriteria->addCondition('EmpID =' . $id . '', 'AND');
        $workCriteria->addCondition('PositionTitle !=""');
        $WorkExps = EmpWorkexp::model()->findAll($workCriteria);
        $volCriteria = new CDbCriteria;
        $volCriteria->addCondition('EmpID =' . $id . '', 'AND');
        $volCriteria->addCondition('NameAddressOrg !=""');
        $VolWorks = EmpOrganization::model()->findAll($volCriteria);
        $trainingCriteria = new CDbCriteria;
        $trainingCriteria->addCondition('EmpID =' . $id . '', 'AND');
        $trainingCriteria->addCondition('SeminarTitle !=""');
        $trainings = EmpTraining::model()->findAll($trainingCriteria);
        //$otherInfoCriteria=new CDbCriteria;$otherInfoCriteria->addCondition('EmpID='.$id.'')
        $otherInfos = EmpOtherinfo::model()->findByPk($id);
        $queries = EmpQueries::model()->findByPk($id);
        $refCriteria = new CDbCriteria;
        $refCriteria->addCondition('EmpID =' . $id . '', 'AND');
        $ref = EmpRef::model()->findAll($refCriteria);
        /* */
        $htmlOutput = '<table border="0">
			<tr>
				<td style="width:30%"><img src="' . Yii::app()->baseUrl . '/images/logo-ecmci.png" style="width:150px; height:55px;"/><br></td>
				<td style="width:70%"><img src="' . Yii::app()->baseUrl . '/images/pdshdr.png" style="width:300px; height:55px;"/><br></td> 
			</tr></table>';

        $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
        $htmlOutput.='<td colspan="5" class="hdr"><h3>PERSONAL INFORMATION</h3></td></tr>';
        $htmlOutput.='<tr><td class="lbl">Badge No.</td><td colspan="4">' . $PDS['EmpID'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Surname</td><td colspan="4">' . $PDS['LastName'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Firstname</td><td colspan="4">' . $PDS['FirstName'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Middlename</td><td colspan="2">' . $PDS['MiddleName'] . '</td><td class="lbl">Name Ext.</td><td>' . $PDS['NameExt'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Date of Birth (mm/dd/yyyy)</td><td>' . date('m/d/Y', strtotime($PDS['BirthDate'])) . '</td>
			<td class="lbl" rowspan="2">Residential Address</td><td rowspan="2" colspan="2">' . $PDS['ResidentialAddress'] . '</td>
		</tr>';
        $htmlOutput.='<tr><td class="lbl">Place of Birth</td><td>' . $PDS['BdayPlace'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Gender</td><td>' . $PDS['gender']['gender'] . '</td><td class="lbl">Zip Code</td><td colspan="2">' . $PDS['RAZipCode'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Civil Status</td><td>' . $PDS['civilStat']['CivilStat'] . '</td><td class="lbl">Telephone No.</td><td colspan="2">' . $PDS['RATelno'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Citizenship</td><td>' . $PDS['Citizenship'] . '</td>
			<td class="lbl" rowspan="2">Permanent Address</td><td rowspan="2" colspan="2">' . $PDS['HomeAddress'] . '</td>
		</tr>';
        $htmlOutput.='<tr><td class="lbl">Height (m)</td><td>' . $PDS['Height'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Weight (kg)</td><td>' . $PDS['Weight'] . '</td><td class="lbl">Zip Code</td><td colspan="2">' . $PDS['HAZipCode'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Blood Type</td><td>' . $PDS['BloodType'] . '</td><td class="lbl">Telephone No.</td><td colspan="2">' . $PDS['HATelno'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">HDMF No.</td><td>' . $PDS['HDMF'] . '</td><td class="lbl">Email Address</td><td colspan="2">' . $PDS['EmailAddress'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">PHIC No.</td><td>' . $PDS['PHIC'] . '</td><td class="lbl">Cellphone No.</td><td colspan="2">' . $PDS['ContactNo'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">SSS No.</td><td>' . $PDS['SSS'] . '</td><td class="lbl">TIN</td><td colspan="2">' . $PDS['TIN'] . '</td> </tr>';
        $htmlOutput.='<tr><td class="lbl">Agency Employee No.</td><td colspan="4">' . $PDS['AgencyEmpNo'] . '</td></tr></table><br>';
        /* FAMILY BACKGROUND */
        $htmlOutput.=$styling . '<table border="1" cellpadding="7"><tr style="font-weight:bold;">';
        $htmlOutput.='<td colspan="5" class="hdr"><h3>FAMILY BACKGROUND</h3></td></tr>';
        $htmlOutput.='<tr><td class="lbl">Spouse\'s Surname</td><td colspan="4">' . $FamBg['SpouseLname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">First Name</td><td colspan="4">' . $FamBg['SpouseFname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Middle Name</td><td colspan="4">' . $FamBg['SpouseMname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Occupation</td><td colspan="4">' . $FamBg['SpouseOccupation'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Employer/Bus. Name</td><td colspan="4">' . $FamBg['SpouseEmployer'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Business Address</td><td colspan="4">' . $FamBg['SpouseBusinessAddress'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Telephone No.</td><td colspan="4">' . $FamBg['SpouseTelno'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Father\'s Surname</td><td colspan="4">' . $FamBg['FatherLname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">First Name</td><td colspan="4">' . $FamBg['FatherFname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Middle Name</td><td colspan="4">' . $FamBg['FatherMname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Mother\'s Maiden Name</td><td colspan="4">' . $FamBg['MotherMaiden'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Surname</td><td colspan="4">' . $FamBg['MotherLname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">First Name</td><td colspan="4">' . $FamBg['MotherFname'] . '</td></tr>';
        $htmlOutput.='<tr><td class="lbl">Middle Name</td><td colspan="4">' . $FamBg['MotherMname'] . '</td></tr></table><br>';
        /* CHILDREN */
        if (!empty($myChildren)) {
            $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
            $htmlOutput.='<td colspan="2" class="hdr"><h3>CHILDREN</h3></td></tr>';
            $htmlOutput.='<tr><td class="lbl">Name of Child</td>';
            $htmlOutput.='<td class="lbl">BirthDate</td></tr>';

            foreach ($myChildren as $child) {
                $htmlOutput.='<tr><td>' . $child['ChildName'] . '</td>';
                $htmlOutput.='<td>' . date('m/d/Y', strtotime($child['BirthDate'])) . '</td></tr>';
            }
            $htmlOutput.='</table><br>';
        }


        /* EDUC BG */
        if (!empty($EducBg)) {
            $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
            $htmlOutput.='<td colspan="8" class="hdr"><h3>EDUCATIONAL BACKGROUND</h3></td></tr>';
            $htmlOutput.='<tr><td class="lbl">Level</td>
			<td class="lbl" width="20%">Name of School</td>
			<td class="lbl">Degree Course</td>
			<td class="lbl" width="10%">Year Graduated (if graduated)</td>
			<td class="lbl">Highest Grade / Level / Units Earned (if not graduated)</td>
			<td class="lbl" width="10%">From</td>
			<td class="lbl" width="10%">To</td>
			<td class="lbl">Scholarship / Academic Honors Received</td>
			</tr>';
            foreach ($EducBg as $Bgeduc) {
                $htmlOutput.='<tr><td>' . $Bgeduc['educLevel']['EducLevel'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['NameofSchool'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['DegreeCourse'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['YearGrad'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['HighestEarned'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['FromDate'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['ToDate'] . '</td>';
                $htmlOutput.='<td>' . $Bgeduc['ScholarshipReceived'] . '</td></tr>';
            }
            $htmlOutput.='</table><br>';
        }
        /* CIVIL SERVICE */
        if (!empty($CivilService)) {
            $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
            $htmlOutput.='<td colspan="6" class="hdr"><h3>CIVIL SERVICE ELIGIBILITY</h3></td></tr>';
            $htmlOutput.='<tr><td class="lbl" width="25%">Career Service / RA 1080 (Board/Bar) under Special Laws / CES / CSEE</td>
			<td class="lbl" width="15%">Rating</td>
			<td class="lbl" width="15%">Date of Examination / Conferment</td>
			<td class="lbl" width="15%">Place of Examination / Conferment</td>
			<td class="lbl" width="15%">License Number</td>
			<td class="lbl" width="15%">Date of Release</td></tr>';
            foreach ($CivilService as $cvl) {
                $htmlOutput.='<tr><td>' . $cvl['CareerService'] . '</td>';
                $htmlOutput.='<td>' . $cvl['Rating'] . '</td>';
                $htmlOutput.='<td>' . date('m/d/Y', strtotime($cvl['DateExam'])) . '</td>';
                $htmlOutput.='<td>' . $cvl['ExamPlace'] . '</td>';
                $htmlOutput.='<td>' . $cvl['LicenseNumber'] . '</td>';
                $htmlOutput.='<td>' . date('m/d/Y', strtotime($cvl['ReleaseDate'])) . '</td></tr>';
            }
            $htmlOutput.='</table><br>';
        }
        /* WORK EXP */
        if (!empty($WorkExps)) {
            $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
            $htmlOutput.='<td colspan="8" class="hdr"><h3>WORK EXPERIENCE</h3></td></tr>';
            $htmlOutput.='<tr><td class="lbl">From</td>
			<td class="lbl">To</td>
			<td class="lbl">Position Title</td>
			<td class="lbl">Department / Agency / Office / Company</td>
			<td class="lbl">Monthly Salary</td>
			<td class="lbl">Salary Grade & Step Increment (Format "00-0")</td>
			<td class="lbl">Status of Appointment</td>
			<td class="lbl">Gov\'t Service</td>
			</tr>';
            foreach ($WorkExps as $workexp) {
                $altDate = ($workexp['ToDate'] == '0000-00-00' ? 'PRESENT' : date('m/d/Y', strtotime($workexp['ToDate'])));
                $htmlOutput.='<tr><td>' . date('m/d/Y', strtotime($workexp['FromDate'])) . '</td>';
                $htmlOutput.='<td>' . $altDate . '</td>';
                $htmlOutput.='<td>' . $workexp['PositionTitle'] . '</td>';
                $htmlOutput.='<td>' . $workexp['Company'] . '</td>';
                $htmlOutput.='<td>' . $workexp['MonthlySalary'] . '</td>';
                $htmlOutput.='<td>' . $workexp['SalaryGrade'] . '</td>';
                $htmlOutput.='<td>' . $workexp['StatAppointment'] . '</td>';
                $htmlOutput.='<td>' . $workexp['GovtService'] . '</td></tr>';
            }
            $htmlOutput.='</table><br>';
        }
        /* VOLUNTARY */
        if (!empty($VolWorks)) {
            //

            $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
            $htmlOutput.='<td colspan="5" class="hdr" ><h3>VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</h3></td></tr>';
            $htmlOutput.='<tr><td class="lbl" width="35%">Name & Address of Organization</td>
			<td class="lbl" width="11%">From</td>
			<td class="lbl" width="11%">To</td>
			<td class="lbl" width="15%">Number of Hours</td>
			<td class="lbl" width="28%">Position / Nature of Work</td>
			</tr>';
            foreach ($VolWorks as $volWork) {
                $altDate = ($volWork['ToDate'] == '0000-00-00' ? "PRESENT" : date('m/d/Y', strtotime($volWork['ToDate'])));
                $htmlOutput.='<tr><td>' . $volWork['NameAddressOrg'] . '</td>';
                $htmlOutput.='<td>' . date('m/d/Y', strtotime($volWork['FromDate'])) . '</td>';
                $htmlOutput.='<td>' . $altDate . '</td>';
                $htmlOutput.='<td>' . $volWork['NoOfHrs'] . '</td>';
                $htmlOutput.='<td>' . $volWork['PositionNatureOfWork'] . '</td></tr>';
            }
            $htmlOutput.='</table><br>';
        }
        /* other info */
        if (!empty($otherInfos)) {
            if (!empty($otherInfos['SkillsHobbies']) || (!empty($otherInfos['NonAcadRecognition'])) || (!empty($otherInfos['MembershipAssocOrg']))) {
                $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
                $htmlOutput.='<td colspan="3" class="hdr"><h3>OTHER INFORMATION</h3></td></tr>';
                $htmlOutput.='<tr><td class="lbl">Special Skills / Hobbies</td>
				<td class="lbl">Non-Academic Distinctions / Recognition</td>
				<td class="lbl">Membership in Association / Organization</td></tr>';
                $htmlOutput.='<tr><td>' . $otherInfos['SkillsHobbies'] . '</td>
				<td>' . $otherInfos['NonAcadRecognition'] . '</td>
				<td>' . $otherInfos['MembershipAssocOrg'] . '</td></tr>';
                $htmlOutput.='</table><br>';
            }
        }
        /* queries */
        $imgunchk = Yii::app()->baseUrl . '/images/unchk2.png';
        $imgchk = Yii::app()->baseUrl . '/images/chk2.png';
        $htmlOutput.=$styling . '<br><table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group;">';
        $htmlOutput.='<tr><td class="lbl" width="70%"><b>Are you related by consanguinity or affinity to any of the following :</b><br><br>
					<b>a.</b> 	Within the third degree:<br> 
						appointing authority, recommending authority, chief of office/bureau/department or person who has immediate supervision over you in the Office, Bureau, Department where you will be appointed, with ECMCI and any affiliated with Eva Care Group?
						
						<br><br><br>
						<b>b.</b> Within the fourth degree:<br>
						appointing authority or recommending authority where you will be appointed?</td>
						
						<td width="30%"><br><br><br><img src="' . (($queries['ThirdDegreeRelated'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['ThirdDegreeRelated'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['TDRdetails'] . '
						
						<br><br>
						<img src="' . (($queries['FourthDegreeRelated'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['FourthDegreeRelated'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['FDRdetails'] . '
						</td></tr>';
        $htmlOutput.='<tr><td class="lbl">
					<b>a.</b> Have you ever been formally charged?
					<br><br><br><br><br>
					
					<b>b. </b>Have you ever been guilty of any administrative offense?</td>
		
					 
					 <td><img src="' . (($queries['FormallyCharged'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['FormallyCharged'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['ChargedDetails'] . '
						<br><br>
						
						<img src="' . (($queries['AdminOffense'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['AdminOffense'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['OffenseDetails'] . '</td>
					 </tr>';
        $htmlOutput.='<tr>
					<td class="lbl">Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</td>
		
					
					<td><img src="' . (($queries['CrimeConvicted'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['CrimeConvicted'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['CrimeDetails'] . '
						
					</td>
					</tr>';
        $htmlOutput.='<tr>
					<td class="lbl">Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or phased out, in the public or private sector?</td>
					
					<td><img src="' . (($queries['SeparatedService'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['SeparatedService'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['SSdetails'] . '
						
					</td>
					</tr>';
        $htmlOutput.='<tr>
					<td class="lbl">Have you ever been a candidate in a national or local election (except Barangay election)?</td>
					
					<td><img src="' . (($queries['ElectionCandidate'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['ElectionCandidate'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['ECdetails'] . '
						
					</td>
					</tr>';
        $htmlOutput.='<tr>
					<td class="lbl"><b>Pursuant to: (a) Indigenous People\'s Act (RA 8371); (b) Magna Carta for Disabled Persons (RA
7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:<br><br>

					
					a. </b>Are you a member of any indigenous group?<br><br><br><br>
					<b>b. </b>Are you differently abled?<br><br><br><br><br>
					<b>c. </b>Are you a solo parent?
					
					</td>
					<td><br><br><br>
					<img src="' . (($queries['Indigenous'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['Indigenous'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['IndiDetails'] . '<br><br><br>
					
					
						<img src="' . (($queries['DiffAbled'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['DiffAbled'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['DAdetails'] . '<br><br><br>
						
						<img src="' . (($queries['SoloParent'] == 1) ? Yii::app()->baseUrl . '/images/chk2.png' : Yii::app()->baseUrl . '/images/unchk2.png') . '" style="width:10px; height:10px;" /> Yes &nbsp;&nbsp;&nbsp;
						<img src="' . (($queries['SoloParent'] == 1) ? Yii::app()->baseUrl . '/images/unchk2.png' : Yii::app()->baseUrl . '/images/chk2.png') . '" style="width:10px; height:10px;" /> No<br>
						
						If YES, give details: <br>
						' . $queries['SPdetails'] . '
					</td>
					</tr>';
        $htmlOutput.='</table><br>';

        if (!empty($ref)) {
            $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group"><tr style="font-weight:bold;">';
            $htmlOutput.='<td colspan="3" class="hdr"><h3>REFERENCES</h3></td></tr>';
            $htmlOutput.='<tr><td class="lbl">Name</td>
				<td class="lbl">Address</td>
				<td class="lbl">Tel. No.</td></tr>';
            foreach ($ref as $refdata) {
                $htmlOutput.='<tr><td>' . $refdata['RefName'] . '</td>';
                $htmlOutput.='<td>' . $refdata['RefAdd'] . '</td>';
                $htmlOutput.='<td>' . $refdata['Telno'] . '</td></tr>';
            }

            $htmlOutput.='</table><br>';
        }

        $htmlOutput.=$styling . '<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group">';
        $htmlOutput.='<tr><td align="center"><br><br>I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines.<br><br>
		I also authorize the agency head / authorized representative to verify / validate the contents stated herein. I trust that this information shall remain confidential.<br>
		</td>
		
		</tr>';
        $htmlOutput.='</table><br>';
        $htmlOutput.='<table border="1" cellpadding="7" style="page-break-inside:avoid; page-break-after:auto; display:table-header-group">
		<tr>
			<td width="38%" align="center">' . $PDS['TaxCertNo'] . '</td>
			<td width="2%" rowspan="6" ></td>
			<td width="60%" rowspan="3"></td>
		</tr>
		<tr>
			<td class="lbl" align="center"><b>COMMUNITY TAX CERTIFICATE NO.</b></td>
		</tr>
		<tr>
			<td align="center">' . $PDS['IssuedAt'] . '</td>
		</tr>
		<tr>
			<td class="lbl" align="center"><b>ISSUED AT</b></td>
			<td class="lbl" align="center"><b>SIGNATURE</b> <font color="red">(Sign inside the box)</font></td>
		</tr>
		<tr>
			<td align="center">' . date('m/d/Y', strtotime($PDS['IssuedOn'])) . '</td>
			<td align="center">' . date('m/d/Y', strtotime($PDS['DateAccomplished'])) . '</td>
			
		</tr>
		<tr>
			<td class="lbl" align="center"><b>ISSUED ON (mm/dd/yyyy)</b></td>
			<td class="lbl" align="center"><b>DATE ACCOMPLISHED</b></td>
		</tr>
		
		
		</table>';

        //(($queries['ThirdDegreeRelated']==1) ? Yii::app()->baseUrl.'/images/chk2.png' : Yii::app()->baseUrl.'/images/unchk2.png')
        $outputPdf->SetPrintHeader(false);
        //$outputPdf->SetPrintFooter(false);
        $outputPdf->AddPage('P', 'LEGAL');
        $outputPdf->writeHTML($htmlOutput, true, false, true, false, '');
        $outputPdf->Output(trim('Report') . '.pdf', 'I');

        // at the end of the script set it to it's original value 
        // (if you forget this PHP will do it for you when performing garbage collection)
        ini_set('memory_limit', $original_mem);
        ini_set('max_execution_time', $original_max_exec);
    }

    public function actionPrintallappraisal() {
        $pdfname = date('YmdHis');
        require_once('/../extensions/tcpdf/tcpdf.php');
        $outputPdf = new TCPDF();
        $creator = !empty($_POST['rptCreator']) ? $_POST['rptCreator'] : "Eva Care Management Consultancy Inc";
        $author = !empty($_POST['rptAuthor']) ? $_POST['rptAuthor'] : "ECMCI";
        $title = !empty($_POST['rptTitle']) ? $_POST['rptTitle'] : "Salary Appraisal";
        $subj = !empty($_POST['rptSubj']) ? $_POST['rptSubj'] : "ECMCI";
        $outputPdf->setCreator($creator);
        $outputPdf->setAuthor($author);
        $outputPdf->setTitle($title);
        $outputPdf->setSubject($subj);
        $outputPdf->setKeywords('');
        $outputPdf->setHeaderData('', 0, $title, '');
        $outputPdf->setHeaderFont(array('helvetica', '', 9));
        $outputPdf->setFooterFont(array('helvetica', '', 6));
        $outputPdf->setMargins(5, 18, 5);
        $outputPdf->setHeaderMargin(5);
        $outputPdf->setFooterMargin(10);
        //$outputPdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $outputPdf->setFont('helvetica', '', 8);
        //Add a custom size  
        $width = 175;
        $height = 266;
        $orientation = ($height > $width) ? 'P' : 'L';
        //$outputPdf->addFormat("custom", $width, $height);  
        //$outputPdf->reFormat("custom", $orientation);  

        $outputPdf->setPageOrientation('P');

        $styling = '<style type="text/css">
				table { page-break-inside:auto }
				tr    { page-break-inside:avoid; page-break-after:auto }
				td { vertical-align:middle;
					font-weight:normal;
					color:#000000;
					}
				td.lbl {
					background-color:#eae9e9;
				}
				td.noborder {
					vertical-align:middle;
					font-weight:normal;
					color:#000000;
					background-color:#eae9e9;
					border-top-color:transparent;
				}
				td.hdr{
					background:-o-linear-gradient(bottom, #5fbf00 5%, #3f7f00 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5fbf00), color-stop(1, #3f7f00) );
					background:-moz-linear-gradient( center top, #5fbf00 5%, #3f7f00 100% );
					filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5fbf00", endColorstr="#3f7f00");	background: -o-linear-gradient(top,#5fbf00,3f7f00);

					background-color:#878686;
					font-weight:bold;
					color:#ffffff;
				}
				thead { page-break-inside:avoid; page-break-after:auto; display:table-header-group }
				tfoot { display:table-footer-group }
				
				</style>';

        $appraisals = EmpAppraisals::model()->findAll(array('order' => 'DateEffective DESC, EmpID ASC'));
        $htmlOutput = '';
        $htmlOutput.=$styling . '<table border="1" cellpadding="7">
			<tr><td class="lbl">Name</td>
			<td class="lbl">Current Salary</td>
			<td class="lbl">New Salary</td>
			<td class="lbl" width="15%">Date Effective</td>
			<td class="lbl" width="25%">Notes</td>
			</tr>';
        foreach ($appraisals as $apps) {
            $htmlOutput.='<tr><td>' . $apps['emp']['EmpName'] . '</td>';
            $htmlOutput.='<td>' . $apps['FromSalary'] . '</td>
			<td>' . $apps['ToSalary'] . '</td>
			<td>' . date('m/d/Y', strtotime($apps['DateEffective'])) . '</td>
			<td>' . $apps['Notes'] . '</td>
			</tr>';
        }
        $htmlOutput.='</table>';

        $outputPdf->AddPage();
        $outputPdf->writeHTML($htmlOutput, true, false, true, false, '');
        $outputPdf->Output(trim('Report') . '.pdf', 'I');
    }

    public function actionPrintsalaryoptions() {
        include '/rpts/_salaryoptions.php';
    }

}

?>