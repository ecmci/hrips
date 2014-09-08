<?php
/* @var $this EmpInformationController */
/* @var $model EmpInformation */

$curruser=HrisUsers::model()->findByPk(Yii::app()->user->emp_id);
$userlvl=$curruser->access_lvl_id;

//if($userlvl=='3' || $userlvl=='4'){ //admin and hr can see the menu to update this record
	$this->menu=array(
		//array('label'=>'View EmpInformation', 'url'=>array('view','id'=>$model->EmpID)),
		//array('label'=>'Create PDS', 'url'=>array('create')),
		array('label'=>'Update PDS', 'url'=>array('update', 'id'=>$model->EmpID)),
		array('label'=>'View my PDS ('.Yii::app()->user->emp_id .')', 'url'=>array('view', 'id'=>Yii::app()->user->emp_id)),
		array('label'=>'View All PDS', 'url'=>array('admin')),
		array('label'=>'Print this PDS (.pdf format)', 'url'=>array('PdsPrint/printpds/'.$model->EmpID),'linkOptions'=>array('target'=>'_blank')),	
		array('label'=>'Generate Reports', 'url'=>array('ReportViewer/index'))
		);
//}

?>

<h1>Personal Data Sheet <?php //echo $model->EmpID; ?></h1>


<div class="cdview">
<table border="1"> <!-- 5columns -->
<tr> <!-- Personal info starts here -->
	<td colspan="5">PERSONAL INFORMATION</td>
</tr>
<tr>
	<th width="20%">Badge No.</th>
	<td colspan="4"><?php echo $model->EmpID; ?></td>
</tr>
<tr>
	<th>First Name</th>
	<td colspan="4"><?php echo $model->FirstName; ?></td>
</tr>
<tr>
	<th>Surname</th>
	<td colspan="4"><?php echo $model->LastName; ?></td>
</tr>
<tr>
	<th>Middle Name</th>
	<td colspan="2"><?php echo $model->MiddleName; ?></td>
	<th width="20%">Name Extension</th>
	<td><?php echo $model->NameExt; ?></td>
</tr>
<tr>
	<th>Date of Birth</th>
	<td><?php echo date('F j, Y',strtotime($model->BirthDate)); ?></td>
	<th width="20%" rowspan="2">Residential Address</th>
	<td colspan="2" rowspan="2"><?php echo $model->ResidentialAddress; ?></td>
</tr>
<tr>
	<th>Place of Birth</th>
	<td><?php echo $model->BdayPlace; ?></td>
</tr>
<tr>
	<th>Gender</th>
	<td><?php echo $model->gender->gender; ?></td>
	<th>Zip Code</th>
	<td colspan="2"><?php echo $model->RAZipCode; ?></td>
</tr>
<tr>
	<th>CivilStat</th>
	<td><?php echo $model->civilStat->CivilStat; ?></td>
	<th>Tel. no</th>
	<td colspan="2"><?php echo $model->RATelno; ?></td>
</tr>
<tr>
	<th>Citizenship</th>
	<td><?php echo $model->Citizenship; ?></td>
	<th rowspan="2">Permanent Address</th>
	<td colspan="2" rowspan="2"><?php echo $model->HomeAddress; ?></td>
</tr>
<tr>
	<th>Height (m)</th>
	<td><?php echo $model->Height; ?></td>
</tr>
<tr>
	<th>Weight (kg)</th>
	<td><?php echo $model->Weight; ?></td>
	<th>Zip Code</th>
	<td colspan="2"><?php echo $model->HAZipCode; ?></td>
</tr>
<tr>
	<th>Blood Type</th>
	<td><?php echo $model->BloodType; ?></td>
	<th>Tel. no</th>
	<td colspan="2"><?php echo $model->HATelno; ?></td>
</tr>
<tr>
	<th>HDMF No.</th>
	<td><?php echo $model->HDMF; ?></td>
	<th>Email Address</th>
	<td colspan="2"><?php echo $model->EmailAddress; ?></td>
</tr>
<tr>
	<th>PHIC No.</th>
	<td><?php echo $model->PHIC; ?></td>
	<th>Cellphone No.</th>
	<td colspan="2"><?php echo $model->ContactNo; ?></td>
</tr>
<tr>
	<th>SSS No.</th>
	<td><?php echo $model->SSS; ?></td>
	<th>TIN</th>
	<td colspan="2"><?php echo $model->TIN; ?></td>
