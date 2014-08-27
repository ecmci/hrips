<script>
var numItems=0;
var rowIdCivil = null;
var tblCivil = null;
var rowId = null;
var rowCount=0;
$(function() {
    $( ".rowCivil" ).find( "input.dtpDateexam" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			}); 
	
	$( ".rowCivil" ).find( "input.dtpReleasedate" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
			
	tbl = document.getElementById('tblcivil');
	rowId = tbl.rows.length;
 });
function addCivil(){
		var tableCvl=document.getElementById('tblcivil');
		rowCount=tableCvl.rows.length;
		var row=tableCvl.insertRow(rowCount);
		var rowIdx = tableCvl.rows.length;
		row.className = "rowCivil";
		rowIdx -= 1;
		row.id = rowId;
		
		//careerservice
		var cell = row.insertCell(0);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpCivilservice_CareerService";
		element.name = "EmpCivilservice["+(rowCount-1)+"][CareerService]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//rating
		var cell = row.insertCell(1);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpCivilservice_Rating";
		element.name = "EmpCivilservice["+(rowCount-1)+"][Rating]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//date exam
		var cell = row.insertCell(2);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpCivilservice_DateExam";
		element.name = "EmpCivilservice["+(rowCount-1)+"][DateExam]";
		element.size = "5";
		element.className="dtpDateexam";
		cell.appendChild(element);
		
		
		//exam place
		var cell = row.insertCell(3);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpCivilservice_ExamPlace";
		element.name = "EmpCivilservice["+(rowCount-1)+"][ExamPlace]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//license number
		var cell = row.insertCell(4);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpCivilservice_LicenseNumber";
		element.name = "EmpCivilservice["+(rowCount-1)+"][LicenseNumber]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		var cell = row.insertCell(5);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpCivilservice_ReleaseDate";
		element.name = "EmpCivilservice["+(rowCount-1)+"][ReleaseDate]";
		element.size = "5";
		element.className="dtpReleasedate";
		cell.appendChild(element);
		//exam date
		$( ".rowCivil:last" ).find( "input.dtpDateexam" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
		//release date
		$( ".rowCivil:last" ).find( "input.dtpReleasedate" )
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
function deleteCvl(tblcivil) {
	var tablecvl=document.getElementById('tblcivil');
	var rowCountcvl=tablecvl.rows.length;
	var rowIdcvl=rowCountcvl-1;
	//rowCount-=1;
	if (rowCountcvl>2){
		tablecvl.deleteRow(rowIdcvl);
	}else if (rowCountcvl<=2){
		alert('You can\'t remove all rows.');
	}
}
</script>
<?php if($model->isNewRecord){ ?>
<fieldset class="myclass"> <!-- Civil Service -->
	<h4><i>IV. CIVIL SERVICE ELIGIBILITY</i></h4>
	<input type="checkbox" id="chkCvl" name="chkCvl" <?php if(isset($_POST['chkCvl'])) echo "checked='checked'"; ?> /> Include</input>
	<?=$cvlservice_error?>
	<div class="CSSTableGenerator">
		<table id="tblcivil">
			<tr>
				<td><?php echo $form->labelEx($modCivil,'CareerService',array('style'=>"text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modCivil,'Rating',array('style'=>"text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modCivil,'DateExam',array('style'=>"text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modCivil,'ExamPlace',array('style'=>"text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modCivil,'LicenseNumber',array('style'=>"text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modCivil,'ReleaseDate',array('style'=>"text-align: center;")); ?></td>
			</tr>
			
			<?php
					$i=0;
					foreach($cvlservice_details as $row){
						echo "<tr class='rowCivil'>";
						echo "<td><input type='text' name='EmpCivilservice[$i][CareerService]' value='".$row['CareerService']."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][Rating]' value='".$row['Rating']."'></td>";
						echo "<td><input type='text' class='dtpDateexam' id='EmpCivilservice_DateExam0' name='EmpCivilservice[$i][DateExam]' value='".$row['DateExam']."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][ExamPlace]' value='".$row['ExamPlace']."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][LicenseNumber]' value='".$row['LicenseNumber']."'></td>";
						echo "<td><input type='text' class='dtpReleasedate' id='EmpCivilservice_ReleaseDate0' name='EmpCivilservice[$i][ReleaseDate]' value='".$row['ReleaseDate']."'></td>";
						echo "</tr>";
						$i++;						
					}
			?>
		</table>
	</div>
	<p><input id="cloneCvl" type="button" value="Add row" onclick="addCivil()" class="classname" />
	<input id="delcvl" type="button" value="Remove" onclick="deleteCvl(tblcivil)" class="btnGray" /></p>
</fieldset>

<?php }else{ ?>

<fieldset class="myclass">
<?php $data = $model->empCivilservices; ?>
	<h4><i>IV. CIVIL SERVICE ELIGIBILITY</i></h4>
	<input type="checkbox" id="chkCvl" name="chkCvl" <?php if(isset($_POST['chkCvl']) || (!empty($data))) echo "checked='checked'"; ?> /> Include</input>
	<?=$cvlservice_error?>
	<div class="CSSTableGenerator">
		<table id="tblcivil">
			<tr>
				<td>Career Service</td>
				<td>Rating</td>
				<td>Date Exam</td>
				<td>Exam Place</td>
				<td>License Number</td>
				<td>Release Date</td>
			</tr>
			<?php
				if(empty($data)){
					$i=0;
					foreach($cvlservice_details as $row){
						echo "<tr class='rowCivil'>";
						echo "<td><input type='text' name='EmpCivilservice[$i][CareerService]' value='".$row['CareerService']."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][Rating]' value='".$row['Rating']."'></td>";
						echo "<td><input type='text' class='dtpDateexam' id='EmpCivilservice_DateExam0' name='EmpCivilservice[$i][DateExam]' value='".$row['DateExam']."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][ExamPlace]' value='".$row['ExamPlace']."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][LicenseNumber]' value='".$row['LicenseNumber']."'></td>";
						echo "<td><input type='text' class='dtpReleasedate' id='EmpCivilservice_ReleaseDate0' name='EmpCivilservice[$i][ReleaseDate]' value='".$row['ReleaseDate']."'></td>";
						echo "</tr>";
						$i++;		
					}
				}else{
					foreach($data as $i=>$d){
						echo "<tr class='rowCivil'>";
						echo "<td><input type='text' name='EmpCivilservice[$i][CareerService]' value='".$civilServices[$i]['CareerService']= $d->CareerService."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][Rating]' value='".$civilServices[$i]['Rating']= $d->Rating."'></td>";
						echo "<td><input type='text' class='dtpDateexam' id='EmpCivilservice_DateExam0' name='EmpCivilservice[$i][DateExam]' value='".$civilServices[$i]['DateExam']= $d->DateExam."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][ExamPlace]' value='".$civilServices[$i]['ExamPlace']= $d->ExamPlace."'></td>";
						echo "<td><input type='text' name='EmpCivilservice[$i][LicenseNumber]' value='".$civilServices[$i]['LicenseNumber']= $d->LicenseNumber."'></td>";
						echo "<td><input type='text' class='dtpReleasedate' id='EmpCivilservice_ReleaseDate0' name='EmpCivilservice[$i][ReleaseDate]' value='".$civilServices[$i]['ReleaseDate']= $d->ReleaseDate."'></td>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
	
	<p><input id="cloneCvl" type="button" value="Add row" onclick="addCivil()" class="classname" />
	<input id="delcvl" type="button" value="Remove" onclick="deleteCvl(tblcivil)" class="btnGray" /></p>
</fieldset>

<?php } ?>