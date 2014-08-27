<fieldset class="myclass"> <!-- Educ Bg -->
	<h4><i>III. EDUCATIONAL BACKGROUND</i></h4>
	<div class="CSSTableGenerator">
	<table id="myeduc" cellpadding="2">
	
	<tr><td><?php echo $form->labelEx($modEduc,'EducLevel',array('style'=>"width: 180px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'NameofSchool',array('style'=>"width: 220px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'DegreeCourse',array('style'=>"width: 220px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'YearGrad',array('style'=>"width: 90px; text-align: center;")); ?></td>
	<td><?php echo $form->labelEx($modEduc,'HighestEarned', array('style'=>"width: 220px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'FromDate', array('style'=>"width: 80px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'ToDate', array('style'=>"width: 80px; text-align: center;")); ?></td><td><?php echo $form->labelEx($modEduc,'ScholarshipReceived', array('style'=>"width: 250px; text-align: center;")); ?></td></tr>
	
<!-- Elem -->
	<tr>
		
	</tr>
	
	<tr id="myelem"><td><input type="checkbox" name="chkBoxElem" <?php if(isset($_POST['chkBoxElem'])) echo "checked='checked'"; ?> />&nbsp;<?php echo Chtml::textField('EducLevel', EmpEduclvl::model()->FindByPk(1)->EducLevel,array('readonly'=>true,'style'=>"width: 150px;")); ?><?php echo $form->error($modEduc,'Level'); ?></td> 
	
	<td><input type="text" name="EmpEducbg[0][NameofSchool]" <?php if(isset($_POST['chkBoxElem'])) echo "value='EmpEducbg[0][NameofSchool]'"; ?> ></td> 
	
	<td><?php echo $form->textField($modEduc,'DegreeCourse[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($modEduc,'DegreeCourse'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'YearGrad[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'YearGrad'); ?></td>
	
	<td><?php echo $form->textField($modEduc,'HighestEarned[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($model,'HighestEarned'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'FromDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'FromDate'); ?></td>
		
	<td><?php echo $form->dropDownList($modEduc,'ToDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'ToDate'); ?></td>
	
	<td><?php echo $form->textArea($modEduc,'ScholarshipReceived[]',array('rows'=>6, 'cols'=>30, 'style'=>'width: 250px; height: 17px;')); ?><?php echo $form->error($modEduc,'ScholarshipReceived'); ?></td>
	
	</tr> 
	
	<!-- HS -->
	<tr id="myhs"><td><input type="checkbox" name="chkBox[1]">&nbsp;<?php echo Chtml::textField('EducLevel', EmpEduclvl::model()->FindByPk(2)->EducLevel,array('readonly'=>true,'style'=>"width: 150px;")); ?><?php echo $form->error($modEduc,'Level'); ?></td> 
	
	<td><input type="text" name="EmpEducbg[1][NameofSchool]"></td>
	
	<td><?php echo $form->textField($modEduc,'DegreeCourse[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($modEduc,'DegreeCourse'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'YearGrad[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'YearGrad'); ?></td>
	
	<td><?php echo $form->textField($modEduc,'HighestEarned[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($model,'HighestEarned'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'FromDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'FromDate'); ?></td>
		
	<td><?php echo $form->dropDownList($modEduc,'ToDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'ToDate'); ?></td>
	
	<td><?php echo $form->textArea($modEduc,'ScholarshipReceived[]',array('rows'=>6, 'cols'=>30, 'style'=>'width: 250px; height: 17px;')); ?><?php echo $form->error($modEduc,'ScholarshipReceived'); ?></td>
	
	</tr> 
	
	<!-- Vocational -->
	<tr id="myvocational"><td><input type="checkbox" name="chkBox[2]">&nbsp;<?php echo Chtml::textField('EducLevel', EmpEduclvl::model()->FindByPk(3)->EducLevel,array('readonly'=>true,'style'=>"width: 150px;")); ?><?php echo $form->error($modEduc,'Level'); ?></td> 
	
	<td><input type="text" name="EmpEducbg[2][NameofSchool]"></td>
	
	<td><?php echo $form->textField($modEduc,'DegreeCourse[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($modEduc,'DegreeCourse'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'YearGrad[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'YearGrad'); ?></td>
	
	<td><?php echo $form->textField($modEduc,'HighestEarned[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($model,'HighestEarned'); ?><?php echo $form->error($modEduc,'FromDate'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'FromDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?></td>
		
	<td><?php echo $form->dropDownList($modEduc,'ToDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'ToDate'); ?></td>
	
	<td><?php echo $form->textArea($modEduc,'ScholarshipReceived[]',array('rows'=>6, 'cols'=>30, 'style'=>'width: 250px; height: 17px;')); ?><?php echo $form->error($modEduc,'ScholarshipReceived'); ?></td>
	
	</tr> 
	
	<!-- College -->
	<tr id="mycollege"><td><input type="checkbox" name="chkBox[3]">&nbsp;<?php echo Chtml::textField('EducLevel', EmpEduclvl::model()->FindByPk(4)->EducLevel,array('readonly'=>true,'style'=>"width: 150px;")); ?><?php echo $form->error($modEduc,'Level'); ?></td> 
	
	<td><input type="text" name="EmpEducbg[3][NameofSchool]"></td>
	
	<td><?php echo $form->textField($modEduc,'DegreeCourse[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($modEduc,'DegreeCourse'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'YearGrad[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'YearGrad'); ?></td>
	
	<td><?php echo $form->textField($modEduc,'HighestEarned[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($model,'HighestEarned'); ?><?php echo $form->error($modEduc,'FromDate'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'FromDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?></td>
		
	<td><?php echo $form->dropDownList($modEduc,'ToDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'ToDate'); ?></td>
	
	<td><?php echo $form->textArea($modEduc,'ScholarshipReceived[]',array('rows'=>6, 'cols'=>30, 'style'=>'width: 250px; height: 17px;')); ?><?php echo $form->error($modEduc,'ScholarshipReceived'); ?></td>
	
	</tr> 
	
	<!-- Grad Stud -->
	<tr id="mygrad"><td><input type="checkbox" name="chkBox[]">&nbsp;<?php echo Chtml::textField('EducLevel', EmpEduclvl::model()->FindByPk(5)->EducLevel,array('readonly'=>true,'style'=>"width: 150px;")); ?><?php echo $form->error($modEduc,'Level'); ?></td> 
	
	<td><input type="text" name="EmpEducbg[4][NameofSchool]"></td>
	
	<td><?php echo $form->textField($modEduc,'DegreeCourse[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($modEduc,'DegreeCourse'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'YearGrad[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'YearGrad'); ?></td>
	
	<td><?php echo $form->textField($modEduc,'HighestEarned[]',array('size'=>60,'maxlength'=>100)); ?><?php echo $form->error($model,'HighestEarned'); ?></td>
	
	<td><?php echo $form->dropDownList($modEduc,'FromDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'FromDate'); ?></td>
		
	<td><?php echo $form->dropDownList($modEduc,'ToDate[]',$arrYears,array('options' => array($yearNow=>array('selected'=>true)),'style'=>"width: 80px;")); ?><?php echo $form->error($modEduc,'ToDate'); ?></td>
	
	<td><?php echo $form->textArea($modEduc,'ScholarshipReceived[]',array('rows'=>6, 'cols'=>30, 'style'=>'width: 250px; height: 17px;')); ?><?php echo $form->error($modEduc,'ScholarshipReceived'); ?></td>
	
	</tr> 

	</table>
</div>	
</fieldset>