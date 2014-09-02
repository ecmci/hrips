<?php
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'For My Approval'),
);
$data = $model->getLOAForApproval();
$loa_list = GxHtml::listDataEx(JobCode::model()->findAll(array('condition'=> "title LIKE '%LOA%'",'order'=>'title asc')));

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/DT_bootstrap.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.dataTables.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/DT_bootstrap.js');
Yii::app()->clientScript->registerScript('ot-approvals-begin-js',"
var loaDT = null;    
",CClientScript::POS_BEGIN);
Yii::app()->clientScript->registerScript('ot-approvals-ready-js',"
loaDT = $('#loa-approvals').dataTable( {
    'drawCallback': function( settings ) {
        bindCheckboxes();
    },
    'dom': '<\"row-fluid\"<\"span6\"f><\"span6\"l>>t<\"row-fluid\"<\"span6\"i><\"span6\"p>>',
});
",CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('ot-approvals-js',"
var btnSave = $('#btnSave');
var btnDeny = $('#btnDeny');
var btnApprove = $('#btnApprove');
function approve(){
    var url = '".Yii::app()->createUrl('hrisLoaApplication/approve')."';
    if(confirm('This action will approve and sign off the LOA(s). Are you sure you want to approve these LOA(s)?')){
        btnApprove.html('Approving... Please wait.');
        btnApprove.attr('disabled','disabled');
        btnDeny.attr('disabled','disabled');
        btnSave.attr('disabled','disabled');
        var data = loaDT.$('input,select').serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success:function(data,textStatus,jqXHR){
                $('div#page-submit-success #message').html('<h5><b>Saved</b></h5><p>'+data+'</p>');
                $('div#page-submit-success').fadeIn('fast',function(){
                    $(this).delay(5000).fadeOut('fast',function(){
                        location.reload();
                    });
                });
            },
            error:function(jqXHR,textStatus,errorThrown){            
                $('div#page-submit-error #message').html('<p><b>Unable to proceed with your request.</b></p><p>Error '+jqXHR.status+': '+jqXHR.responseText+'</p>');
                $('div#page-submit-error').fadeIn('fast',function(){
                    $(this).delay(5000).fadeOut('fast');
                });                
            },
            complete:function(){
                btnApprove.html('Approve');
                btnDeny.removeAttr('disabled');
                btnSave.removeAttr('disabled');
                btnApprove.removeAttr('disabled');
            }
        });
    }
}
function deny(){  
  var url = '".Yii::app()->createUrl('hrisLoaApplication/deny')."';
  if(confirm('This action will deny the LOA(s). Are you sure you want to deny the these LOA(s)?')){
        var reason = prompt('State the reason for denial.');
        btnDeny.html('Denying... Please wait.');
        btnDeny.attr('disabled','disabled');
        btnApprove.attr('disabled','disabled');
        btnSave.attr('disabled','disabled');
        $('#denial-reason').val(reason);
        var data = loaDT.$('input,select').serialize();
        data = data + '&r=' + reason;
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success:function(data,textStatus,jqXHR){
                $('div#page-submit-success #message').html('<h5><b>Saved</b></h5><p>'+data+'</p>');
                $('div#page-submit-success').fadeIn('fast',function(){
                    $(this).delay(5000).fadeOut('fast',function(){
                        location.reload();
                    });
                });
            },
            error:function(jqXHR,textStatus,errorThrown){            
                $('div#page-submit-error #message').html('<p><b>Unable to proceed with your request.</b></p><p>Error '+jqXHR.status+': '+jqXHR.responseText+'</p>');
                $('div#page-submit-error').fadeIn('fast',function(){
                    $(this).delay(5000).fadeOut('fast');
                });                
            },
            complete:function(){
                btnSave.html('Save');
                btnDeny.removeAttr('disabled');
                btnApprove.removeAttr('disabled');
                btnSave.removeAttr('disabled');
            }
        });
    }
}
function save(){
    var url = '".Yii::app()->createUrl('hrisLoaApplication/saveapprovals')."';
    if(confirm('This action will only save the changes but not sign off the LOA(s). Are you sure you want to save the changes?')){
        btnSave.html('Saving... Please wait.');
        btnDeny.attr('disabled','disabled');
        btnApprove.attr('disabled','disabled');
        btnSave.attr('disabled','disabled');
        var data = loaDT.$('input,select').serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success:function(data,textStatus,jqXHR){
                $('div#page-submit-success #message').html('<h5><b>Saved</b></h5><p>'+data+'</p>');
                $('div#page-submit-success').fadeIn('fast',function(){
                    $(this).delay(5000).fadeOut('fast');
                });
            },
            error:function(jqXHR,textStatus,errorThrown){            
                $('div#page-submit-error #message').html('<p><b>Unable to proceed with your request.</b></p><p>Error '+jqXHR.status+': '+jqXHR.responseText+'</p>');
                $('div#page-submit-error').fadeIn('fast',function(){
                    $(this).delay(5000).fadeOut('fast');
                });                
            },
            complete:function(){
                btnSave.html('Save');
                btnDeny.removeAttr('disabled');
                btnApprove.removeAttr('disabled');
                btnSave.removeAttr('disabled');
            }
        });
    }
}
function bindCheckboxes(){
    $('input.checkbox-selector').on('click',function(){
        if($(this).is(':checked')){
            $('#row'+$(this).val()).val('1');
        }else{
            $('#row'+$(this).val()).val('0');
        }
    });
}
",CClientScript::POS_END);
?>