</tr>
<tr>
	<th>Department</th>
	<td><?php echo $model->Department; ?></td>
	<th>Position</th>
	<td colspan="2"><?php echo $model->Position; ?></td>
</tr>
<tr>
	<th>Date Hired</th>
	<td><?php echo date('F j, Y',strtotime($model->DateHire)); ?></td>
	<th>Agency Employee No.</th>
	<td colspan="2"><?php echo $model->AgencyEmpNo; ?></td>
</tr>
<tr> <!-- emergency contact details -->
	<th colspan="5">In case of emergency, please notify:</th>
</tr>
<tr>
	<th>Name</th>
	<td><?php echo $model->EMGName; ?></td>
	<th>Address</th>
	<td colspan="2"><?php echo $model->EMGAddress; ?></td>
</tr>
<tr>
	<th>Relation</th>
	<td><?php echo $model->EMGRelation; ?></td>
	<th>Contact No.</th>
	<td colspan="2"><?php echo $model->EMGContactNum; ?></td>
</tr>
<tr> <!--fam bg starts here -->
	<th colspan="5">FAMILY BACKGROUND</th>
</tr>
<tr>
	<th>Spouse's Surname</th>
	<td><?php echo $model->empFambg->SpouseLname; ?></td>
	<th>Father's Surname</th>
	<td colspan="2"><?php echo $model->empFambg->FatherLname; ?></td>
</tr>
<tr>
	<th>Spouse's Firstname</th>
	<td><?php echo $model->empFambg->SpouseFname; ?></td>
	<th>Father's Firstname</th>
	<td colspan="2"><?php echo $model->empFambg->FatherFname; ?></td>
</tr>
<tr>
	<th>Spouse's Middlename</th>
	<td><?php echo $model->empFambg->SpouseMname; ?></td>
	<th>Father's Middlename</th>
	<td colspan="2"><?php echo $model->empFambg->FatherMname; ?></td>
</tr>
<tr>
	<th>Occupation</th>
	<td><?php echo $model->empFambg->SpouseOccupation; ?></td>
	<th>Mother's Maiden Name</th>
	<td colspan="2"><?php echo $model->empFambg->MotherMaiden; ?></td>
</tr>
<tr>
	<th>Employer/Business Name</th>
	<td><?php echo $model->empFambg->SpouseEmployer; ?></td>
	<th>Mother's Surname</th>
	<td colspan="2"><?php echo $model->empFambg->MotherLname; ?></td>
</tr>
<tr>
	<th>Business Address</th>
	<td><?php echo $model->empFambg->SpouseBusinessAddress; ?></td>
	<th>Mother's Firstname</th>
	<td colspan="2"><?php echo $model->empFambg->MotherFname; ?></td>
</tr>
<tr>
	<th>Tel. No</th>
	<td><?php echo $model->empFambg->SpouseTelno; ?></td>
	<th>Mother's Middlename</th>
	<td colspan="2"><?php echo $model->empFambg->MotherMname; ?></td>
</tr>
</table>
</div>
<?php
//children
$items = null;
$cols = null;
$data = $model->empChildrens;
$cols = array('Child Name','BirthDate');
foreach($data as $i=>$d){
	$items[$i]['ChildName'] = $d->ChildName;
	$items[$i]['BirthDate'] = $d->BirthDate;
}
if (!empty($data)){
	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'CHILDREN',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));
}

//educbg
$items = null;
$cols = null;
$data = $model->empEducbgs;
$cols = array('Level','Name of School', 'Degree Course','Year Graduated','Highest Grade/<br>Level/Units Earned','From','To','Scholarship/Academic<br> Honors Received');
foreach($data as $i=>$d){ /*if empty school name, dont show*/
	if(!empty($d->NameofSchool)){
		$items[$i]['EducLevel'] = $d->educLevel->EducLevel;
		$items[$i]['NameofSchool'] = $d->NameofSchool;
		$items[$i]['DegreeCourse'] = $d->DegreeCourse;
		$items[$i]['YearGrad'] = $d->YearGrad;
		$items[$i]['HighestEarned'] = $d->HighestEarned;
		$items[$i]['FromDate'] = $d->FromDate;
		$items[$i]['ToDate'] = $d->ToDate;
		$items[$i]['ScholarshipReceived'] = nl2br($d->ScholarshipReceived);
	}
}

	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'EDUCATIONAL BACKGROUND',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));


