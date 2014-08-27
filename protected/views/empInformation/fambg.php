<fieldset class="myclass"> <!-- Fam Bg -->
	<h4><i>II. FAMILY BACKGROUND</i></h4>
	
	<div class="CSSTableGenerator">
	<table id="spouse">
		<tr>
			<td colspan="4"></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseLname'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseLname'); ?>
				<?php echo $form->error($modelFam,'SpouseLname'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'FatherLname'); ?></td>
			<td><?php echo $form->textField($modelFam,'FatherLname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'FatherLname'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseFname'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseFname'); ?>
				<?php echo $form->error($modelFam,'SpouseFname'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'FatherFname'); ?></td>
			<td><?php echo $form->textField($modelFam,'FatherFname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'FatherFname'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseMname'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseMname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'SpouseMname'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'FatherMname'); ?></td>
			<td><?php echo $form->textField($modelFam,'FatherMname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'FatherMname'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseOccupation'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseOccupation',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($modelFam,'SpouseOccupation'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'MotherMaiden'); ?></td>
			<td><?php echo $form->textField($modelFam,'MotherMaiden',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'MotherMaiden'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseEmployer'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseEmployer',array('size'=>60,'maxlength'=>250)); ?>
				<?php echo $form->error($model,'SpouseEmployer'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'MotherLname'); ?></td>
			<td><?php echo $form->textField($modelFam,'MotherLname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'MotherLname'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseBusinessAddress'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseBusinessAddress',array('size'=>60,'maxlength'=>250)); ?>
				<?php echo $form->error($modelFam,'SpouseBusinessAddress'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'MotherFname'); ?></td>
			<td><?php echo $form->textField($modelFam,'MotherFname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'MotherFname'); ?></td>
		</tr>
		
		<tr>
			<td><?php echo $form->labelEx($modelFam,'SpouseTelno'); ?></td>
			<td><?php echo $form->textField($modelFam,'SpouseTelno',array('size'=>15,'maxlength'=>15)); ?>
				<?php echo $form->error($modelFam,'SpouseTelno'); ?></td>
			<td><?php echo $form->labelEx($modelFam,'MotherMname'); ?></td>
			<td><?php echo $form->textField($modelFam,'MotherMname',array('size'=>50,'maxlength'=>50)); ?>
				<?php echo $form->error($modelFam,'MotherMname'); ?></td>
		</tr>
	</table>
	</div>
	<br><br>
	<?php Yii::import('ext.jqrelcopy.JQRelcopy');
	$datePickerConfig =  array('name'=>'dayofbirth[]',
		'language'=>'en',
		'options'=>array(
			'showOn' => 'focus', 
				//'showAnim'=>'fold', 
				'showButtonPanel' => true,
				'showOtherMonths' => 'true',
				'selectOtherMonths' => 'true',
				'changeMonth' => true,
				'changeYear' => true,
				'dateFormat'=>'yy-mm-dd'
				),
		'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-03-11')		    		    
		    		
				);
	 
	$this->widget('ext.jqrelcopy.JQRelcopy',
				array(
					'id' => 'copylink',
					'removeText' => 'X', //uncomment to add remove link
					'jsAfterNewId' => JQRelcopy::afterNewIdDatePicker($datePickerConfig),
					)
				);
	?>
	<!-- Children tbl -->
<table>	
<tr><td>
	<div class="CSSTableGenerator">
	<table id="mychildren">
		<tr>
			<td><?php echo $form->labelEx($modChild,'ChildName', array('style'=>"width:400px; text-align: center;")); ?></td>
			<td><?php echo $form->labelEx($modChild,'BirthDate', array('style'=>"width:400px; text-align: center;")); ?></td>
		</tr>
	</table>
	</div>
	
<div id="mychildren">
	<div class="row name">
		<?php echo $form->textField($modChild,'ChildName[]',array('style'=>'width:485px;')); ?>
		<?php echo $form->textField($modChild,'BirthDate[]',array('size'=>60,'maxlength'=>100, 'placeholder'=>'yyyy-mm-dd','style'=>'width:450px;')); ?>
		
	</div>
	<div class="row copy">
			<a id="copylink" href="#" rel=".name">Add row</a>
	</div>
</div>
</td><tr>
</table>
</fieldset>