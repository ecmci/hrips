<?php
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'For My Approval'),
);
$data = $model->getOTForApproval();
$ot_list = CHtml::listData(OtSubCode::model()->findAll(),"ot_code","title");

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/DT_bootstrap.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.dataTables.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/DT_bootstrap.js');
Yii::app()->clientScript->registerScript('ot-approvals-begin-js',"
    var DT = null;
",CClientScript::POS_BEGIN);
Yii::app()->clientScript->registerScript('ot-approvals-ready-js',"
DT = $('#ot-approvals').dataTable( {
    'drawCallback':function(){
        bindCheckboxEditEvt();
        $('#check-all').removeAttr('checked');
    }
} );
$('#check-all').on('click',function(){
    if($(this).is(':checked')){
        $('.checkbox-edit').attr('checked','checked');        
    }else{
        $('.checkbox-edit').removeAttr('checked');
    }
    $('.checkbox-edit').each(function(){
        if($(this).is(':checked')){
            $('#row'+$(this).val()).val('1');
        }else{
            $('#row'+$(this).val()).val('0');
        }
    });
});
",CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('ot-approvals-js',"
var url = '';
var btnSave = $('#btnSave');
var btnDeny = $('#btnDeny');
var btnApprove = $('#btnApprove');
var isDeny = false;
function approve(){
    if(confirm('This action will approve the selected records. Are you sure you want to proceed?')){  
        url = '".Yii::app()->createUrl('hrisOtApplication/approve')."';
        btnApprove.html('Approving... Please wait.');
        submit();
    }
}
function deny(){
    if(confirm('This action will deny the selected records. Are you sure you want to proceed?')){
        $('#r').val(prompt('State the reason for denying'));
        url = '".Yii::app()->createUrl('hrisOtApplication/deny')."';
        btnDeny.html('Denying... Please wait.');
        submit();
    }
}
function save(){
    url = '".Yii::app()->createUrl('hrisOtApplication/save')."'; 
    btnSave.html('Saving... Please wait.');
    submit();
}
function submit()
{
    btnSave.attr('disabled','disabled');
    btnDeny.attr('disabled','disabled');
    btnApprove.attr('disabled','disabled');
    
    var data = DT.$('input,select').serialize();
    data = data + '&r=' + $('#r').val();
    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        success : function(data,textStatus,jqXHR){
            $('#message-success #message').html('<h5>Success</h5><p>'+data+'</p>');
            $('#message-success').slideDown(function(){
                $(this).delay(5000).slideUp(function(){ location.reload(); });
            });
        },
        error : function(jqXHR,textStatus,errorThrown){
            $('#message-error #message').html('<h5>Error '+jqXHR.status+'</h5><p>'+jqXHR.responseText+'</p>');
            $('#message-error').slideDown(function(){
                $(this).delay(5000).slideUp();
            });
        },
        complete : function(){
                btnSave.html('Save');
                btnDeny.html('Deny');
                btnApprove.html('Approve');

                btnSave.removeAttr('disabled');
                btnDeny.removeAttr('disabled');
                btnApprove.removeAttr('disabled');
        }
    });
}
function bindCheckboxEditEvt() 
{
    $('.checkbox-edit').on('click',function(){
        if($(this).is(':checked')){
            $('#row'+$(this).val()).val('1');
        }else{
            $('#row'+$(this).val()).val('0');
        }
    });
}
",CClientScript::POS_END);
?>

<h1 class="page-header"><?php echo Yii::t('app', 'Overtime For My Approval'); ?></h1>

<table id="ot-approvals" class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th><input type="checkbox" id="check-all" /></th>
      <th>ID</th>
      <th>Employee</th>      
      <th>In</th>
      <th>Out</th>
      <th>Rendered</th>
      <th>Approved</th>
      <th>Type</th>
      <th width="200">Reason</th>
      <th>Submitted</th>
      <th></th>
    </tr>
    <tr>
      <td><input name="r" id="r" type="hidden"/></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data->getData() as $row=>$d): ?>
    <tr>
      <td>
          <input type="checkbox" name="row[]" class="checkbox-edit" value="<?php echo $row;?>">
          <input type="hidden" name="ot[<?php echo $row;?>][edit]" class="" value="0" id="row<?php echo $row;?>">
          <input type="hidden" name="ot[<?php echo $row;?>][id]" class="" value="<?php echo $d->id;?>">
          
      </td>
      <td><?php echo $d->id; ?></td>
      <td><?php echo $d->emp->getEmpIdFullName(); ?></td>
      <td><?php echo WebApp::formatDate($d->in_datetime); ?></td>
      <td><?php echo WebApp::formatDate($d->out_datetime); ?></td>
      <td><?php echo WebApp::actualHours($d->in_datetime,$d->out_datetime); ?></td>
      <td><?php echo $d->renderApprovedHours($d,$row); ?></td>
      <td><?php echo CHtml::dropDownList("ot[$row][sub_code_id]",$d->sub_code_id,$ot_list); ?></td>      
      <td><?php echo $d->reason; ?></td>
      <td><?php echo WebApp::formatDate($d->timestamp); ?></td>
      <td><a href="<?php echo Yii::app()->createUrl('hrisOtApplication/formyapprovalview',array('id'=>$d->id)); ?>" target="_blank"><i class="icon-eye-open"></i></a></td>
    </tr>
    <?php endforeach; ?>    
  </tbody>   
</table>
<div class="row-fluid" id="message-success" style="display:none;">
    <div class="alert alert-success" id="message">
        
    </div>    
</div>
<div class="row-fluid" id="message-info" style="display:none;">
    <div class="alert alert-info" id="message">
        
    </div>    
</div>
<div class="row-fluid" id="message-error" style="display:none;">
    <div class="alert alert-error" id="message">
        
    </div>    
</div>
<div class="row-fluid">
  <div class="span4"><button onclick="approve()" id="btnApprove" class="btn btn-success btn-large btn-block">Approve</button></div>
  <div class="span4"><button onclick="deny()" id="btnDeny" class="btn btn-danger btn-large btn-block">Deny</button></div>
  <div class="span4"><button onclick="save()" id="btnSave" class="btn btn-info btn-large btn-block">Save</button></div> 
</div>