<!--<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/coolfieldset/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/coolfieldset/jquery.coolfieldset.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/js/js/css/jquery.coolfieldset.css" />
-->
<?php
$yearNow = date("Y");
$yearFrom = $yearNow-100;
$yearTo = $yearNow;
$arrYears = array();
	foreach (range($yearTo,$yearFrom) as $number) 
	{
		$arrYears[$number] = $number; 
	}
$arrYears = array_reverse($arrYears, true);

$arrDays=array();
foreach (range(1,31) as $number) 
	{
		$arrDays[$number] = $number; 
	}
//$arrYears = array_reverse($arrYears, false);
/* $sql="SELECT * FROM employee_position";
$com=Yii::app()->db->createCommand($sql);
$positions=$com->query(); */

/* $sql="SELECT * FROM employee_department";
$com=Yii::app()->db->createCommand($sql);
$departments=$com->query();
 */
$departments=EmployeeDepartment::model()->findAll(array('order'=>'Department ASC'));
$positions=EmployeePosition::model()->findAll(array('order'=>'Position ASC'));
?>
<head>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/coolfieldset/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/coolfieldset/js/jquery.coolfieldset.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/js/coolfieldset/css/jquery.coolfieldset.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/images/css/style1.css" type="text/css">

<!--
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/abound/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/abound/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/abound/css/abound.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/abound/css/style-green.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/abound/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/abound/css/customization.css" />
-->


<script language="javascript">
function checkAll(formname, fsname, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[formname][fsname].getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
}
</script>

</head>
<body>
<div id="header-container">
	<p class="padding">
	<h3>Generate Reports</h3>
	</p>
</div>
<br><br>

<form id="myForm" name="myForm" action="index2" method="POST">

	
	<fieldset id="fsPersonal"  name="fsPersonal" class="coolfieldset" style="width:50%">
		<legend>Personal Information</legend>
			<div>
				<a href="javascript:void();" onclick="javascript:checkAll('myForm','fsPersonal', true);">Check all</a>/<a href="javascript:void();" onclick="javascript:checkAll('myForm','fsPersonal', false);">uncheck all</a><br>
				<table cellpadding="2" cellspacing="5" width="100%"><br>
					<tr>
						<td class="bold">Columns to display</td>
						<td class="bold">Filter options</td>
					
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkEmpID" name="chkEmpID" value="1">Employee ID</input></td>
						<td><input type="text" id="txtEmpId" name="txtEmpId" style="width:300px" class="font"></input><i><div class="hint">separated by a comma for multiple IDs</font></div></i></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkFname" name="chkFname" value="1">Name</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkHome" name="chkHome" value="1">Home Address</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkContact" name="chkContact" value="1">Contact No.</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkBday" name="chkBday" value="1">Birth Date</input><br></td>
						<td><select name="bday" id="bday">
								<option value="">--Select Month--</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							<!--
							<select name="myYr" id="myYr">
								<option value="">--Select Year--</option>
								<?php 
									$currYr=date('Y');
									$selected="";
									foreach($arrYears as $arrYr => $value) 
									{
									   $arrYr = htmlspecialchars($arrYr); 
									   $selected=($currYr=$value) ? "selected" : "";
									   //echo '<option value="'. $value .'" '.$selected.' >'. $arrYr .'</option>';
									   echo '<option value="'. $value .'" >'. $arrYr .'</option>';
									   
									}
								?>
							</select>
							-->
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkGender" name="chkGender" value="1">Gender</input><br></td>
						<td><select name="myGender" id="myGender">
								<option value="">--Select--</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkCivilStat" name="chkCivilStat" value="1">Civil Status</input><br></td>
						<td><select name="myCivilStat" id="myCivilStat">
								<option value="">--Select--</option>
								<option value="1">Single</option>
								<option value="2">Married</option>
								<option value="3">Annulled</option>
								<option value="4">Widowed</option>
								<option value="5">Separated</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkHire" name="chkHire" value="1">Date Hired</input><br></td>
						<td><select name="hireMonth" id="hireMonth">
								<option value="">--Select Month--</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							<select name="hireDay" id="hireDay">
								<option value="">--Select Day--</option>
								<?php 
									foreach($arrDays as $arrDay => $value) 
									{
									   $arrDay = htmlspecialchars($arrDay); 
									   //$selected=($currYr=$value) ? "selected" : "";
									   //echo '<option value="'. $value .'" '.$selected.' >'. $arrYr .'</option>';
									   echo '<option value="'. $value .'" >'. $arrDay .'</option>';
									   
									}
								?>
							</select>
							<select name="hireYr" id="hireYr">
								<option value="">--Select Year--</option>
								<?php 
									$currYr=date('Y');
									$selected="";
									foreach($arrYears as $arrYr => $value) 
									{
									   $arrYr = htmlspecialchars($arrYr); 
									   $selected=($currYr=$value) ? "selected" : "";
									   //echo '<option value="'. $value .'" '.$selected.' >'. $arrYr .'</option>';
									   echo '<option value="'. $value .'" >'. $arrYr .'</option>';
									   
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkSSS" name="chkSSS" value="1">SSS</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkTIN" name="chkTIN" value="1">TIN</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkPHIC" name="chkPHIC" value="1">PHIC</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkHDMF" name="chkHDMF" value="1">HDMF</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkAcctNo" name="chkAcctNo" value="1">Acct. No.</input><br></td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkDept" name="chkDept" value="1">Department</input><br></td>
						<td><select name="mydept" id="mydept">
							<option value="">--Select--</option>
							<?php
								foreach($departments as $department){
									echo "<option value=".$department['Department'].">".$department['Department']."</option>";
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkPosition" name="chkPosition" value="1">Position</input><br></td>
						<td><select name="myPos" id="myPos">
							<option value="">--Select--</option>
							<?php
								foreach($positions as $position){
									echo "<option value=".$position['Position'].">".$position['Position']."</option>";
								}
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkEmailadd" name="chkEmailadd" value="1">Email Address</input><br></td>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkContact" name="chkContact" value="1">Contact No.</input><br></td>
						</td>
					</tr>
					<tr>
						<td class="bold"><input type="checkbox" id="chkMB" name="chkMB" />Monthly Basic</td>
					</tr>
				</table>
			</div>
		
</fieldset>
<fieldset id="rptDeets" name="rptDeets" class="coolfieldset" style="width:50%">
	<legend>Set Report Details</legend>
	<div>
	<table cellpadding="2" cellspacing="5" width="100%">
		<tr>
			<td class="bold">Creator</td>
			<td><input type="text" style="width:300px" placeholder="Default" id="rptCreator" name="rptCreator" class="font"></input></td>
		</tr>
		<tr>
			<td class="bold">Author</td>
			<td><input type="text" style="width:300px" placeholder="Default" id="rptAuthor" name="rptAuthor" class="font"></input></td>
		</tr>
		<tr>
			<td class="bold">Title</td>
			<td><input type="text" style="width:300px" placeholder="Default" id="rptTitle" name="rptTitle" class="font"></input></td>
		</tr>
		<tr>
			<td class="bold">Subject</td>
			<td><input type="text" style="width:300px" placeholder="Default" id="rptSubj" name="rptSubj" class="font"></input></td>
		</tr>
	</table>
	</div>
</fieldset>

<input type="submit" name="submit" class="classname" style="margin: 20px;" value="Submit"><a href="<?php echo Yii::app()->baseUrl;?>/index.php/empInformation/admin"><input type="button" value="Cancel" class="btnGray"></input></a>
 


</form>

</body>

<script>
  $('#fsPersonal').coolfieldset();
  $('#rptDeets').coolfieldset();
</script>
