<fieldset class="myclass"> <!-- Educ Bg -->
	<h4><i>III. EDUCATIONAL BACKGROUND</i></h4>
	<div class="CSSTableGenerator">
	<table id="myeduc" cellpadding="2">
	
	<tr><td><?php echo $form->labelEx($modEduc,'EducLevel',array('style'=>"text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'NameofSchool',array('style'=>"width: 220px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'DegreeCourse',array('style'=>"text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'YearGrad',array('style'=>"width:80px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'HighestEarned',array('style'=>"width:150px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'FromDate',array('style'=>"width:80px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'ToDate',array('style'=>"width:80px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'ScholarshipReceived',array('style'=>"width:325px; text-align: center;")); ?></td></tr>
	
<!-- Elem <td>-->
	
	<?php
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
			?>

	</table>
</div>	
</fieldset>