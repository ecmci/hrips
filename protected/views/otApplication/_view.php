<?php
/* @var $this OtApplicationController */
/* @var $data OtApplication */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_id')); ?>:</b>
	<?php echo CHtml::encode($data->dept_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_lvl_id')); ?>:</b>
	<?php echo CHtml::encode($data->next_lvl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_code_id')); ?>:</b>
	<?php echo CHtml::encode($data->job_code_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_code_id')); ?>:</b>
	<?php echo CHtml::encode($data->sub_code_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('in_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->in_datetime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('out_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->out_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ifexistid')); ?>:</b>
	<?php echo CHtml::encode($data->ifexistid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approved_hours')); ?>:</b>
	<?php echo CHtml::encode($data->approved_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_id')); ?>:</b>
	<?php echo CHtml::encode($data->sup_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_approve')); ?>:</b>
	<?php echo CHtml::encode($data->sup_approve); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_approve_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->sup_approve_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_disapprove_reason')); ?>:</b>
	<?php echo CHtml::encode($data->sup_disapprove_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mgr_id')); ?>:</b>
	<?php echo CHtml::encode($data->mgr_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mgr_approve')); ?>:</b>
	<?php echo CHtml::encode($data->mgr_approve); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mgr_approve_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->mgr_approve_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mgr_disapprove_reason')); ?>:</b>
	<?php echo CHtml::encode($data->mgr_disapprove_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hr_id')); ?>:</b>
	<?php echo CHtml::encode($data->hr_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hr_approve')); ?>:</b>
	<?php echo CHtml::encode($data->hr_approve); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hr_approve_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->hr_approve_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hr_disapprove_reason')); ?>:</b>
	<?php echo CHtml::encode($data->hr_disapprove_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employer_id')); ?>:</b>
	<?php echo CHtml::encode($data->employer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employer_approve')); ?>:</b>
	<?php echo CHtml::encode($data->employer_approve); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employer_approve_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->employer_approve_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employer_disapprove_reason')); ?>:</b>
	<?php echo CHtml::encode($data->employer_disapprove_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('replicated_to_emp_hrs')); ?>:</b>
	<?php echo CHtml::encode($data->replicated_to_emp_hrs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_entered')); ?>:</b>
	<?php echo CHtml::encode($data->is_entered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	*/ ?>

</div>