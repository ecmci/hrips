<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('emp_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->emp)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('message')); ?>:
	<?php echo GxHtml::encode($data->message); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('timestamp')); ?>:
	<?php echo GxHtml::encode($data->timestamp); ?>
	<br />

</div>