<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('category_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->category)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('author_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->author)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
	<?php echo GxHtml::encode($data->description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_timestamp')); ?>:
	<?php echo GxHtml::encode($data->created_timestamp); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('updated_timestamp')); ?>:
	<?php echo GxHtml::encode($data->updated_timestamp); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('filename_storage')); ?>:
	<?php echo GxHtml::encode($data->filename_storage); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('filename_real')); ?>:
	<?php echo GxHtml::encode($data->filename_real); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('active')); ?>:
	<?php echo GxHtml::encode($data->active); ?>
	<br />
	*/ ?>

</div>