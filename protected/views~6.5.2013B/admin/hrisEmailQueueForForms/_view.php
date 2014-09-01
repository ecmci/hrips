<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('template_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->template)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('to_group')); ?>:
	<?php echo GxHtml::encode($data->to_group); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('to_user')); ?>:
	<?php echo GxHtml::encode($data->to_user); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('to')); ?>:
	<?php echo GxHtml::encode($data->to); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('subject')); ?>:
	<?php echo GxHtml::encode($data->subject); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('content')); ?>:
	<?php echo GxHtml::encode($data->content); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('model_name')); ?>:
	<?php echo GxHtml::encode($data->model_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('model_id')); ?>:
	<?php echo GxHtml::encode($data->model_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sent')); ?>:
	<?php echo GxHtml::encode($data->sent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sent_timestamp')); ?>:
	<?php echo GxHtml::encode($data->sent_timestamp); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('timestamp')); ?>:
	<?php echo GxHtml::encode($data->timestamp); ?>
	<br />
	*/ ?>

</div>