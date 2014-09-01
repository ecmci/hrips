<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('doc_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->doc)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dept_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->dept)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create')); ?>:
	<?php echo GxHtml::encode($data->create); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('update')); ?>:
	<?php echo GxHtml::encode($data->update); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('delete')); ?>:
	<?php echo GxHtml::encode($data->delete); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('admin')); ?>:
	<?php echo GxHtml::encode($data->admin); ?>
	<br />
	*/ ?>

</div>