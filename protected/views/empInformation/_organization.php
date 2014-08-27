<script>
var numItems=0;
var rowIdCivil = null;
var tblCivil = null;
var rowId = null;
var rowCount=0;
$(function() {
    $( ".rowCivicorg" ).find( "input.dtpFrom1" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			}); 
	
	$( ".rowCivicorg" ).find( "input.dtpTo1" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
			
	tbl = document.getElementById('voluntary');
	rowId = tbl.rows.length;
 });
function addCivicorg(){
		var tableCvcorg=document.getElementById('voluntary');
		rowCount=tableCvcorg.rows.length;
		var row=tableCvcorg.insertRow(rowCount);
		var rowIdx = tableCvcorg.rows.length;
		row.className = "rowCivicorg";
		rowIdx -= 1;
		row.id = rowId;
		
		//NameAddressOrg
		var cell = row.insertCell(0);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpOrganization_NameAddressOrg";
		element.name = "EmpOrganization["+(rowCount-1)+"][NameAddressOrg]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//FromDate
		var cell = row.insertCell(1);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpOrganization_FromDate";
		element.name = "EmpOrganization["+(rowCount-1)+"][FromDate]";
		element.size = "5";
		element.className="dtpFrom1";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//ToDate
		var cell = row.insertCell(2);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpOrganization_ToDate";
		element.name = "EmpOrganization["+(rowCount-1)+"][ToDate]";
		element.size = "5";
		element.className="dtpTo1";
		element.placeholder="PRESENT";
		cell.appendChild(element);
		
		
		//NoOfHrs
		var cell = row.insertCell(3);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpOrganization_NoOfHrs";
		element.name = "EmpOrganization["+(rowCount-1)+"][NoOfHrs]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		//PositionNatureOfWork
		var cell = row.insertCell(4);
		var element = document.createElement("input");
		element.type = "text";
		element.id="EmpOrganization_PositionNatureOfWork";
		element.name = "EmpOrganization["+(rowCount-1)+"][PositionNatureOfWork]";
		element.size = "5";
		//elemet.style= "width:300px";
		cell.appendChild(element);
		
		
		//date options
		$( ".rowCivicorg:last" ).find( "input.dtpFrom1" )
			.removeAttr( "id" )
			.removeClass( "hasDatepicker" )
			.datepicker({
			  dateFormat: "yy-mm-dd",
			  changeMonth: true,
			  changeYear: true,
			});
		//release date
		$( ".rowCivicorg:last" ).find( "input.dtpTo1" )
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
function deleteVol(voluntary) {
	var table=document.getElementById('voluntary');
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
<fieldset class="myclass"> <!-- Voluntary Work / EmpOrganization -->
	<h4><i>VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</i></h4>
	<input type="checkbox" id="chkOrg" name="chkOrg" <?php if(isset($_POST['chkOrg'])) echo "checked='checked'"; ?> /> Include</input>
	<?=$cvcorg_error;?>
	<div class="CSSTableGenerator">
		<table id="voluntary">
			<tr>
				<td><?php echo $form->labelEx($modOrg,'NameAddressOrg', array('style'=>"width: 300px; text-align: left;")); ?></td>
				<td><?php echo $form->labelEx($modOrg,'FromDate', array('style'=>"width: 100px; text-align: left;")); ?></td>
				<td><?php echo $form->labelEx($modOrg,'ToDate', array('style'=>"width: 100px; text-align: left;")); ?></td>
				<td><?php echo $form->labelEx($modOrg,'NoOfHrs', array('style'=>"width: 80px; text-align: left;")); ?></td>
				<td><?php echo $form->labelEx($modOrg,'PositionNatureOfWork', array('style'=>"width: 300px; text-align: left;")); ?></td>
			</tr>
			<?php
					$i=0;
					foreach($cvcorg_details as $row){
						echo "<tr class='rowCivicorg'>";
						echo "<td><input type='text' name='EmpOrganization[$i][NameAddressOrg]' value='".$row['NameAddressOrg']."'></td>";
						echo "<td><input type='text' class='dtpFrom1' name='EmpOrganization[$i][FromDate]' value='".$row['FromDate']."'></td>";
						echo "<td><input type='text' class='dtpTo1' name='EmpOrganization[$i][ToDate]' value='".$row['ToDate']."' placeholder='PRESENT'></td>";
						echo "<td><input type='text' name='EmpOrganization[$i][NoOfHrs]' value='".$row['NoOfHrs']."'></td>";
						echo "<td><input type='text' name='EmpOrganization[$i][PositionNatureOfWork]' value='".$row['PositionNatureOfWork']."'></td>";
						echo "</tr>";
						$i++;						
					}
			?>
		</table>
	</div>
	<p><input id="cloneCvcorg" type="button" value="Add row" onclick="addCivicorg()" class="classname" />
	<input id="delvol" type="button" value="Remove" onclick="deleteVol(voluntary)" class="btnGray" /></p>
</fieldset>

<?php }else{ ?>
<fieldset class="myclass">
<?php $data = $model->empOrganizations; ?>
	<h4><i>VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</i></h4>
	<input type="checkbox" id="chkOrg" name="chkOrg" <?php if(isset($_POST['chkOrg']) || (!empty($data))) echo "checked='checked'"; ?> /> Include</input>
	<?=$cvcorg_error?>
	<div class="CSSTableGenerator">
		<table id="voluntary">
			<tr>
				<td>Name & Address of Organization (Write in full)</td>
				<td>From</td>
				<td>To</td>
				<td>No. Of Hours</td>
				<td>Position/Nature Of Work </td>
			</tr>
		
		<?php
			if(empty($data)){
				$i=0;
				foreach($cvcorg_details as $row){
					echo "<tr class='rowCivicorg'>";
					echo "<td><input type='text' name='EmpOrganization[$i][NameAddressOrg]' value='".$row['NameAddressOrg']."'></td>";
					echo "<td><input type='text' class='dtpFrom1' name='EmpOrganization[$i][FromDate]' value='".$row['FromDate']."'></td>";
					echo "<td><input type='text' class='dtpTo1' name='EmpOrganization[$i][ToDate]' value='".$row['ToDate']."' placeholder='PRESENT'></td>";
					echo "<td><input type='text' name='EmpOrganization[$i][NoOfHrs]' value='".$row['NoOfHrs']."'></td>";
					echo "<td><input type='text' name='EmpOrganization[$i][PositionNatureOfWork]' value='".$row['PositionNatureOfWork']."'></td>";
					echo "</tr>";
					$i++;						
				}
			}else{
				foreach($data as $i=>$d){
					echo "<tr class='rowCivicorg'>";
					echo "<td><input type='text' name='EmpOrganization[$i][NameAddressOrg]' value='".$civicorgs[$i]['NameAddressOrg']= $d->NameAddressOrg."'></td>";
					echo "<td><input type='text' class='dtpFrom1' name='EmpOrganization[$i][FromDate]' value='".$civicorgs[$i]['FromDate']= $d->FromDate."'></td>";
					echo "<td><input type='text' class='dtpTo1' name='EmpOrganization[$i][ToDate]' value='".$civicorgs[$i]['ToDate']= $d->ToDate."' placeholder='PRESENT'></td>";
					echo "<td><input type='text' name='EmpOrganization[$i][NoOfHrs]' value='".$civicorgs[$i]['NoOfHrs']= $d->NoOfHrs."'></td>";
					echo "<td><input type='text' name='EmpOrganization[$i][PositionNatureOfWork]' value='".$civicorgs[$i]['PositionNatureOfWork']= $d->PositionNatureOfWork."'></td>";
					echo "</tr>";
				}
			}
		?>
		</table>
	</div>
	<p><input id="cloneCvcorg" type="button" value="Add row" onclick="addCivicorg()" class="classname" />
	<input id="delvol" type="button" value="Remove" onclick="deleteVol(voluntary)" class="btnGray" /></p>
</fieldset>
<?php } ?>