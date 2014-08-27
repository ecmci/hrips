<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('category_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->category)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reported_by_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->reportedBy)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_by_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->createdBy)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('notes')); ?>:
	<?php echo GxHtml::encode($data->notes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_timestamp')); ?>:
	<?php echo GxHtml::encode($data->created_timestamp); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('closed_timestamp')); ?>:
	<?php echo GxHtml::encode($data->closed_timestamp); ?>
	<br />
	*/ ?>

</div>