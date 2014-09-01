<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/form-print.css'; ?>" />
<table class="print_tbl short_size_bp">
<thead>
    <tr class="center">
    <td class="logo" colspan="2"><img src="<?php echo Yii::app()->baseUrl; ?>/images/logo-ecmci.png"></td>
    <td class="hd1" colspan="2"><h1>Request For Leave of Absence Form</h1></td>
    </tr>
</thead>
<tbody>
<tr>
    <td class="label">ID:</td><td>1</td><td class="label">Date Submitted:</td><td><?php echo WebApp::formatDate($model->timestamp); ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Status:</td><td colspan="3">"<?php echo $model->getCurrentStatus(); ?>"</td>
</tr>
<tr>
    <td class="label">Name:</td><td><?php echo $model->emp->getFullName(); ?></td><td class="label">Employee ID:</td><td><?php echo $model->emp->Emp_ID; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Department:</td><td><?php echo $model->emp->Department; ?></td><td class="label">Position:</td><td><?php echo $model->emp->Position; ?></td>
</tr>
<tr>
    <td class="label">Type of Leave/Absence:</td><td><?php echo $model->jobCode->title; ?></td><td class="label">Hours Requested:</td><td><?php echo $model->hours_requested; ?></td>
</tr>
<tr>
    <td class="label">From:</td><td><?php echo WebApp::formatDate($model->from_datetime); ?></td><td class="label">To:</td><td><?php echo WebApp::formatDate($model->to_datetime); ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Reason:</td><td colspan="3"><?php echo $model->reason; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Reliever:</td><td><?php echo ($model->reliever!=null) ? $model->reliever->getFullName() : ''; ?></td><td class="label">Signed:</td><td><?php echo $model->reliever_approve_datetime; ?></td>
</tr>
<tr>
    <td class="label">Supervisor:</td><td><?php echo ($model->sup!=null) ? $model->sup->getFullName() : 'Pending...'; ?></td><td class="label">Signed:</td><td><?php echo WebApp::formatDate($model->sup_approve_datetime) ; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Note:</td><td colspan="3"><?php echo $model->sup_disapprove_reason; ?></td>
</tr>
<tr>
    <td class="label">Manager:</td><td><?php echo ($model->mgr!=null) ? $model->mgr->getFullName() : 'Pending...'; ?></td><td class="label">Signed:</td><td><?php echo WebApp::formatDate($model->mgr_approve_datetime) ; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Note:</td><td colspan="3"><?php echo $model->mgr_disapprove_reason; ?></td>
</tr>
<tr>
    <td class="label">Human Resource:</td><td><?php echo ($model->hr!=null) ? $model->hr->getFullName() : 'Pending...'; ?></td><td class="label">Signed:</td><td><?php echo WebApp::formatDate($model->hr_approve_datetime) ; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Note:</td><td colspan="3"><?php echo $model->mgr_disapprove_reason; ?></td>
</tr>
</tbody>
</table>
<input class="btn-print" value="Print This Page" onclick="window.print()" type="submit">