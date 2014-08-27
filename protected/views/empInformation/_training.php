<script>
var numItems=0;
var rowIdCivil = null;
var tblCivil = null;
var rowId = null;
var rowCount=0;
$(function() {
    $( ".rowTraining" ).find( "input.dtpFrom2" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			}); 
	
	$( ".rowTraining" ).find( "input.dtpTo2" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
			
	tbl = document.getElementById('tbltraining');
	rowId = tbl.rows.length;
 });
function addTraining(){
		var tableTraining=document.getElementById('tbltraining');
		rowCount=tableTraining.rows.length;
		var row=tableTraining.insertRow(rowCount);
		var rowIdx = tableTraining.rows.length;
		row.className = "rowTraining";
		rowIdx -= 1;
		row.id = rowId;
		
		//SeminarTitle
		var cell = row.insertCell(0);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpTraining_SeminarTitle";
		element.name = "EmpTraining["+(rowCount-1)+"][SeminarTitle]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//FromDate
		var cell = row.insertCell(1);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpTraining_FromDate";
		element.name = "EmpTraining["+(rowCount-1)+"][FromDate]";
		element.size = "5";
		element.className="dtpFrom2";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//ToDate
		var cell = row.insertCell(2);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpTraining_ToDate";
		element.name = "EmpTraining["+(rowCount-1)+"][ToDate]";
		element.size = "5";
		element.className="dtpTo2";
		cell.appendChild(element);
		
		
		//NoOfHrs
		var cell = row.insertCell(3);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpTraining_NoOfHrs";
		element.name = "EmpTraining["+(rowCount-1)+"][NoOfHrs]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//ConductedBy
		var cell = row.insertCell(4);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpTraining_ConductedBy";
		element.name = "EmpTraining["+(rowCount-1)+"][ConductedBy]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		
		//date options
		$( ".rowTraining:last" ).find( "input.dtpFrom2" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
		//release date
		$( ".rowTraining:last" ).find( "input.dtpTo2" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
		
		
	}
function deleteTraining(tbltraining) {
	var table=document.getElementById('tbltraining');
	var rowCount=table.rows.length;
	var rowId=rowCount-1;
	//rowCount-=1;
	if (rowCount>2){
		table.deleteRow(rowId);
	}else if (rowCount<=2){
		alert('You can\'t remove all rows.');
	}
}
</script>
<?php if($model->isNewRecord){ ?>
<fieldset class="myclass"> <!-- Training Programs -->
	<h4><i>VII. TRAINING PROGRAMS (Start from the most recent training)</i></h4>
	<input type="checkbox" id="chkTraining" name="chkTraining" <?php if(isset($_POST['chkTraining'])) echo "checked='checked'"; ?> /> Include</input>
	<?=$training_error?>
	<div class="CSSTableGenerator">
		<table id="tbltraining">
			<tr>
				<td><?php echo $form->labelEx($modTrain,'SeminarTitle', array('style'=>"width: 300px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modTrain,'FromDate', array('style'=>"width: 100px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modTrain,'ToDate', array('style'=>"width: 100px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modTrain,'NoOfHrs', array('style'=>"width: 80px; text-align: center;")); ?></td>
				<td><?php echo $form->labelEx($modTrain,'ConductedBy', array('style'=>"width: 300px; text-align: center;")); ?></td>
			</tr>
			<?php
					$i=0;
					foreach($training_details as $row){
						echo "<tr class='rowTraining'>";
						echo "<td><input type='text' name='EmpTraining[$i][SeminarTitle]' value='".$row['SeminarTitle']."'></td>";
						echo "<td><input type='text' class='dtpFrom2' name='EmpTraining[$i][FromDate]' value='".$row['FromDate']."'></td>";
						echo "<td><input type='text' class='dtpTo2' name='EmpTraining[$i][ToDate]' value='".$row['ToDate']."'></td>";
						echo "<td><input type='text' name='EmpTraining[$i][NoOfHrs]' value='".$row['NoOfHrs']."'></td>";
						echo "<td><input type='text' name='EmpTraining[$i][ConductedBy]' value='".$row['ConductedBy']."'></td>";
						echo "</tr>";
						$i++;						
					}
			?>
		</table>
	</div>
	<p><input id="cloneTraining" type="button" value="Add row" onclick="addTraining()" class="classname" />
	<input id="deltrain" type="button" value="Remove" onclick="deleteTraining(tbltraining)" class="btnGray" /></p>
</fieldset>

<?php }else{ ?>
<fieldset class="myclass"> <!-- Training Programs -->
<?php $data = $model->empTrainings; ?>
	<h4><i>VII. TRAINING PROGRAMS (Start from the most recent training)</i></h4>
	<input type="checkbox" id="chkTraining" name="chkTraining" <?php if(isset($_POST['chkTraining']) || (!empty($data))) echo "checked='checked'"; ?> /> Include</input>
	<?=$training_error; ?>
	<div class="CSSTableGenerator">
		<table id="tbltraining">
			<tr>
				<td>Seminar Title</td>
				<td>From</td>
				<td>To</td>
				<td>No. Of Hours</td>
				<td>Conducted By</td>
			</tr>
			<?php
				if(empty($data)){
					$i=0;
					foreach($training_details as $row){
						echo "<tr class='rowTraining'>";
						echo "<td><input type='text' name='EmpTraining[$i][SeminarTitle]' value='".$row['SeminarTitle']."'></td>";
						echo "<td><input type='text' class='dtpFrom2' name='EmpTraining[$i][FromDate]' value='".$row['FromDate']."'></td>";
						echo "<td><input type='text' class='dtpTo2' name='EmpTraining[$i][ToDate]' value='".$row['ToDate']."'></td>";
						echo "<td><input type='text' name='EmpTraining[$i][NoOfHrs]' value='".$row['NoOfHrs']."'></td>";
						echo "<td><input type='text' name='EmpTraining[$i][ConductedBy]' value='".$row['ConductedBy']."'></td>";
						echo "</tr>";
						$i++;						
					}
				}else{
					foreach($data as $i=>$d){
						echo "<tr class='rowTraining'>";
						echo "<td><input type='text' name='EmpTraining[$i][SeminarTitle]' value='".$trainings[$i]['SeminarTitle']= $d->SeminarTitle."'></td>";
						echo "<td><input type='text' class='dtpFrom2' name='EmpTraining[$i][FromDate]' value='".$trainings[$i]['FromDate']= $d->FromDate."'></td>";
						echo "<td><input type='text' class='dtpTo2' name='EmpTraining[$i][ToDate]' value='".$trainings[$i]['ToDate']= $d->ToDate."'></td>";
						echo "<td><input type='text' name='EmpTraining[$i][NoOfHrs]' value='".$trainings[$i]['NoOfHrs']= $d->NoOfHrs."'></td>";
						echo "<td><input type='text' name='EmpTraining[$i][ConductedBy]' value='".$trainings[$i]['ConductedBy']= $d->ConductedBy."'></td>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
	<p><input id="cloneTraining" type="button" value="Add row" onclick="addTraining()" class="classname" />
	<input id="deltrain" type="button" value="Remove" onclick="deleteTraining(tbltraining)" class="btnGray" /></p>
</fieldset>


<?php } ?>