<h1 class="page-header"><?php echo Yii::t('app', 'LOA For My Approval'); ?></h1>

<?php 
$this->beginWidget('GxActiveForm', array(
    'id' => 'hris-loa-application-form-approval',
));
?>
<table id="loa-approvals" class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th></th>
      <th>ID</th>
      <th>Employee</th>      
      <th>From</th>
      <th>To</th>
      <th>Hours</th>
      <th>Type</th>
      <th width="200">Reason</th>
      <th>Submitted</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data->getData() as $row=>$d): ?>
    <tr>  
      <td><input type="checkbox" class="checkbox-selector" value="<?php echo $row;?>"><input type="hidden" id="row<?php echo $row;?>" value="0" name="loa[<?php echo $row;  ?>][edit]" /><input type="hidden" id="row<?php echo $d->id;?>" value="<?php echo $d->id?>" name="loa[<?php echo $row?>][id]" /></td>
      <td><?php echo $d->id;?></td>
      <td><?php echo $d->emp->getEmpIdFullName();?></td>      
      <td><?php echo WebApp::formatDate($d->from_datetime);?></td>
      <td><?php echo WebApp::formatDate($d->to_datetime);?></td>
      <td><?php echo $d->hours_requested;?></td>
      <td><?php echo CHtml::dropDownList("loa[$row][job_code_id]",$d->job_code_id,$loa_list); ?></td>
      <td width="200"><?php echo $d->reason;?></td>
      <td><?php echo WebApp::formatDate($d->timestamp);?></td>
      <td><?php echo CHtml::link('<i class="icon icon-eye-open"></i>',Yii::app()->createUrl('hrisLoaApplication/formyapprovalview',array('id'=>$d->id)),array('target'=>'_blank')); ?></td>
    </tr>
    <?php endforeach; ?>   
  </tbody>
</table>

<?php 
$this->endWidget('GxActiveForm');
?>

<div class="row-fluid" id="page-submit-error" style="display:none;">
    <div class="span12 alert alert-error" id="message"></div>
</div>
<div class="row-fluid" id="page-submit-success" style="display:none;">
    <div class="span12 alert alert-success" id="message"></div>
</div>
<div class="row-fluid">
  <div class="span4"><button onclick="approve()" id="btnApprove" class="btn btn-success btn-large btn-block">Approve</button></div>
  <div class="span4"><button onclick="deny()" id="btnDeny" class="btn btn-danger btn-large btn-block">Deny</button></div>
  <div class="span4"><button onclick="save()" id="btnSave" class="btn btn-info btn-large btn-block">Save</button></div> 
</div>