<script>
var numItems=0;
var rowIdCivil = null;
var tblCivil = null;
var rowId = null;
var rowCount=0;
$(function() {
	tbl = document.getElementById('tblref');
	rowId = tbl.rows.length;
 });
function addRef(){
		var tableRef=document.getElementById('tblref');
		rowCount=tableRef.rows.length;
		var row=tableRef.insertRow(rowCount);
		var rowIdx = tableRef.rows.length;
		row.className = "rowRef";
		rowIdx -= 1;
		row.id = rowId;
		
		//RefName
		var cell = row.insertCell(0);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpRef_RefName";
		element.name = "EmpRef["+(rowCount-1)+"][RefName]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//RefAdd
		var cell = row.insertCell(1);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpRef_RefAdd";
		element.name = "EmpRef["+(rowCount-1)+"][RefAdd]";
		element.size = "5";
		cell.appendChild(element);
		
		//TelNo
		var cell = row.insertCell(2);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpRef_Telno";
		element.name = "EmpRef["+(rowCount-1)+"][Telno]";
		element.size = "5";
		cell.appendChild(element);
		
	}
function deleteRef(tblref) {
	var table=document.getElementById('tblref');
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
<fieldset class="myclass"> <!-- References -->
	<h4><i>X. REFERENCES <font color="red">(Person not related by consanguinity or affinity to applicant / appointee)</font></i></h4>
	<?=$ref_error;?>
	<div class="CSSTableGenerator">
		<table id="tblref">
			<tr>
				<td width="40%"><?php echo $form->labelEx($modRef,'RefName',array('style'=>"width: 350px; text-align: left;")); ?></td>
				<td width="40%"><?php echo $form->labelEx($modRef,'RefAdd',array('style'=>"width: 350px;text-align: left;")); ?></td>
				<td width="20%"><?php echo $form->labelEx($modRef,'Telno',array('style'=>"text-align: left;")); ?></td>
			</tr>
			<?php
					$i=0;
					foreach($ref_details as $row){
						echo "<tr class='rowRef'>";
						echo "<td><input type='text' name='EmpRef[$i][RefName]' value='".$row['RefName']."'></td>";
						echo "<td><input type='text' name='EmpRef[$i][RefAdd]' value='".$row['RefAdd']."'></td>";
						echo "<td><input type='text' name='EmpRef[$i][Telno]' value='".$row['Telno']."'></td>";
						echo "</tr>";
						$i++;						
					}
			?>
		</table>
	</div>
	<p><input id="cloneRef" type="button" value="Add row" onclick="addRef()" class="classname" />
	<input id="delref" type="button" value="Remove" onclick="deleteRef(tblref)" class="btnGray" /></p>
</fieldset>

<?php }else{ ?>
<fieldset class="myclass"> <!-- References -->
<?php $data = $model->empRefs; ?>
	<h4><i>X. REFERENCES <font color="red">(Person not related by consanguinity or affinity to applicant / appointee)</font></i></h4>
	<div class="CSSTableGenerator">
		<table id="tblref">
			<tr>
				<td style="text-align: left">Name</td>
				<td style="text-align: left">Address</td>
				<td style="text-align: left">Tel. No</td>
			</tr>
			<?php
				if(empty($data)){
					$i=0;
					foreach($ref_details as $row){
						echo "<tr class='rowRef'>";
						echo "<td><input type='text' name='EmpRef[$i][RefName]' value='".$row['RefName']."'></td>";
						echo "<td><input type='text' name='EmpRef[$i][RefAdd]' value='".$row['RefAdd']."'></td>";
						echo "<td><input type='text' name='EmpRef[$i][Telno]' value='".$row['Telno']."'></td>";
						echo "</tr>";
						$i++;						
					}
				}else{
					foreach($data as $i=>$d){
						echo "<tr class='rowRef'>";
						echo "<td><input type='text' name='EmpRef[$i][RefName]' value='".$refs[$i]['RefName']= $d->RefName."'></td>";
						echo "<td><input type='text' name='EmpRef[$i][RefAdd]' value='".$refs[$i]['RefAdd']= $d->RefAdd."'></td>";
						echo "<td><input type='text' name='EmpRef[$i][Telno]' value='".$refs[$i]['Telno']= $d->Telno."'></td>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
	<p><input id="cloneRef" type="button" value="Add row" onclick="addRef()" class="classname" />
	<input id="delref" type="button" value="Remove" onclick="deleteRef(tblref)" class="btnGray" /></p>
</fieldset>



<?php } ?>