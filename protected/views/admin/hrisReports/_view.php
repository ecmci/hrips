<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sql_stmt')); ?>:
	<?php echo GxHtml::encode($data->sql_stmt); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_by_user_id')); ?>:
	<?php echo GxHtml::encode($data->created_by_user_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_timestamp')); ?>:
	<?php echo GxHtml::encode($data->created_timestamp); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('last_updated_timestamp')); ?>:
	<?php echo GxHtml::encode($data->last_updated_timestamp); ?>
	<br />

</div>