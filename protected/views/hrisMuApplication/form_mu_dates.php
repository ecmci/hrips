<?php

Yii::app()->clientScript->registerScript('mu-dates',"
var iRow = 0;
$('#btn-add-mu-date').click(function(){
  var iRowId = 'row-'+ (iRow);
  var iRowRemove = 'removeRow(iRow)';
  var from = $('#mu-from').val();
  var to = $('#mu-to').val();
  var row = '<tr id=\"' + iRowId + '\"><td><input value=\"'+ from +'\" name=\"HrisMuApplication[from_datetime]['+ iRow +']\" type=\"text\" readonly></td><td><input value=\"'+ to +'\" name=\"HrisMuApplication[to_datetime]['+ iRow +']\" type=\"text\" readonly></td><td><a onclick=\"removeRow('+ iRow +')\" href=\"#top\">Remove</a></td></tr>';
  $('#tbl-mu-dates > tbody:last').append(row);
  iRow++;
  $('#mu-from').val('');
  $('#mu-to').val('');
  return false;  
});
");
Yii::app()->clientScript->registerScript('mu-dates',"
function removeRow(row){
  $('#row-' + row).remove();
  return false;
}
",CClientScript::POS_BEGIN);
?>
<div class="row-fluid">  
  <table id="tbl-mu-dates-form">
    <tr class="well">
      <th>From</th>
      <th>
      <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(    
          'id'=>'mu-from',
          'name'=>'mu-from',	    		    
  		    'options'=>array(
  		        'showAnim'=>'fade',
  		        'dateFormat'=>'yy-mm-dd',
  		        'timeFormat'=>'hh:mm:ss',
              'showMinute'=> true,            
  		    ),
  		    'language' => '',	
  			  //'mode'=>'date',
  		  ));?>
      </th>
      <th>To</th>
      <th>
      <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(    
          'id'=>'mu-to',
          'name'=>'mu-to',	    		    
  		    'options'=>array(
  		        'showAnim'=>'fade',
  		        'dateFormat'=>'yy-mm-dd',
  		        'timeFormat'=>'hh:mm:ss',
              'showMinute'=> true,            
  		    ),
  		    'language' => '',	
  			  //'mode'=>'date',
  		  ));?>
      </th>
      <th><a id="btn-add-mu-date" class="btn" href="#tbl-mu-dates-form">Add</a></th>  
    </tr>
  </table>  
</div>
<div class="row-fluid" style="max-height:250px; overflow:auto;">  
  <table id="tbl-mu-dates" class="table table-condensed">
    <thead>
    <tr>
      <th>From</th>
      <th>To</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    
    </tbody>
  </table>  
</div>