//civil service
$items = null;
$cols = null;
$data = $model->empCivilservices;
$cols = array('Career Service','Rating', 'Date of Examination/<br>Conferment','Place of Examination/<br>Conferment','License Number','Date of Release');
foreach($data as $i=>$d){ 
	$items[$i]['CareerService'] = $d->CareerService;
	$items[$i]['Rating'] = $d->Rating;
	$items[$i]['DateExam'] = $d->DateExam;
	$items[$i]['ExamPlace'] = $d->ExamPlace;
	$items[$i]['LicenseNumber'] = $d->LicenseNumber;
	$items[$i]['ReleaseDate'] = $d->ReleaseDate;
}
if (!empty($data)){
	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'CIVIL SERVICE ELIGIBILITY',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));
}

//work exp
$items = null;
$cols = null;
$data = $model->empWorkexps;
$cols = array('From','To', 'Position Title','Department/Agency/<br>Office/Company','Monthly Salary','Salary Grade & <br>Step Increment <br>(Format "00-0")','Status of <br>Appointment', 'Gov\'t Service');
foreach($data as $i=>$d){
	$items[$i]['FromDate'] = $d->FromDate;
	$items[$i]['ToDate'] = $d->ToDate=="0000-00-00" ? "PRESENT" : $d->ToDate;
	$items[$i]['PositionTitle'] = $d->PositionTitle;
	$items[$i]['Company'] = $d->Company;
	$items[$i]['MonthlySalary'] = $d->MonthlySalary;
	$items[$i]['SalaryGrade'] = $d->SalaryGrade;
	$items[$i]['StatAppointment'] = $d->StatAppointment;
	$items[$i]['GovtService']=$d->GovtService=="1" ? "Yes" : "No";
	//$items[$i]['GovtService'] = $d->GovtService;
}
if (!empty($data)){
	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'WORK EXPERIENCE',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));
}

//vountary work
$items = null;
$cols = null;
$data = $model->empOrganizations;
$cols = array('Name & Address of Organization','From','To', 'Number of Hours','Position/Nature of Work');
foreach($data as $i=>$d){ 
	$items[$i]['NameAddressOrg'] = $d->NameAddressOrg;
	$items[$i]['FromDate'] = $d->FromDate;
	$items[$i]['ToDate'] = $d->ToDate=="0000-00-00" ? "PRESENT" : $d->ToDate;
	$items[$i]['NoOfHrs'] = $d->NoOfHrs;
	$items[$i]['PositionNatureOfWork'] = $d->PositionNatureOfWork;
}
if (!empty($data)){
	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));
}

//training
$items = null;
$cols = null;
$data = $model->empTrainings;
$cols = array('Title of Seminar/Workshop/Short Courses ','From','To', 'Number of Hours','Conducted/Sponsored By');
foreach($data as $i=>$d){ 
	$items[$i]['SeminarTitle'] = $d->SeminarTitle;
	$items[$i]['FromDate'] = $d->FromDate;
	$items[$i]['ToDate'] = $d->ToDate;
	$items[$i]['NoOfHrs'] = $d->NoOfHrs;
	$items[$i]['ConductedBy'] = $d->ConductedBy;
}
if (!empty($data)){
	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'TRAINING PROGRAMS',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));
}

//other info
$items = null;
$cols = null;
$data = $model->empOtherinfos;
$cols = array('Special Skills/Hobbies','Non-Academic Distinctions/Recognition','Membership in Association/Organization');
foreach($data as $i=>$d){ 
	$items[$i]['SkillsHobbies'] = nl2br($d->SkillsHobbies);
	$items[$i]['NonAcadRecognition'] = nl2br($d->NonAcadRecognition);
	$items[$i]['MembershipAssocOrg'] = nl2br($d->MembershipAssocOrg);
}

	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'OTHER INFORMATION',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));


?>

