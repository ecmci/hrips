<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('emp_id')); ?>:
	<?php echo GxHtml::encode($data->emp_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('schedule')); ?>:
	<?php echo GxHtml::encode($data->schedule); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('datetime_in')); ?>:
	<?php echo GxHtml::encode($data->datetime_in); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('datetime_out')); ?>:
	<?php echo GxHtml::encode($data->datetime_out); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sched_in')); ?>:
	<?php echo GxHtml::encode($data->sched_in); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sched_out')); ?>:
	<?php echo GxHtml::encode($data->sched_out); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('job_code')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->jobCode)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('OT_code')); ?>:
	<?php echo GxHtml::encode($data->OT_code); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('breakflag')); ?>:
	<?php echo GxHtml::encode($data->breakflag); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('UTC_added')); ?>:
	<?php echo GxHtml::encode($data->UTC_added); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('process')); ?>:
	<?php echo GxHtml::encode($data->process); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('raw_mins_late')); ?>:
	<?php echo GxHtml::encode($data->raw_mins_late); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mins_late')); ?>:
	<?php echo GxHtml::encode($data->mins_late); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hrs_late')); ?>:
	<?php echo GxHtml::encode($data->hrs_late); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hrs_patch')); ?>:
	<?php echo GxHtml::encode($data->hrs_patch); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('updated_to_payroll')); ?>:
	<?php echo GxHtml::encode($data->updated_to_payroll); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Amt')); ?>:
	<?php echo GxHtml::encode($data->Amt); ?>
	<br />
	*/ ?>

</div>