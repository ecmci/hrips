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
Yii::app()->clientScript->registerScript('ot-approvals-ready-js',"
$('#ot-approvals').dataTable( {
	\"sDom\": \"<'row-fluid'<'span3'f><'span3'l><'span3'p><'span3'i>r>t<'row-fluid'<'span3'f><'span3'l><'span3'p><'span3'i>r>\"
} );
$.extend( $.fn.dataTableExt.oStdClasses, {
    \"sWrapper\": \"dataTables_wrapper form-inline\"
} );
",CClientScript::POS_READY);
Yii::app()->clientScript->registerCss('ot-approvals-css',"
.dataTables_wrappers .rows{
	padding-left:30px;
}
");
Yii::app()->clientScript->registerScript('ot-approvals-js',"
function approve(){
  alert('To implement approve');
}
function deny(){
  alert('To implement deny');
}
function save(){
  alert('To implement save');
}
",CClientScript::POS_END);
?>

<h1 class="page-header"><?php echo Yii::t('app', 'Overtime For My Approval'); ?></h1>

<table id="ot-approvals" class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th></th>
      <th>ID</th>
      <th>Employee</th>      
      <th>In</th>
      <th>Out</th>
      <th>Rendered</th>
      <th>Approved</th>
      <th>Type</th>
      <th width="200">Reason</th>
      <th>Submitted</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data->getData() as $row=>$d): ?>
    <tr>
      <td><input type="checkbox" name="row[]" value="<?php echo $row;?>"></td>
      <td><?php echo $d->id; ?></td>
      <td><?php echo $d->emp->getEmpIdFullName(); ?></td>
      <td><?php echo WebApp::formatDate($d->in_datetime); ?></td>
      <td><?php echo WebApp::formatDate($d->out_datetime); ?></td>
      <td><?php echo WebApp::actualHours($d->in_datetime,$d->out_datetime); ?></td>
      <td><?php echo $d->renderApprovedHours($d,$row); ?></td>
      <td><?php echo CHtml::dropDownList("ot[$row][sub_code_id]",$d->sub_code_id,$ot_list); ?></td>      
      <td><?php echo $d->reason; ?></td>
      <td><?php echo WebApp::formatDate($d->timestamp); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>   
</table>
<div class="row-fluid">
  <div class="span4"><button onclick="approve()" id="btnApprove" class="btn btn-success btn-large btn-block">Approve</button></div>
  <div class="span4"><button onclick="deny()" id="btnDeny" class="btn btn-danger btn-large btn-block">Deny</button></div>
  <div class="span4"><button onclick="save()" id="btnSave" class="btn btn-info btn-large btn-block">Save</button></div> 
</div>