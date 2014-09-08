<?php
/* @var $this EmpInformationController */
/* @var $model EmpInformation */
/* @var $form CActiveForm */
?>

<script type="text/javascript">

    var numItems=0;
    var rowId = null;
    var rowIdCivil = null;
    var tbl = null;
    var tblCivil = null;

    function countRows(){
        //var numItems = $('.hasDatepicker').length;
        numItems = $('#mychildren .hasDatepicker').length;
        var i=1;
        for (i=1; i<=numItems; i++)
        {
            //alert(i);
        }
    }

    function setFieldid(){
        var listItem = $('#mychildren .hasDatepicker');
        alert('Index: ' + $('class').index(listItem));

    }

    function hideMe(){
        var chkme=document.getElementById('chkChildren');
        if(chkme.checked){
            //alert ("Checked!");
            document.getElementById('hideChildren').style.visibility='visible';
        }else{
            document.getElementById('hideChildren').style.visibility='hidden';
        }
    }

    function addChild(){
        var table=document.getElementById('tblChildren');
        var rowCount=table.rows.length;
        var row=table.insertRow(rowCount);
        var rowIdx = table.rows.length;
        row.className = "row1";
        rowIdx -= 1;
        row.id = rowId;
		
        //childname
        var cell = row.insertCell(0);
        var element = document.createElement("input");
        element.type = "text";
        element.id="EmpChildren_ChildName";
        element.name = "EmpChildren["+(rowCount-1)+"][ChildName]";
        element.size = "5";
        //elemet.style= "width:300px";
        cell.appendChild(element);
		
        //bday
        var cell = row.insertCell(1);
        var element = document.createElement("input");
        element.type = "text";
        element.id="EmpChildren_BirthDate";
        element.name = "EmpChildren["+(rowCount-1)+"][BirthDate]";
        element.size = "5";
        element.className="mydatepicker";
        cell.appendChild(element);
        $( ".row1:last" ).find( "input.mydatepicker" )
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

	
    $(function() {
        $( ".row1" ).find( "input.mydatepicker" )
        .removeAttr( "id" )
        .removeClass( "hasDatepicker" )
        .datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        }); 
        tbl = document.getElementById('tblChildren');
        rowId = tbl.rows.length;
	
	
	
	
    });
    function deleteRow(tblChildren) {
        var table=document.getElementById('tblChildren');
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
<script type="text/css">
    .border_bottom{
    tr.border_bottom td {
    border-bottom:1pt solid black;
    }
    }
</script>
<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'emp-information-form',
        'enableAjaxValidation' => false,
            ));
    ?>
    <?php
    $yearNow = date("Y");
    $yearFrom = $yearNow - 100;
    $yearTo = $yearNow;
    $arrYears = array();
    foreach (range($yearTo, $yearFrom) as $number) {
        $arrYears[$number] = $number;
    }
    $arrYears = array_reverse($arrYears, true);

    /* yes no */
    $arrYesNo = array('1' => 'Yes', '0' => 'No');
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <p class="note">Use <b>UPPERCASE</b> in filling up the form.</p>

    <?php echo $form->errorSummary(array($model, $modelFam, $modChild, $modEduc, $modCivil, $modWork, $modOrg, $modTrain, $modOther, $modQueries, $modRef)); ?>
    <?php if (!empty($children_error)) {
        echo "<div class='errorSummary'>Please fix the following input errors in the <b>Children</b> section</div>";
    } ?>
    <?php if (!empty($cvlservice_error)) {
        echo "<div class='errorSummary'>Please fix the following input errors in the <b>Civil Service Eligibility</b> section</div>";
    } ?>
    <?php if (!empty($workexp_error)) {
        echo "<div class='errorSummary'>Please fix the following input errors in the <b>Work Experience</b> section</div>";
    } ?>
