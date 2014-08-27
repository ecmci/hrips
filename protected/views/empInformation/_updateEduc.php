<fieldset class="myclass">
	<?php $data = $model->empEducbgs; ?>
	<h4><i>III. EDUCATIONAL BACKGROUND</i></h4>
	<div class="CSSTableGenerator">
			<table id="tblEduc">
				<tr>
					<td>Level</td>
					<td>Name of School (Write in full)</td>
					<td>Degree Course (Write in full)</td>
					<td>Year Graduated (if graduated)</td>
					<td>Highest Grade/Level/Units Earned (if not graduated)</td>
					<td>From</td>
					<td>To</td>
					<td>Scholarship/Academic Honors Received</td>
				</tr>
				
					<?php
						if (empty($data)){
							$i=0;
							foreach($educ_details as $row){
								echo "<tr>";
								echo "<td><input type='text' style='width:130px' name='EmpEducbg[$i][EducLevel]' value='".$row['EducLevel']."' disabled='disabled'></td>";
								echo "<td><input type='text' name='EmpEducbg[$i][NameofSchool]' value='".$row['NameofSchool']."'></td>";
								echo "<td><input type='text' name='EmpEducbg[$i][DegreeCourse]' value='".$row['DegreeCourse']."'></td>";
								echo "<td><input type='text' style='width:80px' name='EmpEducbg[$i][YearGrad]' value='".$row['YearGrad']."'></td>";
								echo "<td><input type='text' style='width:150px' name='EmpEducbg[$i][HighestEarned]' value='".$row['HighestEarned']."'></td>";
								echo "<td><input type='text' style='width:80px' name='EmpEducbg[$i][FromDate]' value='".$row['FromDate']."'></td>";
								echo "<td><input type='text' style='width:80px' name='EmpEducbg[$i][ToDate]' value='".$row['ToDate']."'></td>";
								echo "<td><textarea rows=14' cols='50' style='width: 325px; height: 17px;' name='EmpEducbg[$i][ScholarshipReceived]'>".$row['ScholarshipReceived']."</textarea></td>";
								echo "</tr>";
								$i++;							
							}
						}else{
							foreach($data as $i=>$d){
								echo "<tr>";
								echo "<td><input type='text' style='width:130px' name='EmpEducbg[$i][EducLevel]' value='".$education[$i]['EducLevel'] = $d->educLevel['EducLevel']."' disabled='disabled'></td>";
								echo "<td><input type='text' name='EmpEducbg[$i][NameofSchool]' value='".$education[$i]['NameofSchool']= $d->NameofSchool."'></td>";
								echo "<td><input type='text' name='EmpEducbg[$i][DegreeCourse]' value='".$education[$i]['DegreeCourse']= $d->DegreeCourse."'></td>";
								echo "<td><input type='text' style='width:80px' name='EmpEducbg[$i][YearGrad]' value='".$education[$i]['YearGrad']= $d->YearGrad."'></td>";
								echo "<td><input type='text' style='width:150px' name='EmpEducbg[$i][HighestEarned]' value='".$education[$i]['HighestEarned']= $d->HighestEarned."'></td>";
								echo "<td><input type='text' style='width:80px' name='EmpEducbg[$i][FromDate]' value='".$education[$i]['FromDate']= $d->FromDate."'></td>";
								echo "<td><input type='text' style='width:80px' name='EmpEducbg[$i][ToDate]' value='".$education[$i]['ToDate']= $d->ToDate."'></td>";
								echo "<td><textarea rows=14' cols='50' style='width: 325px; height: 17px;' name='EmpEducbg[$i][ScholarshipReceived]'>".$education['ScholarshipReceived']= $d->ScholarshipReceived."</textarea></td>";
								echo "</tr>";
							}
						}
					?>
			</table>
	</div>
</fieldset>	