<br>
<div class="cdview">
<?php $data=$model->empQueries; ?>
	<table border="1">
		<tr><td></td></tr>
		<tr>
			<td><b>Are you related by consanguinity or affinity to any of the following :<br><br>
				a.</b> Within the third degree: <br>
				appointing authority, recommending authority, chief of office/bureau/department or person who has immediate supervision over you in the Office, Bureau, Department where you will be appointed, with ECMCI and any affiliated with Eva Care Group? &nbsp; <font color="red"><b><?php echo $answer=$data->ThirdDegreeRelated=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->TDRdetails)){ echo $deets=$data->TDRdetails;} ?></i>
				
			</td>
		</tr>
		<tr style="border-bottom: 2px solid black !important;">
			<td>
				<b>b.</b> Within the fourth degree:<br>
				appointing authority or recommending authority where you will be appointed?
				&nbsp; <font color="red"><b><?php echo $answer=$data->FourthDegreeRelated=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->FDRdetails)){ echo $deets=$data->FDRdetails;} ?></i>
			</td>
		</tr>
		<tr>
			<td>
				<b>a.</b> Have you ever been formally charged?
				&nbsp; <font color="red"><b><?php echo $answer=$data->FormallyCharged=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->ChargedDetails)){ echo $deets=$data->ChargedDetails;} ?></i>
			</td>
		</tr>
		<tr style="border-bottom:2px solid black;padding:5px;">
			<td>
				<b>b.</b> Have you ever been guilty of any administrative offense?
				&nbsp; <font color="red"><b><?php echo $answer=$data->AdminOffense=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->OffenseDetails)){ echo $deets=$data->OffenseDetails;} ?></i>
			</td>
		</tr>
		<tr style="border-bottom:2px solid black;padding:5px;">
			<td>
				Have you ever been convicted of any crime or violation of any law, decree, ordinance orregulation by any court or tribunal?
				&nbsp; <font color="red"><b><?php echo $answer=$data->CrimeConvicted=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->CrimeDetails)){ echo $deets=$data->CrimeDetails;} ?></i>
			</td>
		</tr>
		<tr style="border-bottom:2px solid black;padding:5px;">
			<td>
				Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or phased out, in the public or private sector?
				&nbsp; <font color="red"><b><?php echo $answer=$data->SeparatedService=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->SSdetails)){ echo $deets=$data->SSdetails;} ?></i>
			</td>
		</tr>
		<tr style="border-bottom:2px solid black;padding:5px;">
			<td>
				Have you ever been a candidate in a national or local election (except Barangay election)?
				&nbsp; <font color="red"><b><?php echo $answer=$data->ElectionCandidate=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->ECdetails)){ echo $deets=$data->ECdetails;} ?></i>
			</td>
		</tr>
		<tr> 
			<td>
				<b>Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:<br><br>
				a.</b> Are you a member of any indigenous group?
				&nbsp; <font color="red"><b><?php echo $answer=$data->Indigenous=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->IndiDetails)){ echo $deets=$data->IndiDetails;} ?></i>
			</td>
		</tr>
		<tr>
			<td>
				<b>b.</b> Are you differently abled?
				&nbsp; <font color="red"><b><?php echo $answer=$data->DiffAbled=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->DAdetails)){ echo $deets=$data->DAdetails;} ?></i>
			</td>
		</tr>
		<tr>
			<td>
				<b>c.</b> Are you a solo parent?
				&nbsp; <font color="red"><b><?php echo $answer=$data->SoloParent=="1" ? "Yes" : "No"; ?></b></font>&nbsp;&nbsp;&nbsp;<i><?php if(!empty($data->SPdetails)){ echo $deets=$data->SPdetails;} ?></i>
			</td>
		</tr>
	</table>
</div>

<?php

//references
$items = null;
$cols = null;
$data = $model->empRefs;
$cols = array('Name','Address','Tel. No.');
foreach($data as $i=>$d){ 
	$items[$i]['RefName'] = $d->RefName;
	$items[$i]['RefAdd'] = $d->RefAdd;
	$items[$i]['Telno'] = $d->Telno;
}
if (!empty($data)){
	$this->widget('ext.htmltableui.htmlTableUi',array(
		'collapsed'=>false,
		'enableSort'=>false,
		'title'=>'REFERENCES',
		//'subtitle'=>'Rev 1.3.3',
		'columns'=>$cols,
		'rows'=>$items,
		'cssFile'=>'/themes/themes/sunny/jquery.ui.theme.css',
		//'footer'=>'Total Amount: '.$total,
	));
}

?>

<div class="cdview">
	<table border="1">
		<tr><td>Oath</td></tr>
		<tr>
			<td><center>
				I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and<br>
			complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the<br>
			Philippines.<br><br>

				I also authorize the agency head / authorized representative to verify / validate the contents stated herein. I trust<br>
			that this information shall remain confidential.</center>
			<P style="text-align: right"><b>Date Accomplished</b><br><i><?php echo $model->DateAccomplished; ?></i></P>
			</td>
		</tr>
	</table>
</div>