<?php

class ReportViewerController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        if (Yii::app()->user->emp_id == 1002) { //sir jude ONLY
            return array(
                array('allow',
                    'actions' => array('index', 'index2'),
                    'roles' => array('manager', 'admin', 'hr', 'employer'),
                ),
            );
        } else {
            return array(
                array('allow',
                    'actions' => array('index', 'index2'),
                    'roles' => array('admin', 'hr', 'employer'),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }
    }

    public function actionIndex() {
        //require_once('localhost/hris/themes/abound/views/layouts/tpl_header.php');
        //echo "<h3>Generate Reports</h3>";
        include '_form1.php';
        //echo "<br><br><a href='".Yii::app()->baseUrl."/index.php/ReportViewer/index2'>Let's check</a>"; //working
        //include 'header.html';
    }

    public function actionIndex2() {
        $pdfname = date('YmdHis');
        require_once(Yii::getPathOfAlias('ext.tcpdf') . '/tcpdf.php');
        $outputPdf = new TCPDF();
        $creator = !empty($_POST['rptCreator']) ? $_POST['rptCreator'] : "Eva Care Management Consultancy Inc";
        $author = !empty($_POST['rptAuthor']) ? $_POST['rptAuthor'] : "ECMCI";
        $title = !empty($_POST['rptTitle']) ? $_POST['rptTitle'] : "Reports";
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

        $outputPdf->setPageOrientation('L');

        $styling = '<style type="text/css">
				table { page-break-inside:auto }
				tr    { page-break-inside:avoid; page-break-after:auto }
				thead { page-break-inside:avoid; page-break-after:auto; display:table-header-group }
				tfoot { display:table-footer-group }
				</style>';

        $chkbox_count = 0;
        if (isset($_POST['chkEmpID']))
            $chkbox_count++;
        if (isset($_POST['chkFname']))
            $chkbox_count++;
        if (isset($_POST['chkHome']))
            $chkbox_count++;
        if (isset($_POST['chkContact']))
            $chkbox_count++;
        if (isset($_POST['chkBday']))
            $chkbox_count++;
        if (isset($_POST['chkGender']))
            $chkbox_count++;
        if (isset($_POST['chkCivilStat']))
            $chkbox_count++;
        if (isset($_POST['chkHire']))
            $chkbox_count++;
        if (isset($_POST['chkSSS']))
            $chkbox_count++;
        if (isset($_POST['chkTIN']))
            $chkbox_count++;
        if (isset($_POST['chkPHIC']))
            $chkbox_count++;
        if (isset($_POST['chkHDMF']))
            $chkbox_count++;
        if (isset($_POST['chkAcctNo']))
            $chkbox_count++;
        if (isset($_POST['chkDept']))
            $chkbox_count++;
        if (isset($_POST['chkPosition']))
            $chkbox_count++;
        if (isset($_POST['chkEmailadd']))
            $chkbox_count++;
        if (isset($_POST['chkContact']))
            $chkbox_count++;
        if (isset($_POST['chkMB']))
            $chkbox_count++;

        //$chkEmpID = (isset($_POST['chkEmpID']) ? "1" : "0");

        /* $htmlOutput='helloooo';
          $htmlOutput=$htmlOutput.' hiiii';
         */
        //$htmlOutput=$_POST['myForm']['chkEmpID'];
        if ($chkbox_count != 0) { //arrParams and arrCondition accept empty val
            //add conditions based on the following user input
            $criteria = new CDbCriteria;
            if (!empty($_POST['txtEmpId'])) {
                $empid = rtrim($_POST['txtEmpId'], ',');
                $criteria->addCondition('EmpID in (' . $empid . ')', 'AND');
            }
            if (!empty($_POST['bday'])) {
                $bday = $_POST['bday'];
                $criteria->addCondition('MONTH(BirthDate)=' . $bday . '', 'AND');
            }
            /* if (!empty($_POST['myYr'])){ 
              $myYr=$_POST['myYr'];
              $criteria->addCondition('Year(BirthDate)='.$myYr.'' , 'AND');
              } */
            if (!empty($_POST['myGender'])) {
                $myGender = $_POST['myGender'];
                $criteria->addCondition('Gender=' . $myGender . '', 'AND');
            }
            if (!empty($_POST['myCivilStat'])) {
                $myCivilStat = $_POST['myCivilStat'];
                $criteria->addCondition('CivilStat=' . $myCivilStat . '', 'AND');
            }
            if (!empty($_POST['hireMonth'])) {
                $hireMonth = $_POST['hireMonth'];
                $criteria->addCondition('MONTH(DateHire)=' . $hireMonth . '', 'AND');
            }
            if (!empty($_POST['hireDay'])) {
                $hireDay = $_POST['hireDay'];
                $criteria->addCondition('DAY(DateHire)=' . $hireDay . '', 'AND');
            }
            if (!empty($_POST['hireYr'])) {
                $hireYr = $_POST['hireYr'];
                $criteria->addCondition('YEAR(DateHire)=' . $hireYr . '', 'AND');
            }
            if (!empty($_POST['mydept'])) {
                $mydept = $_POST['mydept'];
                $criteria->addCondition('Department LIKE ("%' . $mydept . '%")', 'AND');
            }
            if (!empty($_POST['myPos'])) {
                $myPos = $_POST['myPos'];
                $criteria->addCondition('Position LIKE ("%' . $myPos . '%")', 'AND');
            }
            if (isset($_POST['chkBday']) && isset($_POST['chkHire'])) {
                $criteria->order = "Department ASC";
            } elseif (isset($_POST['chkBday'])) {
                $criteria->order = "MONTH( birthdate ) ASC , DATE( birthdate ) ASC";
            } else {
                $criteria->order = "Department ASC";
            }

            //$criteria->addCondition('FirstName="Vargas"');

            $personalInfo = EmpInformation::model()->findAll($criteria);
            $htmlOutput = $styling . '<table border="1" cellpadding="7"><tr style="font-weight:bold;">';
            $htmlOutput.=(isset($_POST['chkEmpID']) ? "<td>ID</td>" : "");
            $htmlOutput.=(isset($_POST['chkFname']) ? "<td>Name</td>" : "");
            $htmlOutput.=(isset($_POST['chkHome']) ? "<td>Home Address</td>" : "");
            $htmlOutput.=(isset($_POST['chkContact']) ? "<td>Contact No.</td>" : "");
            $htmlOutput.=(isset($_POST['chkBday']) ? "<td>Birth Date</td>" : "");
            $htmlOutput.=(isset($_POST['chkGender']) ? "<td>Gender</td>" : "");
            $htmlOutput.=(isset($_POST['chkCivilStat']) ? "<td>Civil Status</td>" : "");
            $htmlOutput.=(isset($_POST['chkHire']) ? "<td>Date Hired</td>" : "");
            $htmlOutput.=(isset($_POST['chkSSS']) ? "<td>SSS</td>" : "");
            $htmlOutput.=(isset($_POST['chkTIN']) ? "<td>TIN</td>" : "");
            $htmlOutput.=(isset($_POST['chkPHIC']) ? "<td>PHIC</td>" : "");
            $htmlOutput.=(isset($_POST['chkHDMF']) ? "<td>HDMF</td>" : "");
            $htmlOutput.=(isset($_POST['chkAcctNo']) ? "<td>Acct. No.</td>" : "");
            $htmlOutput.=(isset($_POST['chkDept']) ? "<td>Department</td>" : "");
            $htmlOutput.=(isset($_POST['chkPosition']) ? "<td>Position</td>" : "");
            $htmlOutput.=(isset($_POST['chkEmailadd']) ? "<td>Email Address</td>" : "");
            $htmlOutput.=(isset($_POST['chkContact']) ? "<td>Contact No.</td>" : "");
            $htmlOutput.=(isset($_POST['chkMB']) ? "<td>Monthly Basic</td>" : "");

            $htmlOutput.='</tr>';
            $recordCtr = count($personalInfo);
            foreach ($personalInfo as $data) {
                if (isset($_POST['chkMB'])) {
                    $crit = new CDbCriteria;
                    $crit->addCondition('Emp_ID=' . $data['EmpID'] . '');
                    $mod = Employee::model()->find($crit);
                    //find($crit);
                    $mbasic = $mod['Monthly_Basic'];
                }
                $htmlOutput.='<tr>';
                $htmlOutput.=(isset($_POST['chkEmpID']) ? "<td>" . $data['EmpID'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkFname']) ? "<td>" . $data['FirstName'] . " " . $data['LastName'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkHome']) ? "<td>" . $data['HomeAddress'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkContact']) ? "<td>" . $data['ContactNo'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkBday']) ? "<td>" . date('F j, Y', strtotime($data['BirthDate'])) . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkGender']) ? "<td>" . $data['gender']['gender'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkCivilStat']) ? "<td>" . $data['civilStat']['CivilStat'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkHire']) ? "<td>" . date('F j, Y', strtotime($data['DateHire'])) . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkSSS']) ? "<td>" . $data['SSS'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkTIN']) ? "<td>" . $data['TIN'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkPHIC']) ? "<td>" . $data['PHIC'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkHDMF']) ? "<td>" . $data['HDMF'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkAcctNo']) ? "<td>" . $data['AcctNo'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkDept']) ? "<td>" . $data['Department'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkPosition']) ? "<td>" . $data['Position'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkEmailadd']) ? "<td>" . $data['EmailAddress'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkEmailadd']) ? "<td>" . $data['ContactNo'] . "</td>" : "");
                $htmlOutput.=(isset($_POST['chkMB']) ? "<td>" . $mbasic . "</td>" : "");


                //
                $htmlOutput.='</tr>';
            }

            $htmlOutput.='</table><br><br><div align="right">' . $recordCtr . ' record(s) found.</div><br>';
        } else {
            $htmlOutput = "No input selected";
        }
        /* $htmlOutput="";
          if($chkbox_count!=0){
          $htmlOutput= "<table><tr>";
          for($i=0; $i<$chkbox_count; $i++){
          $htmlOutput.="<td>".$i."</td>";
          }
          $htmlOutput.="</td></tr></table>";
          } */
        $resolution = array(216, 1000); //216 x 356
        $outputPdf->AddPage('L', $resolution);
        //$outputPdf->AddPage();
        $outputPdf->writeHTML($htmlOutput, true, false, true, false, '');
        $outputPdf->Output(trim('Report') . '.pdf', 'I');
    }

}

?>