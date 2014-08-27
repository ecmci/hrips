<script>
var numItems=0;
var rowIdCivil = null;
var tblCivil = null;
var rowId = null;
var rowCount=0;
$(function() {
    $( ".rowWorkexp" ).find( "input.dtpFrom" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			}); 
	
	$( ".rowWorkexp" ).find( "input.dtpTo" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
			
	tbl = document.getElementById('tblworkexp');
	rowId = tbl.rows.length;
 });
function addWorkexps(){
		var tableCvl=document.getElementById('tblworkexp');
		rowCount=tableCvl.rows.length;
		var row=tableCvl.insertRow(rowCount);
		var rowIdx = tableCvl.rows.length;
		row.className = "rowWorkexp";
		rowIdx -= 1;
	//	row.id = rowId;
		
		//from date
		var cell = row.insertCell(0);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_FromDate";
		element.name = "EmpWorkexp["+(rowCount-1)+"][FromDate]";
		element.style = "width: 200px";
		element.className="dtpFrom";
		//elemet.style= "width:300px";
		element.size="15";
		cell.appendChild(element);
		//$("#EmpWorkexp_FromDate").css({ width: "80px" });
		
		//todate
		var cell = row.insertCell(1);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_ToDate";
		element.name = "EmpWorkexp["+(rowCount-1)+"][ToDate]";
		element.className="dtpTo";
		element.placeholder="PRESENT";
		cell.appendChild(element);
		//$("#EmpWorkexp_ToDate").css({ width: "80px" });
		
		//position title
		var cell = row.insertCell(2);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_PositionTitle";
		element.name = "EmpWorkexp["+(rowCount-1)+"][PositionTitle]";
		cell.appendChild(element);
		//$("#EmpWorkexp_PositionTitle").css({ width: "250px" });
		
		//company
		var cell = row.insertCell(3);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_Company";
		element.name = "EmpWorkexp["+(rowCount-1)+"][Company]";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		//$("#EmpWorkexp_Company").css({ width: "300px" });
		
		//monthlysalary
		var cell = row.insertCell(4);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_MonthlySalary";
		element.name = "EmpWorkexp["+(rowCount-1)+"][MonthlySalary]";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		//$("#EmpWorkexp_MonthlySalary").css({ width: "100px" });
		
		//salary grade
		var cell = row.insertCell(5);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_SalaryGrade";
		element.name = "EmpWorkexp["+(rowCount-1)+"][SalaryGrade]";
		cell.appendChild(element);
		//$("#EmpWorkexp_SalaryGrade").css({ width: "100px" });
		
		//statappointment
		var cell = row.insertCell(6);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpWorkexp_StatAppointment";
		element.name = "EmpWorkexp["+(rowCount-1)+"][StatAppointment]";
		cell.appendChild(element);
		//$("#EmpWorkexp_StatAppointment").css({ width: "100px" });
		
		//govtservice
		var cell = row.insertCell(7);
		var element = document.createElement("select");
		var option = document.createElement("option");
		option.text = "No";
		option.value = "0";	
		element.add(option);
		option = document.createElement("option");
		option.text = "Yes";
		option.value = "1";	
		element.add(option);
		
		//element.type = "text";
		element.id="EmpWorkexp_GovtService";
		element.name = "EmpWorkexp["+(rowCount-1)+"][GovtService]";
		cell.appendChild(element); 
		
		//addtnl
		
		$( ".rowWorkexp:last" ).find( "input.dtpFrom" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
		//release date
		$( ".rowWorkexp:last" ).find( "input.dtpTo" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
			
	
		//remove
		/* var cell = row.insertCell(2);
		var element = document.createElement("a");
		var txt = document.createTextNode("Remove");
		element.id='rem-lnk';
		element.href='#';
		element.appendChild(txt);	
		element.setAttribute('onclick', 'deleteRow('+rowId+')');
		//element.className='remove';
		cell.appendChild(element);
		//'+rowId+'
		rowId++; */
	}
function deleteWork(tblworkexp) {
	var tablewrk=document.getElementById('tblworkexp');
	var rowCountwrk=tablewrk.rows.length;
	var rowIdwrk=rowCountwrk-1;
	//rowCount-=1;
	if (rowCountwrk>2){
		tablewrk.deleteRow(rowIdwrk);
	}else if (rowCountwrk<=2){
		alert('You can\'t remove all rows.');
	}
}
</script>

<?php if($model->isNewRecord){ ?>
<fieldset class="myclass"> <!-- Work Experience -->
	<h4><i>V. WORK EXPERIENCE (Start from your current work)</i></h4>
	<input type="checkbox" id="chkWork" name="chkWork" <?php if(isset($_POST['chkWork'])) echo "checked='checked'"; ?> /> Include</input>
	<?=$workexp_error;?>
	<div class="CSSTableGenerator">
		<table id="tblworkexp">
			<tr>
				<td><?php echo $form->labelEx($modWork,'FromDate')//, array('style'=>"width: 80px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'ToDate')//, array('style'=>"width: 80px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'PositionTitle')//, array('style'=>"width: 250px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'Company')//, array('style'=>"width: 300px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'MonthlySalary')//, array('style'=>"width: 100px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'SalaryGrade')//, array('style'=>"width: 100px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'StatAppointment')//, array('style'=>"width: 100px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modWork,'GovtService')//,array('style'=>"width: 80px;text-align: center;")); ?></td>
			</tr>
			
			<?php
					$i=0;
					foreach($workexp_details as $row){
						echo "<tr class='rowWorkexp'>";
						echo "<td><input size='5' type='text' class='dtpFrom' name='EmpWorkexp[$i][FromDate]' value='".$row['FromDate']."'></td>";
						echo "<td><input type='text' class='dtpTo' name='EmpWorkexp[$i][ToDate]' value='".$row['ToDate']."' placeholder='PRESENT'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][PositionTitle]' value='".$row['PositionTitle']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][Company]' value='".$row['Company']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][MonthlySalary]' value='".$row['MonthlySalary']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][SalaryGrade]' value='".$row['SalaryGrade']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][StatAppointment]' value='".$row['StatAppointment']."'></td>";
						//echo "<td><input type='text' style='width: 70px' name='EmpWorkexp[$i][GovtService]' value='".$row['GovtService']."'></td>";
						echo "<td><select id='GovtService' name='EmpWorkexp[$i][GovtService]' value='".$row['GovtService']."'><option value='0'>No</option><option value='1'>Yes</option></td>";
						//echo "<td>".$form->dropDownList($modWork,'[$i]GovtService',$arrYesNo,array('style'=>"width: 80px;"))."</td>";
						echo "</tr>";
						$i++;						
					}
			?>
			
		</table>
	</div>
	<p><input id="cloneWork" type="button" value="Add row" onclick="addWorkexps()" class="classname" />
	<input id="delwork" type="button" value="Remove" onclick="deleteWork(tblworkexp)" class="btnGray" /></p>
</fieldset>

<?php }else{ ?>

<fieldset class="myclass">
<?php $data = $model->empWorkexps; ?>
	<h4><i>V. WORK EXPERIENCE (Start from your current work)</i></h4>
	<input type="checkbox" id="chkWork" name="chkWork" <?php if(isset($_POST['chkWork']) || (!empty($data))) echo "checked='checked'"; ?> /> Include</input>
	<?=$workexp_error;?>
	<div class="CSSTableGenerator">
		<table id="tblworkexp">
			<tr>
				<td>From</td>
				<td>To</td>
				<td>Position Title (Write in full) </td>
				<td>Department/ Agency/ Office/ Company</td>
				<td>Monthly Salary</td>
				<td>Salary Grade & Step Increment (Format "00-0")</td>
				<td>Status of Appointment</td>
				<td>Gov't. Service</td>
			</tr>
			<?php
				if(empty($data)){
					$i=0;
					foreach($workexp_details as $row){
						echo "<tr class='rowWorkexp'>";
						echo "<td><input size='5' type='text' class='dtpFrom' name='EmpWorkexp[$i][FromDate]' value='".$row['FromDate']."'></td>";
						echo "<td><input type='text' class='dtpTo' name='EmpWorkexp[$i][ToDate]' value='".$row['ToDate']."' placeholder='PRESENT'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][PositionTitle]' value='".$row['PositionTitle']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][Company]' value='".$row['Company']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][MonthlySalary]' value='".$row['MonthlySalary']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][SalaryGrade]' value='".$row['SalaryGrade']."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][StatAppointment]' value='".$row['StatAppointment']."'></td>";
						//echo "<td><input type='text' style='width: 70px' name='EmpWorkexp[$i][GovtService]' value='".$row['GovtService']."'></td>";
						echo "<td><select id='GovtService' name='EmpWorkexp[$i][GovtService]' value='".$row['GovtService']."'><option value='0'>No</option><option value='1'>Yes</option></td>";
						//echo "<td>".$form->dropDownList($modWork,'[$i]GovtService',$arrYesNo,array('style'=>"width: 80px;"))."</td>";
						echo "</tr>";
						$i++;						
					}
				
				}else{
					foreach($data as $i=>$d){
						echo "<tr class='rowWorkexp'>";
						echo "<td><input type='text' class='dtpFrom' name='EmpWorkexp[$i][FromDate]' value='".$workExps[$i]['FromDate']= $d->FromDate."'></td>";
						echo "<td><input type='text' class='dtpTo' name='EmpWorkexp[$i][ToDate]' value='".$workExps[$i]['ToDate']= $d->ToDate."' placeholder='PRESENT'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][PositionTitle]' value='".$workExps[$i]['PositionTitle']= $d->PositionTitle."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][Company]' value='".$workExps[$i]['Company']= $d->Company."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][MonthlySalary]' value='".$workExps[$i]['MonthlySalary']= $d->MonthlySalary."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][SalaryGrade]' value='".$workExps[$i]['SalaryGrade']= $d->SalaryGrade."'></td>";
						echo "<td><input type='text' name='EmpWorkexp[$i][StatAppointment]' value='".$workExps[$i]['StatAppointment']= $d->StatAppointment."'></td>";
						//echo "<td><input type='text' style='width: 70px' name='EmpWorkexp[$i][GovtService]' value='".$row['GovtService']."'></td>";
						 if ($d->GovtService==1){
							echo "<td><select id='GovtService' name='EmpWorkexp[$i][GovtService]' value='".$workExps[$i]['GovtService']= $d->GovtService."'><option value='0'>No</option><option value='1' selected>Yes</option></td>";
						}else{
							echo "<td><select id='GovtService' name='EmpWorkexp[$i][GovtService]' value='".$workExps[$i]['GovtService']= $d->GovtService."'><option value='0' selected>No</option><option value='1'>Yes</option></td>";
						} 
						/*  echo "<td><select id='GovtService' name='EmpWorkexp[$i][GovtService]' value='".$workExps[$i]['GovtService']= $d->GovtService."'><option value='1'>Yes</option><option value='0'>No</option></td>"; 
						echo "<td><input type='text' name='GovtServicehidden' value='".$workExps[$i]['GovtService']= $d->GovtService."'></td>"; */
						echo "</tr>";
						$i++;						
					}
				}
			
			?>
		</table>
	</div>
	
	<p><input id="cloneWork" type="button" value="Add row" onclick="addWorkexps()" class="classname" />
	<input id="delwork" type="button" value="Remove" onclick="deleteWork(tblworkexp)" class="btnGray" /></p>
</fieldset>
<?php } ?>