<fieldset class="myclass">
<center><table width="50%">
<tr><td>
	<?php $data = $model->empChildrens; ?>
	<input type="checkbox" id="chkChildren1" name="chkMychild" <?php if(isset($_POST['chkMychild']) || (!empty($data))) echo "checked='checked'"; ?> /> Include</input>
	<div class="CSSTableGenerator">
		
		<table id="tblChildren">
			<tr>
				<td>ChildName</td>
				<td>BirthDate</td>
			</tr>
			
				<?php
					if (!empty($data)){
						$i=0;
						foreach($children_details as $row){
							echo "<tr class='row1'>";
							echo "<td><input style='width: 300px' type='text' name='EmpChildren[$i][ChildName]' value='".$row['ChildName']."'></td>";
							echo "<td><input maxlength='100' size='50' type='text' class='mydatepicker' id='EmpChildren_BirthDate0' name='EmpChildren[$i][BirthDate]' value='".$row['BirthDate']."'></td>";
							
							
							echo "</tr>";
							$i++;						
						}
					}else{
					
						foreach($data as $i=>$d){
							echo "<tr class='row1'>";
							echo "<td><input type='text' name='EmpChildren[$i][ChildName]' value='".$children[$i]['ChildName'] = $d->ChildName."'></td>";
							echo "<td><input maxlength='100' size='50' type='text' class='mydatepicker' id='EmpChildren_BirthDate0' name='EmpChildren[$i][BirthDate]' value='".$children[$i]['BirthDate'] = $d->BirthDate."'></td>";
							echo "</tr>";
						}
					}
				?>
		</table>
	</div>
	
</td></tr>
</table>
<p><input id="clone" id="clone" type="button" value="Add Item" onclick="addChild()" /></p>
</center>
</fieldset>