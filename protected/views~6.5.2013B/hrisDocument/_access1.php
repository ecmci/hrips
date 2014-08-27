<?php  
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/hahay.js");
?>
<div class="row">
  <fieldset><legend>Access Rules</legend>
    <div class="alert alert-info">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong><i class="icon-warning-sign"></i> Note:</strong> 
      <br />Selecting a department will automatically grant access to ALL members of that department. Otherwise, define only certain users who can access this document.  
    </div>
    <fieldset><legend><small>Grant Access</small></legend>
      <table id="" class="table table-condensed">
        <thead>         
              <tr>
                  <th>Select</th>
                  <th>Read</th>
                  <th>Update</th>
                  <th>Delete</th>
                  <th>Options</th>
              </tr>
              <tr class="info">
                  <td><?php echo CHtml::dropDownList('', '', GxHtml::listDataEx(HrisDept::model()->findAllAttributes(null, true)),array('id'=>'dept_id','empty'=>'-Select A Department-')); ?></td>
                  <td><input type="checkbox" id="addDept-read" checked="checked" /></td>
                  <td><input type="checkbox" id="addDept-update"></td>
                  <td><input type="checkbox" id="addDept-delete"></td>
                  <td><button id="addDeptBtn" class="btn btn-small" type="button">Add Department</button></td>
              </tr>
              <tr class="info">
                  <td><?php echo CHtml::dropDownList('', '', CHtml::listData(HrisUsers::model()->findAll(),'emp_id','fullName'),array('id'=>'user_id','empty'=>'-Select A User-')); ?></td>
                  <td><input type="checkbox" id="addUser-read" checked="checked" /></td>
                  <td><input type="checkbox" id="addUser-update"></td>
                  <td><input type="checkbox" id="addUser-delete"></td>
                  <td><button id="addUserBtn" class="btn btn-small" type="button">Add User</button></td>
              </tr>
         </thead>               
      </table>
    </fieldset><!--Grant Access-->
    
    <fieldset><legend><small>Access Summary</small></legend>
      <table id="access" class="table table-condensed">
          <caption><h4></h4></caption>
          <thead>         
              <tr>
                  <th>User</th>
                  <th>Department</th>
                  <th>Read</th>
                  <th>Update</th>
                  <th>Delete</th>
                  <th>Options</th>
              </tr>
          </thead>
          <tbody>
              <?php
                   foreach($access as $i=>$acd){
                      echo "<tr id='deptRow$i'>";
                      echo '<td>'.CHtml::activeHiddenField($acd,"[$i]user_id").$acd->user->Fname.' '.$acd->user->Lname.(($acd->user_id == Yii::app()->user->getState('emp_id')) ? ' (You) ' : '').'</td>';
                      echo '<td>'.CHtml::activeHiddenField($acd,"[$i]dept_id").$acd->dept->title.'</td>';
                      echo '<td>'.CHtml::activeCheckbox($acd,"[$i]read").'</td>';
                      echo '<td>'.CHtml::activeCheckbox($acd,"[$i]update").'</td>';
                      echo '<td>'.CHtml::activeCheckbox($acd,"[$i]delete").'</td>';
                      echo ($acd->user_id == Yii::app()->user->getState('emp_id')) ? "<td>Default</td>" : "<td><button onclick='$(\"#deptRow$i\").fadeOut(300,function(){jQuery(\"#deptRow$i\").remove();});return false;' class='btn btn-mini' type='button'>Remove</button></td>";
                      echo '</tr>';                    
                   }               
                  ?>               
  
          </tbody>
      </table>    
    </fieldset><!--Access Summary-->
  </fieldset><!--Access Rules-->
</div><!--span6-->


       


