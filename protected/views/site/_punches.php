<?php
Yii::app()->clientScript->registerScript("_punches-script-ready-js","
getPunches();
$('#Timesheet_TimeIn, #Timesheet_TimeOut').on('change',function(){
  getPunches(); 
});
",CClientScript::POS_READY); 
Yii::app()->clientScript->registerScript("_punches-script-js","
var url = '".Yii::app()->createAbsoluteUrl("timesheet/get",array('e'=>Yii::app()->user->getState('emp_id')))."';
var hrefOutlook = 'mailto:employee_attendance@evacare.com?subject=Time Correction Request from ".Yii::app()->user->getState('emp_name')."';
function getPunches()
{
  var tblData = $('#tblData');
  tblData.find('tbody').html('<img src=\"/hrips/images/preloader.gif\" style=\"height:50px;\" /> Loading punches...Please wait.');
  $.ajax({
    method : 'POST',
    data : $('#tc').serialize(),
    url : url,
    success : function(a,b,c){
      if(c.status == '200'){
        var rdata = $.parseJSON(a);        
        var d = '';
        $.each(rdata,function(k,v){
          var clockedIn = formatDate(v.TimeIn);
          var clockedOut = formatDate(v.TimeOut);
          d += '<tr>';
          d += '<td>'+clockedIn+'</td>';          
          d += '<td>'+clockedOut+'</td>';
          d += '<td>'+diffHours(clockedIn,clockedOut)+'</td>';
          d += '<td>'+((v.JobCode == '2001') ? 'Overtime' : 'Salary' )+'</td>';
          d += '<td>'+((v.BreakFlag == '1') ? 'Yes' : 'No' )+'</td>';
          d += '<td>'+(v.JobCode=='2001' ? getOtApplyLink(v.TimeIn,v.TimeOut) : '')+' <a href=\"'+hrefOutlook+'&body=Date and Time to Correct: '+formatDate(v.TimeIn)+' - '+formatDate(v.TimeOut)+', Job Code: '+v.JobCode+'\" alt=\"Request Correction\" title=\"Request Correction\"><i class=\"icon-edit\"></i></a></td>'
          d += '</tr>';          
        });
        tblData.find('tbody').html('');
        tblData.append(d);
      }  
    },
    error : function(a,b,c){
      console.log(a);
      $('#tblData').append('<tr class=\"error\"><td colspan=\"4\"><strong>ERROR '+a.status+' :</strong> '+a.responseText+'</td>');
    },
    complete : function(a,b,c){
    
    }
  });  
}
function getOtApplyLink(clockedIn,clockedOut){
  var clkIn = new Date(formatDate(clockedIn));
  var clkOut = new Date(formatDate(clockedOut));
  clkIn = clkIn.getFullYear()+'-'+(clkIn.getMonth()+1)+'-'+clkIn.getDate()+' '+clkIn.getHours()+':'+clkIn.getMinutes()+':00';
  clkOut = clkOut.getFullYear()+'-'+(clkOut.getMonth()+1)+'-'+clkOut.getDate()+' '+clkOut.getHours()+':'+clkOut.getMinutes()+':00';
  var hrefLnk = '".Yii::app()->createAbsoluteUrl('otextraction/otApplication/admin?')."';
  var hrefParams = 'OtApplication[from]='+clkIn+'&OtApplication[to]='+clkOut;
  return '<a href=\"'+hrefLnk+hrefParams+'\" target=\"_blank\"><i class=\"icon-share\" title=\"Apply Overtime\" alt=\"Apply Overtime\"></i><a/>';
}
function diffHours(d1,d2){
  if(!d2)return '';
  var one_hour = 3600000; //in ms
  var date1 = new Date(d1);
  var date2 = new Date(d2);
  var diff_ms = date2.getTime() - date1.getTime();
  var hours = Math.floor(diff_ms/one_hour);
  var mins = ((Math.abs(diff_ms - (hours * one_hour))) / (1000*60));
  hours = hours < 10 ? '0'+hours : hours;
  mins = mins < 10 ? '0'+mins : mins;
  return hours+':'+mins;
}
function formatDate(d){
  if(!d)return '';
  var datePart = d;
  datePart = datePart.split(':');
  var str = datePart[0]+':'+datePart[1]+' '+datePart[3].slice(3,5);
  return new Date(str).toLocaleString(); 
}
function resetPunchList(){
  $('form#tc').trigger('reset');
  getPunches();
}
",CClientScript::POS_BEGIN); 
?>
<div class="portlet">   
  <div class="portlet-decoration">
      <div class="portlet-title">
        <div class="row-fluid">
         <div class="span3">
          <i class="icon-list"></i>Your Worked Hours
         </div>
         <div class="span9">
             <div class="row-fluid">
              <form id="tc" action="#" method="get">
              <div class="span6">From:              
              <?php
               $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Timesheet[TimeIn]',
                    'options'=>array(
                      'changeMonth'=>true,
                      'changeYear'=>true
                    ),
                    'htmlOptions'=>array(
                        'placeholder'=>'From',
                    ),
                ));
              ?> 
              </div>
              <div class="span6">To:
               <?php
               $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    'name'=>'Timesheet[TimeOut]',
                    'options'=>array(
                      'changeMonth'=>true,
                      'changeYear'=>true
                    ),
                    'htmlOptions'=>array(
                        'placeholder'=>'To'
                    ),
                ));
              ?> 
              <a class="btn btn-mini" href="javascript:resetPunchList()">Reset</a>              
              </div>              
              </form>
             </div> 
         </div>
        </div>
      </div>
  </div>
  <div class="portlet-content">
    <table class="table table-condensed table-striped" id="tblData">
     <thead>
      <tr><th>In</th><th>Out</th><th>Hours</th><th>Job Code</th><th>Break After</th><th>Actions</th></tr>
     </thead>
     <tbody></tbody>
    </table>
  </div>
</div>