<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('emp_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->emp)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_code_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->jobCode)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('clockedin_datetime')); ?>:
	<?php echo GxHtml::encode($data->clockedin_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('clockedout_datetime')); ?>:
	<?php echo GxHtml::encode($data->clockedout_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('from_datetime')); ?>:
	<?php echo GxHtml::encode($data->from_datetime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('to_datetime')); ?>:
	<?php echo GxHtml::encode($data->to_datetime); ?>
	<br />
	<?php /*
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
	*/ ?>

</div>