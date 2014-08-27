<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('next_lvl_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->nextLvl)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('emp_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->emp)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dept_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->dept)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_code_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->jobCode)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('from_datetime')); ?>:
	<?php echo GxHtml::encode($data->from_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('to_datetime')); ?>:
	<?php echo GxHtml::encode($data->to_datetime); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('hours_requested')); ?>:
	<?php echo GxHtml::encode($data->hours_requested); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hours_approved')); ?>:
	<?php echo GxHtml::encode($data->hours_approved); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reason')); ?>:
	<?php echo GxHtml::encode($data->reason); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('remarks')); ?>:
	<?php echo GxHtml::encode($data->remarks); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reliever_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->reliever)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reliever_approve')); ?>:
	<?php echo GxHtml::encode($data->reliever_approve); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reliever_approve_datetime')); ?>:
	<?php echo GxHtml::encode($data->reliever_approve_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sup_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->sup)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sup_approve')); ?>:
	<?php echo GxHtml::encode($data->sup_approve); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sup_approve_datetime')); ?>:
	<?php echo GxHtml::encode($data->sup_approve_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sup_disapprove_reason')); ?>:
	<?php echo GxHtml::encode($data->sup_disapprove_reason); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mgr_id')); ?>:
	<?php echo GxHtml::encode($data->mgr_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mgr_approve')); ?>:
	<?php echo GxHtml::encode($data->mgr_approve); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mgr_approve_datetime')); ?>:
	<?php echo GxHtml::encode($data->mgr_approve_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mgr_disapprove_reason')); ?>:
	<?php echo GxHtml::encode($data->mgr_disapprove_reason); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hr_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->hr)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hr_approve')); ?>:
	<?php echo GxHtml::encode($data->hr_approve); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hr_approve_datetime')); ?>:
	<?php echo GxHtml::encode($data->hr_approve_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hr_disapprove_reason')); ?>:
	<?php echo GxHtml::encode($data->hr_disapprove_reason); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('replicated_to_emp_hrs')); ?>:
	<?php echo GxHtml::encode($data->replicated_to_emp_hrs); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('timestamp')); ?>:
	<?php echo GxHtml::encode($data->timestamp); ?>
	<br />
	*/ ?>

</div>