<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/form-print.css'; ?>" />
<table class="print_tbl short_size_bp">
<thead>
    <tr class="center">
    <td class="logo" colspan="2"><img src="<?php echo Yii::app()->baseUrl; ?>/images/logo-ecmci.png"></td>
    <td class="hd1" colspan="2"><h1>Overtime Authorization Form</h1></td>
    </tr>
</thead>
<tbody>
<tr>
    <td class="label">ID:</td><td><?php echo $model->id; ?></td><td class="label">Date Submitted:</td><td><?php echo WebApp::formatDate($model->timestamp); ?></td>
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
    <td class="label">From:</td><td><?php echo WebApp::formatDate($model->in_datetime); ?></td><td class="label">To:</td><td><?php echo WebApp::formatDate($model->out_datetime); ?></td>
</tr>
<tr>
    <td class="label">Hours Rendered:</td><td><?php echo WebApp::getTimeDifferenceInHrs($model->in_datetime,$model->out_datetime); ?></td><td class="label">Hours Approved:</td><td><?php echo $model->approved_hours; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Reason:</td><td colspan="3"><?php echo $model->reason; ?></td>
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
<tr>
    <td class="label">Employer:</td><td><?php echo ($model->employer!=null) ? $model->employer->getFullName() : 'Pending...'; ?></td><td class="label">Signed:</td><td><?php echo WebApp::formatDate($model->employer_approve_datetime) ; ?></td>
</tr>
<tr class="border-bottom">
    <td class="label">Note:</td><td colspan="3"><?php echo $model->employer_disapprove_reason; ?></td>
</tr>
</tbody>
</table>
<input class="btn-print" value="Print This Page" onclick="window.print()" type="submit">