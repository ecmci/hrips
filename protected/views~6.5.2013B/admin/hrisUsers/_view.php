<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('emp_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->emp_id), array('view', 'id' => $data->emp_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('password_md5')); ?>:
	<?php echo GxHtml::encode($data->password_md5); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('access_lvl_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->accessLvl)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dept_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->dept)); ?>
	<br />

</div>