<?php if (!empty($cvcorg_error)) {
    echo "<div class='errorSummary'>Please fix the following input errors in the <b>Voluntary Work</b> section</div>";
} ?>
<?php if (!empty($training_error)) {
    echo "<div class='errorSummary'>Please fix the following input errors in the <b>Training Programs</b> section</div>";
} ?>
<?php if (!empty($ref_error)) {
    echo "<div class='errorSummary'>Please fix the following input errors in the <b>References</b> section</div>";
} ?>
                        <?php //if($query_error==0){ echo "<div class='errorSummary'>Please answer all the questions in section <b>IX</b>.</div>"; }else { echo '<br><br>no error';} ?>
    <fieldset class="myclass"> <!--Personal info ;-->
        <h4><i>I. PERSONAL INFORMATION</i></h4>
        <div class="CSSTableGenerator">
            <table id="personalinfo" border="1">
                <tr>
                    <td colspan="5"></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'EmpID'); ?></td>
                    <td colspan="4"><?php echo $form->textField($model, 'EmpID', array('readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'EmpID'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'FirstName'); ?></td>
                    <td colspan="4"><?php echo $form->textField($model, 'FirstName', array('style' => 'width:790px;')); ?>
                        <?php echo $form->error($model, 'FirstName'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'LastName'); ?></td>
                    <td colspan="4"><?php echo $form->textField($model, 'LastName', array('style' => 'width:790px;')); ?>
<?php echo $form->error($model, 'LastName'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'MiddleName'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'MiddleName', array('size' => 50, 'maxlength' => 50, 'style' => 'width:370px')); ?>
                        <?php echo $form->error($model, 'MiddleName'); ?></td>
                    <td><?php echo $form->labelEx($model, 'NameExt'); ?></td>
                    <td><?php echo $form->textField($model, 'NameExt', array('size' => 10, 'maxlength' => 10, 'style' => 'width:200px')); ?>
                        <?php echo $form->error($model, 'NameExt'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'BirthDate'); ?></td>
                    <td><?php echo $form->textField($model, 'BirthDate', array('size' => 60, 'maxlength' => 100, 'readonly' => 'readonly')); ?>
                        <?php /* $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                          'model'=>$model,
                          //'id'=>'mybday',
                          'name'=>'EmpInformation[BirthDate]',
                          'value'=>$model->BirthDate,
                          'htmlOptions'=>array('required'=>'required','placeholder'=>'e.g., 2013-03-11'),
                          'options'=>array(
                          'showAnim'=>'fade',
                          'dateFormat'=>'yy-mm-dd',
                          'changeMonth' => true,
                          'changeYear' => true,
                          'minDate'=>'-150y',
                          'maxDate' => '0',
                          'yearRange'=>'-150:-0'
                          ),
                          'language' => '',
                          //'mode'=>'date',
                          )); */ ?>
<?php echo $form->error($model, 'BirthDate'); ?></td>
                    <td rowspan="2"><?php echo $form->labelEx($model, 'ResidentialAddress'); ?></td>
                    <td colspan="2" rowspan="2"><?php echo $form->textArea($model, 'ResidentialAddress', array('rows' => 6, 'cols' => 30, 'style' => 'width: 380px; height: 72px;')); ?>
<?php echo $form->error($model, 'ResidentialAddress'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'BdayPlace'); ?></td>
                    <td><?php echo $form->textField($model, 'BdayPlace', array('size' => 60, 'maxlength' => 100, 'readonly' => 'readonly')); ?>
<?php echo $form->error($model, 'BdayPlace'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'Gender'); ?></td>
                    <td><?php echo $form->dropDownList($model, 'Gender', array('1' => 'Male', '2' => 'Female'), array('required' => 'required', 'prompt' => '- select -', 'readonly' => 'readonly')); ?></td>
                    <td><?php echo $form->labelEx($model, 'RAZipCode'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'RAZipCode', array('size' => 15, 'maxlength' => 15, 'style' => "width:380px;")); ?>
<?php echo $form->error($model, 'RAZipCode'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'CivilStat'); ?></td>
                    <td><?php echo $form->dropDownList($model, 'CivilStat', array('1' => 'Single', '2' => 'Married'), array('required' => 'required', 'prompt' => '- select -')); ?>
                        <?php echo $form->error($model, 'CivilStat'); ?></td>
                    <td><?php echo $form->labelEx($model, 'RATelno'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'RATelno', array('size' => 30, 'maxlength' => 30, 'style' => "width:380px;")); ?>
<?php echo $form->error($model, 'RATelno'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'Citizenship'); ?></td>
                    <td><?php echo $form->textField($model, 'Citizenship', array('size' => 20, 'maxlength' => 20, 'readonly' => 'readonly')); ?>
<?php echo $form->error($model, 'Citizenship'); ?></td>
                    <td rowspan="2"><?php echo $form->labelEx($model, 'HomeAddress'); ?></td>
                    <td colspan="2" rowspan="2"><?php echo $form->textArea($model, 'HomeAddress', array('rows' => 6, 'cols' => 30, 'style' => 'width: 380px; height: 72px;')); ?>
                        <?php echo $form->error($model, 'HomeAddress'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'Height'); ?></td>
                    <td><?php echo $form->textField($model, 'Height', array('size' => 10, 'maxlength' => 10)); ?>
<?php echo $form->error($model, 'Height'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'Weight'); ?></td>
                    <td><?php echo $form->textField($model, 'Weight', array('size' => 10, 'maxlength' => 10)); ?>
                        <?php echo $form->error($model, 'Weight'); ?></td>
                    <td><?php echo $form->labelEx($model, 'HAZipCode'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'HAZipCode', array('size' => 15, 'maxlength' => 15, 'style' => "width:380px;")); ?>
<?php echo $form->error($model, 'HAZipCode'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'BloodType'); ?></td>
                    <td><?php echo $form->textField($model, 'BloodType', array('size' => 5, 'maxlength' => 5, 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'BloodType'); ?></td>
                    <td><?php echo $form->labelEx($model, 'HATelno'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'HATelno', array('size' => 30, 'maxlength' => 30, 'style' => "width:380px;")); ?>
<?php echo $form->error($model, 'HATelno'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'HDMF'); ?></td>
                    <td><?php echo $form->textField($model, 'HDMF', array('size' => 20, 'maxlength' => 20, 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'HDMF'); ?></td>
                    <td><?php echo $form->labelEx($model, 'EmailAddress'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'EmailAddress', array('size' => 25, 'maxlength' => 25, 'style' => "width:380px;")); ?>
<?php echo $form->error($model, 'EmailAddress'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'PHIC'); ?></td>
                    <td><?php echo $form->textField($model, 'PHIC', array('size' => 20, 'maxlength' => 20, 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'PHIC'); ?></td>
                    <td><?php echo $form->labelEx($model, 'ContactNo'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'ContactNo', array('size' => 25, 'maxlength' => 25, 'style' => "width:380px;")); ?>
<?php echo $form->error($model, 'ContactNo'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'SSS'); ?></td>
                    <td><?php echo $form->textField($model, 'SSS', array('size' => 20, 'maxlength' => 20, 'readonly' => 'readonly')); ?>
<?php echo $form->error($model, 'SSS'); ?></td>
                    <td><?php echo $form->labelEx($model, 'TIN'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'TIN', array('size' => 20, 'maxlength' => 20, 'style' => "width:380px;", 'readonly' => 'readonly')); ?>
<?php echo $form->error($model, 'TIN'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'Position'); ?></td>
                    <td><?php echo $form->textField($model, 'Position', array('readonly' => 'readonly')); ?><?php echo $form->error($model, 'AgencyEmpNo'); ?></td>
                    <td><?php echo $form->labelEx($model, 'Department'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'Department', array('readonly' => 'readonly')); ?><?php echo $form->error($model, 'AgencyEmpNo'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'AgencyEmpNo'); ?></td>
                    <td><?php echo $form->textField($model, 'AgencyEmpNo'); ?><?php echo $form->error($model, 'AgencyEmpNo'); ?></td>
                    <td><?php echo $form->labelEx($model, 'DateHire'); ?></td>
                    <td colspan="2"><?php echo $form->textField($model, 'DateHire', array('readonly' => 'readonly')); ?><?php echo $form->error($model, 'AgencyEmpNo'); ?></td>

                </tr>

            </table>

        </div>

    </fieldset>

    <fieldset class="myclass"> <!-- EMERGENCY CONTACT DETAILS -->
        <center><table width="50%">
                <tr><td>
                        <div class="CSSTableGenerator">
                            <table id="emgcontact">
                                <tr>
                                    <td colspan="2">In case of emergency, please notify:</td>
                                </tr>
                                <tr>
                                    <td><?php echo $form->labelEx($model, 'EMGName'); ?></td>
                                    <td><?php echo $form->textField($model, 'EMGName'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form->labelEx($model, 'EMGAddress'); ?></td>
                                    <td><?php echo $form->textField($model, 'EMGAddress'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form->labelEx($model, 'EMGRelation'); ?></td>
                                    <td><?php echo $form->textField($model, 'EMGRelation'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $form->labelEx($model, 'EMGContactNum'); ?></td>
                                    <td><?php echo $form->textField($model, 'EMGContactNum'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </td></tr>
            </table></center>
    </fieldset>

    <fieldset class="myclass"> <!-- Fam Bg -->
        <h4><i>II. FAMILY BACKGROUND</i></h4>

        <div class="CSSTableGenerator">
            <table id="spouse">
                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseLname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseLname'); ?>
                        <?php echo $form->error($modelFam, 'SpouseLname'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'FatherLname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'FatherLname', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($modelFam, 'FatherLname'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseFname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseFname'); ?>
                        <?php echo $form->error($modelFam, 'SpouseFname'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'FatherFname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'FatherFname', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($modelFam, 'FatherFname'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseMname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseMname', array('size' => 50, 'maxlength' => 50)); ?>
                        <?php echo $form->error($modelFam, 'SpouseMname'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'FatherMname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'FatherMname', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($modelFam, 'FatherMname'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseOccupation'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseOccupation', array('size' => 60, 'maxlength' => 100)); ?>
                        <?php echo $form->error($modelFam, 'SpouseOccupation'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'MotherMaiden'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'MotherMaiden', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($modelFam, 'MotherMaiden'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseEmployer'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseEmployer', array('size' => 60, 'maxlength' => 250)); ?>
                        <?php echo $form->error($model, 'SpouseEmployer'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'MotherLname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'MotherLname', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($modelFam, 'MotherLname'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseBusinessAddress'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseBusinessAddress', array('size' => 60, 'maxlength' => 250)); ?>
                        <?php echo $form->error($modelFam, 'SpouseBusinessAddress'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'MotherFname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'MotherFname', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($modelFam, 'MotherFname'); ?></td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($modelFam, 'SpouseTelno'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'SpouseTelno', array('size' => 15, 'maxlength' => 15)); ?>
        <?php echo $form->error($modelFam, 'SpouseTelno'); ?></td>
                    <td><?php echo $form->labelEx($modelFam, 'MotherMname'); ?></td>
                    <td><?php echo $form->textField($modelFam, 'MotherMname', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($modelFam, 'MotherMname'); ?></td>
                </tr>
            </table>
        </div>
        <br><br>
        <?php
        Yii::import('ext.jqrelcopy.JQRelcopy');
        $datePickerConfig = array('name' => 'dayofbirth[]',
            'language' => 'en',
            'options' => array(
                'showOn' => 'focus',
                //'showAnim'=>'fold', 
                'showButtonPanel' => true,
                'showOtherMonths' => 'true',
                'selectOtherMonths' => 'true',
                'changeMonth' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array('required' => 'required', 'placeholder' => 'e.g., 2013-03-11')
        );

        $this->widget('ext.jqrelcopy.JQRelcopy', array(
            'id' => 'copylink',
            'removeText' => 'X', //uncomment to add remove link
            'jsAfterNewId' => JQRelcopy::afterNewIdDatePicker($datePickerConfig),
                )
        );
        ?>
        <!-- Children tbl -->

        <center><table width="50%">
                <tr><td>

                        <input type="checkbox" id="chkChildren1" name="chkMychild" <?php if (isset($_POST['chkMychild'])) echo "checked='checked'"; ?> /> Include</input>
                                <?= $children_error ?>
                        <div class="CSSTableGenerator">

                            <table id="tblChildren">
                                <tr>
                                    <td><?php echo $form->labelEx($modChild, 'ChildName', array('style' => "text-align: center;")); ?></td>
                                    <td><?php echo $form->labelEx($modChild, 'BirthDate', array('style' => "text-align: center;")); ?></td>
                                </tr>

                                <?php
                                $i = 0;
                                foreach ($children_details as $row) {
                                    echo "<tr class='row1'>";
                                    echo "<td><input type='text' name='EmpChildren[$i][ChildName]' value='" . $row['ChildName'] . "'></td>";
                                    echo "<td><input type='text' class='mydatepicker' id='EmpChildren_BirthDate0' name='EmpChildren[$i][BirthDate]' value='" . $row['BirthDate'] . "'></td>";

                                    /* echo "<td>".$form->textField($modChild,'[$i]ChildName')."</td>";
                                      echo "<td>".$form->textField($modChild,'[$i]BirthDate', array('class'=>'mydatepicker', 'id'=>'EmpChildren_BirthDate0'))."</td>"; */
                                    echo "</tr>";
                                    $i++;
                                }
                                ?>
                            </table>
                        </div>

                    </td></tr>
            </table>
            <p><input id="clone" id="clone" type="button" value="Add Child" onclick="addChild()" class="classname" />
                <input id="btndelchild" id="btndelchild" type="button" value="Remove" onclick="deleteRow()" class="btnGray" /></p>
        </center>
    </fieldset>

    <!-- import for "EmpEducbg" -->
    <?php include '_eductbl.php'; ?>

    <!-- import for "EmpCivilservice" -->
    <?php include '_cvlservice.php'; ?>
    <!--
    <div class="row civil">
    <?php echo $form->textField($modCivil, 'CareerService[]', array('size' => 60, 'maxlength' => 300, 'style' => 'width: 262px;')); ?>
    <?php echo $form->error($modCivil, 'CareerService'); ?>
            
    <?php echo $form->textField($modCivil, 'Rating[]', array('size' => 60, 'maxlength' => 100, 'style' => 'width: 112px;')); ?>
    <?php echo $form->error($modCivil, 'Rating'); ?>
            
<?php echo $form->textField($modCivil, 'DateExam[]', array('style' => 'width: 112px;')); ?>
    <?php echo $form->error($modCivil, 'DateExam'); ?>
            
    <?php echo $form->textField($modCivil, 'ExamPlace[]', array('size' => 60, 'maxlength' => 200, 'style' => 'width: 195px;')); ?>
    <?php echo $form->error($modCivil, 'ExamPlace'); ?>
            
    <?php echo $form->textField($modCivil, 'LicenseNumber[]', array('size' => 30, 'maxlength' => 30, 'style' => 'width: 105px;')); ?>
    <?php echo $form->error($modCivil, 'LicenseNumber'); ?>
            
    <?php echo $form->textField($modCivil, 'ReleaseDate[]', array('style' => 'width: 100px;')); ?>
<?php echo $form->error($modCivil, 'ReleaseDate'); ?>
    </div>
    
<?php
Yii::import('ext.jqrelcopy.JQRelcopy');
$this->widget('ext.jqrelcopy.JQRelcopy', array(
    'id' => 'copyCivil',
    'removeText' => 'X', //uncomment to add remove link
        )
);
?>
    
    <div class="row copy">
                    <a id="copyCivil" href="#" rel=".civil">Add row</a>
    </div>
    -->

    <!-- import for "EmpWorkexp" -->
    <?php include '_workexp.php'; ?>

    <!--
            <div class="row workexp">
    <?php echo $form->textField($modWork, 'FromDate[]', array('style' => "width: 110px;")); ?>
    <?php echo $form->error($modWork, 'FromDate'); ?>
                    
    <?php echo $form->textField($modWork, 'ToDate[]', array('style' => "width: 110px;")); ?>
    <?php echo $form->error($modWork, 'ToDate'); ?>
                    
    <?php echo $form->textField($modWork, 'PositionTitle[]', array('size' => 60, 'maxlength' => 100, 'style' => "width: 254px;")); ?>
    <?php echo $form->error($modWork, 'PositionTitle'); ?>
                    
    <?php echo $form->textField($modWork, 'Company[]', array('size' => 60, 'maxlength' => 100, 'style' => "width: 208px;")); ?>
    <?php echo $form->error($modWork, 'Company'); ?>
                    
<?php echo $form->textField($modWork, 'MonthlySalary[]', array('size' => 20, 'maxlength' => 20, 'style' => "width: 109px;")); ?>
    <?php echo $form->error($modWork, 'MonthlySalary'); ?>
                    
    <?php echo $form->textField($modWork, 'SalaryGrade[]', array('size' => 15, 'maxlength' => 15, 'style' => "width: 157px;")); ?>
    <?php echo $form->error($modWork, 'SalaryGrade'); ?>
                    
    <?php echo $form->textField($modWork, 'StatAppointment[]', array('size' => 20, 'maxlength' => 20, 'style' => "width: 109px;")); ?>
    <?php echo $form->error($modWork, 'StatAppointment'); ?>
                    
    <?php echo $form->dropDownList($modWork, 'GovtService[]', $arrYesNo, array('style' => "width: 80px;")); ?>
<?php echo $form->error($modWork, 'GovtService'); ?>
            </div>
            
<?php
Yii::import('ext.jqrelcopy.JQRelcopy');
$this->widget('ext.jqrelcopy.JQRelcopy', array(
    'id' => 'copyWork',
    'removeText' => 'X', //uncomment to add remove link
        )
);
?>
            
            <div class="row copy">
                            <a id="copyWork" href="#" rel=".workexp">Add row</a>
            </div>
    -->	

    <!-- import for "EmpOrganization" -->
    <?php include '_organization.php'; ?>
    <!--
            <div class="row orgcivic">
    <?php echo $form->textField($modOrg, 'NameAddressOrg[]', array('size' => 60, 'maxlength' => 300, 'style' => "width: 315px;")); ?>
    <?php echo $form->error($modOrg, 'NameAddressOrg'); ?>
                    
<?php echo $form->textField($modOrg, 'FromDate[]', array('style' => "width: 100px;")); ?>
    <?php echo $form->error($modOrg, 'FromDate'); ?>
                    
    <?php echo $form->textField($modOrg, 'ToDate[]', array('style' => "width: 108px;")); ?>
    <?php echo $form->error($modOrg, 'ToDate'); ?>
                    
    <?php echo $form->textField($modOrg, 'NoOfHrs[]', array('size' => 20, 'maxlength' => 20, 'style' => "width: 90px;")); ?>
    <?php echo $form->error($modOrg, 'NoOfHrs'); ?>
                    
    <?php echo $form->textField($modOrg, 'PositionNatureOfWork[]', array('size' => 60, 'maxlength' => 100, 'style' => "width: 290px;")); ?>
<?php echo $form->error($modOrg, 'PositionNatureOfWork'); ?>
            </div>
            
<?php
Yii::import('ext.jqrelcopy.JQRelcopy');
$this->widget('ext.jqrelcopy.JQRelcopy', array(
    'id' => 'copyOrgcivic',
    'removeText' => 'X', //uncomment to add remove link
        )
);
?>
            
            <div class="row copy">
                            <a id="copyOrgcivic" href="#" rel=".orgcivic">Add row</a>
            </div>
    -->

    <!-- import for "EmpTraining" -->
    <?php include '_training.php'; ?>
    <!--	
            <div class="row training">
    <?php echo $form->textField($modTrain, 'SeminarTitle[]', array('size' => 60, 'maxlength' => 150, 'style' => "width: 315px;")); ?>
    <?php echo $form->error($modTrain, 'SeminarTitle[]'); ?>
                    
<?php echo $form->textField($modTrain, 'FromDate[]', array('style' => "width: 100px;")); ?>
    <?php echo $form->error($modTrain, 'FromDate[]'); ?>
                    
    <?php echo $form->textField($modTrain, 'ToDate[]', array('style' => "width: 108px;")); ?>
    <?php echo $form->error($modTrain, 'ToDate[]'); ?>
                    
    <?php echo $form->textField($modTrain, 'NoOfHrs[]', array('size' => 20, 'maxlength' => 20, 'style' => "width: 90px;")); ?>
    <?php echo $form->error($modTrain, 'NoOfHrs'); ?>
                    
    <?php echo $form->textField($modTrain, 'ConductedBy[]', array('size' => 60, 'maxlength' => 100, 'style' => "width: 290px;")); ?>
<?php echo $form->error($modTrain, 'ConductedBy[]'); ?>
            </div>
            
<?php
Yii::import('ext.jqrelcopy.JQRelcopy');
$this->widget('ext.jqrelcopy.JQRelcopy', array(
    'id' => 'copyTraining',
    'removeText' => 'X', //uncomment to add remove link
        )
);
?>
            
            <div class="row copy">
                            <a id="copyTraining" href="#" rel=".training">Add row</a>
            </div>
    -->


    <fieldset class="myclass"> <!-- Other Info -->
        <h4><i>VIII. OTHER INFORMATION</i></h4>
        <div class="CSSTableGenerator">
            <table id="otherinfo">
                <tr>
                    <td><?php echo $form->labelEx($modOther, 'SkillsHobbies', array('style' => "width: 250px; text-align: center;")); ?></td>
                    <td><?php echo $form->labelEx($modOther, 'NonAcadRecognition', array('style' => "width: 250px; text-align: center;")); ?></td>
                    <td><?php echo $form->labelEx($modOther, 'MembershipAssocOrg', array('style' => "width: 250px; text-align: center;")); ?></td>
                </tr>
            </table>
        </div>

        <div class="row">
<?php echo $form->textArea($modOther, 'SkillsHobbies', array('rows' => 6, 'cols' => 50, 'style' => "width: 322px;")); ?>
<?php echo $form->error($modOther, 'SkillsHobbies'); ?>

<?php echo $form->textArea($modOther, 'NonAcadRecognition', array('rows' => 6, 'cols' => 50, 'style' => "width: 313px;")); ?>
<?php echo $form->error($modOther, 'NonAcadRecognition'); ?>

<?php echo $form->textArea($modOther, 'MembershipAssocOrg', array('rows' => 6, 'cols' => 50, 'style' => "width: 317px;")); ?>
<?php echo $form->error($modOther, 'MembershipAssocOrg'); ?>
        </div>
    </fieldset>

    <fieldset class="myclass"> <!-- Queries -->
        <h4><i>IX.</i></h4>
        <div class="CSSTableGenerator">
            <table id="queries" border="1">
                <tr>
                    <td colspan="2"></td>
                </tr>

                <tr>
                    <td width="65%"><b>Are you related by consanguinity or affinity to any of the following :</b><br><br>
                        <b>a.</b> 	Within the third degree: <br>
                        appointing authority, recommending authority, chief of office/bureau/department or person who
                        has immediate supervision over you in the Office, Bureau, Department where you will be
                        appointed, with ECMCI and any affiliated with Eva Care Group?<br>
                    </td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'ThirdDegreeRelated', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
<?php echo $form->error($modQueries, 'ThirdDegreeRelated'); ?>
<?php echo $form->labelEx($modQueries, 'TDRdetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'TDRdetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr class="border_bottom">
                    <td width="65%"><b>b. </b>Within the fourth degree:<br>
                        appointing authority or recommending authority where you will be appointed?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'FourthDegreeRelated', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
<?php echo $form->error($modQueries, 'FourthDegreeRelated'); ?>
<?php echo $form->labelEx($modQueries, 'FDRdetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'FDRdetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><b>a. </b>Have you ever been formally charged?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'FormallyCharged', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
<?php echo $form->error($modQueries, 'FormallyCharged'); ?>
<?php echo $form->labelEx($modQueries, 'ChargedDetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'ChargedDetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><b>b. </b>Have you ever been guilty of any administrative offense?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'AdminOffense', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
<?php echo $form->error($modQueries, 'AdminOffense'); ?>
<?php echo $form->labelEx($modQueries, 'OffenseDetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'OffenseDetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Have you ever been convicted of any crime or violation of any law, decree, ordinance orregulation by any court or tribunal?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'CrimeConvicted', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
                            <?php echo $form->error($modQueries, 'CrimeConvicted'); ?>
<?php echo $form->labelEx($modQueries, 'CrimeDetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'CrimeDetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Have you ever been separated from the service in any of the following modes: resignation,
                        retirement, dropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or
                        phased out, in the public or private sector?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'SeparatedService', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
                            <?php echo $form->error($modQueries, 'SeparatedService'); ?>
                            <?php echo $form->labelEx($modQueries, 'SSdetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'SSdetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Have you ever been a candidate in a national or local election (except Barangay election)?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
                            <?php
                            echo $form->radioButtonList($modQueries, 'ElectionCandidate', array('1' => 'Yes', '0' => 'No'), array(
                                'template' => '{input}{label}',
                                'separator' => '',
                                'labelOptions' => array(//padding-left:5px;
                                    'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
                                'style' => 'float:left;',
                                    )
                            );
                            ?>
                            <div style="clear: both;"></div>
                            <?php echo $form->error($modQueries, 'ElectionCandidate'); ?>
                            <?php echo $form->labelEx($modQueries, 'ECdetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'ECdetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><b>Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA
                            7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:</b><br><br>

                        <b>a. </b>Are you a member of any indigenous group?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
<?php
echo $form->radioButtonList($modQueries, 'Indigenous', array('1' => 'Yes', '0' => 'No'), array(
    'template' => '{input}{label}',
    'separator' => '',
    'labelOptions' => array(//padding-left:5px;
        'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
    'style' => 'float:left;',
        )
);
?>
                            <div style="clear: both;"></div>
                            <?php echo $form->error($modQueries, 'Indigenous'); ?>
                            <?php echo $form->labelEx($modQueries, 'IndiDetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'IndiDetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><b>b. </b>Are you differently abled?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
<?php
echo $form->radioButtonList($modQueries, 'DiffAbled', array('1' => 'Yes', '0' => 'No'), array(
    'template' => '{input}{label}',
    'separator' => '',
    'labelOptions' => array(//padding-left:5px;
        'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
    'style' => 'float:left;',
        )
);
?>
                            <div style="clear: both;"></div>
                            <?php echo $form->error($modQueries, 'DiffAbled'); ?>
                            <?php echo $form->labelEx($modQueries, 'DAdetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'DAdetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><b>c. </b>Are you a solo parent?</td>
                    <td>
                        <!-- choices -->
                        <div class="row">
<?php
echo $form->radioButtonList($modQueries, 'SoloParent', array('1' => 'Yes', '0' => 'No'), array(
    'template' => '{input}{label}',
    'separator' => '',
    'labelOptions' => array(//padding-left:5px;
        'style' => '
														  
														  width: 30px;
														  float: left;
														 '),
    'style' => 'float:left;',
        )
);
?>
                            <div style="clear: both;"></div>
                            <?php echo $form->error($modQueries, 'SoloParent'); ?>
                            <?php echo $form->labelEx($modQueries, 'SPdetails', array('style' => "text-align: left;")); ?><?php echo $form->textArea($modQueries, 'SPdetails', array('rows' => 6, 'cols' => 50, 'style' => 'width: 325px; height: 17px;')); ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>

    <!-- import for "EmpRef" -->
                            <?php include '_ref.php'; ?>

    <!--	
            <div class="row pplref">
<?php echo $form->textField($modRef, 'RefName[]', array('size' => 60, 'maxlength' => 100, 'style' => "width: 380px")); ?>
<?php echo $form->error($modRef, 'RefName'); ?>
                    
<?php echo $form->textField($modRef, 'RefAdd[]', array('size' => 60, 'maxlength' => 150, 'style' => "width: 390px")); ?>
    <?php echo $form->error($modRef, 'RefAdd'); ?>
                    
<?php echo $form->textField($modRef, 'Telno[]', array('size' => 25, 'maxlength' => 25, 'style' => "width: 170px")); ?>
<?php echo $form->error($modRef, 'Telno'); ?>
            </div>
            
    <?php
    Yii::import('ext.jqrelcopy.JQRelcopy');
    $this->widget('ext.jqrelcopy.JQRelcopy', array(
        'id' => 'copyRef',
        'removeText' => 'X', //uncomment to add remove link
            )
    );
    ?>
            
            <div class="row copy">
                            <a id="copyRef" href="#" rel=".pplref">Add row</a>
            </div>
    -->


    <fieldset class="myclass"> <!-- Oath -->
        <table>
            <tr><td>
<?php echo $form->checkBox($model, 'CertifyTrue'); ?>
                    <font face="Arial" style="size:5px"><b>I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and
                        complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the
                        Philippines.<br><br>I also authorize the agency head / authorized representative to verify / validate the contents stated herein. I trust
                        that this information shall remain confidential.</b></font>
                </td>
            </tr>
        </table>


    </fieldset>

    <div class="row buttons" align="right">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class' => 'classname')); ?>
        <!--<?php echo CHtml::Button('Cancel', array('submit' => array('cancel'), 'class' => 'btnGray')); ?>-->
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->